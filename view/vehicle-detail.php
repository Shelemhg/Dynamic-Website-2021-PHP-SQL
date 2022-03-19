<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

<h1><?php 
echo $vehicle['invMake'];
echo " " . $vehicle['invModel'];
?></h1>
<?php 
    if(isset($message)){
        echo $message; }
?>
<div class="vehicle-images-display">
<?php
    // print_r($thumbnailsPath);
    
    if(isset($vehicleDisplay)){
        echo $vehicleDisplay;
    } 
    if(isset($thumbnailsDisplay)){
        echo $thumbnailsDisplay;
    }
?>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
