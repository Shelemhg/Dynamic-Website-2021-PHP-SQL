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
                        <select name="cars" id="cars">
                            <option value="" disabled selected>Choose Car Classification</option>
                            <?php 
                                if(!empty($classificationsList)){
                                    echo $classificationsList;
                                }
                            ?>
                        </select><br>                                            
                        <label for="invMake">Make</label><br>
                        <input name='invMake' id='invMake' type="text"><br>
                        <label for="invModel">Model</label><br>
                        <input name='invModel' id='invModel' type="text"><br>
                        <label for="invDescription">Description</label><br>
                        <input name='invDescription' id='invDescription' type="text" ><br>
                        <label for="invImage">Image Path</label><br>
                        <input name='invImage' id='invImage' type="text"><br>
                        <label for="invThumbnail">Thumbnail Path</label><br>
                        <input name='invThumbnail' id='invThumbnail' type="text"><br>
                        <label for="invPrice">Price</label><br>
                        <input name='invPrice' id='invPrice' type="number"><br>
                        <label for="invStock">Stock</label><br>
                        <input name='invStock' id='invStock' type="number"><br>
                        <label for="invColor">Color</label><br>
                        <input name='invColor' id='invColor' type="text"><br>

                        <?php
                            if (isset($message)){
                                echo $message;
                            }
                        ?>
                        <input type="submit" name="submit" class="submit-btn" value="Add Classification"></input>
                        <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="add-vehicle">
                    </form>

                </div>
            </section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>   