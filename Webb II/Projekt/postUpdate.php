<?php   
    
    //Allows user to update/change text and title for posts
    //Made March 2021 of Emilia Holmström 
    
    $pageTitle = "Uppdatera inlägg";

    include("includes/header.php"); 
    include("includes/classes/Posts.class.php");

    //Kontrollera om användaren är inloggad
    if(!isset($_SESSION['userID'])) {
        header("Location: login.php?message=Du måste vara inloggad för denna webbsida");
    } 

    //Check if user have right to be on page, compere session with writers userID
    if(isset($_GET['postID'])) {
        $postID = $_GET['postID'];
        $check = new Posts();
        $result = $check->getSingelPost($postID);
        
        foreach($result as $row) { 
            $userID = $row['userID'];
        }

        if($_SESSION['userID'] != $userID) {
            header("Location: postSolo.php?postID=$postID&message=Du är inte behörig för den sidan");
        }
    }

?>

<div class="addingPostBox updatePostBox">

    <h2>Uppdatera inlägg</h2>



            <?php

                if(isset($_GET['postID'])) {

                    $postID = $_GET['postID'];

                    $latestPosts = new Posts();
                    $result = $latestPosts->getSingelPost($postID);
                    foreach($result as $row) {
                        //$row = mysqli_fetch_array($result);
                        
                        $title = $row['title'];
                        $content = $row['content'];
                        $postID = $row['postID'];

                        $img = $row['img'];
                        $imgText = $row['imgText'];

                        $timestamp = strtotime($row["postdate"]);
                        $postdate = date("d/m/y", $timestamp);
                    ?>

                    <img src="uploads/<?=$img?>" alt="<?=$imgText?>">
            <?php } } ?> <!-- Avlsutar for loopen för inlägget -->

            
            
            <button id="postRulsBtn">Kolla vad som krävs för att posta ett inlägg</button> 
            <div id="postRulsBox">
                <?= include_once("includes/postRules.php");?>
            </div>

            
<?php

    $errors = [];                       //Array to fill with errors messages

    if(isset($_POST['title'])){
        //Instans av klassen
        $post = New Posts(); 

        //Gather data
        $title = $_POST['title'];
        $content = $_POST['content'];
        $userID = $_SESSION['userID'];


        //Chech input info
        if($title == "") {
            array_push($forget, "Rubrik");
        } elseif (!$post->setTitle($title)){
            array_push($errors, "Rubriken är för kort");
        } elseif (!$post->setMaxLength($title)){
            array_push($errors, "Rubriken får max vara 64 tecken, innehåller nu: <b>" . strlen($title) . "</b> tecken");
        } 

        if($content == "") {
            array_push($forget, "Text till inlägget");
        } elseif (!$post->setMiniContent($content)){
            array_push($errors, "Innehållet är för kort!");
        } elseif (!$post->setMaxContentWord($content)){
            array_push($errors, "Innehållet är för långt, max 500 ord, innehållet nu" . str_word_count($content) . "ord");
        } elseif (!$post->setMaxContentCh($content)){
            array_push($errors, "Innehållet är för långt, max 3 000 tecken, innehållet nu" . strlen($content) . "ord");
        } 
        
        //If no error exist save to database
        if(sizeof($errors) == 0) {
            $postID = $_GET['postID'];
            if($post->updatePost($title, $content, $postID, $userID)) {
                header("Location: postSolo.php?postID=$postID&message=Inlägget uppdaterat");
            }

        }
    }
       
?>


        <form method="post">
            <?php
                if(sizeof($errors) > 0) {
                    echo "<p class='postError'>Något har gått fel: </p> <ul class='postUlError'>";
                    foreach ($errors as $errors) {
                        echo "<li> $errors </li> ";
                    }
                    echo "</ul> <br>";
                }
            ?>

            <label for="title">Rubrik</label>
            <input type="text" id="title" name="title" value="<?= $title ?>">
            
            <label for="content">Artikel text </label> <br>
            <textarea name="content" id="content" cols="40" rows="5"> <?= $content ?> </textarea>
            <br>
            <input type="submit" value="Updatera">
        </form>





</div> <!-- Masterbox end-->


<!--Expands textarea -->
<script src="//cdn.ckeditor.com/4.16.0/basic/ckeditor.js"></script>
<script> CKEDITOR.replace( 'content' ); </script>

<script src="javascript/addPostBox.js"></script>
<?php include("includes/footer.php"); ?>