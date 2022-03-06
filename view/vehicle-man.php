<?php
    //Check if there is an open session, otherwise return the user to home
    if(!isset($_SESSION['loggedin'])){
        // do something here if the value is FALSE
        header('Location: /phpmotors/index.php');
        exit;
    }else{
        //Check if the user has the right priviledges, otherwise return the user to home
        if($_SESSION['clientData']['clientLevel'] < 2){
            header('Location: /phpmotors/index.php');
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
            }
            exit;
        }
    }
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
            <section>
                <div>
                    <h1 class="large">Vehicle Management</h1>
                </div>
            </section>
            <section>
                <div class="wrapper space">
                    <?php
                    // if (isset($message)){
                    //     echo $message;
                    // }
                    ?>
                    <ul>
                        <li>                        
                            <a href="/phpmotors/vehicles/index.php?action=add-classification-page" class="no-horizontal-padding">
                                Add Classification
                            </a>
                        </li>
                        <li>                        
                            <a href="/phpmotors/vehicles/index.php?action=add-vehicle-page" class="no-horizontal-padding">
                                Add Vehicle
                            </a>
                        </li>
                    </ul>
                    

                </div>
                <?php
                    if (isset($message)) { 
                        echo $message; 
                    } 
                    if (isset($classificationList)) { 
                        echo '<h2>Vehicles By Classification</h2>'; 
                        echo '<p>Choose a classification to see those vehicles</p>'; 
                        echo $classificationList; 
                    }
                ?>
                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>
                <table id="inventoryDisplay"></table>

            </section>
            <script src="../JavaScript/inventory.js"></script>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
 <?php unset($_SESSION['message']); ?>