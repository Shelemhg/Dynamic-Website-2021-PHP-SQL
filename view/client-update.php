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
                    echo 'Manage Account';
                    // echo "{$_SESSION['clientData']['clientFirstname']} {$_SESSION['clientData']['clientLastname']}";
                }
            ?>
        </h1>
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
        <p>Update Account</p><br>
        <form action="/phpmotors/accounts/" method="post">
            <label for="clientFirstname">First Name</label><br>
            <input name='clientFirstname' id='clientFirstname' type="text" required autofocus 
                <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($clientInfo['clientFirstname'])) {echo "value='$clientInfo[clientFirstname]'"; }?>><br>
            <label for="clientLastname">Last Name</label><br>
            <input name='clientLastname' id='clientLastname' type="text" required 
                <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($clientInfo['clientLastname'])) {echo "value='$clientInfo[clientLastname]'"; }?>><br>
            <label for="clientEmail">Email</label><br>
            <input name='clientEmail' id='clientEmail' type="email" placeholder="Enter a valid email address" required 
                <?php 
                    if(isset($clientEmail)){
                        echo "value='$clientEmail'";
                    }elseif(isset($clientInfo['clientEmail'])) {
                        echo "value='$clientInfo[clientEmail]'";
                    }
                ?>><br>
            
            <input type="submit" name="submit" class="submit-btn" value="Update">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="updateClient">
            <input type="hidden" name="clientId" value="
                <?php 
                    if(isset($clientInfo['clientId'])){ 
                        echo $clientInfo['clientId'];} 
                    elseif(isset($clientId)){ 
                        echo $clientId;}
                    ?>
                ">
        </form>


        <form action="/phpmotors/accounts/" method="post">
            <label for="clientPassword">Password Change</label><br>
            <span>Password must be at least 8 characters long and contain at least 1 number, 1 capital letter and 1 symbol</span><br>
            <input name='clientPassword' id='clientPassword' type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>


            
            <input type="submit" name="submit" class="submit-btn" value="Update Password">
            <input type="hidden" name="clientId" value="
                <?php 
                    if(isset($clientInfo['clientId'])){ 
                        echo $clientInfo['clientId'];} 
                    elseif(isset($clientId)){ 
                        echo $clientId;}
                    ?>
                ">
            <input type="hidden" name="action" value="updatePassword">
        </form>   
        
    </div>
</section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php';?>   