<?php

//  PHP MOTORS MAIN CONTROLLER

//Create or access a Session
if(!isset($_SESSION)){ 
    session_start(); 
} 
// session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';


$pageTitle = 'Welcome to PHP Motors!';

$navList = getNav();




$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}
// $_SESSION['message'] = "Welcome {$clientData['clientFirstname']}";

switch ($action) {
    case 'login-page':
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


