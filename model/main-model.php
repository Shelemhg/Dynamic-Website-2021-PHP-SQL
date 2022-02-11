<?php

/*
MAIN PHP MOTORS MODEL
*/

function getClassifications(){
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    // The SQL statement to be used with the database 
    $sql = 'SELECT classificationName FROM carclassification ORDER BY classificationName ASC'; 
    
    // Creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    
    // Runs the prepared statement 
    $stmt->execute(); 
    
    // Gets the data from the database and 
    // stores it as an array in the $classifications variable 
    $classifications = $stmt->fetchAll(); 
    
    // Closes the interaction with the database 
    $stmt->closeCursor(); 

    // Sends the array of data back to where the function 
    // was called (this should be the controller) 
    return $classifications;
}