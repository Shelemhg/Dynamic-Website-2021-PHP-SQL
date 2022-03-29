<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

<h1>Search Results</h1>
<?php 
    if(isset($message)){
        echo $message; }
?>
<div class="search-results">
<?php
    // print_r($thumbnailsPath);
    
    if(isset($searchDisplay)){
        echo $searchDisplay;
    }
?>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
