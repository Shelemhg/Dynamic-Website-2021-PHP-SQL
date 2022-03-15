<?php
//VEHICLES CONTROLLER

//Create or access a Session
// session_start();
if(!isset($_SESSION)){ 
    session_start(); 
} 
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the VEHICLES model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

//  Gets the classification Array
$classifications = getClassifications();

$pageTitle = 'Vehicles';
//  Builds the navbar 
$navList = buildNav();

// //  Builds the Select List for the Drop down menu of classificaitons
// $classificationsList = '';
// $getClassifications = getClassifications();
// //  Creates the classificationsList for the drop down menu on add-vehicle.php
// foreach ($getClassifications as $classId) {
//     $classificationsList .= "<option value='$classId[classificationId]'>$classId[classificationName]</option>";
// }

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
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));


        // Check for missing data
        if(empty($invMake) || empty($invModel) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
            $message = '<br><p>ERROR - Please provide information for all empty form fields.</p><br>';
            // $message = "<p>Classification ID = $classificationId </p>";
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-vehicle.php';
            exit; 
        }
        $regOutcome = "";
        // Send the data to the model
        $regOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
        // Check and report the result
        if($regOutcome === 1){
            $message = "<p>Register of <b>'$invMake $invModel'</b> successful.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles');
            exit;
        } else {
            $message = "<p>Sorry, the registration of <b>'$invMake $invModel'</b> failed. Please try again.</p>";
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
        $regOutcome = addClassification($classificationName);
        // Check and report the result
        if($regOutcome === 1){
            // $message = "<p>Register of $invModel successful.</p>";
            $message = "";
            $navList = buildNav();
            // include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-classification.php';
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/vehicle-man.php';
            exit;
        } else {
            $message = "<p>Sorry but the registration of $classificationName failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/add-classification.php';
            exit;
        }
        break;

    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
    case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
        break;

    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';

        break;

    case 'updateVehicle':
        // Filter and store the data
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));


        // Check for missing data
        if(empty($invMake) || empty($invModel) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
            $message = '<br><p>ERROR - Please provide information for all empty form fields.</p><br>';
            // $message = "<p>Classification ID = $classificationId </p>";
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/vehicle-update.php';
            exit; 
        }
        // $updateResult = NULL;
        // Send the data to the model
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
        // Check the result
        if($updateResult){
            $message = "<p>Update of <b>'$invMake $invModel'</b> was successful.</p>";
            //we will use the session to store the message, use a header function to return to the controller, and then have the controller deliver the view and display the message. 
            // Changed from session message to regular message as this messed with the header session message.
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles');
            // include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/vehicle-man.php';
            exit;
        }else{
            $message = "<p>Sorry, the update of <b>'$invMake $invModel'</b> failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/vehicle-update.php';
            exit;
        }
        break;

    case 'del':
        if(isset($invInfo['invMake'])){ 
            $pageTitle = "Delete $invInfo[invMake] $invInfo[invModel]";
        }

        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/vehicle-delete.php';
        exit;
        break;
    
    case 'deleteVehicle':
        // Filter and store the data
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        
        // $updateResult = NULL;
        // Send the data to the model
        $deleteResult = deleteVehicle($invId);
        // Check the result
        if($deleteResult){
            $message = "<p>Deletion of <b>'$invMake $invModel'</b> was successful.</p>";
            //we will use the session to store the message, use a header function to return to the controller, and then have the controller deliver the view and display the message. 
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles');
            // include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/vehicle-man.php';
            exit;
        }else{
            $message = "<p>Deletion of <b>'$invMake $invModel'</b> failed.</p>";
            //we will use the session to store the message, use a header function to return to the controller, and then have the controller deliver the view and display the message.
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles');
            // include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/vehicle-man.php';
            exit;
        }


        break;
    
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);
        if(!count($vehicles)){
            $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        // echo $vehicleDisplay;
        // exit;
        $pageTitle = $classificationName . ' vehicles | PHP Motors, Inc.';
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/classification.php';
        break;

    case 'vehicleInfo':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);

        if(empty($invId)){
            $message = '<p>ERROR - Unable to find the Vehicle. Please try again.</p>';
            $_SESSION['message'] = $message;
            buildNav();
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/index.php';
            exit; 
        }else{
            unset($_SESSION['message']);
            $vehicle = getInvItemInfo($invId);
            $vehicleDisplay = buildVehicleInfo($vehicle);
            include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/classification.php';
        }
        

        
        break;


    default:
        $classificationList = buildClassificationList($classifications);
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/vehicle-man.php';
        break;
}



