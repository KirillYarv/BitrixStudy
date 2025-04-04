<?php
$et = new CEventType;
$et->Add(array(
    "LID"           => "ru",
    "EVENT_NAME"    => "TESTING_TYPE_EVENT",
    "EVENT_TYPE"    => "email",
    "NAME"          => "тестовый тип события",
    "DESCRIPTION"   => "От #ADMIN_EMAIL# с любовью,
                        #EMAIL_TO# - EMail получателя сообщения,
                        #SITE_ID# - ID сайта
    "
));
$et->Add(array(
    "LID"           => "en",
    "EVENT_NAME"    => "TESTING_TYPE_EVENT",
    "EVENT_TYPE"    => "email",
    "NAME"          => "тестовый тип события",
    "DESCRIPTION"   => "От #ADMIN_EMAIL# с любовью,
                        #EMAIL_TO# - EMail получателя сообщения,
                        #SITE_ID# - ID сайта
    "
));