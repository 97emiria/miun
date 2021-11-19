<?php   
    //This code it similir to profile, it have its own header 
    //Show post images thou userID that comes in the URL
    //Made March 2021 of Emilia Holmström

    $pageTitle = "Besöka användare";

    include("includes/header.php"); 
    include("includes/classes/Users.class.php");
    include("includes/classes/Posts.class.php");
?>

<br>
<br>
<br>
<br>

    <?php 
        $visitUser = $_GET['userID'];
    ?>


<section>
        <?php 
            //Get user info
            $userInfo = new Users();

            $result = $userInfo->getUserInfo($visitUser);

            foreach($result as $row) {
                //$row = mysqli_fetch_array($result);
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
            }
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
                    <div>
                        <h1><?= $firstname . " " . $lastname ?></h1>
                        <p><b>Medlem sendan: </b> <?=$regDate?>
                    </div>
                </div>
            </div>
        
    </section>



                <div class="frameFlexBox">
                    <?php
                        
                        //Get users post info
                        $userPosts = new Posts(); 
                        $result = $userPosts->getUserPost($visitUser);


                        if ($result) {
                            foreach($result as $row) {
                                $postID = $row['postID'];
                                $img = $row['img'];
                                $imgText = $row['imgText'];
                                $writer = $row['writer'];
                    ?>
                        <div class="flowBox">
                                <img src="uploads/<?=$img?>" alt="<?=$imgText?>">
                                    <div class="subFlow">
                                        <button class="btnReadProfile" onclick="window.location.href='postSolo.php?postID=<?=$postID?>';">
                                            <img src="images/see.png" alt="">
                                        </button>
                                    </div>
                        </div>
                    <?php
                        } //Ending foreach loop 
                    } else {
                        echo "<p>$writer har inte gjort några inlägg ännu!</p>";
                    }
                    ?>
                </div> <!-- frameFlexBox end -->



  





<!-- Button leding to top of page -->
<button class="upBtn" onclick="window.location.href='#top'"> &#8593; </button>


<?php include("includes/footer.php"); ?>