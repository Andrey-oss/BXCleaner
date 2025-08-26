<?php
use Bitrix\Main\Loader;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

if (!$USER->IsAdmin()) {
    $APPLICATION->AuthForm("Insufficient permission");
}

$APPLICATION->SetTitle("Lite cleaner");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

function scanDirectory(string $dir, &$files = array()): array {
    /**
     * Scan recursively dir for files
     * 
     * @param string|int $dir Directory path
     * @return array Array of files
     */

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS)
    );
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $files[] = $file->getPathname();
        }
    }
    return $files;
}

$result = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && check_bitrix_sessid()) {
    if (isset($_POST["scan"])) {
        $files = scanDirectory($_SERVER["DOCUMENT_ROOT"]."/upload/tmp");
        $result = "Found files: " . count($files);
    }
    if (isset($_POST["clean"])) {
        $files = scanDirectory($_SERVER["DOCUMENT_ROOT"]."/upload/tmp");
        foreach ($files as $file) {
            @unlink($file);
        }
        $result = "Deleted files: " . count($files);
    }
}
?>

<form method="post">
    <?= bitrix_sessid_post() ?>
    <input type="submit" name="scan" value="Scan /upload/tmp" class="adm-btn-save">
    <input type="submit" name="clean" value="Delete files" onclick="return confirm('Are you sure?');">
</form>

<?php if ($result): ?>
    <div style="margin-top:20px; padding:10px; border:1px solid #ccc; background:#f9f9f9;">
        <?= htmlspecialcharsbx($result) ?>
    </div>
<?php endif; ?>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
