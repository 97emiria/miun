<?php 
    include_once("includes/config.php"); 
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                
    <title> <?php echo "&bull; " . $pageTitle . " &bull;" ?> </title>
    <link rel="shortcut icon" type="images/x-icon" href="images/logo.png">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>


<header>
    <div class="menuBox">

        <div class="logobox">
            <a href="index.php">
                <h1>MAT<span>&</span>GRAM</h1>
            </a>
        </div>

        <nav>   
            <div class="navBox" >
                <!--Button use on small screen to show and hide menu -->
                <button id="navBtn">    
                    <img src="images/list.png" alt="">
                </button>

                <div id="navBoxSmall">
                    <?php 
                        //Check if user is logged in or not, show different menu link depends on it
                        if(isset($_SESSION['userID'])) {
                    ?>

                    <ul>
                        <li><a href="index.php" title="Startsida">Startsida</a></li>
                            <li><span> &bull; </span></li>
                        <li> <a href="inspiration.php" title="Inspiration sida fylld med bilder">Inspiration</a></li>
                            <li><span> &bull; </span></li>
                        <li> <a href="postAdd.php" title="Skapa ett inlägg">Skapa inlägg</a></li>
                            <li><span> &bull; </span></li>
                        <li><a href="userProfile.php" title="Min profil sida">Profil</a> </li>
                            <li><span> &bull; </span></li>
                        <li><a href="logout.php" title="Logga ut">Logga ut</a></li>
                    </ul>
                    
                    <?php
                        } else {
                    ?>
                        <ul>
                            <li><a href="index.php" title="Startsida">Startsida</a></li>
                                <li><span> &bull; </span></li>
                            <li> <a href="inspiration.php" title="Inspirations sida fylld med bilder">Inspiration</a></li>
                                <li><span> &bull; </span></li>
                            <li> <a href="register.php" title="Skapa ett konto">Bli medlem</a> </li>
                                <li><span> &bull; </span></li>
                            <li> <a href="login.php" title="Logga in"> Logga in</a></li>
                        </ul>
                    <?php
                        }
                    ?> 
                </div>
            </div>
        </nav>
    </div>
  

</header>