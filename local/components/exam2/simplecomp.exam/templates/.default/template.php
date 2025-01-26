<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>

<?
//echo "<ul style='list-style-type: disc'>";
//foreach ($arResult["NEWS"] as $newsItem) {
//    echo "<li style='margin-left:30px'><b>".$newsItem["NAME"]."</b> - ".$newsItem["DATE_ACTIVE_FROM"];
//    echo " (";
//    foreach ($newsItem["PRODUCT_SECTION_ID"] as $sectionItem) {
//        echo $arResult["SECTIONS_PRODUCT"][$sectionItem]["NAME"]. ", ";
//    }
//    echo ")</li> <ul style='list-style-type: disc'>";
//
//    foreach ($newsItem["PRODUCT_SECTION_ID"] as $newsSectionItem) {
//        foreach ($arResult["SECTIONS_PRODUCT"][$newsSectionItem]["SECTION_ELEMENTS_ID"] as $elementItem) {
//            echo "<li style='margin-left:70px'>".$arResult["ELEMENTS_PRODUCT"][$elementItem]["NAME"]." - ".
//                $arResult["ELEMENTS_PRODUCT"][$elementItem]["PROPERTY_PRICE_VALUE"]." - ".
//                $arResult["ELEMENTS_PRODUCT"][$elementItem]["PROPERTY_MATERIAL_VALUE"]." - ".
//                $arResult["ELEMENTS_PRODUCT"][$elementItem]["PROPERTY_ARTNUMBER_VALUE"]."</li>";
//        }
//    }
//    echo "</ul>";
//}
//echo "</ul>";

?>
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
        <ul style='list-style-type: disc'>
            <?php foreach ($arResult["ELEMENTS_PRODUCT"]["ITEMS"] as $elementItem){?>
                <?php if(in_array($newsItem["ID"], $elementItem["NEWS_ID"])) {?>
                    <li style='margin-left:70px'>
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
