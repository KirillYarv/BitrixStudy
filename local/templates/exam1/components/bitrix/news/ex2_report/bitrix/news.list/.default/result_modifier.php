<?php

if ($arParams["DISPLAY_SPECIALDATE"] == 'Y'){
    $arResult["DATA_FIRST"] = $arResult["ITEMS"][0]["ACTIVE_FROM"];
    $this->__component->setResultCacheKeys(array("DATA_FIRST"));
}


if ($arParams["DISPLAY_REPORT_AJAX"] == 'Y')
{
    foreach ($arResult["ITEMS"] as $key => $arItem) {
        $arResult["ITEMS"][$key]["DISPLAY_REPORT_AJAX"] = "aaaaaa";
    }
}
else {
    foreach ($arResult["ITEMS"] as $key => $arItem) {
        $arButtons = CIBlock::GetPanelButtons(
            1,
            $arItem["ID"],
            0,
            array()
        );

        $arResult["ITEMS"][$key]["DISPLAY_REPORT_AJAX"] = $arButtons["edit"]["add_element"]["ACTION_URL"];
    }
}