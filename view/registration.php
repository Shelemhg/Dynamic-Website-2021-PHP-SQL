<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    <section>
        <div>
            <h1 class="large">Register</h1>
        </div>
        <div class="wrapper space">
            <?php
                if (isset($message)){
                    echo $message;
                }
            ?>
            <form action="/phpmotors/accounts/index.php" method="post">
                <label for="clientFirstname">First Name</label><br>
                <input name='clientFirstname' id='clientFirstname' type="text" required autofocus 
                    <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>><br>
                <label for="clientLastname">Last Name</label><br>
                <input name='clientLastname' id='clientLastname' type="text" required 
                    <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>><br>
                <label for="clientEmail">Email</label><br>
                <input name='clientEmail' id='clientEmail' type="email" placeholder="Enter a valid email address" required 
                    <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>><br>
                <label for="clientPassword">Password</label><br>
                <span>Password must be at least 8 characters long and contain at least 1 number, 1 capital letter and 1 symbol</span><br>
                <input name='clientPassword' id='clientPassword' type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                
                <input type="submit" name="submit" class="submit-btn" value="Register">Sign-in</input>
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="register">
            </form>

            <a href="/phpmotors/accounts/index.php?action=registration">
                Not a member yet?
            </a>

        </div>
    </section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>   