#!/usr/bin/php
<?php

if (!defined('NOT_CHECK_PERMISSIONS')) {
    define('NOT_CHECK_PERMISSIONS', true);
}

define('SITE_ID', 's1');
define('LANG_ID', 'ru');
define('NO_AGENT_CHECK', true);
define('NO_KEEP_STATISTIC', true);

// cli installing
if (PHP_SAPI === 'cli') {
    $pwd = getcwd();
    echo (copy(__FILE__, $pwd.DIRECTORY_SEPARATOR.basename(__FILE__).'.php') ? "OK\n" : "Copy error\n");
    return;
}

// web usage
// options
$bxAuConf = array(
    'reusable' => isset($_REQUEST['reusable']) ? !!$_REQUEST['reusable'] : true,
);


// core
require __DIR__.'/bitrix/modules/main/include/prolog_before.php';

// authorize
if ($USER->Authorize($_REQUEST['userId'] ?: 1)) {
    // self-delete
    if (!$bxAuConf['reusable']) {
        if (!unlink(__FILE__)) {
            $USER->Logout();
            echo "Can't process self-delete. Skip authorize\n";
            return;
        }
    }

    LocalRedirect('/bitrix/admin/');
} else {
    echo "Authorize error\n";
}

