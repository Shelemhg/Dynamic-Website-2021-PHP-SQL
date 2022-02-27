<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <title>Welcome to PHP Motors!</title>
</head>
<body>
    <div class="page-container">
        <header>
            <div class="icon-wrapper">
                <img src="/phpmotors/images/logo.png" alt="" id="icon-img">
            </div>
            <div class="my-account-wrapper">
                <div>
                    <?php 
                        // if(isset($cookieFirstname)){
                        //     echo "<span>Welcome $cookieFirstname</span>";
                        // }
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                        }
                    ?>
                </div>
                    <?php
                        if(isset($_SESSION['loggedin'])){
                            // do something here if the value is FALSE
                            echo "<a href='/phpmotors/accounts/index.php?action=Logout'>
                                    <p>
                                        Log Out
                                    </p>
                                </a>";
                        }else{
                            echo "<a href='/phpmotors/index.php?action=login-page'>
                                    <p>
                                        My Account
                                    </p>
                                </a>";
                        }
                    ?>
                
            </div>
        </header>
        <nav>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; ?>
        </nav>
        <main>