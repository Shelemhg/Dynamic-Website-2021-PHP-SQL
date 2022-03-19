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
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php';?>
    <section>
        <div>
            <h1 class="large">Add Car Classification</h1>
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
            <form action="/phpmotors/vehicles/index.php" method="post">
                <label for="classificationName">Classification Name</label><p>Max 30 char.</p>
                <input name='classificationName' id='classificationName' type="text" required autofocus maxlength="30"
                    <?php if(isset($classificationName)){echo "value='$classificationName'";}?>>
                <br>
                <input type="submit" name="submit" class="padding-vertical padding-horizontal" value="Add Classification">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="add-class">
            </form>

        </div>
    </section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php';?>   