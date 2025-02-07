<?php


function CheckUserCount()
{

    $rsUsers = CUser::GetList("date_register", "asc");
    $arUsers = [];
//    echo "<pre>";
//
//    echo "</pre>";
    while ($arUser = $rsUsers->GetNext()) {
        $arUsers[] = $arUser;
    }
    //echo $arUser;
    foreach ($arUsers as $arUser) {
        //echo "dffds";
        var_dump($arUser);
//            Bitrix\Main\Mail\Event::send(array(
//                "EVENT_NAME" => "CHECK_USER_COUNT",
//                "LID" => "s1",
//                "C_FIELDS" => array(
//                    "EMAIL_TO" => $arUser["EMAIL"],
//                    "COUNT_USERS" => count($arUsers),
//                    "COUNT_DAYS" => 3
//                ),
//            ));

    }

    return "CheckUserCount()";
}
CheckUserCount();

