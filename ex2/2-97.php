<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("2-97");
?><?$APPLICATION->IncludeComponent(
	"exam2:simplecomp.exam97",
	"",
	Array(
		"AUTHOR_FIELD_KEY" => "AUTHOR",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"NEWS_IBLOCK_ID" => "1",
		"TYPE_AUTHOR_FIELD_KEY" => "UF_AUTHOR_TYPE"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>