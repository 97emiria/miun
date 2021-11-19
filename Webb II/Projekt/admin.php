<!-- This page have 5 section who all have its own form, 
that update/change data in database connected thru methods -->



<?php   
    include("includes/config.php");
    include("includes/classes/Users.class.php");
    include("includes/classes/Posts.class.php");
    include("includes/classes/Comments.class.php");
    include("includes/classes/Save.class.php");




    //Kontrollera om användaren är inloggad
    if(!isset($_SESSION['userID'])) {
        header("Location: login.php?message=Du måste vara inloggad som admin för denna webbsida");

    } else {

        $userID = $_SESSION['userID'];
        $users = New Users();

        //Ifall inget resultat kommer tillbaka ska användaren skickas till index med ett meddelande
        if(!$users->adminExists($userID)) {
            header("Location: index.php?message=Du har inte behörighet för denna sida");
        }
    }

    



    $pageTitle = "Admin";
    include("includes/header.php");
?>

<div class="masterbox adminSection">

        <div>
            <h1>Adminstation</h1>
            
            <div class="adminBtnBox">
                    <button id="changePasswordBtn">Byta lösenord åt användare</button>
                    <button id="setAdminBtn">Ge adminstations-rättigheter</button>
                    <Button id="deletePostsBtn">Radera inlägg</Button>
                    <Button id="deleteCommentBtn">Radera kommentar</Button>
                    <Button id="deleteUserBtn">Ta bort konto</Button>
            </div>
        </div>

        <?php //To open current box

            $hidePassword = "";
            $hideAdmin = "";
            $hidePosts = "";
            $hideComment = "";
            $hideUser = "";

            if(isset($_GET['openBox'])) {
                $box = $_GET['openBox'];

                if($box == "hidePassword") {
                    $hidePassword = "style='display:block;'";
                }
                
                if($box == "hideAdmin") {
                    $hideAdmin = "style='display:block;'";
                }

                if($box == "hidePosts") {
                    $hidePosts = "style='display:block;'";
                }

                if($box == "hideComment") {
                    $hideComment = "style='display:block;'";
                }

                if($box == "hideUser") {
                    $hideUser = "style='display:block;'";
                }
            }


        ?>


    <section id="changePasswordBox" <?=$hidePassword;?>>
        <h2>Ändra lösenord åt användare</h2>
        <?php
            $errors = [];

            if(isset($_POST['email'])) {
                
                $changePassword = new Users();

                $email = $_POST['email'];
                $newPassword = $_POST['newPassword'];

                if(!$changePassword->emailExists($email)) {
                    array_push($errors, "E-postadressen existerar inte");
                }
                if(!$changePassword->setPassword($newPassword)){
                    array_push($errors, "Lösenordet måste vara minst 5 tecken långt");
                }
                    
                if(sizeof($errors) == 0) {
                    //Sparar den nya lösenordet
                    if($changePassword->adminChangePassword($newPassword, $email)) {
                        echo "<p class='success'> Lösenordet bytt </p>";

                    } else {
                        array_push($errors, "Det nya lösenordet kunde inte sparas");
                    }
                }
                                        
            } 

            if(sizeof($errors) > 0) {
                echo "<ul class='error'>";
                foreach ($errors as $errors) {
                    echo "<li> $errors </li> ";
                }
                echo "</ul> <br>";
            }

            ?>

            <div class="smallFormBox smallFormBoxWihtoutBorder">
                <form method="POST" action="admin.php?openBox=hidePassword">
                    <label for="email"> E-post: </label>
                    <input type="text" id="email" name="email"> 
                    <br>
                    <br>
                    <label for="newPassword"> Nya lösenordet: </label>
                    <input type="password" id="newPassword" name="newPassword">
                    <br>
                    <br>
                    <input type="submit" value="Byt lösenord">
                </form>
            </div>
    </section>

    <section id="setAdminBox" <?=$hideAdmin?>>
        <h2>Uppgradera användare till admin</h2>

            <?php

            $errors = [];

            if(isset($_POST['emailForAdmin'])) {
                    
                $updateUserToAdmin = new Users();
                $email = $_POST['emailForAdmin'];

                if(!$updateUserToAdmin->emailExists($email)) {
                    array_push($errors, "E-postadressen existerar inte");
                }

                if(sizeof($errors) == 0) {
                    //Sparar den nya lösenordet
                    if($updateUserToAdmin->updateUserToAdmin($email)) {
                        echo "<p class='success'> Användare uppgraderad </p>";
                    } else {
                        array_push($errors, "Något har gått fel");
                    }
                }
                                        
            } 

            if(sizeof($errors) > 0) {
                echo "<ul class='error'>";
                foreach ($errors as $errors) {
                    echo "<li> $errors </li> ";
                }
                echo "</ul> <br>";
            }

            ?>

            <div class="smallFormBox smallFormBoxWihtoutBorder">
                <form method="POST" action="admin.php?openBox=hideAdmin">
                    <label for="emailForAdmin"> E-posten på den person som ska få admin rättigheter </label>
                    <input type="text" id="emailForAdmin" name="emailForAdmin"> 
                    <input type="submit" value="Uppgradera användare">
                </form>
            </div>
    </section>

    <section id="deletePostsBox" <?=$hidePosts?>>
        <h2>Radera inlägg</h2>
        
        <?php

            $errors = [];
    
            $userID = "";
            $postID = "";

            if(isset($_POST["userIDDeletePost"])) {
                //Get 
                $userID = $_POST["userIDDeletePost"];
                $postID = $_POST['deletePostID'];

                //Open classes
                $checkUser = new Users();
                $postClass = new Posts();


                //Kontroller
                if(!$checkUser->userIDExists($userID)) {
                    array_push($errors, "Användar ID finns inte databasen");
                }
                if(!$postClass->existPostIDWithUserID($postID, $userID)) {
                    array_push($errors, "PostID och användar ID matchar inte");
                }

                    if(sizeof($errors) == 0) {
                            if($postID != null) {
                                //Hämta bildnamnet, för att radera från mappen
                                $result = $postClass->getImg($postID); 
                                $row = mysqli_fetch_array($result);
                                $imgName = $row['img'];

                                if($imgName != null) {
                                    unlink("uploads/" . $imgName);
                                }

                            }

                            //Hämta alla inläggets kommentarer för att radera ur databasen
                            $commentClass = new Comments();
                            $commentClass->deleteComment($postID);


                            //Slutligen radera inlägget
                            $postClass->deletePost($postID, $userID);
            
                            $userID = "";
                            $postID = "";
                            echo "<p class='success'> Inlägget är nu borttaget";
                    }
            }

            if(sizeof($errors) > 0) {
                echo "<ul class='error'>";
                foreach ($errors as $errors) {
                    echo "<li> $errors </li> ";
                }
                echo "</ul> <br>";
            }
        ?>
        
        
        <div class="smallFormBox smallFormBoxWihtoutBorder">
                <form method="Post" action="admin.php?openBox=hidePosts">
                    <label for="userIDDeletePost"> Beröd användare ID </label>
                    <input type="text" id="userIDDeletePost" name="userIDDeletePost" value="<?=$userID?>" > 

                    <label for="deletePostID"> postID </label>
                    <input type="text" id="deletePostID" name="deletePostID" value="<?=$postID?>" > 
                    <input type="submit" value="Ta bort inlägg">
                </form>
            </div>    
    </section>




    <section id="deleteCommentBox" <?=$hideComment?>>
        <h2>Radera kommentarer</h2>
        <?php
                $errors = [];
                $userID = "";
                $commentID = "";

                //Get users post info
                $checkComments = new Comments(); 
                $checkUsername = new Users();

                //To delete posts
                if(isset($_POST['userIDDeleteComment'])) {

                    $commentID = $_POST['deleteCommentID'];
                    $userID= $_POST['userIDDeleteComment'];

                    if(!$checkUsername->adminExists($userID)) {
                        array_push($errors, "Användar ID finns inte ");
                    }

                    if(!$checkComments->existComment($commentID)) {
                        array_push($errors, "Kommentaren finns inte");
                    }

                    if(sizeof($errors) == 0) {
                        if($checkComments->existCommentWithUser($commentID, $userID)) {
                            
                            $checkComments->deleteSpecificComment($commentID, $userID);
                        
                            echo "<p class='success'> Kommentarer är borttagen </p>";
                            $username = "";
                            $commentID = "";

                        } else {
                            array_push($errors, "kommentars ID och användarnamn matchar inte");
                        }
                    }

                }

                if(sizeof($errors) > 0) {
                    echo "<ul class='error'>";
                    foreach ($errors as $errors) {
                        echo "<li> $errors </li> ";
                    }
                    echo "</ul> <br>";
                }
            ?>

            <div class="smallFormBox smallFormBoxWihtoutBorder">
                <form method="Post" action="admin.php?openBox=hideComment">
                    <label for="userIDDeleteComment"> Beröd användarID </label>
                    <input type="text" id="userIDDeleteComment" name="userIDDeleteComment" value="<?=$userID?>"> 

                    <label for="deleteCommentID"> commentID </label>
                    <input type="text" id="deleteCommentID" name="deleteCommentID" value="<?=$commentID?>"> 
                    <input type="submit" value="Ta bort inlägg">
                </form>
            </div>

    </section>

    <section id="deleteUserBox" <?=$hideUser?>>
        <h2>Ta bort användare</h2>

        <?php

        //Måste ta bort användare, kommentarer från användaren samt inlägg
        $errors = [];

        //Get users post info
        $deleteUser = new Users();
        $deletePosts = new Posts();
        $deleteComments = new Comments();
        $deleteSave = new Save();

        

        //To delete posts
        if(isset($_POST['userMail'])) {

            //Samlar värden
            $userMail = $_POST['userMail'];
            $checkMail = $_POST['checkMail'];
            $adminPassword = $_POST['passwordAdmin'];

            //Kontroller
            if(!$deleteUser->emailExists($userMail)) {
                array_push($errors, "E-postadressen finns inte ");
            } elseif ($userMail != $checkMail) {
                    array_push($errors, "E-postadresserna stämmer inte överens med varandra");
            }  

        

            //Samlar världen för att kolla så inloggad användare kan sitt lösenord
            $userID = $_SESSION['userID'];
            $oldPassword = $adminPassword;

            if(!$deleteUser->checkPassword($userID, $oldPassword)) {
                array_push($errors, "Felaktigt admin lösenord");
            }
            
            if(sizeof($errors) == 0) {

                //Get userID from Email
                $result = $deleteUser->getUserInfoFromEmail($userMail);
                $row = mysqli_fetch_array($result);
                $userID = $row['userID'];

                //Hämta alla bilder med det userID och raderar dem ifrån mappen
                $result = $deletePosts->getImgUser($userID);
                foreach ($result as $row) {
                    unlink("uploads/" . $row['img']);
                }

                //Raderar alla kommentarer från en användare databasen
                $deleteComments->deleteUserIDComments($userID);

                //Delete all saved post for a user 
                $deleteSave->removeUserSaved($userID);

                //Slutligen radera inlägget
                $deletePosts->deleteUserPosts($userID);
                $deleteUser->deleteUser($userID);

                echo "<p class='success'> Användaren ska nu vara borttagen </p>";
            }
            
        }  

        if(sizeof($errors) > 0) {
            echo "<ul class='error'>";
            foreach ($errors as $errors) {
                echo "<li> $errors </li> ";
            }
            echo "</ul> <br>";
        }

        ?>


        <div class="smallFormBox smallFormBoxWihtoutBorder">
            <form method="Post" action="admin.php?openBox=hideUser">
                <label for="userMail"> Användarens e-posten </label>
                <input type="text" id="userMail" name="userMail"> 

                <label for="checkMail"> Upprepa e-post </label>
                <input type="text" id="checkMail" name="checkMail"> 

                <label for="passwordAdmin"> Adminstratören <?=$_SESSION['fname'] . " " . $_SESSION['lname']?> lösenord </label>
                <input type="text" id="passwordAdmin" name="passwordAdmin"> 
                
                <p> Tänk på att när användare är borttagen är den borta och går inte att återställa </p>
                <input type="submit" value="Ta bort användare">
            </form>
        </div>
    </section>

</div> <!-- End masterbox -->
<script src="javascript/adminBoxes.js"></script>
<?php include("includes/footer.php"); ?>