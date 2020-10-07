<?php

use Delight\Auth\Auth;

session_start();

define("PROJECT_PATH", dirname(__FILE__));
require_once PROJECT_PATH . '/vendor/autoload.php';

define("DBNAME", "delight-authentication-mvc");
// TODO: Replace username and password before going into production
define("DBUSER", "root");
define("DBPASS", "root");
$db = new PDO('mysql:dbname=' . DBNAME . ';host=localhost;charset=utf8mb4', DBUSER, DBPASS);

// TODO: Set throttling to true before going into production
$ip = $_SERVER['SERVER_ADDR'];
$auth = new Auth($db, $ip, '', false);

$smarty = new Smarty();
$smarty->setTemplateDir(PROJECT_PATH . '/views/');
$smarty->setCompileDir(PROJECT_PATH . '/templates_c/');
$smarty->setConfigDir(PROJECT_PATH . '/configs/');
$smarty->setCacheDir(PROJECT_PATH . '/cache/');
// TODO: Set debugging to false before going into production
$smarty->debugging = true;

require_once(PROJECT_PATH . '/controllers/HomeController.php');
require_once(PROJECT_PATH . '/controllers/AuthController.php');
$homeController = new HomeController();
$authController = new AuthController();

