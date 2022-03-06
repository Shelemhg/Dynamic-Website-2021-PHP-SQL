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
                    if(isset($invInfo['invMake'])){ 
                        echo "Delete $invInfo[invMake] $invInfo[invModel]";
                    }
                ?>
            </h1>
        </div>
    </section>
    <section>
        <div class="wrapper space">
            <h2>*Confirm Vehicle Deletion. The delete is permanent.</h2>
            <form method="post" action="/phpmotors/vehicles/">
                <fieldset>
                    <label for="invMake">Vehicle Make</label>
                    <input type="text" readonly name="invMake" id="invMake" <?php
                        if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>

                    <label for="invModel">Vehicle Model</label>
                    <input type="text" readonly name="invModel" id="invModel" <?php
                        if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>

                    <label for="invDescription">Vehicle Description</label>
                    <textarea name="invDescription" readonly id="invDescription"><?php
                        if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
                        ?>
                    </textarea>

                    <input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

                    <input type="hidden" name="action" value="deleteVehicle">
                    <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
                        echo $invInfo['invId'];} ?>">

                </fieldset>
            </form>

        </div>
    </section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>   