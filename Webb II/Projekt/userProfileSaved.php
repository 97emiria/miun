<?php   
    //This code is to display user saved posts.
    //Made march 2021 of Emilia Holmström
    
    $pageTitle = "Mina sparade inlägg";

    include("includes/header.php"); 
    include("includes/classes/Users.class.php");
    include("includes/classes/Posts.class.php");
    include("includes/classes/Comments.class.php");
    include("includes/classes/Save.class.php");

    $errors = [];

    include("includes/profileTop.php");
?>


        <section id="saveBox">
        <h1 class="profileHeading">Mina sparade inlägg</h1>
            
        <div class="frameFlexBox">
                <?php
                    if(isset($_GET['remove'])) {
                        $postID = $_GET['remove'];
                        $userID = $_SESSION['userID'];

                        $hejsan = new Save();

                        $hejsan->removeSaved($postID, $userID);

                    }

                        $userID = $_SESSION['userID'];
                        $testTwo = new Save();
                        $result = $testTwo->getSaved($userID);

                        if($result != null) {

                            foreach ($result as $row) {
                                $postID = $row['postID'];
                                $postID = $row['postID'];


                                if($postID > 0) {
                                    $getPosts = new Posts();
                                    $result = $getPosts->getSingelPost($postID);
                            
                                    foreach($result as $row) {
                                        $postID = $row['postID'];
                                        $img = $row['img'];
                                        $imgText = $row['imgText'];
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
                                    }
                                } else {
                                        echo "<div class='userVisitingEmptyBox'>
                                                <p> $userID har inte gjort några inlägg ännu </p>
                                            </div>";
                                }
                            }
                        }
                ?> 
            </div>
        </section>








<?php include("includes/footer.php"); ?>