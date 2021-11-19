<?php 
include_once("includes/config.php");
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                
    <title> <?php echo "&bull; " . $pageTitle . " &bull;" ?> </title>
    <link rel="shortcut icon" type="images/x-icon" href="images/favicon.ico">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="menuBox">
  <div class="userInfo">
  <?php 
                    //Kollar och vissar om anvädaren är inloggad eller ej 
                    if(isset($_SESSION['username'])) {
                        echo "<p style='color:greenyellow'>Du är inloggad som: ". $_SESSION['username'] ."</p>";

                    } else {
                        echo "<p style='color:red'>Inte inloggad</p>";
                    }
                ?>
  </div>
  
  
  <div class="logInOut">
  <?php 
                //Kollar och vissar om anvädaren är inloggad eller ej 
                if(isset($_SESSION['username'])) {
                    echo "<a href='admin.php' title='Till admin sidan'> admin </a>";
                    echo "<span>&bull; </span>";
                    echo "<a href='logout.php' title='Du kommer loggas ut'>Logga ut</a>";
                } else {
                ?>
                    <a href="login.php" 
                    <?php if($activePage == "login.php") {echo "id='active'";} ?>
                    title="Logga in">
                    Logga in</a>
                <?php
                }
                ?>  
  
  </div>


    <div class="boxforLogo">
                <a href="index.php">SPER</a>
    </div>



  <div class="navBox">
                <a href="index.php" 
                    <?php if($activePage == "index.php") {echo "id='active'";} ?>
                    title="Startsida"> Startsida </a>

                <span>&bull; </span>

                <a href="allNews.php" 
                <?php if($activePage == "allNews.php") {echo "id='active'";} ?>
                title="allNews">  Alla nyheter</a>
               
                <?php
                    if(isset($_SESSION['username'])) {
                
                echo "<span>&bull; </span> <a href='addNews.php' title='Till skapa nyheter'>Skapa nyheter</a>";
                    } 
                ?>  
    </div>
</div>

    <div class="heroBox">
        <div class="heroImg">
            <picture >
                        <img    src="images/headerImg.jpg"  alt="En spelkaraktär Link från Tloz som sitter på en fågel" >
            </picture>
        </div>
        <div class="heroText">
                <h1>SPER</h1>
                <p>
                    Där de senaste och bästa spelnyehterna finns, direkt hos oss SPel nyhetER.  
                </p>
            </div>
    </div>


    <?php 

    if (isset($_GET['message'])) {
        echo "<p class='error'>" . $_GET['message'] . "</p>";
    }

