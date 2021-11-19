<?php 
    $pageTitle = "Startsida";
    include("include/header.php");
    include("include/classes/Stores.class.php");
    include("include/classes/Cars.class.php");
    include("include/classes/Rented.class.php");
    include("include/classes/Customers.class.php");
?>

    <h1>Bil återlämnad</h1>


    <?php 

        //Check if employees is logged in
        if(!isset($_SESSION['employeeID'])) {
            header("Location: login.php?message=Du måste vara inloggad för denna webbsida");
        } 
    
        if(isset($_GET['message'])) {
            echo "<br><br>
                <p class='message' style='margin-top:'>" . $_GET['message'] . "</p>";
        }

    ?> 


    

<?php 
    include("include/footer.php");
?>
