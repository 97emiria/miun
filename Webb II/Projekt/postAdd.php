<?php   
    
    //This page allows user to create and post posts on the webpage. 
    //In this file images that user choose will be save in a upload map
    //Made March 2021 of Emilia Holmström
    
    $pageTitle = "Skapa inlägg";

    include("includes/header.php"); 
    include("includes/classes/Posts.class.php"); 
    include("includes/classes/Users.class.php"); 


    //Kontrollera om användaren är inloggad
    if(!isset($_SESSION['userID'])) {
        header("Location: login.php?message=Du måste vara inloggad för denna webbsida");
    } 
?>

<div class="addingPostBox">
    
                <h1>Skapa artikel </h1>

                    <?php
                        $title = "";
                        $content = "";
                        $img = "";
                        $imgText = "";
                        $errors = [];                       //Array to fill with errors messages
                        $forget = [];

                        if(isset($_POST['title'])){
       
                            //Instans av klassen
                            $post = New Posts();      //Instance of class

                            //Gather data
                            $title = $_POST['title'];
                            $content = $_POST['content'];
                            $imgText = $_POST['imgText'];
                            $userID = $_SESSION['userID'];



                            //Checks and displays different messages depending if user forgets or has done anything wrong in form
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


                            if($imgText == "") {
                                array_push($forget, "Bildtexten"); 
                            } elseif(!$post->setImgText($imgText)) {
                                array_push($errors, "Bildtexten är för lång");
                            } elseif (!$post->setMaxLength($imgText)){
                                array_push($errors, "Bildtexten får max vara 15 ord, innehåller nu: <b>" . strlen($title) . "</b> tecken");
                            } 

                            //Kontrollerar bilder
                            if (isset($_FILES['file'])) {

                                //Kollar filformat är korrekt samt bildstorlek                                        
                                if (
                                    (($_FILES["file"]["type"] == "image/jpeg") || 
                                    ($_FILES["file"]["type"] == "image/pjpeg") || 
                                    ($_FILES["file"]["type"] == "image/png") || 
                                    ($_FILES["file"]["type"] == "image/gif")) && 
                                    ($_FILES["file"]["size"] < 5000000)) {

                                        //Do prevent error message
                                        if ($_FILES["file"]["error"] == 0) {
                                        
                                            //Ger filen ett nytt namn
                                            //$randomNumber = substr(number_format(time() * rand(),0,'',''),0,10);
                                            $randomNumber = rand(100000000, 10000000000);
                                            $type = substr($_FILES['file']['type'], 6, 4);
                                            $newfilename = $randomNumber . "." . $type;
                                            $img = $newfilename;
                                        
                                            //Dubbelkollar så inte filen redan finnas
                                            if (file_exists("uploads/" . $newfilename)) {
                                                array_push($errors, "Hoppsan, något gick fel. Testa igen, annars kontakta admin");
                                                
                                            } else {

                                                //If no error exist save to database
                                                if(sizeof($errors) == 0 && sizeof($forget) == 0) {

                                                        //Get users name
                                                        $userID = $_SESSION['userID'];
                                                        //$writer = substr($_SESSION['fname'], 0, 1) . "." . $_SESSION['lname'];
                                                        $writer = $_SESSION['fname'] . " " . $_SESSION['lname'];
                                                    
                                                        //Lägger till filen i rätt mapp    
                                                        move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $img);
                                                        $post->addPost($title, $content, $img, $imgText, $writer, $userID);
                                                   
                                                } 
                                            }
                                        
                                    } else {
                                        array_push($errors, "Något är fel med bildupladdningnen, kolla så du uppfyller kraven för bilder");
                                    }
                                } else {
                                    array_push($errors, "Något är fel med bildupladdningnen, kolla så du uppfyller kraven för bilder");
                                }

                            } else {
                                echo "<p class='error'> Ej tillagd, kontakta admin </p>";
                            }   //Slut för bilden
                            
                        }   
                            
                    ?>

        <br>
        <br>
            <button id="postRulsBtn">Kolla vad som krävs för att posta ett inlägg</button> 
            <div id="postRulsBox">
                <?= include_once("includes/postRules.php");?>
            </div>
            <br>
            <br>


                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                        <?php
                            if(sizeof($forget) && (sizeof($errors) > 0)) {
                                echo "<h2> Felmeddelanden: </h2>";
                            }
                            if(sizeof($forget) > 0) {
                                echo "<p class='postForget'>Du har glömmt att fylla i: </p> <ul class='postUlForget'>";
                                foreach ($forget as $forget) {
                                    echo "<li> $forget </li> ";
                            }
                                echo "</ul> <br>";
                            }
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

                        <label for="file">Lägg till en bild</label> <br>
                        <input type="file" name="file" id="file"
                            onchange="document.getElementById('fileImg').src = window.URL.createObjectURL(this.files[0])">
                        
                        <!-- Vissar användarens valda bilden -->
                        <img id="fileImg" alt="Din valda bild kommer synas här" width="100"/>
                        <br>
                        <br>
                        <label for="imgText">Bild text</label>
                        <input type="text" id="imgText" name="imgText" value="<?= $imgText ?>"/>
                        
                        <br>

                        <label for="content">Artikel text </label> <br>
                        <textarea name="content" id="content" cols="40" rows="5"> <?= $content ?> </textarea>
                        <br>
                        <br>
                        <input type="submit" value="Skapa post">

                        </form>
            <br>
            <br>
            <br>
            <br>
            <br>
            
            
        
</div> <!-- addingPostBox end -->


<!--Expands textarea -->
<script src="//cdn.ckeditor.com/4.16.0/basic/ckeditor.js"></script>
<script> CKEDITOR.replace( 'content' ); </script>

<script src="javascript/addPostBox.js"></script>
<?php include("includes/footer.php"); ?>