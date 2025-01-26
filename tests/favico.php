<?
AddEventHandler("main", "OnCheckListGet", array("Tests", "onCheckListGet"));

class Tests
{
    static public function onCheckListGet($arCheckList)
    {

        $checkList['CATEGORIES']['ITC_QC'] = array(
            'NAME' => 'Корпоративный тест качества ITConstruct',
            'LINKS' => ''
        );
        $checkList['POINTS']['ITC_QC_FAVICON'] = array(
            'PARENT' => 'ITC_QC',
            'REQUIRE' => 'Y',
            'AUTO' => 'Y',
            'CLASS_NAME' => __CLASS__,
            'METHOD_NAME' => 'checkFavicon',
            'NAME' => 'Наличие favicon',
            'DESC' => 'Проверка наличия favicon - иконки сайта, отображаемой в заголовке вкладки и поисковых системах',
            'HOWTO' => 'Производится проверка главной страницы сайта на наличие соответствующего мета-тэга. 
                Если тэг объявлен - проверяется наличие иконки по указанному урлу. 
                Если не указан - наличие favicon.ico в корне сайта',
            'LINKS' => 'links'
        );
        
        return $checkList;
    }

    static public function checkFavicon($arParams)
    {
        $arResult = array('STATUS' => 'F');
        $check = file_exists($_SERVER['DOCUMENT_ROOT'] . '/favicon.ico');
        if ($check === true) {
            $arResult = array(
                'STATUS' => true,
                'MESSAGE' => array(
                'PREVIEW' => 'Favicon найдена - ' . '/favicon.ico',
                ),
            );
        } else {
            $arResult = array(
                'STATUS' => false,
                'MESSAGE' => array(
                    'PREVIEW' => 'Favicon не найдена',
                    'DETAIL' => 'Тест очень старался, но так и не смог найти фавыконку. Ну и чёрт с ней',
                ),
            );
        }
        return $arResult;
    }
}