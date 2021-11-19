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



    <header>
        <div>
            <!-- Logo -->
            <div class="navLogo">
                <a href="profile.php">
                    <img src="images/logoFV.png" alt="Färdtjänst Väst">
                </a>
            </div>

            <!-- Menu -->
            <div class="menuBox">

                <!--Button to relive menu -->
                <button id="navBtn" class="navButton" title="Öppna menyn">
                    Öppna meny
                </button>

                <!-- Menu list -->
                <nav id="navMenu" class="navMenu">
                    <ul>
                        <!-- Profile btn -->
                        <li> 
                            <a href="profile.php" 
                                <?php 
                                    if($activePage == "profile.php" || 
                                    $activePage == "profileFutureBooking.php" || 
                                    $activePage == "profileOldBooking.php") 
                                    {echo "class='active'";} 
                                ?>
                                
                                 id="profileBtn"  tabindex="0"
                            > <!-- close start-tag of a element -->
                                <img src="images/iconProfile.png"  alt=""> <br>
                                Min sida
                            </a>
                                
                        </li>
                        
                        <!-- Bookning btn -->
                        <li> 
                            <a href="booking.php" id="bookingBtn"
                                <?php 
                                    if(
                                        $activePage == "booking.php" || 
                                        $activePage == "bookEnd.php" || 
                                        $activePage == "bookConfirm.php" ||
                                        $activePage == "bookRebook.php"
                                    ) 
                                    {echo "class='active'";} 
                                ?>
                                tabindex="0" 
                            > <!-- close start-tag of a element -->

                                <img src="images/iconCar.png" alt=""> <br>
                                Boka resa
                            </a>
                        </li>

                        <!-- Info btn -->
                        <li>
                            <a href="info.php" id="infoBtn"
                                <?php 
                                    if($activePage == "info.php" )
                                    {echo "class='active'";} 
                                ?>
                                tabindex="0" 
                            > <!-- close start-tag of a element -->

                                <img src="images/iconInfo.png" alt=""> <br>
                                Info
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </header>



    <div class="frameBox" id="frameBox">
