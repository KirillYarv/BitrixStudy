<?php

$maxPrice = PHP_INT_MIN;
$minPrice = PHP_INT_MAX;
foreach ($arResult["NEWS"]["ITEMS"] as $newsItem) {
    foreach ($arResult["ELEMENTS_PRODUCT"]["ITEMS"] as $elementItem) {
        if (in_array($newsItem["ID"], $elementItem["NEWS_ID"])) {

            if ($elementItem["PROPERTY_PRICE_VALUE"] > $maxPrice){
                $maxPrice = $elementItem["PROPERTY_PRICE_VALUE"];
            }
            if ($elementItem["PROPERTY_PRICE_VALUE"] < $minPrice){
                $minPrice = $elementItem["PROPERTY_PRICE_VALUE"];
            }
        }
    }
}

$arResult["MIN_PRICE"] = $minPrice;
$arResult["MAX_PRICE"] = $maxPrice;

$this->__component->SetResultCacheKeys(array("MIN_PRICE", "MAX_PRICE"));