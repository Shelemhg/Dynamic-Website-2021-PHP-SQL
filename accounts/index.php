<?php

//ACCOUNTS CONTROLLER



// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the accounts model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';




// Get the array of classifications, from the main-model.php file
$classifications = getClassifications();

// TEST LINES V
// var_dump($classifications);
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
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/login.php';
        break;
    case 'registration':
        // Filter and store the data
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/registration.php';
        break;
    case 'register':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
        $clientLastname = filter_input(INPUT_POST, 'clientLastname');
        $clientEmail = filter_input(INPUT_POST, 'clientEmail');
        $clientPassword = filter_input(INPUT_POST, 'clientPassword');

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/registration.php';
            exit; 
        }
        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
        // Check and report the result
        if($regOutcome === 1){
            $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/registration.php';
            exit;
        }
        break;
    default:
        break;
}

