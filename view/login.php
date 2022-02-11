<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
            <section>
                <div>
                    <h1 class="large">Sign in</h1>
                </div>
            </section>
            <section>
                <div class="wrapper space">
                    <?php
                    if (isset($message)){
                        echo $message;
                    }
                    ?>
                    <form action="submit">
                        <label for="clientFirstname">Email</label><br>
                        <input name='clientFirstname' id='clientFirstname' type="text" ><br>
                        <label for="clientPassword">Password</label><br>
                        <input name='clientPassword' id='clientPassword' type="text"><br>
                        <button type="submit" class="submit-btn" value="Sign-in">Sign-in</button>
                    </form>

                    <a href="/phpmotors/accounts/index.php?action=registration">
                        Not a member yet?
                    </a>

                </div>
            </section>
 <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>   