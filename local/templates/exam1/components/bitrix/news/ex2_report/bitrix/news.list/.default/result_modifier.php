<?php

if ($arParams["DISPLAY_SPECIALDATE"] == 'Y'){
    $arResult["DATA_FIRST"] = $arResult["ITEMS"][0]["ACTIVE_FROM"];
    $this->__component->setResultCacheKeys(array("DATA_FIRST"));
}
