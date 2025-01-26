<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if($this->startResultCache()) {
    $arParams['X'] = doubleval($arParams['X']);

    $arResult['Y'] = $this->f($arParams['X']);

}

$this->includeComponentTemplate();