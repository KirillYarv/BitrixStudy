<?php
$arr["ACTIVE"] = "Y";
$arr["EVENT_NAME"] = "TESTING_TYPE_EVENT";
$arr["LID"] = array("s1");
$arr["EMAIL_FROM"] = "#DEFAULT_EMAIL_FROM#";
$arr["EMAIL_TO"] = "#EMAIL_TO#";
$arr["SUBJECT"] = "Признание";
$arr["BODY_TYPE"] = "text";
$arr["MESSAGE"] = "
Текст сообщения от #ADMIN_EMAIL# с любовью
";
$emess = new CEventMessage;
$emess->Add($arr);