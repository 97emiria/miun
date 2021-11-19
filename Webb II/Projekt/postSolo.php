<?php   
    /* 
    This code have som function
    1. User have a a control panel which allows them to save posts, 
        if user is the creator of the post, delete and edit button will displays 
    2. This page show posts thou postID comes in the URL
    3. Allow logged in user to comment on post, also display these comment
    Made March 2021 of Emilia Holmström
    */
    
    
    $pageTitle = "Posts";

    include("includes/header.php"); 
    include("includes/classes/Posts.class.php");
    include("includes/classes/Comments.class.php");
    include("includes/classes/Save.class.php");
    include("includes/classes/Users.class.php");

?>

<div class="masterbox">

    <section>
        <?php 
            if(isset($_GET['message'])) {
                echo "<p class='message'>" . $_GET['message'] . "</p>";
            }
        ?> 


        <?php
            if(isset($_GET['postID'])) {

                $postID = $_GET['postID'];

                $latestPosts = new Posts();
                $result = $latestPosts->getSingelPost($postID);
                foreach($result as $row) {
                    //$row = mysqli_fetch_array($result);
                    
                    $title = $row['title'];
                    $content = $row['content'];
                    $writer = $row['writer'];
                    $postID = $row['postID'];

                    $img = $row['img'];
                    $imgText = $row['imgText'];

                    $writersUserID = $row['userID'];


                    //Show date with months
                    $SWEmonth = ['Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni', 'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December'];
                    
                    $timestamp = strtotime($row["postdate"]);
                    $monthTime = date('m', $timestamp);

                    //Check if a zero is front or not, if, remove it to get right month
                    if (substr($monthTime, 0, 1) == 0) {
                        $a = substr($monthTime, 1, 1);
                        $postMonth = $SWEmonth[$a - 1];  //Get the random img from array (minus one to get right month)
                    } else {
                        $postMonth = $SWEmonth[$monthTime - 1];  //Get the random img from array (minus one to get right month)
                    }

                    $postDay = date("d", $timestamp);
                    $postYear = date("Y", $timestamp);
                    $postdate = $postDay . " " . $postMonth . " " . $postYear;
        ?>

            <?php if(isset($_SESSION['userID'])) {?>
            <div class="iconMenu">
                <?php
                    $checkSaved = new Save();
                    $loggedInUserID = $_SESSION['userID'];
                    $result = $checkSaved->checkSaved($postID, $loggedInUserID);


                    //Check if post already save or not
                    if($result) {
                    ?>
                        <div>
                            <form method="post" action="includes/savePosts.php?remove=<?=$postID?>" >
                                <input type="image" src="images/save.png" alt="Submit" class="savePost">
                            </form>
                        </div>
                    <?php
                    } else {
                        ?>
                        <div>
                            <form method="post" action="includes/savePosts.php?save=<?=$postID?>" >
                                <input type="image" src="images/unsave.png" alt="Submit" class="savePost">
                            </form>
                        </div>
                    <?php
                    }

                    //Compere if writer userID is the same as login userID.
                    if($writersUserID == $_SESSION['userID']) {
                ?>
                        <button class="btnUpdateProfile" onclick="window.location.href='postUpdate.php?postID=<?=$postID?>';">
                            <img src="images/update.png"  alt="">
                        </button>
                        <button class="btnDeleteProfile" onclick="window.location.href='userProfile.php?deletePost=<?=$postID?>';" >
                            <img src="images/delete.png"  alt="">
                        </button>
                <?php } ?>
            </div>      
            <?php } ?> <!-- End if for user log in or not -->
        
            <div class="postBox">

                <h1><?=$title?></h1>
                <img src="uploads/<?=$img?>" alt="<?=$imgText?>">
                <?=$content?>
                <div class="userPostInfo">
                    <p> 
                        <a href="userVisiting.php?userID=<?=$writersUserID?>"><?=$writer?></a>
                        <br> <?=$postdate?> </p>
                </div>
            </div>
            <?php } } ?> <!-- Avlsutar for loopen för inlägget -->

    </section>
    


    <section id="comments">
        <h2>Kommentarer</h2>

        <!-- Load comments -->

        <?php


            $loadComments = new Comments();

                 //To delete posts
                 if(isset($_GET['deleteComment'])){
                    $commentID = intval($_GET['deleteComment']);
                    $loadComments->deleteComment($commentID, $userID);
                }


            if ($loadComments->getComments($postID)) {
                $resultComments = $loadComments->getComments($postID);
                
                foreach ($resultComments as $row) {
                    $writer = $row['writer'];
                    $comment = $row['comment'];
                    $commentID = $row['commentID'];
                    $userID = $row['userID'];
                    //Show date with months
                    $SWEmonth = ['Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni', 'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December'];
                                    
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
                    $time = date("H:i", $timestamp);
                    $postdateComment = $time . ", " . $postDay . " " . $postMonth . " " . $postYear;
            ?>

                    <div class="singelComment">
                        <p> <a href="userVisiting.php?userID=<?=$userID?>"><?=$writer?></a> </p>
                        <p> <?=$comment?> </p>
                        <p> <?=$postdateComment?> </p>
                    </div>
                    

                    
            <?php } //Avslutar foreach loopen
            } else {
                
                if(isset($_SESSION['userID'])) {
                    echo "<p> Det finns inga kommentar för denna post ännu! Lämna en nedanför &darr; </p>";
                } else {
                    echo 
                        "<p> 
                            Det finns inga kommentar för denna post ännu! 
                            <a href='login.php'>Logga in</a>
                            eller
                            <a href='register.php'>skaffa ett konto</a>
                            för att lämna en kommentar! 
                        </p>";
                }
            }
        
        
        
        if(isset($_SESSION['userID'])) {

            //Get users name
            $fname = $_SESSION['fname'];
            $lname = $_SESSION['lname'];
            $commentWriter = $fname . " " . $lname;

            //<!-- Save comments -->
                
                $errors = [];
                $comment = "";

                if(isset($_POST['comment'])){
                    $comment = $_POST['comment'];
                    $userID = $_SESSION['userID'];
                    
                    $comments = new Comments();
                   

                    if(!$comments->setComment($comment)){
                        array_push($errors, "Kommentaren får max innehålla 50 ord, just nu innehåller den " . str_word_count($comment));
                    } 
                    if(!$comments->setCommentTwo($comment)){
                        array_push($errors, "Du kan inte lämna en tom kommentar");
                    }

                    //If no error exist save to database
                    if(sizeof($errors) == 0) {
                        $comments->addComments($comment, $userID, $postID, $commentWriter);
                        header("Location: postSolo.php?postID=$postID");
                    }else {
                            echo "<p class='error'> Ej tillagd, kontakta admin </p>";
                        }
                }

                if(sizeof($errors) > 0) {
                    echo "<p class='postError'>Något har gått fel: </p> <ul class='postUlError'>";
                    foreach ($errors as $errors) {
                        echo "<li> $errors </li> ";
                    }
                    echo "</ul> <br>";
                }

            ?>
                <form method="post" class="commentForm">
                    <label for="comment">Lämna en kommentar (max 50 ord): </label> <br>
                    <textarea name="comment" id="comment" cols="40" rows="5"> <?=$comment?> </textarea>
                    <input type="submit" value="Lämna kommentaren">
                </form>

        <?php } ?> <!-- Stänger if-statsen som kollar om anändare är inloggad -->
    
    </section>
    
 
</div>




<?php include("includes/footer.php"); ?>