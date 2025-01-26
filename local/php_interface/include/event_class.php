<?php
IncludeModuleLangFile(__FILE__);
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("Ex2", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler("main", "OnBeforeEventAdd", array("Ex2", "OnBeforeEventAddHandler"));
AddEventHandler("main", "OnBeforeEventAdd", array("Ex2", "OnBeforeEventAddFeedback"));
AddEventHandler("main", "OnBuildGlobalMenu", array("Ex2", "OnBuildGlobalMenuManager"));
AddEventHandler("main", "OnBeforeProlog", array("Ex2", "OnBeforeProlog94"));

class Ex2
{
    static function OnBeforeProlog94()
    {
        if(!CModule::IncludeModule("iblock")) { return true; }

        global $APPLICATION;

        $arSelect = Array(
            "ID",
            "IBLOCK_ID",
            "NAME",
            "PROPERTY_TITLE",
            "PROPERTY_DESCRIPTION",
        );
        $arFilter = Array(
            "IBLOCK_ID"=> IBLOCK_ID_METATAGS,
            "NAME"=> $APPLICATION->GetCurPage(),
            "ACTIVE"=>"Y"
        );
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

        if($ob = $res->GetNextElement()){
            $arFields = $ob->GetFields();

            $APPLICATION->SetPageProperty("title", $arFields["PROPERTY_TITLE_VALUE"]);
            $APPLICATION->SetPageProperty("description", $arFields["PROPERTY_DESCRIPTION_VALUE"]);
        }
    }
    // создаем обработчик события "OnBeforeIBlockElementUpdate"
    public static function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        if ($arFields["IBLOCK_ID"] != IBLOCK_PRODUCT || $arFields["ACTIVE"] != "N") {
            return true;
        }

        $arSelect = Array("ID", "NAME", "SHOW_COUNTER");
        $arFilter = Array(
            "IBLOCK_ID"=>IBLOCK_PRODUCT,
            "ID"=> $arFields["ID"],
            "ACTIVE"=>"Y");

        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        $count = $res->Fetch()["SHOW_COUNTER"];

        if ($count <= MAX_COUNT) {
            return true;
        }

        global $APPLICATION;
        $APPLICATION->throwException(GetMessage("ERROR_MESSAGE", array("#COUNT#"=>$count)));
        return false;

    }

    public static function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {
        if ($event != "FEEDBACK_FORM"){
            return false;
        }
        global $USER;

        if($USER->isAuthorized()) {
            $arFields["AUTHOR"] = GetMessage("AUTH_AUTHOR_USER", array(
                "#ID#"=>$USER->GetID(),
                "#LOGIN#"=>$USER->GetLogin(),
                "#NAME_USER#"=>$USER->GetFirstName(),
                "#NAME_FORM#"=>$arFields["AUTHOR"],
            ));
        }
        else{
            $arFields["AUTHOR"] = GetMessage("NO_AUTH_AUTHOR_USER", array(
                "#NAME_FORM#"=>$arFields["AUTHOR"],
            ));

        }
        CEventLog::Add(array(
            "SEVERITY" => "SECURITY",
            "AUDIT_TYPE_ID" => GetMessage("EVENT_AUTHOR_REPLACE"),
            "MODULE_ID" => "main",
            "ITEM_ID" => $event,
            "DESCRIPTION" => GetMessage("EVENT_AUTHOR_REPLACE")." - {$arFields["AUTHOR"]}",
        ));
    }
    public static function OnBeforeEventAddFeedback(&$event, &$lid, &$arFields)
    {
        if ($event != "FEEDBACK_FORM"){
            return false;
        }

        $el = new CIBlockElement;
        $arIBlockFields = array(
            "IBLOCK_ID"      => 6,
            "NAME"           => $arFields["AUTHOR"],
            "ACTIVE"         => "Y",            // активен
            "DETAIL_TEXT"    => $arFields["TEXT"],
            "ACTIVE_FROM" => ConvertTimeStamp(false, "FULL")
        );

        $el->Add($arIBlockFields);

    }


    public static function OnBuildGlobalMenuManager(&$aGlobalMenu, &$aModuleMenu)
    {

        $isManager = false;
        $isAdmin = false;

        global $USER;
        $userGroupsID = $USER->GetUserGroupArray();

        foreach ($userGroupsID as $userGroupID){
            if($userGroupID == 1) {
                $isAdmin = true;
            }
            if ($userGroupID == 5) {
                $isManager = true;
            }
        }

        if ($isAdmin || !$isManager) { return true;}

        foreach($aModuleMenu as $key => $item) {
            if($item["items_id"] == "menu_iblock_/news") {
                $aModuleMenu = [$item];
                break;
            }
        }

        foreach($aGlobalMenu as $key => $item) {
            if($item["items_id"] == "global_menu_content") {
                $aGlobalMenu = ["global_menu_content" => $item];
                break;
            }
        }
    }

}
