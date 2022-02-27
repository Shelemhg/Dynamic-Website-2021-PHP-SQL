<?php

function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}


//  Check the password for a minimum of 8 charactersl
//  at least 1 capital letter, at least 1 number and 
//  at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function getNav(){
    // Get the array of classifications, from the main-model.php file
    $classifications = getClassifications();
    // TEST LINES V
    // var_dump($classifications);
    // 	exit;

    // Build a navigation bar using the $classifications array
    $navList = '<ul>';
    // $navList .= '<button onclick="toggleMenu()">&#9776;</button>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page' class='horizontal-padding'>Home</a></li>";

    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line' class='horizontal-padding'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    
    // Test for the information brough from the server
    // echo $navList;
    // exit;

    return $navList;
}



?>