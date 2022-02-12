<?php

namespace Demirofl\Calendar\Controller;

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Type\DateTime;
use Demirofl\Calendar\Models\RecordTable;

class Ajax extends Controller
{
    public function configureActions()
    {
        return [
            "getRecords" => [
                "prefilters" => []
            ]
        ];
    }

    protected static function getUserId()
    {
        global $USER;

        if (!$userId = $USER->GetID()) {
            $userId = 0;
        }

        return $userId;
    }

    //TODO: не работает фильтр на один день, нужно потом исправить
    public function getRecordsAction($filter = []): array
    {
        $filter = array_merge($filter, ["USER_ID" => self::getUserId()]);

        $dbRes = RecordTable::getList([
            "select" => ["*"],
            "filter" => $filter
        ]);

        $return = [];

        if ($dbRes) {
            while ($res = $dbRes->fetch()) {
                $return[] = $res;
            }
        }

        return $return;
    }

    public function addRecordAction($record) {
        $result = RecordTable::add([
            "NAME" => $record["NAME"],
            "DATE_FROM" => new DateTime($record["DATE_FROM"], "Y-m-d H:i:s"),
            "DATE_TO" => new DateTime($record["DATE_TO"], "Y-m-d H:i:s"),
            "DESCRIPTION" => $record["DESCRIPTION"],
            "STATUS" => $record["STATUS"],
            "USER_ID" => self::getUserId()
        ]);

        if ($result->isSuccess())
        {
            return $result->getId();
        }
    }
}

