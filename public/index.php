<?php

require_once('../initialize.php');

$route = isset($_GET['route']) && !empty($_GET['route']) ? $_GET['route'] : 'home';

switch ($route) {
    // Views
    case 'home':
        $homeController->home($smarty);
        break;
    case 'register':
        $homeController->register($smarty);
        break;
    // Processing
    case 'processregistration':
        $authController->processregistration($auth);
        break;
    // Page not found
    default:
        $homeController->notfound($smarty);
        break;
}