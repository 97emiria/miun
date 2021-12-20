<?php $pageTitle = "Min sida"; ?>
<?php $activePage = basename($_SERVER["SCRIPT_FILENAME"]); ?>
<?php include("includes/header.php"); ?>

<main>
    <div class="profileHeading">
        <h1 >Min sida</h1>
        <img src="images/carSmoke.png" alt="">
    </div>

    <div class="profileFlex">

        <div>

            <button class="greyBtn" onclick="window.location.href='booking.php'">BOKA RESA</button>

            <div class="btnBoxProfile">
                <nav>
                    <button class="normalBtn" onclick="window.location.href='profileFutureBooking.php'"> Hantera kommande resor <span>&#129050;</span> </button>
                    <button class="normalBtn" onclick="window.location.href='profileOldBooking.php'"> Tidigare resor <span>&#129050;</span> </button>
                    <button class="normalBtn" onclick="window.location.href='info.php'"> Information om färdtjänst <span>&#129050;</span> </button>
                </nav>
            </div>

            <button class="logoutBtn" onclick="window.location.href='index.php'"> Logga ut </button>

        </div>
        <div class="profileLeftBox">
        
            <h2 class="">Kommande resa</h2>
            <p> Till: Drottninggatan 22, Åmål<br>
                Från: Schölinsgatan 2, Åmål <br>
                <br>
                Upphämtning 20.30 Söndag den 6 maj<br>
                <br>
                Övrigt: ledsagare, 1 extra passagerare
            </p>
            <br>
            
            <button class="greyBtn" onclick="window.location.href='profileFutureBooking.php'">Hantera resan</button>

        </div>
    </div>
</main>



<?php include("includes/footer.php"); ?>