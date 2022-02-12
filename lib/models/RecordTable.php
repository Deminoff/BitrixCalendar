<?php

namespace Demirofl\Calendar\Models;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\EnumField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\TextField;

use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\Type\DateTime;

class RecordTable extends DataManager
{
    public static function getTableName()
    {
        return "demirofl_calendar_record";
    }

    public static function getMap()
    {
        return [
            new IntegerField(
                "ID",
                [
                    "primary" => true,
                    "autocomplete" => true,
                    "title" => "ID"
                ]
            ),
            new StringField(
                "NAME",
                [
                    "required" => true,
                ]
            ),
            new DatetimeField(
                "DATE_FROM",
                [
                    "required" => true,
                ]
            ),
            new DatetimeField(
                "DATE_TO",
                [
                    "required" => true,
                ]
            ),
            new TextField(
                "DESCRIPTION"
            ),
            new EnumField(
                "STATUS",
                [
                    "values" => [
                        "пойду",
                        "не пойду",
                        "под вопросом"
                    ],
                    "required" => true
                ]
            ),
            new IntegerField(
                "USER_ID"
            ),

            (new Reference("USER", \Bitrix\Main\UserTable::class, Join::on("this.USER_ID", "ref.ID")))
        ];
    }
}
