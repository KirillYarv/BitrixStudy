<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}
global $USER;

$userIID = $USER->GetID();

if(!$arParams["NEWS_IBLOCK_ID"]) {
    $arParams["NEWS_IBLOCK_ID"] = 0;
}
if(!$arParams["AUTHOR_FIELD_KEY"]) {
    $arParams["AUTHOR_FIELD_KEY"] = "";
}
if(!$arParams["TYPE_AUTHOR_FIELD_KEY"]) {
    $arParams["TYPE_AUTHOR_FIELD_KEY"] = "";
}
if(!$arParams["CACHE_TIME"]) {
    $arParams["CACHE_TIME"] = 36000000;
}

$arParams["AUTHOR_FIELD_KEY"] = trim($arParams["AUTHOR_FIELD_KEY"]);
$arParams["TYPE_AUTHOR_FIELD_KEY"] = trim($arParams["TYPE_AUTHOR_FIELD_KEY"]);


if($this->StartResultCache(false, $USER->GetGroups())) {
	//iblock elements
	$arSelectElems = array (
		"ID",
		"IBLOCK_ID",
		"NAME",
        "PROPERTY_{$arParams["AUTHOR_FIELD_KEY"]}",
	);
	$arFilterElems = array (
		"IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
		"ACTIVE" => "Y"
	);
	$arSortElems = array (
			"NAME" => "ASC"
	);
	
	$arResult["NEWS"] = array();
	$rsElements = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);

	while($arElement = $rsElements->GetNext())
	{
		$arResult["NEWS"][$arElement["ID"]]["ID"] = $arElement["ID"];
        $arResult["NEWS"][$arElement["ID"]]["NAME"] = $arElement["NAME"];
		$arResult["NEWS"][$arElement["ID"]]["DISPLAY_PROPERTY_{$arParams["AUTHOR_FIELD_KEY"]}"][] = $arElement["PROPERTY_{$arParams["AUTHOR_FIELD_KEY"]}_VALUE"];
	}
	foreach ($arResult["NEWS"] as $key => $news) {
        if(in_array($userIID, $news["DISPLAY_PROPERTY_{$arParams["AUTHOR_FIELD_KEY"]}"])) {
            unset($arResult["NEWS"][$key]);
        }
    }

	// user

    $UserIGroup = -1;

	$arOrderUser = array("id");
	$sortOrder = "asc";
	$arFilterUser = array(
		"ACTIVE" => "Y"
	);
	
	$arResult["USERS"] = array();

	$rsUsers = CUser::GetList(
        $arOrderUser,
        $sortOrder,
        $arFilterUser,
        ["SELECT"=>[$arParams["TYPE_AUTHOR_FIELD_KEY"]]]
    ); // выбираем пользователей
	while($arUser = $rsUsers->GetNext())
	{
        if($arUser["ID"] == $userIID) {
            $UserIGroup = $arUser[$arParams["TYPE_AUTHOR_FIELD_KEY"]];
        }
        else {
            $arResult["USERS"][] = $arUser;
        }
	}

    //Убираем группы НЕ пользователя
    foreach ($arResult["USERS"] as $i => $user) {
        if($UserIGroup != $user[$arParams["TYPE_AUTHOR_FIELD_KEY"]])
        {
            unset($arResult["USERS"][$i]);
        }
    }

    //Добавляем новости пользователям
    $uniqueNews = [];
    foreach ($arResult["USERS"] as $i => $user) {
        foreach ($arResult["NEWS"] as $news) {
            if (in_array($user["ID"], $news["DISPLAY_PROPERTY_".$arParams["AUTHOR_FIELD_KEY"]])) {
                $arResult["USERS"][$i]["NEWS"][] = $news;
                $uniqueNews[$news["ID"]] = 0;
            }
        }
    }

    $count = count($uniqueNews);
    unset($arResult["NEWS"]);

    $arResult["COUNT"] = $count;
    $this->SetResultCacheKeys(["COUNT"]);

    $this->includeComponentTemplate();

}
else {
    $this->AbortResultCache();
}

$APPLICATION->SetTitle(GetMessage("TITLE_71", ["#COUNT#"=>$arResult["COUNT"]]));

