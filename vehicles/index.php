<?php

//VEHICLES CONTROLLER


// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the VEHICLES model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';


$navList = getNav();

$classificationsList = '';
$getClassifications = getClassifications();
//  Creates the classificationsList for the drop down menu on add-vehicle.php
foreach ($getClassifications as $classId) {
    $classificationsList .= "<option value='$classId[classificationId]'>$classId[classificationName]</option>";
}



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
        $classificationId = filter_input(INPUT_POST, 'classificationId');


        // Check for missing data
        if(empty($invMake) || empty($invModel) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-vehicle.php';
            exit; 
        }
        $regOutcome = "";
        // Send the data to the model
        $regOutcome = regVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
        // Check and report the result
        if($regOutcome === 1){
            $message = "<p>Register of $invModel successful.</p>";
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-vehicle.php';
            exit;
        } else {
            $message = "<p>Sorry, the registration of $invModel failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-vehicle.php';
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
            // $message = "<p>Register of $invModel successful.</p>";
            $message = "";
            $navList = getNav();
            // include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-classification.php';
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/vehicle-man.php';
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


