<?php
if ($USER->isAdmin()) {
    $MODULE_ID = basename(dirname(__FILE__));

    $aMenu = array(
        'parent_menu' => 'global_menu_services',
        'section' => '',
        'sort' => 700,
        'text' => 'BXCleaner',
        'title' => 'BXCleaner',
        'icon' => '',
        'page_icon' => '',
        'items_id' => $MODULE_ID.'_items',
        'items' => array(
            array(
                'text' => 'Webserver statistics',
                'url' => 'statistics.php',
                'title' => 'Webserver statistics'
            ),
            array(
                'text' => 'Lite cleaner',
                'url' => 'lite_cleaner.php',
                'title' => 'Lite cleaner'
            )
        )
    );
    return $aMenu;
    
}
return false;
