<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Entity\Base;

Loc::loadMessages(__FILE__);


class demirofl_calendar extends CModule
{
    const PartnerName = "demirofl";
    const SolutionName = "calendar";

    var $MODULE_ID = "demirofl.calendar";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;

    public function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->MODULE_NAME = Loc::getMessage("DEMIROFL_CALENDAR_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("DEMIROFL_CALENDAR_DESCRIPTION");

        $this->PARTNER_NAME = Loc::getMessage("DEMIROFL_CALENDAR_PARTNER_NAME");
    }

    public function DoInstall()
    {
        $this->InstallFiles();
        ModuleManager::registerModule($this->MODULE_ID);
        $this->InstallDB();
    }

    public function InstallDB()
    {
        Loader::includeModule($this->MODULE_ID);

        if (!Application::getConnection(\Demirofl\Calendar\Models\RecordTable::getConnectionName())
            ->isTableExists(Base::getInstance("\Demirofl\Calendar\Models\RecordTable")
                ->getDBTableName()
            )) {
            Base::getInstance("\Demirofl\Calendar\Models\RecordTable")->createDbTable();
        }
    }

    public function InstallFiles()
    {
        CopyDirFiles(__DIR__ . '/css/', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/css/' . self::PartnerName . '.' . self::SolutionName, true, true);
        CopyDirFiles(__DIR__ . '/js/', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/js/' . self::PartnerName . '.' . self::SolutionName, true, true);
        CopyDirFiles(__DIR__ . "/components/", $_SERVER["DOCUMENT_ROOT"] . "/local/components/" . self::PartnerName, true, true);
        CopyDirFiles(__DIR__ . "/public/", $_SERVER["DOCUMENT_ROOT"] . "/". self::SolutionName, true, true);
    }

    public function DoUninstall()
    {
        $this->UnInstallFiles();
        $this->UnInstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function UnInstallDB()
    {
        Loader::includeModule($this->MODULE_ID);

        Demirofl\Calendar\Models\RecordTable::getEntity()
            ->getConnection()
            ->queryExecute(
                'drop table if exists ' . Demirofl\Calendar\Models\RecordTable::getTableName()
            );
    }

    public function UnInstallFiles()
    {
        DeleteDirFilesEx("/local/components/" . self::PartnerName . "/" . self::SolutionName . "/");
        DeleteDirFilesEx("/bitrix/js/" . self::PartnerName . "." . self::SolutionName);
        DeleteDirFilesEx("/bitrix/css/" . self::PartnerName . "." . self::SolutionName);
        DeleteDirFilesEx("/" . self::SolutionName);
    }
}
