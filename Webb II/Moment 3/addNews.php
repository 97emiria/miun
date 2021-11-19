<?php   
include("includes/config.php");
include("includes/classes/Articles.class.php");

//Kontrollera om användaren är inloggad
if(!isset($_SESSION['username'])) {
    header("Location: login.php?message=Du måste logga in först!");
}

$pageTitle = "Skapa ny artikel";
$activePage = basename($_SERVER["SCRIPT_FILENAME"]);
include("includes/header.php"); 
?>



<div class="masterBox">



    <h1>Skapa artikel </h1>


    <?php

        $title = "";
        $content = "";
        $img = "";
        $imgText = "";
        $author = "";
        $errors = [];                       //Array to fill with errors messages


        if(isset($_POST['title'])){
            
            //Instans av klassen
            $article = New Articles();      //Instance of class

            //Gather data
            $title = $_POST['title'];
            $content = $_POST['content'];
            $img = $_POST['img'];
            $imgText = $_POST['imgText'];
            $author = $_POST['author'];

                        

            //Chech input info
            if(!$article->setTitle($title)){
                array_push($errors, "Titeln måste innehålla minst 3 tecken");
            }
            if(!$article->setContent($content)){
                array_push($errors, "Artikeltexten måste innehålla minst 50 tecken");
            }
            if(!$article->setImg($img)){
                array_push($errors, "Du måste infoga en bild");
            }
            if(!$article->setAuthor($imgText)){
                array_push($errors, "Bildtexten måste innehålla minst 3 tecken");
            } 
            if(!$article->setAuthor($author)){
                array_push($errors, "Författaren/källan måste innehålla minst 2 tecken");
            }

            //If no error exist save to database
            if(sizeof($errors) == 0) {

                if ($article->addArticle($title, $content, $img, $imgText, $author)) {
                    //Meddelande om allt gått rätt till
                    echo "<p class='success'> Tillagd </p>";
                } else {
                echo "<p class='error'> Ej tillagd, kontakta admin </p>";
                }
            
            }   
        }   
            
    ?>

    <form method="POST" action="addNews.php">

        <?php
            if(sizeof($errors) > 0) {
                echo "<ul class='error'>";
                foreach ($errors as $errors) {
                    echo "<li> $errors </li> ";
                }
                echo "</ul> <br>";
            }
        ?>

        <label for="title">Rubrik</label>
        <input type="text" id="title" name="title" value="<?= $title ?>">

        <label for="content">Artikel text </label> <br>
        <ul>
            <li>Artikel texten måste innehålla minst 50 tecken</li>
            <li>Artikel texten får max innehålla 5 000 tecken</li>
        </ul>
        <textarea name="content" id="content" cols="40" rows="5"> <?= $content ?> </textarea>
        <p>Artikeltexten innehåller just nu: <?= strlen($content)?></p>
        <br>
        <br>

        <label for="img">Lägg till en bild (filnamn får max innehålla 128 tecken)</label> <br>
        <input type="file" name="img" id="img">

        <br>
        <br>
        <label for="imgText">Bild text</label>
        <input type="text" id="imgText" name="imgText" value="<?= $imgText ?>">

        <br>
        <br>
        <label for="author">Författare/Källa</label>
        <input type="text" id="author" name="author" value="<?= $author ?>">


        <input type="submit" value="Skapa article">
    </form>
</div>

<!--Expands textarea -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script> CKEDITOR.replace( 'content' ); </script>

<?php $webpageUpdate = "2020/02/15"; include("includes/footer.php"); ?>