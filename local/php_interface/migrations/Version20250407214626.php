<?php

namespace Sprint\Migration;



use Bitrix\Main\DB\Exception;
use CEventMessage;
use CEventType;

class Version20250407214626 extends Version
{
    protected $author = "admin";

    protected $description = "";

    protected $moduleVersion = "4.18.4";

    private $typeEventName = "EVENT_ESP";


    private function getTemplates()
    {
        return [
            [
                "ACTIVE" => "Y",
                "EVENT_NAME" => $this->typeEventName,
                "LID" => array("s1"),
                "EMAIL_FROM" => "#EMAIL_OUR#",
                "EMAIL_TO" => "#EMAIL_USER#",
                "SUBJECT" => "Заявка № #ID# на приглашения иностранного гражданина - делового партнера ВЭБ.РФ.",
                "BODY_TYPE" => "text",
                "MESSAGE" => "Здравствуйте, #NAME_USER# #MIDDLE_NAME#! Ваша Заявка #ID# #NAME# зарегистрирована. Подробности #LINK# С уважением, Служба технической поддержки ЕСП",
            ]

        ];
    }

    public function up()
    {

        $helper = $this->getHelperManager();
        $et = new CEventType;
        $et->Add(array(
            "LID" => "ru",
            "EVENT_NAME" => $this->typeEventName,
            "EVENT_TYPE" => "email",
            "NAME" => "Уведомления на почту и в ЕСП",
            "DESCRIPTION" => "#ID# - ID Заявки,
#NAME# - название заявки,
#LINK# - ссылка на подробности,
#NAME_USER# - имя инициатора,
#MIDDLE_NAME_USER# - второе (среднее) имя инициатора,
#EMAIL_USER# - email инициатора,
#EMAIL_OUR# - email сотрудников компании/органов гос.,
"
        ));

        $emess = new CEventMessage;
        foreach ($this->getTemplates() as $template){
            $emess->Add($template);
        }
    }

    public function down()
    {
        $et = new CEventType;
        $et->Delete($this->typeEventName);
    }
}
