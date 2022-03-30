<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <title>
        <?php 
            if(isset($pageTitle)){ echo $pageTitle;}
        ?>
    </title>
</head>
<body>
    <div class="page-container">
        <header>
            <div class="icon-wrapper">
                <img src="/phpmotors/images/logo.png" alt="" id="icon-img">
            </div>
            <div class="my-account-wrapper">

                    <form action="/phpmotors/vehicles/?action=search" method="GET">
                        
                        <input type="hidden" name="action" value="search">
                        <input type="text" placeholder="Search" name="search-query"  <?php if(isset($_SESSION['searchQuery'])){echo "value='$_SESSION[searchQuery]'";}  ?> required>
                        <input type="submit" value="Search">
                    </form>
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
                            echo "<div class='move-end'>
                                    <a href='/phpmotors/accounts/index.php'>
                                       Admin
                                    </a>
                                </div>";
                            // do something here if the value is FALSE
                            echo "<a href='/phpmotors/accounts/index.php?action=Logout' class='move-end'>
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