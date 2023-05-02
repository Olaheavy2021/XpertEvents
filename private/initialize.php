<?php
require_once("/home/SHU/c2042523/public_html/xpertevents/private/class/databaseobject.class.php");
require_once("/home/SHU/c2042523/public_html/xpertevents/private/class/session.class.php");
//require_once("../private/class/databaseobject.class.php");
//require_once("../private/class/session.class.php");
ob_start(); // turn on output buffering

// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

// Assign the root URL to a PHP constant
// * Do not need to include the domain
// * Use same document root as webserver
// * Can set a hardcoded value:
// define("WWW_ROOT", '');
// * Can dynamically find everything in URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

require_once('functions.php');

require_once('status_error_functions.php');
require_once('db_credentials.php');
require_once('user_roles_constants.php');
require_once('database_functions.php');
require_once('validation_functions.php');


error_reporting(E_WARNING);

$database = db_connect();
DatabaseObject::setDatabase($database);

$session = new Session;
