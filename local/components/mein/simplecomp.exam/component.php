<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


use Bitrix\Main\Loader,
    Bitrix\Main\Web\Uri,
    Bitrix\Main\Application;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}


$arResult = [];

if (!isset($arParams["NEWS_IBLOCK_ID"])){
    $arParams["NEWS_IBLOCK_ID"] = 0;
}
if (!isset($arParams["PRODUCTS_IBLOCK_ID"])){
    $arParams["PRODUCTS_IBLOCK_ID"] = 0;
}
if (!isset($arParams["PRODUCT_NEWS_IBLOCK_PROP_ID"])){
    $arParams["PRODUCT_NEWS_IBLOCK_PROP_ID"] = "";
}
if (!isset($arParams["CACHE_TIME"]) || $arParams["CACHE_TIME"] == 0) {
    $arParams["CACHE_TIME"] = 360000;
}

$FValue = $_REQUEST["F"];
//Результат в arResult["ELEMENTS"]
function GetProductElement($arParams, &$arSections,$FValue)
{
    $arFilterElems = match ($FValue) {
        "Y" => array(
            "IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
            "IBLOCK_SECTION_ID" => $arSections["ID"],
            "ACTIVE" => "Y",
            [
                ["PROPERTY_MATERIAL" => "Кожа, ткань",
                    "<=PROPERTY_PRICE" => 1700,
                ],
                ["PROPERTY_MATERIAL" => "Металл, пластик",
                    "<PROPERTY_PRICE" => 1500,
                ],
                "LOGIC" => "OR"
            ]
        ),
        default => array(
            "IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
            "IBLOCK_SECTION_ID" => $arSections["ID"],
            "ACTIVE" => "Y"
        ),
    };
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

    $arSortElems = array (
        "NAME" => "ASC"
    );

    $rsElements = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
    while($arElement = $rsElements->GetNext())
    {
        $arButtons = CIBlock::GetPanelButtons(
            $arParams["PRODUCTS_IBLOCK_ID"],
            $arElement["ID"],
            0,
            array()
        );

        $arElement["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
        $arElement["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
        $result["ADD_LINK"] = $arButtons["edit"]["add_element"]["ACTION_URL"];

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

function GetFilterOnUri($filter)
{
    $context = Application::getInstance()->getContext();
    $request = $context->getRequest();

    $uriString = $request->getRequestUri();
    $uri = new Uri($uriString);
    return $uri->addParams(array("F"=>$filter));
}

if($this->StartResultCache(false, $FValue)) {

    if($FValue=="Y"){
        $this->AbortResultCache();
    }

    $arResult["NEWS"] = GetNewsElement($arParams);
    $arResult["SECTIONS_PRODUCT"] = GetProductSection($arParams, $arResult["NEWS"]["ID"]);
    $arResult["ELEMENTS_PRODUCT"] = GetProductElement($arParams, $arResult["SECTIONS_PRODUCT"], $FValue);

    $arResult["ELEMENTS_COUNT"] = $arResult["ELEMENTS_PRODUCT"]["ID"] ? count($arResult["ELEMENTS_PRODUCT"]["ID"]) : 0;

    $this->SetResultCacheKeys(array("ELEMENTS_COUNT"));
    $this->includeComponentTemplate();
}
else{
    echo "cache";
    $this->AbortResultCache();
}
$APPLICATION->SetTitle(GetMessage("SIMPLECOMP_EXAM2_TITLE1").$arResult["ELEMENTS_COUNT"]);


global $USER;

if ($USER->IsAuthorized()) {
    $arButtons = CIBlock::GetPanelButtons(
        $arParams["PRODUCTS_IBLOCK_ID"]
    );

    $this->AddIncludeAreaIcons(
        [
            [
                "ID" => 101,
                "URL" => $arButtons["submenu"]["element_list"]["ACTION_URL"],
                "TITLE" => "ИБ в админке",
                "IN_PARAMS_MENU" => true,
            ]
        ]
    );
}




