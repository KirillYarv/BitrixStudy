<?php
if (isset($arResult["MIN_PRICE"]) && isset($arResult["MAX_PRICE"])) {
    $htmlBlock = '<div style="color:red; margin: 34px 15px 35px 15px">
                Минимальная цена - ' . $arResult["MIN_PRICE"] . '
                Максимальная цена - ' . $arResult["MAX_PRICE"] . '
              </div>';
    $APPLICATION->AddViewContent("min_max_price", $htmlBlock);
}
