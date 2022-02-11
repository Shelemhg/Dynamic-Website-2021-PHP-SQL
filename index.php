<?php


// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

// Get the array of classifications, from the main-model.php file
$classifications = getClassifications();
// var_dump($classifications);

// TEST LINES V
// echo '<pre>' . print_r($classifications, true).'</pre>';
// 	exit;

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";

foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

// Test for the information brough from the server
// echo $navList;
// exit;



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


