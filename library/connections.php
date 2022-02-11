<?php

//Connection to phpmotors database
function phpmotorsConnect(){
    $server = 'localhost';
    $dbname= 'phpmotors';
    $username = 'iClient';
    $password = 'kmN*CHqcyzXUqJwD'; 
    // $password = '';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // Create the actual connection object and assign it to a variable
    try {
        $link = new PDO($dsn, $username, $password, $options);
        // echo 'Connection made succesfully';
        return $link;
    } catch(PDOException $e) {
        // echo 'Unable to connect!';
        header('Location: /phpmotors/view/500.php');
        exit;
    }
}

phpmotorsConnect();