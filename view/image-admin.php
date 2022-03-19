<?php
    //Check if there is an open session, otherwise return the user to home
    if(!isset($_SESSION['loggedin'])){
        // do something here if the value is FALSE
        // header('Location: /phpmotors/index.php');
    }else{
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
           }
        //Check if the user has the right priviledges, otherwise return the user to home
        // if($_SESSION['clientData']['clientLevel'] < 2){
        //     header('Location: /phpmotors/index.php');
        //     exit;
        // }
    }
?>
<?php
//  Builds the Select List for the Drop down menu of classificaitons
// $classificationsList = "<select name='classificationId' id='cars' required>
// <option value='' disabled selected>Choose Car Classification</option>";
$classificationsList = "<select name='classificationId'>";
//  Creates the classificationsList for the drop down menu on add-vehicle.php
foreach ($classifications as $classification) {
    $classificationsList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)){
        if($classification['classificationId'] == $classificationId){            
            $classificationsList .= ' selected ';
        }
    }    
    $classificationsList .= ">$classification[classificationName]</option>";
}
$classificationsList .= "</select><br>"
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    <section>
        <div>
            <h1 class="large">Image Administration</h1>
        </div>
    </section>
    <section>
        <div class="wrapper space">
            <h2>Add New Vehicle Image</h2><hr>
            <?php
                if (isset($message)) {
                    echo $message;
                } 
            ?>

            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
                <label for="invItem">Vehicle</label>
                    <?php echo $prodSelect; ?>
                    <fieldset>
                        <label>Is this the main image for the vehicle?</label>
                        <label for="priYes" class="pImage">Yes</label>
                        <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                        <label for="priNo" class="pImage">No</label>
                        <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                    </fieldset>
                <label>Upload Image:</label>
                <input type="file" name="file1">
                <input type="submit" class="regbtn" value="Upload">
                <input type="hidden" name="action" value="upload">
            </form>
            <h2>Existing Images</h2><hr>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
                echo $imageDisplay;
            } ?>
        </div>
    </section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
 <?php unset($_SESSION['message']); ?>