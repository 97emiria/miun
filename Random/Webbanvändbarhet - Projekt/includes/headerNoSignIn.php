<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                
    <title> <?php echo $pageTitle . " | Färdtjänst Väst" ?> </title>
    <link rel="shortcut icon" type="images/x-icon" href="images/favicon.png">
    <link href="style/css.css" rel="stylesheet" type="text/css">
</head>

<body>



    <header class="headerHigher">
        <div>
            <!-- Logo -->
            <div class="navLogo">
                <a href="index.php">
                    <img src="images/logoFV.png" alt="Färdtjänst Väst">
                </a>
            </div>
            
            <!-- Menu -->
            <nav class="indexInfoBtn">
            <!-- Info btn -->
                <a href="infoNotSignin.php" tabindex="0" id="infoBtn"
                    <?php 
                        if($activePage == "infoNotSignin.php" )
                        {echo "class='active'";} 
                    ?>
                > <!-- close start-tag of a element -->

                    <img src="images/iconInfo.png" alt=""> <br>
                    Info
                </a>
            </nav>
        </div>
    </header>

    

    <div class="frameBox" id="frameBox">
