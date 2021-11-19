<?php   
$pageTitle = "Article?";
$activePage = basename($_SERVER["SCRIPT_FILENAME"]);

include("includes/header.php"); 
include("includes/classes/Articles.class.php");

?>

<div class="masterBox">

    <h1>Uppdatera artikel</h1>



    <?php


    //Get ID to get article
    if(isset($_GET['articleID'])){

        $id = $_GET['articleID'];

        //Contection to datebase
        $getSingelArticles = new Articles();
        $result = $getSingelArticles->getSingelArticles($id);


        foreach($result as $res) {
            $id = $res['id'];
            $title = $res['title'];
            $content = $res['content'];
            $oldImg = $res['img'];
            $imgText = $res['imgText'];
            $author = $res['author'];
            
            $timestamp = strtotime($res["postdate"]);
            $postdate = date("d/m/y H:i", $timestamp);
        ?>
        
        <article>
            <h2 class="updateHeading">Vald artikel: </h2>
                    <div class="articleMini">

                        <div class="imgBox">
                            <img src='images/articlesImg/<?=$oldImg?>' alt='<?=$imgText?>'>
                        </div>

                        <div class="textBox">
                            <h2><?=$title?></h2>
                            <p class="postdate"> Publicerades <?=  $postdate?> </p>
                            <br>
                            <p class="content"><?=$content?><span>...</span></p>
                        </div>
                        <div class="readMoreBtn">
                            <button class="readBtn" onclick="window.location.href='singelNews.php?articleID=<?=$id?>';">Till artikeln</button>
                        </div>
                    </div>


            </article>
        
    <?php 
    } 
    }?>


    <?php
        //Adding form input to database
        if(isset($_GET['articleID'])){
            $id = intval($_GET['articleID']);

            if(isset($_POST['title'])){
                $title = $_POST['title'];
                $content = $_POST['content'];
                $img = $_POST['img'];
                $imgText = $_POST['imgText'];
                $author = $_POST['author'];

                if ($img == "") {
                    $img = $oldImg;
                } 

                //Instans av klassen
                $article = New Articles();

                if($article->updateArticle($id, $title, $content, $img, $imgText, $author)){
                    echo "<p> Tillagd </p>";
                }   else {
                    echo "<p> Inte tillagd, försök igen </p>";
                }
            }
        }
    ?>

    <!-- Form that update articles -->
    <form method="POST" action="">
        <label for="title">Rubrik</label>
        <input type="text" id="title" name="title" value="<?=$title?>">

        <label for="content">Artikel text</label> <br>
        <ul>
            <li>Artikel texten måste innehålla minst 50 tecken</li>
            <li>Artikel texten får max innehålla 5 000 tecken</li>
        </ul>
        <textarea name="content" id="content" value="<?=$content?>"><?=nl2br($content)?></textarea>

        <br>
        <br>

        <label for="img">Lägg till en bild</label> <br>
        <ul>
            <li>Filnamn får bara innehålla 128 tecken</li>
            <li>Sålänge du inte väljer en ny bild kommer den gammla att vissas</li>
        </ul>
        <input type="file" name="img" id="img">

        <br>
        <br>
        <label for="imgText">Bild text</label>
        <input type="text" id="imgText" name="imgText" value="<?=$imgText?>">

        <br>
        <br>

        <label for="author">Författare/Källa</label>
        <input type="text" id="author" name="author" value="<?=$author?>">


        <input type="submit" value="Uppdatera">

    </form>

</div>


<!--Expands textarea -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script> CKEDITOR.replace( 'content' ); </script>

<?php $webpageUpdate = "2020/02/15"; include("includes/footer.php"); ?>