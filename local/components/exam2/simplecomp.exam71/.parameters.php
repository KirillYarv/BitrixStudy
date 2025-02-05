<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"PRODUCTS_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CAT_IBLOCK_ID"),
            "PARENT" => "BASE",
			"TYPE" => "STRING",
		),
        "CLASSIFIER_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CLASS_IBLOCK_ID"),
            "PARENT" => "BASE",
			"TYPE" => "STRING",
		),
        "TEMPLATE_DETAIL_PRODUCT" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_TEMPL_PRODUCT"),
            "PARENT" => "BASE",
			"TYPE" => "STRING",
		),
        "PRODUCT_PROPERTY_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_PROD_PROPERTY_ID"),
            "PARENT" => "BASE",
			"TYPE" => "STRING",
		),
        "COUNT_ELEMENT" => array(
            "NAME" => GetMessage("SIMPLECOMP_EXAM2_COUNT_ELEMENT"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
            "DEFAULT" => "8"
        ),

        "CACHE_TIME"  =>  ["DEFAULT"=>36000000],
        "CACHE_GROUPS" => [
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("CP_BNL_CACHE_GROUPS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
	),
);