<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("2-97");
?><?$APPLICATION->IncludeComponent(
	"exam2:simplecomp.exam97", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"NEWS_IBLOCK_ID" => "1",
		"AUTHOR_FIELD_ID" => "AUTHOR",
		"TYPE_AUTHOR_FIELD_ID" => "UF_AUTHOR_TYPE",
		"AUTHOR_FIELD_KEY" => "AUTHOR",
		"TYPE_AUTHOR_FIELD_KEY" => "UF_AUTHOR_TYPE"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>