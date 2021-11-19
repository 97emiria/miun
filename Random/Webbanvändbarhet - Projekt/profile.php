<?php $pageTitle = "Min sida"; ?>
<?php $activePage = basename($_SERVER["SCRIPT_FILENAME"]); ?>
<?php include("includes/header.php"); ?>

<main>
    <div class="iconHeader">
        <img src="images/iconProfileGrey.png" alt="">
        <h1>Min sida</h1>
    </div>

    <div class="profileFlex">

        <div class="profileBox_left">
            <nav>
                <ul>
                    <li>
                        <a href="booking.php">
                            <img src="images/iconCarGrey.png" alt="">
                            Boka en resa
                        </a>
                    </li>
                    <li>
                        <a href="profileFutureBooking.php">
                            <img src="images/iconCalendar.png" alt="">
                            Bokade resor
                        </a>
                    </li>
                    <li>
                        <a href="profileOldBooking.php">
                            <img src="images/iconBack.png" alt="">
                            Tidigare resor
                        </a>
                    </li>
                    <li>
                        <a href="info.php">
                            <img src="images/iconInfoGrey.png" alt="">
                            Information om färdtjänst
                        </a>
                    </li>
                    <li>
                        <a href="index.php">
                            <img src="images/iconLogOut.png" alt="">
                            Logga ut
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="profileBox_right">

            <div>
                <h2>Personlig information</h2>
                <p>
                    Namn: <strong>Stina Stensson</strong> <br>
                    Kommun: Åmål <br>
                    Färdtjänst beviljat till: 31 juli 2021 <br>
                </p>
                <img src="images/stadsvapen.png" class="kommunImg" alt="">
            </div>

            <div>
                <h2> Nästa resa är</h2>
                <p>  
                    Söndag den 6 maj, kl. 20.30<br>
                    Till: Drottninggatan 22, Åmål<br>
                </p>
                <button class="cancelBtn" onclick="window.location.href='messageExempel.php'" >Avboka</button>
                <button class="rebookBtn" onclick="window.location.href='bookChange.php'" >Ändra</button>
            </div>

           
            
            <div>
               <p id="clock" role="timer" aria-live="off">
                    Du loggas ut om 15 minuter
               </p>
            </div>
            
            

        </div>
    </div>
</main>

<script>
    function logOut() {
        setTimeout(function(){ window.location.href = 'index.php'; }, 900000);
    }
    logOut();
</script>

<?php include("includes/footer.php"); ?>