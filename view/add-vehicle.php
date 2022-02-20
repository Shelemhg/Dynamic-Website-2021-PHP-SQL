<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    <section>
        <div>
            <h1 class="large">Add Vehicle</h1>
        </div>
    </section>
    <section>
        <div class="wrapper space">
            <h2>*Not all Fields are Required</h2>
            <form action="/phpmotors/vehicles/index.php" method="post">
                <br>  
                <select name='classificationId' id="cars" required>
                    <option value="" disabled selected>Choose Car Classification</option>
                    <?php 
                        if(!empty($classificationsList)){
                            echo $classificationsList;
                        }
                    ?>
                </select><br>
                <label for="invMake">Make</label><br>
                <input name='invMake' id='invMake' type="text" required 
                    <?php if(isset($invMake)){echo "value='$invMake'";}?>><br>
                <label for="invModel">Model</label><br>
                <input name='invModel' id='invModel' type="text" required
                    <?php if(isset($invModel)){echo "value='$invModel'";}?>><br>
                <label for="invDescription">Description</label><br>
                <input name='invDescription' id='invDescription' type="text" 
                    <?php if(isset($invDescription)){echo "value='$invDescription'";}?>><br>
                <label for="invImage">Image Path</label><br>
                <input name='invImage' id='invImage' type="text" value="/phpmotors/images/no-image.png"
                    <?php if(isset($invImage)){echo "value='$invImage'";}?>><br>
                <label for="invThumbnail">Thumbnail Path</label><br>
                <input name='invThumbnail' id='invThumbnail' type="text" value="/phpmotors/images/no-image.png" 
                    <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}?>><br>
                <label for="invPrice">Price</label><br>
                <input name='invPrice' id='invPrice' type="number" 
                    <?php if(isset($invPrice)){echo "value='$invPrice'";}?>><br>
                <label for="invStock">Stock</label><br>
                <input name='invStock' id='invStock' type="number" 
                    <?php if(isset($invStock)){echo "value='$invStock'";}?>><br>
                <label for="invColor">Color</label><br>
                <input name='invColor' id='invColor' type="text" 
                    <?php if(isset($invColor)){echo "value='$invColor'";}?>><br>

                <?php
                    if (isset($message)){
                        echo $message;
                    }
                ?>
                <input type="submit" name="submit" class="extra-padding" value="Add Vehicle">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="add-vehicle">
            </form>

        </div>
    </section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>   