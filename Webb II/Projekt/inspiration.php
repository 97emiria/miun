<?php   

    //This page print out the latest posts. 
    //Made March 2021 of Emilia Holmström

    $pageTitle = "Inspiration";

    include("includes/header.php"); 
    include("includes/classes/Posts.class.php");
    include("includes/classes/Users.class.php");
?>

<br>
<br>


    <div class="inspoImgSystem">

            <?php

                $latestPosts = new Posts();
                $result = $latestPosts->getPosts();
                foreach ($result as $row) {
                    
                    $postID = $row['postID'];
                    $img = $row['img'];
                    $imgText = $row['imgText'];

                    
            ?>
            
            <div>
                <a href="postSolo.php?postID=<?=$postID?>">
                    <img src="uploads/<?=$img?>" alt="<?=$imgText?>">
                </a>
            </div>
            
        

            <?php } ?> <!-- Avlsutar for loopen med senaste inlägg -->
    </div>

<br>
<br>




<script src="javascript/burgerMenu.js"></script>
</body>
</html>