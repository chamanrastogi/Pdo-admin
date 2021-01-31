<?php
// Define the core paths
// Define them as absolute paths to make sure that include works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)

defined('DS') ? null : define('DS', '/');
$path = realpath(dirname(__FILE__));
date_default_timezone_set('Asia/Kolkata');

$path = explode("\includes", $path);

defined('SITE_ROOT') ? null : define('SITE_ROOT', $path[0]);
defined('MYF') ? null : define('MYF', 'test/defence/');

$base_url = "http://".$_SERVER['SERVER_NAME'].DS.MYF;

defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT . DS . 'includes');
defined('BASE_PATH') ? null : define('BASE_PATH', $base_url);
defined('BASE_FOLDER') ? null : define('BASE_FOLDER', 'public');	
defined('TP_BACK') ? null : define('TP_BACK', $base_url.'public'.DS);
defined('TP_BACK_SIDE') ? null : define('TP_BACK_SIDE', $base_url.'public'.DS.'admin'.DS);
defined('FULL_PATH') ? null : define('FULL_PATH', BASE_FOLDER.'/editor/files/Uploads/');
defined('UPLOAD_PATH') ? null : define('UPLOAD_PATH', '/editor/files/Uploads/');
defined('ADF') ? null : define('ADF', 'public'.DS.'admin'.DS);

include (LIB_PATH.DS.'config.php');
include (LIB_PATH.DS.'session.php');
include (LIB_PATH.DS.'database.php');
include (LIB_PATH.DS.'database_object.php');
include (LIB_PATH.DS.'functions.php');
include (LIB_PATH.DS.'forms.php');
include (LIB_PATH.DS.'router.php');

require 'vendor/autoload.php';
?>
