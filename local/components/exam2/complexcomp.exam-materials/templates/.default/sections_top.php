<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?php
$param1 = 123;
$param2 = 456;
    echo "ссылка на страницу exampage";
    if($arParams["SEF_MODE"] == "Y") {
        $url = $arParams["SEF_FOLDER"].$arResult["URL_TEMPLATES"]["exampage"];
        $url = str_replace("#PARAM1#", $param1, $url);
        if($param2){
            $url = $url."?PARAM2=".$param2;
        }
    }
    else {
        $url = $arResult["URL_TEMPLATES"]["exampage"];
        $url = str_replace("#PARAM1#", $param1, $url);
        if($param2) {
            $url = str_replace("#PARAM2#", $param2, $url);
        }
    }
    echo "<pre>";
    var_dump($arResult);
    echo "</pre>";
?>

<?=GetMessage("EXAM_TEXT_LINK_CP_PHOTO")?> <a href="<?=$url?>"><?=$url?></a>

<?$APPLICATION->IncludeComponent(
	"bitrix:photo.sections.top",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_COUNT" => $arParams["SECTION_COUNT"],
		"ELEMENT_COUNT" => $arParams["TOP_ELEMENT_COUNT"],
		"LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
		"SECTION_SORT_FIELD" => $arParams["SECTION_SORT_FIELD"],
		"SECTION_SORT_ORDER" => $arParams["SECTION_SORT_ORDER"],
		"ELEMENT_SORT_FIELD" => $arParams["TOP_ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["TOP_ELEMENT_SORT_ORDER"],
		"FIELD_CODE" => $arParams["TOP_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["TOP_PROPERTY_CODE"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
	),
	$component
);
?>
