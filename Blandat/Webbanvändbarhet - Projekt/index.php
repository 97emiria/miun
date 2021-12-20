<?php $pageTitle = "Startsida"; ?>
<?php $activePage = basename($_SERVER["SCRIPT_FILENAME"]); ?>

<?php include("includes/headerNoSignIn.php"); ?>

<main> 
    <div class="indexBox">
        <div>
            <h1>Färdtjänst Väst</h1>
                <p>
                    Välkommen till <strong>Färdtjänst Väst</strong>, en webbsida/app som är tillgänglighetsanpassad 
                    för att enklare kunna <strong>boka</strong> och ha <strong>översikt</strong> över sina
                    färdtjänstresor. Färdtjänst Väst är
                    en del av <strong>Västtrafik</strong> i sammarbeta med <strong>Västra Götalandsregionen</strong>. 
                </p>
                <p>
                    För att 
                    <strong>boka</strong>, 
                    <strong>omboka</strong>, 
                    <strong> avboka </strong> 

                    eller se <strong>dina resor</strong> 
                    behöver du <strong>logga in</strong>. 
                </p>
                <p>
                    Saknar du inlogg, 
                    tappat bort inloggningsuppgifter eller har andra <strong>funderingar</strong>, 
                    kolla under <strong><a href="infoNotSignin.php" title="Till info-sidan">info här</a></strong> där du hittar de vanligaste frågorna.
                </p>
                <p>
                    Under <strong>info</strong> hittar du också <strong>telefonnumer</strong> med öppentider samt <strong>mail-kontakt</strong>. 
                </p>
                <button class="normalBtn loginBtnIndex" onclick="window.location.href='login.php'">
                    <img src="images/iconLogin.png" class="loginImg" alt="">    
                    Logga in
                </button>
        </div>

        <div>
            <img src="images/indexImg.jpg" alt="">
        </div>
    
    </div>
</main>

<?php include("includes/footer.php"); ?>