<?php   
    
    //Login in page for users 
    //Made March 2021 of Emilia Holmstörm
    
    
    include("includes/config.php");
    include("includes/classes/Users.class.php");
    include("includes/classes/Posts.class.php");



    $pageTitle = "Logga in";
    include("includes/header.php"); 

?>

    <div class="masterbox">

        <div class="smallFormBox">

        <div class="messageBox">
            <?php if(isset($_GET['message'])) {echo "<p class='message'>" . $_GET['message'] . "</p>";}?> 
        </div>

        <?php

      
        $email = "";
        $password = "";

            if(isset($_POST['email'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $users = New Users();

                if($users->emailExists($email)) {
                    
                    if(!$users->logInUser($email, $password) ) {
                        echo "<p class='error'> Lösenord är felaktigt, försök igen </p>";
                    }
                    
                } else {
                    echo "<p class='error'> E-posten är inte registrerad, skaffa ett konto <a href='register.php'>här</a> </p>";
                }
            
            }

        ?>

        <h1>Logga in</h1>

            <form method="POST" action="login.php">
                <label for="email"> Epost </label>
                <input type="text" id="email" name="email" value="<?=$email?>"> 
                <br>
                <label for="password"> Lösennord </label>
                <input type="password" id="password" name="password" value="<?=$password?>">
                <br>
                <input type="submit" value="Logga in">
            </form>


        <br>

            <p> Inte hunnit bli medlem ännu? Registera dig <a href="register.php">här</a> </p>

        </div>
    </div>

<?php include("includes/footer.php"); ?>
