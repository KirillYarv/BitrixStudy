<?php
$arSelect = Array(
    "ID",
    "NAME",
    "PROPERTY_NEW"
);

$arFilter = Array(
    "IBLOCK_ID" => $arParams["CANONICAL"],
    "PROPERTY_NEW" => $arResult["ID"],
    "ACTIVE" => "Y"
);

$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

$result = $res->GetNextElement()->GetFields()["NAME"];
if ($result) {
    $arResult["CANONICAL"] = $result;
    $this->__component->setResultCacheKeys(array("CANONICAL"));
}
