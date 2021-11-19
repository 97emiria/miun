<?php   
    /*
        This code main focus is to change password and profilpic for users
        It have also link to the visitor's profile, to see its own page thour their eye 
        A link to admin page exist here as well 
        Made March 2021 of Emilia Holmström
    */
    
    $pageTitle = "Inställningar";

    include("includes/header.php"); 
    include("includes/classes/Users.class.php");
    include("includes/classes/Posts.class.php");
    include("includes/classes/Comments.class.php");

    //Kontrollera om användaren är inloggad
    if(!isset($_SESSION['userID'])) {
        header("Location: login.php?message=Du måste vara inloggad för denna webbsida");
    } 

    $openImgBox = "";
    $openPasswordBox = "";

    if(isset($_GET['openBox'])) {
        $box = $_GET['openBox'];

        if($box == "openImgBox") {
            $openImgBox = "style='display:block;'";
        }
        
        if($box == "openPasswordBox") {
            $openPasswordBox = "style='display:block;'";
        }
    }

        //Läser in profilbilds formuläret för att kunna spara den nya bilden innan anävndarens profilbild skrivs ut
        if(isset($_POST['profilePic'])) {

            $changeProfilePic = new Users();
            $profilePic = $_POST['profilePic'];
            $userID = $_SESSION['userID'];
    
            $changeProfilePic->changeProfilePic($profilePic, $userID);
        }
    
?>

<br>
<br>
<br>
<br>
<br>
    <section>
        <?php 
            //Get user info
            $userInfo = new Users();

            $userID = $_SESSION['userID'];
            $result = $userInfo->getUserInfo($userID);

            foreach($result as $row) {
                //$row = mysqli_fetch_array($result);
                $userIDs = $row['userID'];
                $profileImg = $row['profileImg'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
            }
        

        ?>

        <div class="profilGrid">
            <div class="pImg">
                <?php        
                    if (!$profileImg == "") {
                        echo "<img src='images/profilImg/$profileImg.png' class='profileImg' alt='$profileImg'>";  
                    } else {
                        echo "<p class='message'> Det finns ingen profilbild, hoppa ner till användarinställningar för att välja en bild</p>";
                    }
                ?>
            </div>
            <div class="pText">
                <h1>Inställningar för <?=$firstname?> </h1>
                    <ul>
                        <li><a href="userSettings.php?openBox=openImgBox">Ändra profilbild</a></li>
                        <li><a href="userSettings.php?openBox=openPasswordBox">Ändra lösenord</a></li>
                        <li><a href="userVisiting.php?userID=<?=$userID?>">Besök din profil för att se hur den ser ut för andra</a></li>
                        
                        <?php

                            //Ifall inget resultat kommer tillbaka ska användaren skickas till index med ett meddelande
                            if($userInfo->adminExists($userID)) {
                               echo "<li> <a href='admin.php'> Admin sida </a> </li>";
                            }


                        ?>


                        <li><a href="userProfile.php">&#8592; Tillbaka profilen</a></li>
                    </ul>
            </div>
        </div>
            

    </section>

<div class="changeBox">

    <section <?=$openImgBox?> class="profileImgChangeBox">

            <h2>Byt profilbild</h2>

                <form method="POST"  action="userSettings.php?openBox=openImgBox">

                    <div class="selectImg">
                        <div>
                            <img src="images/profilImg/apple.png" alt="Animerad glatt äpple"> <br>
                            <input type="radio"  name="profilePic" id="apple" value="apple" checked>
                            <label for="apple">Äpple</label><br>
                        </div>
                        <div>
                            <img src="images/profilImg/banana.png" alt="Animerad glad banan"> <br>
                            <input type="radio"  name="profilePic" id="banana" value="banana">
                            <label for="banana">Banan</label><br>
                        </div>
                        <div>
                            <img src="images/profilImg/cherry.png" alt="Animerad flörtiga körsbär"> <br>
                            <input type="radio"  name="profilePic" id="cherry" value="cherry">
                            <label for="cherry">Körsbär</label><br>
                        </div>
                        <div>
                            <img src="images/profilImg/melon.png" alt="Animerad vattenmelon med mustache som är glad"> <br>
                            <input type="radio"  name="profilePic" id="melon" value="melon">
                            <label for="melon">Vattenmelon</label><br>
                        </div>
                        <div>
                            <img src="images/profilImg/pear.png" alt="Animerad trött päron"> <br>
                            <input type="radio"  name="profilePic" id="pear" value="pear">
                            <label for="pear">Päron</label><br>
                        </div>
                        <div>
                            <img src="images/profilImg/orange.png" alt="Animerad apelsin med hundmun"> <br>
                            <input type="radio"  name="profilePic" id="orange" value="orange">
                            <label for="orange">Apelsin</label><br>
                        </div>
                        <div>
                            <img src="images/profilImg/kiwi.png" alt="Animerad gladsöt kiwi"> <br>
                            <input type="radio"  name="profilePic" id="kiwi" value="kiwi">
                            <label for="kiwi">Kiwi</label><br>
                        </div>
                        <div>
                            <img src="images/profilImg/peach.png" alt="Animerad glas persika"> <br>
                            <input type="radio"  name="profilePic" id="peach" value="peach">
                            <label for="peach">Persika</label><br>
                        </div>

                        <div>
                            <img src="images/profilImg/strawberry.png" alt="Animerad trött jordgubbe"> <br>
                            <input type="radio"  name="profilePic" id="strawberry" value="strawberry">
                            <label for="strawberry">Jordgubb</label><br>
                        </div>
                    </div>
                    <input type="submit" value="Byt profilbild" style="width: 50%;">
                </form>
    </section>

    <section <?=$openPasswordBox?> >
        <div class="changePasswordBox">

                    <?php
                        $oldPassword = "";
                        $newPassword = "";
                        $passwordCheck = "";

                        $errors = [];

                        if(isset($_POST['oldPassword'])) {
                            
                            $changePassword = new Users();

                            $userID = $_SESSION['userID'];

                            $oldPassword = $_POST['oldPassword'];
                            $newPassword = $_POST['newPassword'];
                            $passwordCheck = $_POST['passwordCheck'];

                            //Kollar om gamla lösenordet stämmer med databasen
                            if(!$changePassword->checkPassword($userID, $oldPassword)) {
                                array_push($errors, "Nuvarnade lösenordet matchar inte ditt användarnamn");
                            }

                            //Kollar så de nya lösenorden stämmer överens och uppfyller kraven för lösenord
                            if($newPassword != $passwordCheck) { 
                                array_push($errors, "Det två nya lösenordet stämmer inte överns");
                            }

                            if(!$changePassword->setPassword($newPassword)) { 
                                array_push($errors, "Lösenordet måste innehålla 5 tecken");
                            }

                            if($oldPassword == $newPassword) { 
                                array_push($errors, "Du kan inte välja samma lösenord som du har nu");
                            }

                            if(sizeof($errors) === 0) {
                                //Sparar den nya lösenordet
                                $changePassword->changePassword($newPassword, $userID);
                                    echo "<p class='success'> Lösenordet bytt </p>";
                            }
                        } 
                    ?>
    

            <h2>Ändra lösenord</h2>

            <?php
        
                if(sizeof($errors) > 0) {
                    echo "<ul class='error'>";
                    foreach ($errors as $errors) {
                        echo "<li> $errors </li> ";
                    }
                    echo "</ul> <br>";
                }

            ?>

            <form method="POST" action="userSettings.php?openBox=openPasswordBox">
                <label for="oldPassword"> Gamla lösenord </label>
                <input type="password" id="oldPassword" name="oldPassword" value="<?=$oldPassword?>"> 

                <label for="newPassword"> Nya lösenord </label>
                <input type="password" id="newPassword" name="newPassword" value="<?=$newPassword?>">

                <label for="passwordCheck"> Skriv nya lösenord igen: </label>
                <input type="password" id="passwordCheck" name="passwordCheck" value="<?=$passwordCheck?>">

                <input type="submit" value="Byt lösenord">
            </form>
        </div>
    </section>
</div>
 

<?php include("includes/footer.php"); ?>