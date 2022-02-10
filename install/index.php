<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

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
        $this->InstallDB();
        ModuleManager::registerModule($this->MODULE_ID);
    }

    public function InstallDB()
    {
        return parent::InstallDB(); // TODO: Change the autogenerated stub
    }

    public function InstallFiles()
    {
        CopyDirFiles(
            __DIR__."/components",
            $_SERVER["DOCUMENT_ROOT"]."/local/components/".self::PartnerName,
            true,
            true,
        );
    }


    public function DoUninstall()
    {
        $this->UnInstallFiles();
        $this->UnInstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function UnInstallDB()
    {
        parent::UnInstallDB();
    }

    public function UnInstallFiles()
    {
        DeleteDirFilesEx(
            "/local/components/".self::PartnerName."/".self::SolutionName."/",
        );
    }
}
