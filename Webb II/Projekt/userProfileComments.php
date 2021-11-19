<?php   
    //This code is to display user own comment made on posts. 
    //Made march 2021 of Emilia Holmström
    
    $pageTitle = "Mina kommentarer";

    include("includes/header.php"); 
    include("includes/classes/Users.class.php");
    include("includes/classes/Posts.class.php");
    include("includes/classes/Comments.class.php");
    include("includes/classes/Save.class.php");


    $errors = [];
    include("includes/profileTop.php");

?>            

        <section id="commentsBox">
        <h1 class="profileHeading">Mina kommentarer</h1>

            <?php

                        //To delete comment
                        if(isset($_GET['deleteSpecificComment'])){
                            $deleteSpecificComment = new Comments();
                            $commentID = $_GET['deleteSpecificComment'];
            
                            //UserID need because delete comment function also used on admin page
                            $userID = $_SESSION['userID'];
                            
                            if($deleteSpecificComment->deleteSpecificComment($commentID, $userID)) {
                                echo "<p class='success'> Kommentaren är nu borttagen!</p> <br>";
                            } else {
                                echo "<p class='error'> Något har gått fel!</p>";
                            }
                            
                        }

                //Get users post info
                $comments = new Comments(); 
                $result = $comments->getUsersComments($userID);

                if ($result != null) {
                    foreach($result as $row) {
                        $comment = $row['comment'];
                        $postID = $row['postID'];
                        $commentID = $row['commentID'];

                        $timestamp = strtotime($row["postdate"]);
                        $postdate = date("d/m/y - H:i", $timestamp);

                        
                                //Get post info
                                $postinfo = new Posts();
                                $result = $postinfo->getSingelPost($postID);

                                if ($result != null) {
                                    foreach($result as $row) {
                                        $title = $row['title'];
                                        $postID = $row['postID'];
                                        $img = $row['img'];
                                        $imgText = $row['imgText'];
                                        
                                   

                ?>

                <div class="commentBoxProfile">
                    <div class="commentImgBox">
                        <img src="uploads/<?=$img?>" alt="<?=$imgText?>">
                    </div>
                    <div class="commentCommentBox">
                            <p>
                                <b>Inlägg:</b> <?=$title?>
                                <br>
                                <br>
                                <b>Kommentar:</b> <?=$comment?>
                            </p>
                    </div>
                    <div class="commentButtonBox">
                                <Button class="btnReadProfile" onclick="window.location.href='postSolo.php?postID=<?=$postID?>';">
                                    <img src="images/see.png" alt="">
                                </Button>
                                <Button class="btnDeleteProfile" onclick="window.location.href='userProfileComments.php?deleteSpecificComment=<?=$commentID?>';">
                                    <img src="images/delete.png" alt="">
                                </Button>
                    </div>
                </div>
                <br>

                <?php
                    }  }
                }//Ending foreach loop 
                } else {
                ?>
                    <div class="noCommentMadeBox">
                        <p> Du har inte lämnat några kommentarer ännu, hoppa till 
                            <a href='inspiration.php'>insperationssidan här</a> 
                            och hitta ditt första inlägg att lämna en kommentar på!
                        </p>
                    </div>
                <?php 
                }
            ?>
        </section>



      





<?php include("includes/footer.php"); ?>