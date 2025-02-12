<?php

if($arResult["NAME_CANONICAL"]){
    $APPLICATION->SetPageProperty("canonical", $arResult["NAME_CANONICAL"]);
}

const IBLOCK_REPORT = 6;
if ($_REQUEST["report"]=="Y" && $_REQUEST["news_id"]) {
    global $USER;

    $propertyUser = "";
    if ($USER->GetLogin()) {
        $propertyUser = "ID - ".$USER->GetID().". Логин - ". $USER->GetLogin().". ФИО - ". $USER->GetFullName();
    }
    else {
        $propertyUser = "Не авторизован";
    }

    $PROP = [
      "USER" => $propertyUser,
      "NEWS" => $_REQUEST["news_id"]
    ];
    $el = new CIBlockElement();

    $arLoadProductArray = Array(
        "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
        "IBLOCK_ID"      => IBLOCK_REPORT,
        "PROPERTY_VALUES"=> $PROP,
        "NAME"           => "Жалоба на новость ".$_REQUEST["news_id"],
        "ACTIVE"         => "Y",            // активен
        "DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL")
    );

    if($REPORT_ID = $el->Add($arLoadProductArray)){

        if ($_REQUEST["ajax"]==1){
            $APPLICATION->RestartBuffer();
            ?>
            <script>
                $('#report_message').text("<?=GetMessage("SUCCESS_REPORT", ["#NEWS_ID#"=>$REPORT_ID])?>");
            </script>
            <?php


            die();
        }
        else{
            ?>
            <script>
                $('#report_message').text("<?=GetMessage("SUCCESS_REPORT", ["#NEWS_ID#"=>$REPORT_ID])?>");
            </script>
            <?php
        }
    }
    else {
        echo "<p style='color: red'>" . GetMessage("ERROR_REPORT", ["#ERROR#" => $el->LAST_ERROR]) . "</p>";
        if ($_REQUEST["ajax"]==1){
            $APPLICATION->RestartBuffer();
            ?>
            <script>
                $('#report_message').text("<?=GetMessage("ERROR_REPORT", ["#ERROR#" => $el->LAST_ERROR])?>");
            </script>
            <?php


            die();
        }
        else{
            ?>
            <script>
                $('#report_message').text("<?=GetMessage("ERROR_REPORT", ["#ERROR#" => $el->LAST_ERROR])?>");
            </script>
            <?php
        }

    }

}