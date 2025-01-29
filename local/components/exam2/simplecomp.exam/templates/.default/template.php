<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>

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
