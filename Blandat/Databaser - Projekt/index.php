<?php 
    $pageTitle = "Startsida";
    include("include/header.php");
    include("include/classes/Cars.class.php");

?>

    <?php 
        if(isset($_GET['message'])) {
            echo "
                <p class='message' style='margin-top:'>" . $_GET['message'] . "</p> <br><br>";
        }
    ?> 

    <main> 
            <img class="indexImg" src="images/dogcar.jpg" alt="">
             <h1>Car rental system</h1>

    </main>


<?php 
    include("include/footer.php");
?>
