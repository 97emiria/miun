<?php   
$pageTitle = "Startsida";
$activePage = basename($_SERVER["SCRIPT_FILENAME"]);

include("includes/header.php"); 
include("includes/classes/Articles.class.php");
?>


<div class="mainLayout">
  <div class="topBox">
     <article>
            <?php
                //Get id to print out specific article with ID
                    
                    //Show article with id
                    $id = 1;

                    //Contection to datebase throu class
                    $getSingelArticles = new Articles();
                    $result = $getSingelArticles->getSingelArticles($id);

                    

                    foreach($result as $res) {
                        $id = $res['id'];
                        $title = $res['title'];
                        $content = $res['content'];
                        $img = $res['img'];
                        $imgText = $res['imgText'];
                        $postdate = $res['postdate'];
                        $author = $res['author'];
                ?>

                        <h2>Månadens nyhet</h2> 
                        <h3> <?=$title?></h3>

                            <div class="responsiveIframe">
                            <iframe src="https://www.youtube.com/embed/u6GX79JWLvo?controls=0?rel=0;&autoplay=1&mute=1&loop=1"  allowfullscreen></iframe>
                            </div>

                        <button class="readBtn" onclick="window.location.href='singelNews.php?articleID=<?=$id?>';">Läs mer</button>
                        <?php 
                            //Chech if user is sign in, show delete and update button
                            if(isset($_SESSION['username'])) {
                        ?>

                            <div class="btnBox">
                                <Button onclick="window.location.href='updateArticle.php?articleID=<?=$id?>';">Uppdatera</Button>
                                <Button onclick="window.location.href='allNews.php?deleteArticle=<?=$id?>';">Radera</Button>
                            </div>
                            
                        <?php } ?>
                    <?php } ?>
                </article>
  </div>
  
  
  
  
    <div class="contentBox">
        <article>
            <h2>Senaste spelnyheterna</h2>

                    <?php
                        //Get the last two article to print out 

                        //Contection to datebase throu class
                        $getSingelArticles = new Articles();
                        $result = $getSingelArticles->getArticles();

                        for ($i=1; $i<=2; $i++) {
                            
                            $row = mysqli_fetch_array($result);
                            $id = $row['id'];
                            $title = $row['title'];
                            $content = substr($res['content'], 0, 200);
                            $img = $row['img'];
                            $imgText = $row['imgText'];
                            $postdate = $row['postdate'];

                    ?>
                        
                            <div class="articleMini">
                                
                                <div class="textBox">
                                    <h3><?=$title?></h3>
                                    <p class="postdate"> Publicerades <?=$postdate?> </p>
                                    <br>
                                    <p class="content"><?=$content?><span>...</span></p>
                                </div>


                                <div class="imgBox">
                                     <img src='images/articlesImg/<?=$img?>' alt='<?=$imgText?>'>
                                </div>

                                <div class="readMoreBtn">
                                <button class="readBtn" onclick="window.location.href='singelNews.php?articleID=<?=$id?>';">Läs mer</button>
                                </div>

                            </div>

                                    <?php 
                                            //Kollar och vissar om anvädaren är inloggad, i så fall finns uppdaterings knappar och delete
                                            if(isset($_SESSION['username'])) {
                                    ?>

                                        <div class="btnBox">
                                            <Button onclick="window.location.href='updateArticle.php?articleID=<?=$id?>';">Uppdatera</Button>
                                            <Button onclick="window.location.href='allNews.php?deleteArticle=<?=$id?>';">Radera</Button>
                                        </div>
                                
                                    <?php } ?> 

                            <?php  } ?> <!--End for foreach loop-->
                        </article>



        <div class="responsiveIframe">
            <iframe src="https://www.youtube.com/embed/dvcQY0v0Ow8?rel=0;&autoplay=1&mute=1&loop=1"></iframe>
        </div>
<br>
<br><br>
<br><br>
            <div class="articleImg">
                <?php
                        //Get the last three article to print out 

                        //Contection to datebase throu class
                        $getSingelArticles = new Articles();
                        $result = $getSingelArticles->getArticles();

                        for ($i=1; $i<=3; $i++) {
                            $row = mysqli_fetch_array($result);
                            $title = $row['title'];
                            $img = $row['img'];
                            $imgText = $row['imgText'];
                            $id = $row['id'];

                ?>

                            <div> 
                                <a href="singelNews.php?articleID=<?=$id?>">
                                    <img src="images/articlesImg/<?=$img?>" alt="<?=$imgText?>"> 
                                    <p> <span> <?=$title?> </span> </p> 
                                </a> 
                            </div> 
                                    
                <?php  
                        } //End for loop
                ?>
            </div>


    </div>
  
  
  
  
  <!-- Box for adds -->
  <div class="adBox">
        <img src="images/ads/ad1.gif" alt="Dancande man">
        <img src="images/ads/ad2.gif" alt="Exempel gif på 20%">
        <img src="images/ads/ad3.gif" alt="Vissar en facebook liknande app">
        <img src="images/ads/ad4.gif" alt="En spelkarektär som knäpper sina fingrar">
        <img src="images/ads/ad5.gif" alt="Gif som vissar spelar spel">
        <img src="images/ads/ad6.gif" alt="Gif där man spelar och skriver meddelanden">
        <img src="images/ads/ad7.gif" alt="Ett tåg som kommer fram och stannar, samt en glad mobil dyker upp med en röd sol i bakgrunden">
  </div>
</div> <!-- End mainLayout -->



<?php $webpageUpdate = "2020/02/15"; include("includes/footer.php"); ?>