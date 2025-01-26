<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arParams["X"] = doubleval($arParams["X"]);

if($this->startResultCache()) //startResultCache используется не для кеширования html, а для кеширования arResult
{
	$arResult["Y"] = $this->pow($arParams["X"]);
}
$this->includeComponentTemplate();
?>