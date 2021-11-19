<?php 
    include("include/classes/Stores.class.php");
    include("include/classes/Cars.class.php");
    include("include/classes/Rented.class.php");
    include("include/classes/Customers.class.php");
    

    if(isset($_GET['rentID'])) {
        $rentID = $_GET['rentID'];
        $carID = $_GET['carID'];


        //Change rented info
        $rented = new Rented;
        $rented->updateRentedCar($rentID);

        //Change car info
        $cars = new Cars;
        $cars->updateRentedCar($carID);

        header('Location: returnCarEnd.php?message="The car is now registered as returned"');

    } else {
        header("Location: returnCar.php?message='Something went wrong, try again'");
    }