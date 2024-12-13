<?php
namespace SomePartner\MyBooksCatalog;
use Bitrix\Main\Entity;
use Bitrix\Main\SystemException;

class BookTable extends Entity\DataManager
{
    public static function getTableName(): string
    {
        return 'my_book';
    }

    public static function getUfId(): string
    {
        return 'MY_BOOK';
    }

    /**
     * @throws SystemException
     */
    public static function getMap(): array
    {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            new Entity\StringField('ISBN', array(
                'required' => true,
                'column_name' => 'ISBNCODE'
            )),
            new Entity\StringField('TITLE'),
            new Entity\DateField('PUBLISH_DATE')
        );
    }
}
// код для создания таблицы в MySQL
// (получен путем вызова BookTable::getEntity()->compileDbTableStructureDump())
//CREATE TABLE `my_book` (
//`ID` int NOT NULL AUTO_INCREMENT,
//	`ISBNCODE` varchar(255) NOT NULL,
//	`TITLE` varchar(255) NOT NULL,
//	`PUBLISH_DATE` date NOT NULL,
//	PRIMARY KEY(`ID`)
//);
