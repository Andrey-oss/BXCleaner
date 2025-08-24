<?php
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

// Module installer

class andreyoss_cleaner extends CModule
{
    var $MODULE_ID = 'andreyoss.cleaner';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $PARTNER_NAME;
    var $PARTNER_URI;

    function __construct()
    {
        $arModuleVersion = array();
        include(dirname(__FILE__).'/version.php');

        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = 'BXCleaner';
        $this->MODULE_DESCRIPTION = 'Simple Bitrix website cleaner';
        $this->PARTNER_NAME = 'Andrey-oss';
        $this->PARTNER_URI = 'https://github.com/Andrey-oss';
    }

    function InstallFiles($arParams = array())
    {
        $source = dirname(__FILE__).'/admin/andreyoss_cleaner';
        $destination = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/';

        return CopyDirFiles($source, $destination, true, true); // As it returns bool
    }

    function UnInstallFiles()
    {
        global $MODULE_ID;

        $mod_destination = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/';
        $adm_destination = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/';
        $file_arr = ['lite_cleaner.php', 'statistics.php'];

        // Delete module dir
        DeleteDirFilesEx($mod_destination . $MODULE_ID);

        // Delete file dynamically from $adm_destination
        foreach ($file_arr as $file) {
            file_exists($adm_destination . $file) && unlink($adm_destination . $file);
        }

        return true;
    }

    function DoInstall()
    {
        global $APPLICATION;

        $this->InstallFiles();
        RegisterModule($this->MODULE_ID);
    }

    function DoUninstall()
    {
        global $APPLICATION;

        $this->UnInstallFiles();

        // If you installed module with DB, don't forget to offer to save tables in it 
        UnRegisterModule($this->MODULE_ID);
    }
}
