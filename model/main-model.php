<?php

/*
MAIN PHP MOTORS MODEL
*/

// function getClassifications(){
//     // Create a connection object from the phpmotors connection function
//     $db = phpmotorsConnect(); 
//     // The SQL statement to be used with the database 
//     $sql = 'SELECT classificationName FROM carclassification ORDER BY classificationName ASC'; 
    
//     // Creates the prepared statement using the phpmotors connection      
//     $stmt = $db->prepare($sql);
    
//     // Runs the prepared statement 
//     $stmt->execute(); 
    
//     // Gets the data from the database and 
//     // stores it as an array in the $classifications variable 
//     $classifications = $stmt->fetchAll(); 
    
//     // Closes the interaction with the database 
//     $stmt->closeCursor(); 

//     // Sends the array of data back to where the function 
//     // was called (this should be the controller) 
//     return $classifications;
// }

function getClassifications(){
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    // The SQL statement to be used with the database 
    $sql = 'SELECT * FROM carclassification ORDER BY classificationName ASC'; 
    
    // Creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    
    // Runs the prepared statement 
    $stmt->execute(); 
    
    // Gets the data from the database and 
    // stores it as an array in the $classifications variable 
    $classIds = $stmt->fetchAll(); 
    
    // Closes the interaction with the database 
    $stmt->closeCursor(); 

    // Sends the array of data back to where the function 
    // was called (this should be the controller) 
    return $classIds;
}

function getNav(){
    // Get the array of classifications, from the main-model.php file
    $classifications = getClassifications();
    // TEST LINES V
    // var_dump($classifications);
    // 	exit;

    // Build a navigation bar using the $classifications array
    $navList = '<ul>';
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

