<?php $pageTitle = "Boka resa"; ?>
<?php $activePage = basename($_SERVER["SCRIPT_FILENAME"]); ?>
<?php include("includes/header.php"); ?>

<main> 
    <h1>Bekräfta resa</h1>


    <p>
        <b>Till</b>: Drottninggatan 22, Åmål <br>
        <b>Från:</b> Schölinsgatan 2, Åmål <br>
        <br>
        <b>Upphämtning:</b> 20.30 söndag den 8 juni <br>
        <br>
        <b>Hjälpmedel:</b> Ledhund <br>
        <b>Resesällskap:</b> Ingen <br>
        <br>
    </p>

    <button class="redBtn maxWidthBtn"   onclick="window.location.href='booking.php'" > Gå tillbaka och ändra   </button>
    <button class="greenBtn maxWidthBtn" onclick="window.location.href='bookEnd.php'" > Boka och bekräfta resan </button>
</main>

<?php include("includes/bodyEnd.php"); ?>