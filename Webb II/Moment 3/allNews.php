<?php   
$pageTitle = "Alla nyhter";
$activePage = basename($_SERVER["SCRIPT_FILENAME"]);

include("includes/header.php"); 
include("includes/classes/Articles.class.php");

?>

<div class="mainLayout">
  <div class="topBox">

  </div>
  
  <div class="contentBox iDidntComeUpWithAName">
            <h1>Senaste spelnyheterna</h1>


            <?php

            $article = new Articles();

            if(isset($_GET['deleteArticle'])){
                $id = intval($_GET['deleteArticle']);
                $article->removeArticle($id);
            }

            //Contection to datebase throu class
            $getArticles = new Articles();
            $result = $getArticles->getArticles();

            foreach($result as $res) {
                //Give varibaler
                $id = $res['id'];
                $title = $res['title'];

                $content = substr($res['content'], 0, 200);
                $img = $res['img'];
                $imgText = $res['imgText'];

                //https://stackoverflow.com/questions/2411970/change-display-format-of-date-and-time-field-in-mysql-php
                $timestamp = strtotime($res["postdate"]);
                $postdate = date("d/m/y H:i", $timestamp);
            ?>

            <article>
                    <div class="articleMini">
                        <div class="imgBox">
                            <img src='images/articlesImg/<?=$img?>' alt='<?=$imgText?>'>
                        </div>

                        <div class="textBox">
                            <h2><?=$title?></h2>
                            <p class="postdate"> Publicerades <?=  $postdate?> </p>
                            <br>
                            <p class="content"><?=$content?> <span>...</span> </p>
                        </div>
                        
                        <div class="readMoreBtn">
                        <button class="readBtn" onclick="window.location.href='singelNews.php?articleID=<?=$id?>';">Läs mer</button>
                        </div>
                    </div>

                    <?php 
                        //Chech if user is sign in to show delete and update button
                        if(isset($_SESSION['username'])) {
                    ?>

                        <div class="btnBox">
                            <Button onclick="window.location.href='updateArticle.php?articleID=<?=$id?>';">Uppdatera</Button>
                            <Button onclick="window.location.href='allNews.php?deleteArticle=<?=$id?>';">Radera</Button>
                        </div>
                    <?php } ?>
            </article>

            <?php  } ?>
  </div>
  
  <div class="adBox">
        <img src="images/ads/ad1.gif" alt="Dancande man">
        <img src="images/ads/ad2.gif" alt="Exempel gif på 20%">
        <img src="images/ads/ad3.gif" alt="Vissar en facebook liknande app">
        <img src="images/ads/ad4.gif" alt="En spelkarektär som knäpper sina fingrar">
        <img src="images/ads/ad5.gif" alt="Gif som vissar spelar spel">
        <img src="images/ads/ad6.gif" alt="Gif där man spelar och skriver meddelanden">
        <img src="images/ads/ad7.gif" alt="Ett tåg som kommer fram och stannar, samt en glad mobil dyker upp med en röd sol i bakgrunden">
  </div>
</div>




<?php $webpageUpdate = "2020/02/15"; include("includes/footer.php"); ?>