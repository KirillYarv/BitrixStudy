<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "ex",
	"DESCRIPTION" => "bla bla bla",
	"SORT" => 30,

	"COMPLEX" => "N",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "news",
			"NAME" => "Пример",
			"SORT" => 11,
			"CHILD" => array(
				"ID" => "news_cmpx",
			),
		),
	),
);

?>