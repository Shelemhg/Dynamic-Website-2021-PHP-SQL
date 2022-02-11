<?php

//VEHICLES CONTROLLER



// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the accounts model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';
// Get the accounts model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';


// Get the array of classifications, from the main-model.php file
$classifications = getClassifications();
$classificationsList = '';
// TEST LINES V
// var_dump($classifications);
// 	exit;

foreach ($classifications as $classification) {
    $classificationsList .= "<option value='$classification[classificationName]'>$classification[classificationName]</option>";
}



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
    case 'add-classification-page':
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-classification.php';
        break;
    case 'add-vehicle-page':
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-vehicle.php';
        break;
    case 'add-vehicle':
        // Filter and store the data
        $invMake = filter_input(INPUT_POST, 'invMake');
        $invModel = filter_input(INPUT_POST, 'invModel');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invImage = filter_input(INPUT_POST, 'invImage');
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invColor = filter_input(INPUT_POST, 'invColor');

        // Check for missing data
        if(empty($invMake) || empty($invModel) || empty($clientEmail) || empty($invPrice) || empty($invStock) || empty($invColor)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-vehicle.php';
            exit; 
        }
        $regOutcome = "";
        // Send the data to the model
        $regOutcome = regVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor);
        // Check and report the result
        if($regOutcome === 1){
            $message = "<p>Register of $invModel successful.</p>";
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/login.php';
            exit;
        } else {
            $message = "<p>Sorry, the registration of $invModel failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/registration.php';
            exit;
        }
        break;        
    case 'add-class':
        // Filter and store the data
        $classificationName = filter_input(INPUT_POST, 'classificationName');

        // Check for missing data
        if(empty($classificationName)){
            $message = '<p>Please provide a Classification Name.</p>';
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-classification.php';
            exit; 
        }
        $regOutcome = "";

        // Send the data to the model
        $regOutcome = regClassification($classificationName);
        // Check and report the result
        if($regOutcome === 1){
            $message = "<p>Registration of $classificationName was successful.</p>";
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-classification.php';
            exit;
        } else {
            $message = "<p>Sorry but the registration of $classificationName failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-classification.php';
            exit;
        }
        break;
    default:
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/vehicle-man.php';
        break;
}


