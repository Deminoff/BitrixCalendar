<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Engine\Controller;
use Demirofl\Calendar\Models\RecordTable;

Loader::includeModule("demirofl.calendar");

class AjaxController extends Controller
{
    /**
     * @return array
     */
    public function configureActions()
    {
        return [
            'test' => [
                'prefilters' => []
            ]
        ];
    }

    /**
     * @param string $param2
     * @param string $param1
     * @return array
     */

    private static function getUserId()
    {
        global $USER;

        $id = 0;

        if($USER->IsAuthorized()){
            $id = $USER->GetID();
        }

        return $id;
    }

    public static function getRecordsAction($dateBegin, $dateEnd): array
    {

        $userId = self::getUserId();

        $dbRes = RecordTable::getList([
            "select" => ["*"],
            "filter" => [
                "USER_ID" => $userId,
                ">=DATE" => new \Bitrix\Main\Type\DateTime(date_create_from_format('Y-m-d', $dateBegin)->format('d.m.Y 00:00:00')),
                "<=DATE" => new \Bitrix\Main\Type\DateTime(date_create_from_format('Y-m-d', $dateEnd)->format('d.m.Y 23:59:59')),
            ]
        ]);

        $records = [];

        if($dbRes){
            while($res = $dbRes->fetch()) {
                $records[] = [
                    "id" => $res["ID"],
                    "title" => $res["DESCRIPTION"],
                    "start" => $res["DATE"],
                ];
            }
        }

        return $records;
    }


    public static function addRecordAction($date) {
        return [
            'date' => $date,
        ];
    }

}
