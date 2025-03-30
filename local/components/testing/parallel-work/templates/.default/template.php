<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<a href="<?=GetFilterOnUri("Y")?>"><?=GetMessage("FILTER_ON_MESSAGE")?></a>
<br>
<a href="<?=GetFilterOnUri("N")?>"><?=GetMessage("FILTER_OFF_MESSAGE")?></a>
<?php
$this->AddEditAction("add_element", $arResult["ELEMENTS_PRODUCT"]["ADD_LINK"], CIBlock::GetArrayByID($arParams["PRODUCTS_IBLOCK_ID"], "ELEMENT_ADD"));
?>
<?php
//echo "<pre>";
//var_dump($arResult);
//echo "</pre>";
?>
<?= time();?>
<ul style='list-style-type: disc'>
    <?php foreach ($arResult["NEWS"]["ITEMS"] as $newsItem){?>
        <li style='margin-left:30px'>
            <b><?=$newsItem["NAME"]?></b> - <?=$newsItem["DATE_ACTIVE_FROM"]?>
            (
            <?php foreach ($arResult["SECTIONS_PRODUCT"]["ITEMS"] as $sectionItem){?>
                <?php if(in_array($newsItem["ID"], $sectionItem["UF_NEWS_LINK"])) {?>
                    <?=$sectionItem["NAME"]?>,
                <?php }?>
            <?php }?>
            )
        </li>

        <ul style='list-style-type: disc' id="<?=$this->GetEditAreaId("add_element");?>">
            <?php foreach ($arResult["ELEMENTS_PRODUCT"]["ITEMS"] as $elementItem){?>
                <?php if(in_array($newsItem["ID"], $elementItem["NEWS_ID"])) {?>
                    <?php
                    $this->AddEditAction($newsItem["ID"]."_".$elementItem['ID'], $elementItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["PRODUCTS_IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($newsItem["ID"]."_".$elementItem['ID'], $elementItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["PRODUCTS_IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <li style='margin-left:70px' id="<?=$this->GetEditAreaId($newsItem["ID"]."_".$elementItem['ID']);?>">
                        <?=$elementItem["NAME"]?> -
                        <?=$elementItem["PROPERTY_PRICE_VALUE"]?> -
                        <?=$elementItem["PROPERTY_MATERIAL_VALUE"]?> -
                        <?=$elementItem["PROPERTY_ARTNUMBER_VALUE"]?>
                    </li>
                <?php }?>
            <?php }?>
        </ul>
    <?php }?>
</ul>

