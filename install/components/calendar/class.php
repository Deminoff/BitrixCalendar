<?
use Demirofl\Calendar\General\CalendarGeneral;
use Bitrix\Main\Loader;

Loader::includeModule("demirofl.calendar");

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class Calendar extends CBitrixComponent
{
    public function executeComponent()
    {
        CalendarGeneral::init();

        $this->includeComponentTemplate();
    }
}
