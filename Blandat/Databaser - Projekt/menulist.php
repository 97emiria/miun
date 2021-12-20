<?php 
    $pageTitle = "Startsida";
    include("include/header.php");

    //Check if employees is logged in
    if(!isset($_SESSION['employeeID'])) {
        header("Location: login.php?message=Du måste vara inloggad för denna webbsida");
    } 
    
?>


<ul class="forKnow">
    <li>Installs</li>
    <li><a href="installs/install.employee.php">Employee</a></li>
    <li><a href="installs/install.cars.php">Cars</a></li>
    <li><a href="installs/install.stores.php">Stores</a></li>
    <li><a href="installs/install.rented.php">Rented</a></li>
    <li><a href="installs/install.customers.php">Customers</a></li>
    <li><a href="installs/install.status.php">Status</a></li>
    <li><a href="installs/install.trigger_rented.php">Trigger</a></li>

    <br>
    <li><a href="logout.php">Logga ut</a></li>
</ul>


<?php 
    include("include/footer.php");
?>
