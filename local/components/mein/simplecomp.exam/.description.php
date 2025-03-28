<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("MEIN_TESTING_COMP_NAME"),
	"CACHE_PATH" => "Y",
    "PATH" => array(
        "ID" => "testing",
        "NAME" => GetMessage("MEIN_TESTING_COMP_DIR"),
    ),
);
?>