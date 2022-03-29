<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

<h1>Search Results</h1>
<?php 
    if(isset($message)){
        echo $message; }
?>
<div class="vehicle-images-display">
<?php
    // print_r($thumbnailsPath);
    
    if(isset($searchDisplay)){
        echo $searchDisplay;
        // print_r($searchDisplay);
        // print_r($searchResult[2]['invDescription']);
        echo "<br><br>Total Res:".  $totalResults . " Total Pages:" . $totalPages . "  Current Page:" . $_SESSION['currentPage'] . " New Search:" . $newSearch;
    }
?>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
