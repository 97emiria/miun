<?php   
include("includes/config.php");
include("includes/classes/Users.class.php");


//Kontrollera om användaren är inloggad
if(!isset($_SESSION['username'])) {
    header("Location: login.php?message=Du måste logga in först!");
} else {
    $username = $_SESSION['username'];
    $users = New Users();
    if(!$users->adminUser($username)) {
        header("Location: index.php?message=Du har inte behörighet för denna sida");
    }
}

$pageTitle = "Admin";
$activePage = basename($_SERVER["SCRIPT_FILENAME"]);
include("includes/header.php"); 
?>



<div class="masterBox">

    <h1>Välkommen till admin</h1>
    <h2>Ge admin rättigheter till användare</h2>

<br>
<br>

<?php

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $users = new Users();
    
    if($users->updateUserToAdmin($username)) {
        echo "<p class='success'> Tillagd </p>";
    }   else {
        echo "<p class='error'> Inte tillagd, försök igen </p>";
    }
}
?>

    <form method="POST" >
                <label for="username">Skriv in användarnamnet på den användare som ska få adminrättigheter </label>
                <input type="text" id="username" name="username"> 

                <input type="submit" value="Uppdatera användaren till admin">
            </form>

</div>


<?php $webpageUpdate = "2020/02/15"; include("includes/footer.php"); ?>