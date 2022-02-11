<?php
namespace Demirofl\Calendar\General;


class CalendarGeneral
{
    public static function init() {
        \Bitrix\Main\Page\Asset::getInstance()->addString("<link rel='stylesheet' href='/bitrix/css/demirofl.calendar/fullcalendar.min.css'>");
        \Bitrix\Main\Page\Asset::getInstance()->addString("<script src='/bitrix/js/demirofl.calendar/fullcalendar.min.js'></script>");
    }
}
