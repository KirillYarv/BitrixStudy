<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
class GreatComponent extends CBitrixComponent {

    public function onPrepareComponentParams($arParams): array
    {
        return array(
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => isset($arParams["CACHE_TIME"]) ?$arParams["CACHE_TIME"]: 36000000,
            "X" => $this->getXFromHL($arParams),
        );
	}


    private function getXFromHL($arParams): float|int {
        $res = 0;
        if (CModule::IncludeModule('highloadblock')) {
            $HeadOfBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(1)->fetch();

            if (isset($HeadOfBlock['ID'])) {
                $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($HeadOfBlock);
                $entity_data_class = $entity->getDataClass();
                $res = $entity_data_class::getList( array('filter'=>array()) )->fetch();
                // или так $arAllRows = $res->fetchAll();
            }
        }
        $arParams['X'] =$res['UF_X'];
        return $arParams['X'];
    }

    /**
     * @param $x
     * @return float|int
     */
    public function f($x): float|int
    {
        return 1 - sqrt($x);
    }
}