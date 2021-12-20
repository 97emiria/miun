<?php $pageTitle = "Logga in"; ?>
<?php $activePage = basename($_SERVER["SCRIPT_FILENAME"]); ?>
<?php include("includes/headerNoSignIn.php"); ?>

<main> 
    <div class="loginBox">

        <h2>Logga in</h2>
        <p class="logInText" id="logInText">Välj att logga in via antingen BankID eller lösenord</p>

        <div class="loginBtnBox">
            <button id="bankBtn" class="loginBtnBoxButton">BankID</button>
            <button id="pwordBtn" class="loginBtnBoxButton">Lösenord</button>
        </div>

            
            <div class="bankID" id="bankID">

                <p>Scana QR-koden nedanför med kameran som finns i bankID-appen</p>
                <img src="images/qrCode.png" class="qrCodeStyle" alt="En falsk bild på QR-kod, tar dig till Wikipedias sida"> 

                <form action="profile.php" style="">
                        <input type="checkbox" id="keepSignIn" name="keepSignIn" value="Bike">
                        <label for="keepSignIn"> Håll mig inloggad</label><br><br>

                        <input type="submit" value="Logga in">
                </form>
            </div>

            <div class="password" id="password">
                <form action="profile.php">
                        <div class="loginFlex">
                            <div>
                                <img src="images/iconProfileGrey.png" alt="">
                            </div>
                            <div>
                                <label for="name"> Ditt personnumer </label>
                                <input type="text" id="name" name="name" placeholder="yymmdd-xxxx">
                            </div>
                        </div>

                        <div class="loginFlex">
                            <div>
                                <img src="images/iconLock.png" alt="">
                            </div>
                            <div>
                                <label for="pwd"> Ditt lösenord </label>
                                <input class="lessBottomMargin" type="password" id="pwd" name="pwd" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" >
                                <a href="info.php#forgetPassword">Glömt lösenord?</a>
                            </div>
                        </div>


                        <input type="checkbox" id="keepSignInTwo" name="keepSignInTwo" value="Bike" style="margin-top: 3em;">
                        <label for="keepSignInTwo"> Håll mig inloggad</label><br><br>

                        <input type="submit" value="Logga in">
                </form>
            </div>
    </div>
</main>

<script src="javascript/login.js"></script>
<?php include("includes/footer.php"); ?>