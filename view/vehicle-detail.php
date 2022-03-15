<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

<h1><?php 
echo $vehicle['invMake'];
echo " " . $vehicle['invModel'];
?></h1>
<?php 
    if(isset($message)){
        echo $message; }
?>
<?php if(isset($vehicleDisplay)){
 echo $vehicleDisplay;
} ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
