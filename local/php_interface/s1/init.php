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

