<?php   
    
    //This page use to registrate user for webpage
    //Made March 2021 of Emilia Holmstörm
    
    include("includes/config.php");
    include("includes/classes/Users.class.php");
    include("includes/classes/Posts.class.php");


    $pageTitle = "Skapa konto";
    include("includes/header.php"); 

?>

<div class="masterbox">

        <?php
            $errors = [];  //Array to show errors messages

            $password = "";
            $passwordCheck = "";
            $firstname = "";
            $lastname = "";
            $email = "";


            if(isset($_POST['email'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $passwordCheck = $_POST['passwordCheck'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];


                //Get class
                $users = New Users();
                
                //Kollar så alla "krav" är uppfyllda
                if(!$users->setPassword($password)){
                    array_push($errors, "Lösenordet måste vara minst 5 tecken långt");
                } 

                if($password != $passwordCheck){
                    array_push($errors, "Lösenorden stämmer inte överens med varandra");
                }
               
                if(!$users->setFirstname($firstname)){
                    array_push($errors, "Ditt förnamn måste bestå av minst två bokstäver");
                } 

                if(!$users->setFirstname($lastname)){
                    array_push($errors, "Ditt efternamn måste bestå av minst två bokstäver");
                } 

                if($users->emailExists($email)) { 
                    array_push($errors, "E-posten finns redan registrerad");
                }

                if(!$users->setFirstname($email)){
                    array_push($errors, "E-posten är inte giltig");
                } 

                if(!isset($_POST['approves'])) {
                    array_push($errors, "Du måste acceptera villkoren");
                }

                //If no error exist ....
                if(sizeof($errors) == 0) {
                        if(!$users->addUsers($password, $firstname, $lastname, $email)) {
                            echo "<p class='error'> Något gick fel </p>";
                        }
                }
            } 

        ?>

    <div class="smallFormBox">

        <h1>Registrera</h1>
        
        <?php

            if(isset($_GET['messageTwo'])) {
                echo "<p class=success>" . $_GET['messageTwo'] . "</p>";
            }


            if(sizeof($errors) > 0) {
                echo "<ul class='error'>";
                foreach ($errors as $errors) {
                    echo "<li> $errors </li> ";
                }
                echo "</ul> <br>";
            }
        ?>

            <form method="POST">
                <h3>Inloggningsuppgifter</h3>

                <label for="email"> E-post </label>
                <input type="email" id="email" name="email" value="<?=$email?>"> 

                <label for="password"> Lösennord </label>
                <input type="password" id="password" name="password" value="<?=$password?>">

                <label for="passwordCheck"> Skriv lösenord igen: </label>
                <input type="password" id="passwordCheck" name="passwordCheck" value="<?=$passwordCheck?>">
                


                <h3>Användaruppgifter</h3>
               
                <label for="firstname"> Förnamn </label>
                <input type="text" id="firstname" name="firstname" value="<?=$firstname?>"> 
      
                <label for="lastname"> Efternamn </label>
                <input type="text" id="lastname" name="lastname" value="<?=$lastname?>"> 

                <br><br>
                <input type="checkbox" id="approves" name="approves">
                <label for="approves"> Jag godkänner att oavstående uppgifter kommer lagras för syfte till inloggning.  </label><br>
                <br>
                <input type="submit" value="Registera dig">
            </form>
    </div> <!-- SmallFormBox end -->
</div> <!-- Masterbox end -->







<?php $webpageUpdate = "2020/02/15"; include("includes/footer.php"); ?>