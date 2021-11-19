<?php   
    
    /*
    This is front page for webpage
    1. A slideshow show random posts images
    2. Welcome message and explanation of what the page is about
    3. Dislpay a choosen post of the month 
    4. A member list exist, show all members on page
    5. Show the last 5 post made om website 
    Made March 2021 of Emilia Holmstörm
    */

    
    
    $pageTitle = "Startsida";

    include("includes/header.php"); 
    include("includes/classes/Posts.class.php");
    include("includes/classes/Users.class.php");
    include("includes/classes/Comments.class.php");
?>

<!-- Print out random images to slideshow --> 
<div class="slideshowBox">
    <?php
        $getPosts = new Posts();
        $result = $getPosts->getRandomPosts();
        foreach($result as $row) {
            //$row = mysqli_fetch_array($result);
            $postID = $row['postID'];
            $img = $row['img'];
            $imgText = $row['imgText'];
            $title = $row['title'];
    ?>
    <div class="mySlides" >
        <div class="fade">
            <img src="uploads/<?=$img?>" alt="<?=$imgText?>">
        </div>
        <div class="slideshowText">
            <a href="postSolo.php?postID=<?=$postID?>"> <?=$title?> </a>
        </div>
        
    </div>

    <?php } ?> <!-- End for loopen with random posts -->

</div> <!-- End for slideshow -->

    <?php 
        if(isset($_GET['message'])) {
            echo "<br><br>
                <p class='message' style='margin-top:'>" . $_GET['message'] . "</p>";
        }
    ?> 



    <div class="indexLayout">

    <div class="introText">
            <h1> MAT<span>&</span>GRAM </h1>
            <p>Välkommen till sann inspirationskälla för alla mattillfällen. Det kan vara frukost, lunch, middag och 
                efterrätt. Du väljer. Surfa runt för att hitta inspirationen eller så delar du med dig! Skaffa ett konto 
                hos oss för att börja dela dina recept och tanker i både inlägg och kommentarer. Eller logga in för att fortsätta. </p>
    </div>
    
    <div class="memberList">
    <h2>Våra medlemar </h2>
            <ul>
                <?php
                //Print out members list 
                $memberList = new Users();
                $result = $memberList->getUserList();

                foreach ($result as $row) {
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $userID = $row['userID'];
                    echo "<li><a href='userVisiting.php?userID=$userID'>$firstname" . " " .  "$lastname</a></li>";
                }
                ?>
            </ul>
    </div>

        <div class="monthBox">
                <?php
                    //Prints out 
                    $getPosts = new Posts();
                    $postID = 28;
                    $result = $getPosts->getSingelPost($postID);


                    if ($result) {
                        foreach($result as $row) {
                            $img = $row['img'];
                            $imgText = $row['imgText'];
                            $title = $row['title'];
                            $writer = $row['writer'];
                            $writerUserID = $row['userID'];

                ?>
                <article>
                    <h2>Redaktionens val till månadens recpet</h2>
                    <img src="uploads/<?=$img?>" alt="<?=$imgText?>">
                    <p>
                        <a href="postSolo.php?postID=<?=$postID?>"><?=$title?></a>
                        av 
                        <a href="userVisiting.php?userID=<?=$writerUserID?>"><?=$writer?></a>
                    </p>
                </article>
                <?php
                        } //Ending foreach loop 
                    } 
                
                ?>
        </div>
    </div> <!-- End indexLayout -->
    
    <br>
    <h2 class="showPostsFrameHeader">De senaste 5 inläggen</h2>
    

    <div class="showPostsFrame">
        <?php
            //prints out the last 5 posts
            $latestPosts = new Posts(); 
            $result = $latestPosts->getPosts();
            
            for ($i=1; $i<=5; $i++) {
                $row = mysqli_fetch_array($result);
                $postID = $row['postID'];
                $img = $row['img'];
                $imgText = $row['imgText'];
                $title = $row['title'];
                $content = $row['content'];

                $writer = $row['writer'];
                $writerUserID = $row['userID'];

                $SWEmonth = ['januari', 'februari', 'mars', 'april', 'maj', 'juni', 'juli', 'augusti', 'september', 'oktober', 'november', 'december'];
                        
                    $timestamp = strtotime($row["postdate"]);
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
                    $postdate = $postDay . " " . $postMonth . " " . $postYear;


            ?>
            <div class="showPosts">
                <div class="imgBox">
                    <a href="postSolo.php?postID=<?=$postID?>">
                        <img src="uploads/<?=$img?>" alt="<?=$imgText?>">
                    </a>
                </div>
                <div class="contentBox">
                    <h3><a href="postSolo.php?postID=<?=$postID?>"><?=$title?></a></h3>
                    <?=$content?>
                    <p> <a href="postSolo.php?postID=<?=$postID?>">Läs eller lämna en kommentar &#8594; </a> </p>
                </div>
                <div class="infoBox">
                    <p><a href="userVisiting.php?userID=<?=$writerUserID?>"><?=$writer?></a></p>
                    <p><?=$postdate?></p>
                </div>
            </div>

            <?php } ?> <!-- Ends loop for the latest posts -->
    </div>

<!-- Button leding to top of page -->
<button class="upBtn" onclick="window.location.href='#top'"> &#8593; </button>

<!-- JavaScript code for slideshow -->
<script src="javascript/slideshow.js"></script>

<?php include("includes/footer.php"); ?>