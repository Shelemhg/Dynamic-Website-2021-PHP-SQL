<?php
    //Check if there is an open session, otherwise return the user to home
    if(!isset($_SESSION['loggedin'])){
        // do something here if the value is FALSE
        header('Location: /phpmotors/index.php');
    }else{
        //Check if the user has the right priviledges, otherwise return the user to home
        if($_SESSION['clientData']['clientLevel'] < 2){
            header('Location: /phpmotors/index.php');
            exit;
        }
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
    }elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId'] === $invInfo['classificationId']){
            $classificationsList .= ' selected';
        }
    }   
    $classificationsList .= ">$classification[classificationName]</option>";
}
$classificationsList .= "</select><br>"
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    <section>
        <div>
            <h1>
                <?php 
                    if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
                        echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
                    elseif(isset($invMake) && isset($invModel)) {
                        echo "Modify$invMake $invModel"; }
                ?>
            </h1>
        </div>
    </section>
    <section>
        <div class="wrapper space">
            <h2>*Not all Fields are Required</h2>
            <form action="/phpmotors/vehicles/index.php" method="post">
                <br>
                    <?php 
                        if(!empty($classificationsList)){
                            echo $classificationsList;
                        }
                    ?>                
                <label for="invMake">Make</label><br>
                <input name='invMake' id='invMake' type="text" required 
                    <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>
                <label for="invModel">Model</label><br>
                <input name='invModel' id='invModel' type="text" required
                    <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>
                <label for="invDescription">Description</label><br>
                <textarea name="invDescription" id="invDescription" required>
                    <?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?>
                </textarea><br>
                <label for="invImage">Image Path</label><br>
                <input name='invImage' id='invImage' type="text" value="/phpmotors/images/no-image.png"
                    <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>><br>
                <label for="invThumbnail">Thumbnail Path</label><br>
                <input name='invThumbnail' id='invThumbnail' type="text" value="/phpmotors/images/no-image.png" 
                    <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>><br>
                <label for="invPrice">Price</label><br>
                <input name='invPrice' id='invPrice' type="number" step="0.01" 
                    <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>><br>
                <label for="invStock">Stock</label><br>
                <input name='invStock' id='invStock' type="number" 
                    <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>><br>
                <label for="invColor">Color</label><br>
                <input name='invColor' id='invColor' type="text" 
                    <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>><br>

                <?php
                    if (isset($message)){
                        echo $message;
                    }
                ?>
                <input type="submit" name="submit" class="extra-padding" value="Update Vehicle">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updateVehicle">
                <input type="hidden" name="invId" value="
                    <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                    elseif(isset($invId)){ echo $invId; } ?>
                    ">
            </form>

        </div>
    </section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>   