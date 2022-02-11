<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
            <section>
                <div>
                    <h1 class="large">Vehicle Management</h1>
                </div>
            </section>
            <section>
                <div class="wrapper space">
                    <?php
                    if (isset($message)){
                        echo $message;
                    }
                    ?>
                    <ul>
                        <li>                        
                            <a href="/phpmotors/vehicles/index.php?action=add-classification-page">
                                Add Classification
                            </a>
                        </li>
                        <br>
                        <li>                        
                            <a href="/phpmotors/vehicles/index.php?action=add-vehicle-page">
                                Add Vehicle
                            </a>
                        </li>
                    </ul>
                    

                </div>
            </section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>   