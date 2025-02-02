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


if(!$USER->IsAuthorized()){
    $arResult["AUTH_USER"] = false;

}
else{
    $arResult["AUTH_USER"] = true;
}

if($this->StartResultCache(false, $USER->GetGroups()) && $USER->IsAuthorized()) {
	//iblock elements
	$arSelectElems = array (
		"ID",
		"IBLOCK_ID",
		"NAME",
        "PROPERTY_{$arParams["AUTHOR_FIELD_KEY"]}",
	);
	$arFilterElems = array (
        "!PROPERTY_{$arParams["AUTHOR_FIELD_KEY"]}" => $USER->GetID(),
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
		$arResult["NEWS"][] = $arElement;
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
        if($arUser["ID"] == $USER->GetID()) {
            $UserIGroup = $arUser[$arParams["TYPE_AUTHOR_FIELD_KEY"]];
        }
        else {
            $arResult["USERS"][] = $arUser;
        }
	}


    foreach ($arResult["USERS"] as $i => $user) {
        if($UserIGroup != $user[$arParams["TYPE_AUTHOR_FIELD_KEY"]])
        {
            unset($arResult["USERS"][$i]);
        }
    }

    $uniqueNews = [];
    foreach ($arResult["USERS"] as $i => $user) {
        foreach ($arResult["NEWS"] as $news) {
            if ($user["ID"] == $news["PROPERTY_".$arParams["AUTHOR_FIELD_KEY"]."_VALUE"]) {
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
else if($arResult["AUTH_USER"]) {
    $this->AbortResultCache();
}
else {
    $this->includeComponentTemplate();
}
$APPLICATION->SetTitle(GetMessage("TITLE_71", ["#COUNT#"=>$arResult["COUNT"]]));

