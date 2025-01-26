<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");

$APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
	"LEVEL"	=>	"3",
	"COL_NUM"	=>	"2",
	"SHOW_DESCRIPTION"	=>	"Y",
	"SET_TITLE"	=>	"Y",
	"CACHE_TIME"	=>	"36000000"
	)
);
define("ERROR_404", "Y");

CEventLog::Add(array(
    "SEVERITY" => "INFO",
    "AUDIT_TYPE_ID" => "ERROR_404",
    "MODULE_ID" => "main",
    "DESCRIPTION" => $APPLICATION->GetCurPage(),
));


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>