<?php


// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

$navList = getNav();



$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/accounts/index.php';
        break;
    case 'register':
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/accounts/index.php';
        break;
    case 'error':
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/500.php';
        break;
    case 'template':
        include 'view/template.php';
        break;
    // case 'registration':
    //     include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/registration.php';
    //     break;
    default:
        include  $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/home.php';
        break;
}


