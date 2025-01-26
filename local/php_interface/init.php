<?php

$arJsConfig = array(
	'custom_main' => array( 
		'js' => '/local/templates/exam1/js/mine.js', 
		'css' => '',
		'rel' => array(), 
	) 
); 
foreach ($arJsConfig as $ext => $arExt) { 
	\CJSCore::RegisterExt($ext, $arExt); 
}

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/define_vars.php"))
{ require_once ($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/define_vars.php" ); }


if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/event_class.php"))
{ require_once ($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/event_class.php" ); }

