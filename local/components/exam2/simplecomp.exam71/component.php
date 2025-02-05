<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}
$arParams["COUNT_ELEMENT"] = intval($arParams["COUNT_ELEMENT"]);

function GetProduct(&$arResult, $arParams) {
    if(intval($arParams["PRODUCTS_IBLOCK_ID"]) <= 0) {return false;}

    //iblock elements
    $arSelectElems = array (
        "ID",
        "IBLOCK_ID",
        "DETAIL_PAGE_URL",
        "NAME",
        "CODE",
        "SORT",
        "IBLOCK_SECTION_ID",
        "PROPERTY_CLASSIFIER",
        "PROPERTY_PRICE",
        "PROPERTY_MATERIAL",
        "PROPERTY_ARTNUMBER",
    );
    $arFilterElems = array (
        "IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
        ">PROPERTY_CLASSIFIER" => 0,
        "ACTIVE" => "Y"
    );
    $arSortElems = array(
        "NAME" => "ASC",
        "SORT" => "ASC"
    );

    $arResult["ELEMENTS"] = array();
    $rsElements = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
    $rsElements->SetUrlTemplates($arParams["TEMPLATE_DETAIL_PRODUCT"]);

    while($arElement = $rsElements->GetNext())
    {
        $arResult["ELEMENTS"][] = $arElement;
    }
}

function GetClassifier(&$arResult, $arParams) {
    if(intval($arParams["CLASSIFIER_IBLOCK_ID"]) <= 0) {return false;}

    //iblock elements
    $arSelectElems = array (
        "ID",
        "IBLOCK_ID",
        "NAME"
    );
    $arFilterElems = array (
        "IBLOCK_ID" => $arParams["CLASSIFIER_IBLOCK_ID"],
        "ACTIVE" => "Y"
    );
    $arSortElems = array (
        "NAME" => "ASC"
    );

    $arResult["CLASSIFIER"] = array();
    $arNavParams = array(
        "nPageSize" => $arParams["COUNT_ELEMENT"],
        "bShowAll" => false
    );

    $rsElements = CIBlockElement::GetList($arSortElems, $arFilterElems, false, $arNavParams, $arSelectElems);

    $arResult["NAV_STRING"] = $rsElements->GetPageNavString(GetMessage("NAV_STRING"));

    while($arElement = $rsElements->GetNext())
    {
        $arResult["CLASSIFIER"][] = $arElement;
    }

}

global $USER;

//Постраничная навигация
$arNavParams = array(
    "nPageSize" => $arParams["COUNT_ELEMENT"],
    "bShowAll" => false
);
$arNavigation = CDBResult::GetNavParams($arNavParams);

if($this->StartResultCache(false, [$USER->GetGroups(), $arNavigation])) {
    GetProduct($arResult, $arParams);
    GetClassifier($arResult, $arParams);

    foreach ($arResult["CLASSIFIER"] as $i => $item) {
        foreach ($arResult["ELEMENTS"] as $y => $itemY) {
            if ($itemY["PROPERTY_CLASSIFIER_VALUE"] == $item["ID"]) {
                $arResult["CLASSIFIER"][$i]["ELEMENTS"][] = $itemY;
            }
        }
    }
    unset($arResult["ELEMENTS"]);

    $count = 0;
    foreach ($arResult["CLASSIFIER"] as $i => $item) {
        $count++;
        if(!$arResult["CLASSIFIER"][$i]["ELEMENTS"]){
            unset($arResult["CLASSIFIER"][$i]);
            $count--;
        }
    }
    $arResult["COUNT"] = $count;

    $this->SetResultCacheKeys(["COUNT"]);
    $this->includeComponentTemplate();
}
else {
    $this->AbortResultCache();
}
$APPLICATION->SetTitle(GetMessage("COMP_TITLE", ["#COUNT#" => $arResult["COUNT"]]));



