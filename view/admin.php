<?php
    if(!isset($_SESSION['loggedin'])){
        // do something here if the value is FALSE
        header('Location: /phpmotors/index.php');
        exit;
    }
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php';?>
    <section>
        <div>
            <h1 class="large">
                <?php
                    if(isset($_SESSION['clientData'])){
                        echo "{$_SESSION['clientData']['clientFirstname']} {$_SESSION['clientData']['clientLastname']}";
                    }
                ?>
            </h1>
            <?php
                // if($_SESSION['clientData']['clientLevel'] > 1){
                //     echo '<h2>Admin User</h2>';
                // }
            ?>
        </div>
    </section>
    <section>
        <div class="wrapper space">
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?>
            <br>            
            <p>You are logged in.</p><br>
            <ul>
                <li>
                    <?php
                            echo "First name: {$_SESSION['clientData']['clientFirstname']}";
                    ?>
                </li>
                <li>
                    <?php                        
                            echo "Last name: {$_SESSION['clientData']['clientLastname']}";
                    ?>
                </li>
                <li>
                    <?php                         
                            echo "Email name: {$_SESSION['clientData']['clientEmail']}";
                    ?>
                </li>
            </ul><br>
            <hr>
            <h2>Account Management</h2>
            <a href="/phpmotors/accounts?action=modAccount&clientId=<?php echo $_SESSION['clientData']['clientId']?>">Update Account Information</a><br><br>
            <?php
                if($_SESSION['clientData']['clientLevel'] > 1){
                    echo '<h2>Inventory Management</h2>';
                    echo "<a href='/phpmotors/vehicles/index.php'>Vehicle Management</a>";
                }
            ?>
        </div>
    </section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php';?>   