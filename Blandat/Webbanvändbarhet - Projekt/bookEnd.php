<?php $pageTitle = "Boka resa"; ?>
<?php $activePage = basename($_SERVER["SCRIPT_FILENAME"]); ?>
<?php include("includes/header.php"); ?>


<main> 

    <h1>Bokningsbekräftelse</h1>

    <p>
        Din resa är nu bokad nedan ser du boknings bekräftelse samt kvitto! 
        Ca 1 timme för resa kommer du få ett sms angående resan. 
    <br>
    <br>
        Resan betalas till chauffören innan avresa. 
    </p>

    <div class="pdfBox">
        <div class="receipt">
            <h2>Kvitto</h2>
            <img class="bookEndImg" src="images/iconDownload.png" alt="">
        </div>


        <div class="confirmation">
            <h2>Bokingsbekräftelse</h2>
            <img class="bookEndImg" src="images/iconDownload.png" alt="">
        </div>
    </div>

    <button class="greyBtn" onclick="window.location.href='profile.php'">Till min sida</button>
    

</main>

<?php include("includes/footer.php"); ?>