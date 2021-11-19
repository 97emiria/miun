<?php   
include("includes/config.php");
include("includes/classes/Users.class.php");


$pageTitle = "Logga in";
$activePage = basename($_SERVER["SCRIPT_FILENAME"]);
include("includes/header.php"); 
?>
<div class="masterBox">
    <div class="loginBox">

    <?php

    $username = "";
    $password = "";

        if(isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $users = New Users();

            if($users->logInUser($username, $password) ) {
                echo "<p class='success'> Inloggad </p>";
            } else {
                echo "<p class='error'> Fel vid inloggning, testa igen </p>";
            } 
        }

    ?>

    <h1>Logga in</h1>

        <form method="POST" action="login.php">
            <label for="username"> Användarnamn </label>
            <input type="text" id="username" name="username" value="<?=$username?>"> 
            <br>
            <br>
            <label for="password"> Lösennord </label>
            <input type="password" id="password" name="password" value="<?=$password?>">
            <br>
            <br>
            <input type="submit" value="Logga in">
        </form>


    <br>

        <button class="readBtn" onclick="window.location.href='register.php';">Ny? Registera dig här! </button>

    </div>
</div>




<?php $webpageUpdate = "2020/02/15"; include("includes/footer.php"); ?>