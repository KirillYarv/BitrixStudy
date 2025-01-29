<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}


$arResult = [];

if (!isset($arParams["NEWS_IBLOCK_ID"])){
    $arParams["NEWS_IBLOCK_ID"] = 1;
}
if (!isset($arParams["PRODUCTS_IBLOCK_ID"])){
    $arParams["PRODUCTS_IBLOCK_ID"] = 2;
}
if (!isset($arParams["PRODUCT_NEWS_IBLOCK_PROP_ID"])){
    $arParams["PRODUCT_NEWS_IBLOCK_PROP_ID"] = "UF_NEWS_LINK";
}
if (!isset($arParams["CACHE_TIME"]) || $arParams["CACHE_TIME"] == 0){
    $arParams["CACHE_TIME"] = 360000;
}


//Результат в arResult["ELEMENTS"]
function GetProductElement($arParams, &$arSections)
{
    $result = [];
    //iblock elements
    $arSelectElems = array (
        "ID",
        "IBLOCK_SECTION_ID",
        "IBLOCK_ID",
        "NAME",
        "PROPERTY_MATERIAL",
        "PROPERTY_ARTNUMBER",
        "PROPERTY_PRICE"
    );
    $arFilterElems = array (
        "IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
        "IBLOCK_SECTION_ID" => $arSections["ID"],
        "ACTIVE" => "Y"
    );
    $arSortElems = array (
        "NAME" => "ASC"
    );

    $rsElements = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
    while($arElement = $rsElements->GetNext())
    {
        $result["ID"][] = $arElement["ID"];
        $result["ITEMS"][$arElement["ID"]] = $arElement;

        foreach($arSections["ITEMS"][$arElement["IBLOCK_SECTION_ID"]]["UF_NEWS_LINK"] as $newsID) {
            $result["ITEMS"][$arElement["ID"]]["NEWS_ID"][] = $newsID;
        }
    }
    return $result;
}

function GetNewsElement($arParams)
{
    $result = [];
    //iblock elements
    $arSelectElems = array (
        "ID",
        "IBLOCK_ID",
        "NAME",
        "DATE_ACTIVE_FROM"
    );
    $arFilterElems = array (
        "IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
        "ACTIVE" => "Y"
    );
    $arSortElems = array (
        "NAME" => "ASC"
    );

    $rsElements = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
    while($arElement = $rsElements->GetNext())
    {
        $result["ID"][] = $arElement["ID"];
        $result["ITEMS"][$arElement["ID"]] = $arElement;
    }
    return $result;
}
//Результат в arResult["SECTIONS"]
function  GetProductSection($arParams, $arNewsID)
{
    $result = [];
    //iblock sections
    $arSelectSect = array (
        "ID",
        "IBLOCK_ID",
        "NAME",
        "UF_NEWS_LINK"
    );
    $arFilterSect = array (
        "IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
        "UF_NEWS_LINK" => $arNewsID,
        "ACTIVE" => "Y"
    );
    $arSortSect = array (
        "NAME" => "ASC"
    );

    $rsSections = CIBlockSection::GetList($arSortSect, $arFilterSect, false, $arSelectSect, false);
    while($arSection = $rsSections->GetNext())
    {
        $result["ID"][] = $arSection["ID"];
        $result["ITEMS"][$arSection["ID"]] = $arSection;

    }
    return $result;
}

if($this->StartResultCache()) {
    $arResult["NEWS"] = GetNewsElement($arParams);
    $arResult["SECTIONS_PRODUCT"] = GetProductSection($arParams, $arResult["NEWS"]["ID"]);
    $arResult["ELEMENTS_PRODUCT"] = GetProductElement($arParams, $arResult["SECTIONS_PRODUCT"]);

    $arResult["ELEMENTS_COUNT"] = count($arResult["ELEMENTS_PRODUCT"]["ID"]);

    $this->SetResultCacheKeys(array("ELEMENTS_COUNT"));
}
else{
    echo "cache";
    $this->AbortResultCache();
}
$APPLICATION->SetTitle(GetMessage("SIMPLECOMP_EXAM2_TITLE1").$arResult["ELEMENTS_COUNT"]);


$this->includeComponentTemplate();
?>