<?php
use Bitrix\Main\Loader;

// Display on admin page

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php');

// Check if user has an access
if (!$USER->IsAdmin()) {
    $APPLICATION->AuthForm("Insufficient permission");
}

$APPLICATION->SetTitle(("Webserver Statistics"));

$id = 1;
$data = array();

$paths = [
    "Cache from components"             => $_SERVER["DOCUMENT_ROOT"]."/bitrix/cache/",
    "Cache from templates"              => $_SERVER["DOCUMENT_ROOT"]."/bitrix/managed_cache/",
    "Session information"               => session_save_path(), // From php.ini
    "Logs"                              => $_SERVER["DOCUMENT_ROOT"]."/bitrix/log/",
    "Temporary files"                   => $_SERVER["DOCUMENT_ROOT"]."/upload/tmp/",
    "Agent cache"                       => $_SERVER["DOCUMENT_ROOT"]."/bitrix/managed_cache/agents/",
    "Uploaded files older than X days"  => $_SERVER["DOCUMENT_ROOT"]."/upload/old_files/",
    "Backup files"                      => $_SERVER["DOCUMENT_ROOT"]."/bitrix/backup/",
    "Module cache"                      => $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/.settings/",
    "Event logs"                        => $_SERVER["DOCUMENT_ROOT"]."/bitrix/managed_cache/event_log/",
    "MYSQL logs"                        => $_SERVER["DOCUMENT_ROOT"]."/bitrix/managed_cache/MYSQL/"
];

function getFolderSize(string $dir): float|int {
    /**
     * Function for calculating dir size
     * 
     * @param string $dir Directory path
     * @return float|int Directory size in MB
     */

    $size = 0;
    if (!is_dir($dir)) return $size;

    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $size += $file->getSize();
        }
    }
    return round($size / 1024 / 1024, 2); // MB
}

// Go through all the paths
foreach ($paths as $name => $path) {
    $data[] = [
        "ID"    => $id++,
        "NAME"  => $name,
        "SIZE"  => getFolderSize($path) . " MB",
        "PATH"  => $path
    ];
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>

<h2>Webserver statistics</h2>

<table class="internal" cellspacing="0" cellpadding="3" border="0" width="60%">
    <tr class="heading">
        <td>ID</td>
        <td>Name</td>
        <td>Value</td>
        <td>Path</td>
    </tr>
    <?php foreach ($data as $row): ?>
        <tr style="width: 50%; text-align: center; margin: auto; border-collapse: collapse;">
            <td><?= $row["ID"] ?></td>
            <td><?= htmlspecialcharsbx($row["NAME"]) ?></td>
            <td><?= htmlspecialcharsbx($row["SIZE"]) ?></td>
            <td><?= htmlspecialcharsbx($row["PATH"]) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_admin.php');
