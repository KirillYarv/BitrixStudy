<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("2-71");
?><?$APPLICATION->IncludeComponent(
	"exam2:simplecomp.exam71", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"PRODUCTS_IBLOCK_ID" => "2",
		"CLASSIFIER_IBLOCK_ID" => "5",
		"TEMPLATE_DETAIL_PRODUCT" => "/products/#SECTION_ID#/#ELEMENT_CODE#/",
		"PRODUCT_PROPERTY_ID" => "CLASSIFIER",
		"COUNT_ELEMENT" => "8",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>