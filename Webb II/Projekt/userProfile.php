<?php   
    
    //This code is to display user own post thou images. 
    //Made march 2021 of Emilia Holmström
    
    $pageTitle = "Mina inlägg";

    include("includes/header.php"); 
    include("includes/classes/Users.class.php");
    include("includes/classes/Posts.class.php");
    include("includes/classes/Comments.class.php");
    include("includes/classes/Save.class.php");

    $errors = [];

    include("includes/profileTop.php");
?>




        <section  id="postBox">
        <h1 class="profileHeading">Mina inlägg</h1>
                    <?php
                        //To delete post
                        if(isset($_GET['deletePost'])){
                            $postID = $_GET['deletePost'];
                            $userID = $_SESSION['userID'];

                            $deletePost = new Posts();

                            //Check if postID exist to not get error messages
                            //Get image name from post
                            $result = $deletePost->getImg($postID); 
                            $row = mysqli_fetch_array($result);
                            $imgName = $row['img'];

                            //Check if file exist
                            if($imgName) {
                                unlink("uploads/" . $imgName);
                            }
    
                            //Hämta alla inläggets kommentarer för att radera ur databasen
                            $commentClass = new Comments();
                            $commentClass->deleteComment($postID);
    
                            $saveClass = new Save();
                            $saveClass->removeSaved($postID, $userID);
                            
                            //Slutligen radera inlägget
                            $deletePost->deletePost($postID, $userID);
                            
                            header("Location: userProfile.php?successMessage=Inlägget är nu borttaget!");
                        }
                ?>
                        
                <div class="frameFlexBox">
                            
                <?php
                        $userID = $_SESSION['userID'];
                        //Get users post info
                        $userPosts = new Posts(); 
                        $result = $userPosts->getUserPost($userID);

                        if ($result) {
                            foreach($result as $row) {
                                $title = $row['title'];
                                $content = $row['content'];
                                $postID = $row['postID'];
                                $img = $row['img'];
                                $imgText = $row['imgText'];


                                $timestamp = strtotime($row["postdate"]);
                                $postdate = date("d/m/y - H:i", $timestamp);
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
                            echo "<p>Du har inte gjort några inlägg ännu, gör ditt första <a href='postAdd.php'>här</a>!</p>";
                        }
                    ?>

                </div> <!-- displayPRofile end -->
        </section>










<?php include("includes/footer.php"); ?>