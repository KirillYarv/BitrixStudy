<?php


function CheckUserCount()
{
    $date = time();

    $lastCounting = \Bitrix\Main\Config\Option::get("main", "last_counting_CheckUserCount");
    if (!$lastCounting){
        $lastCounting = time()-86400;
    }

    $countDays = ceil(($date - $lastCounting)/86400);

    //Количество новых пользователей за n дней
    $rsUsers = CUser::GetList(
        "date_register",
        "desc",
        array(
            "DATE_REGISTER_1"=>date("d.m.Y H:i:s", $lastCounting),
        )
    );
    $count = $rsUsers->SelectedRowsCount();


    //Рассылка админам
    $rsUsers = CUser::GetList(
        "",
        "",
        array("GROUPS_ID" => "1")
    );

    while ($arUser = $rsUsers->GetNext()) {
        Bitrix\Main\Mail\Event::send(array(
            "EVENT_NAME" => "CHECK_USER_COUNT",
            "LID" => "s1",
            "C_FIELDS" => array(
                "EMAIL_TO" => $arUser["EMAIL"],
                "COUNT_USERS" => $count,
                "COUNT_DAYS" => $countDays
            ),
        ));
    }

    \Bitrix\Main\Config\Option::set("main", "last_counting_CheckUserCount", "".$date);
    return "CheckUserCount()";
}
//CheckUserCount();


