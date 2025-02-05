<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php echo time();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<ul style='margin-left:30px; list-style-type: disc'>
    <?php foreach ($arResult["CLASSIFIER"] as $item){?>
        <li>
            <b><?=$item["NAME"]?></b>
            <ul style='margin-left:60px; list-style-type: disc'>
                <?php foreach ($item["ELEMENTS"] as $itemElement){?>
                    <li>
                        <?=$itemElement["NAME"]." - ".
                        $itemElement["PROPERTY_PRICE_VALUE"]." - ".
                        $itemElement["PROPERTY_MATERIAL_VALUE"]." - ".
                        $itemElement["PROPERTY_ARTNUMBER_VALUE"]?>
                        [<a href="<?=$itemElement["DETAIL_PAGE_URL"]?>">Ссылка</a>]
                        (<?=$itemElement["DETAIL_PAGE_URL"]?>)
                    </li>
                <?php }?>
            </ul>
        </li>
    <?php }?>
</ul>
<?=
    $arResult["NAV_STRING"]
?>
