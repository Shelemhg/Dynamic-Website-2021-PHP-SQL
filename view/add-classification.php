<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
            <section>
                <div>
                    <h1 class="large">Add Car Classification</h1>
                </div>
            </section>
            <section>
                <div class="wrapper space">
                    <form action="/phpmotors/vehicles/index.php" method="post">
                        <label for="classificationName">Classification Name</label><br>
                        <input name='classificationName' id='classificationName' type="text" ><br>
                        <?php
                            if (isset($message)){
                                echo $message;
                            }
                        ?>
                        <input type="submit" name="submit" class="submit-btn" value="Add Classification"></input>
                        <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="add-class">
                    </form>

                </div>
            </section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>   