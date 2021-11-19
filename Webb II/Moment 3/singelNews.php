<?php   
$pageTitle = "Article?";
$activePage = basename($_SERVER["SCRIPT_FILENAME"]);

include("includes/header.php"); 
include("includes/classes/Articles.class.php");
?>

    <div class="masterBox">

            <?php


            //Get ID to get specific article
            if(isset($_GET['articleID'])){

                $id = $_GET['articleID'];

                //Contection to datebase
                $getSingelArticles = new Articles();
                $result = $getSingelArticles->getSingelArticles($id);

                foreach($result as $article) {
                    $id = $article['id'];
                    $title = $article['title'];
                    $content = $article['content'];
                    $img = $article['img'];
                    $imgText = $article['imgText'];
                    $postdate = $article['postdate'];
                    $author = $article['author'];

                ?>
                
                <article>
                    <div class="singelArticels">
                        <h2><?=$title?></h2>

                        <?php echo $content; //Have it php to avoid a extra </p> ?> 
                        <img src="images/articlesImg/<?=$img?>" alt="<?=$imgText?>">

                        <div class="dateAuthorBox">
                        <p> Författare: <?=$author?> </p>
                        <p> Publicerades <?=$postdate?> </p>
                        </div>

                    </div>
                </article>

                <?php 
                        //Check if user is sign in, then show delete and update button
                        if(isset($_SESSION['username'])) {
                ?>
                             <div class="btnBox">
                                <Button onclick="window.location.href='updateArticle.php?articleID=<?=$id?>';">Uppdatera</Button>
                                <Button onclick="window.location.href='allNews.php?deleteArticle=<?=$id?>';">Radera</Button>
                            </div>
                <?php } ?>
               

            <?php
                }
            } else {
                    header("Location: brokenLink.php?message=Tyvärr verkar inte artikeln finnas");
                }
            ?>

    </div>

<?php $webpageUpdate = "2020/02/15"; include("includes/footer.php"); ?>