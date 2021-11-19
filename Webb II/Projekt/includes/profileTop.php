<!-- This code is use on profile pages and includes at their tops -->


<br>
<br>
<br>
<br>
<br>


    <section>
        <?php 
            //Check if user is logged in or not, otherwise it will be sent to the home page
            if(!isset($_SESSION['userID'])) {
                header("Location: login.php?message=Du måste vara inloggad för denna webbsida");
            } 

            //Get user info
            $userInfo = new Users();

            $userID = $_SESSION['userID'];
            $result = $userInfo->getUserInfo($userID);

            foreach($result as $row) {
                $userIDs = $row['userID'];
                $profileImg = $row['profileImg'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                

                //Show date with months
                $SWEmonth = ['Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni', 'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December'];
                
                $timestamp = strtotime($row["registration_date"]);
                $monthTime = date('m', $timestamp);

                //Check if a zero is front or not, if, remove it to get right month
                if($monthTime == "00") {
                    $postMonth = "Januari";
                } elseif (substr($monthTime, 0, 1) == 0) {
                    $a = substr($monthTime, 1, 1);
                    $postMonth = $SWEmonth[$a - 1];  //Get the random img from array (minus one to get right month)
                } else {
                    $postMonth = $SWEmonth[$monthTime - 1];  //Get the random img from array (minus one to get right month)
                }

                $postDay = date("d", $timestamp);
                $postYear = date("Y", $timestamp);
                $regDate = $postDay . " " . $postMonth . " " . $postYear;
        ?>

        <div class="profilGrid">
            <div class="pImg">
                    <?php 
                        if (!$profileImg == "") {
                            echo "<img src='images/profilImg/$profileImg.png' alt='$profileImg'>";  
                        } else {
                            echo "<p class='message'> Det finns ingen profilbild, hoppa till 
                            <a href='userSettings.php?openBox=openImgBox'>användarinställningar</a> 
                            för att välja en bild</p>";
                        }
                    ?>
            </div>
            <div class="pText">
                <a href="userSettings.php?" title="inställningar">
                    <img src="images/gear.png" class="gearWheal" alt="Ett kugghjul">
                </a>

                <div>
                    <h1><?= $firstname . " " . $lastname?>s profil </h1>
                    <p><b>Medlem sendan: </b> <?=$regDate?>
                </div>
            </div>
        </div>
        <?php } ?>
    </section>



<div class="profileButtonsBox">
    <button onclick="window.location.href='userProfile.php';">         Mina inlägg</button>
    <button onclick="window.location.href='userProfileComments.php';"> Mina kommentarer</button>
    <button onclick="window.location.href='userProfileSaved.php';">    Sparade inlägg</button>
</div>


<?php
        if(isset($_GET['successMessage'])) {
            echo "<br><br>
                <p class='success' style='margin-top:'>" . $_GET['successMessage'] . "</p>";
        }
        if(isset($_GET['errorMessage'])) {
            echo "<br><br>
                <p class='error' style='margin-top:'>" . $_GET['errorMessage'] . "</p>";
        }
?>