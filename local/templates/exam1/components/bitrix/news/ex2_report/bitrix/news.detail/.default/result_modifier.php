<?php
if ($arParams["DISPLAY_CANONICAL"]){
    $arSelect = Array(
        "ID",
        "NAME",
        "PROPERTY_NEWS"
    );
    $arFilter = Array(
        "IBLOCK_ID"=>IntVal($arParams["DISPLAY_CANONICAL"]),
        "ACTIVE"=>"Y",
        "PROPERTY_NEWS" => $arResult["ID"]
    );
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

    if($ob = $res->Fetch()) {
        $arResult["NAME_CANONICAL"] = $ob["NAME"];
        $this->__component->SetResultCacheKeys(["NAME_CANONICAL"]);
    }
}

