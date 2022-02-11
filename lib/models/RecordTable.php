<?php

namespace Demirofl\Calendar\Models;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\EnumField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\TextField;

use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;

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
            new DateField(
                "DATE",
                [
                    "required" => true,
                ]
            ),
            new TextField(
                "DESCRIPTION",
            ),
            new EnumField(
                "STATUS",
                [
                    "values" => [
                        "пойду",
                        "под вопросом",
                        "не пойду"
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
