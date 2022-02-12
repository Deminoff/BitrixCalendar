<?php
namespace Demirofl\Calendar\General;


class CalendarGeneral
{
    public static function init() {
        \CJSCore::init(["jquery3"]);
        \Bitrix\Main\Page\Asset::getInstance()->addString("<link rel='stylesheet' href='/bitrix/css/demirofl.calendar/fullcalendar.min.css'>");
        \Bitrix\Main\Page\Asset::getInstance()->addString("<link rel='stylesheet' href='/bitrix/css/demirofl.calendar/jqModal.css'>");

        \Bitrix\Main\Page\Asset::getInstance()->addString("<script src='/bitrix/js/demirofl.calendar/fullcalendar.min.js'></script>");
        \Bitrix\Main\Page\Asset::getInstance()->addString("<script src='/bitrix/js/demirofl.calendar/jqModal.js'></script>");
    }
}
