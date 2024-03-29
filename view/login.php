<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    <section>
        <div>
            <h1 class="large">Sign in</h1>
        </div>
    </section>
    <section>
        <div class="wrapper space">
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
               }
            if(isset($message)){
                echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/accounts/">
                <label for="clientEmail">Email</label><br>
                <input name='clientEmail' id='clientEmail' type="email" required autofocus 
                    <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>><br>
                <label for="clientPassword">Password</label><br>
                <span>Password must be at least 8 characters long and contain at least 1 number, 1 capital letter and 1 symbol</span><br>

                <input name='clientPassword' id='clientPassword' type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                
                
                <br>
                <button type="submit" class="submit-btn" value="Sign-in">Sign-in</button>

                <input type="hidden" name="action" value="Login">
            </form>

            <a href="/phpmotors/accounts/index.php?action=registration">
                Not a member yet?
            </a>

        </div>
    </section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>   