<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"PRODUCTS_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CAT_IBLOCK_ID"),
            "PARENT"=>"BASE",
			"TYPE" => "STRING",
		),


        "CACHE_TIME"  =>  ["DEFAULT"=>36000000],
	),
);