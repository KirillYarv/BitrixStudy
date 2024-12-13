<?php

spl_autoload_register(function ($class) {
    include '/home/bitrix/www/local/modules/somepartner.mybookscatalog/lib/BookTable.php';
});


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
require '/home/bitrix/www/local/modules/somepartner.mybookscatalog/lib/BookTable.php';
#\SomePartner\MyBooksCatalog\BookRebirthTable::getEntity()->compileDbTableStructureDump();


