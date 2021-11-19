<?php   
    include("includes/config.php");
    include('includes/classes/Users.class.php');

    $pageTitle = "Registrera";
    $activePage = basename($_SERVER["SCRIPT_FILENAME"]);
    include("includes/header.php"); 
?>
<div class="masterBox">

    <div class="loginBox">

        <?php

            $username = "";
            $password = "";
            $errors = [];  //Array to show errors messages

            if(isset($_POST['username'])){
                $username = $_POST['username'];
                $password = $_POST['password'];

                //Get class
                $users = New Users();
                
                //Chech input info
                if(!$users->setUsername($username)){
                    array_push($errors, "Användarnamnet måste vara minst 5 tecken långt");
                }

                if(!$users->setPassword($password)){
                    array_push($errors, "Lösenordet måste vara minst 5 tecken långt");
                }

                $chechbox = 0;

                if(isset($_POST['approves'])) {
                    $chechbox = 1;
                } else {
                    array_push($errors, "Du måste acceptera villkoren");
                }



                //If no error exist ....
                if(sizeof($errors) == 0) {

                    if($users->userExists($username)) {
                        
                        echo "<p class='error'> Användarnamnet är upptaget </p>";

                    } else {
                            
                        if($users->addUsers($username, $password)) {
                            $_SESSION['username'] = $username;
                            header("Location: register.php?messageTwo=Välkommen till SPER! Du är nu registerad och inloggad!");

                        }   else {
                            echo "<p class='error'> Något gick fel </p>";
                        }
                    } 
                } 
            } 

        ?>

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

            <form method="POST" action="register.php">
                <label for="username"> Användarnamn </label>
                <input type="text" id="username" name="username" value="<?=$username?>"> 
                <br>
                <br>
                <label for="password"> Lösennord </label>
                <input type="password" id="password" name="password" value="<?=$password?>">
                <br>
            
                <input type="checkbox" id="approves" name="approves" value="1">
                <label for="approves"> Jag godkänner att oavstående uppgifter kommer lagras för syfte till inloggning.  </label><br>
                <br>

                <input type="submit" value="Registera dig">
            </form>

    </div>
</div>





<?php $webpageUpdate = "2020/02/15"; include("includes/footer.php"); ?>