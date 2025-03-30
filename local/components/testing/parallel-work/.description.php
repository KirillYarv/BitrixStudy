<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("TESTING_NAME"),
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "testing",
		"NAME" => GetMessage("TESTING_DIR"),
	),
);
?>