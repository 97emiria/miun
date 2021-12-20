<?php   
    
    //Login in page for users 
    //Made March 2021 of Emilia Holmstörm
    
    include("include/config.php");
    include("include/classes/Employee.class.php");

    $pageTitle = "Logga in";
    include("include/header.php"); 

?>
        <h1>Logga in</h1>

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

                $employee = New Employee();

                if($employee->emailExists($email)) {
                    
                    if(!$employee->logInEmployee($email, $password) ) {
                        echo "<p class='error'> Lösenord är felaktigt, försök igen </p>";
                    }
                    
                } else {
                    echo "<p class='error'> E-posten finns inte, kontrollera den!";
                }
            }
        ?>


            <form method="POST" action="login.php">
                <label for="email"> Epost </label>
                <input type="text" id="email" name="email" value="<?=$email?>"> 
                <br>
                <label for="password"> Lösennord </label>
                <input type="password" id="password" name="password" value="<?=$password?>">
                <br>
                <input type="submit" value="Logga in">
            </form>


        </div>
    </div>

<?php include("include/footer.php"); ?>
