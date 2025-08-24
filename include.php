<?php

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();
use Bitrix\Main\Loader;
Loader::registerAutoLoadClasses('andreyoss_cleaner', array(
    'andreyoss${MODULE}${VENDOR}cleanerTable' => 'lib/class.php',
));
