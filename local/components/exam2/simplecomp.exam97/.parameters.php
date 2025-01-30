<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"NEWS_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_NEWS_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
        "AUTHOR_FIELD_KEY" => array(
            "NAME" => GetMessage("SIMPLECOMP_EXAM2_AUTHOR_FIELD_ID"),
            "TYPE" => "STRING",
        ),
        "TYPE_AUTHOR_FIELD_KEY" => array(
            "NAME" => GetMessage("SIMPLECOMP_EXAM2_TYPE_AUTHOR_FIELD_ID"),
            "TYPE" => "STRING",
        ),
        "CACHE_TIME"  =>  ["DEFAULT"=>36000000],

        "CACHE_GROUPS" => [
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("CP_BN_CACHE_GROUPS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
	),
);