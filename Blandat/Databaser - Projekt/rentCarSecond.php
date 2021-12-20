<?php 
    $pageTitle = "Startsida";
    include("include/header.php");
    include("include/classes/Stores.class.php");
    include("include/classes/Cars.class.php");
    include("include/classes/Customers.class.php");

?>

    <?php 

        //Check if employees is logged in
        if(!isset($_SESSION['employeeID'])) {
            header("Location: login.php?message=Du måste vara inloggad för denna webbsida");
        } 
    
        if(isset($_GET['message'])) {
            echo "<br><br>
                <p class='message' style='margin-top:'>" . $_GET['message'] . "</p>";
        }

        
        //Get chosen Car and store
        if(isset($_GET['chosenCustomer'])) {
            $chosenCustomerID = $_GET['chosenCustomer'];
        }

    ?> 

<main> 


    <h1>Rent a Car - Store</h1>

    <form method="GET" action="rentCarThird.php">

        <fieldset class="finishInfo">
            <legend>Finished info </legend>

            <?php
                $customers = new Customers();
                $resultChosenCustomer = $customers->getCustomerByID($chosenCustomerID);

                foreach ($resultChosenCustomer as $resultChosenCustomer) {
                    $chosenCustomerFname = $resultChosenCustomer['fname'];
                    $chosenCustomerLname = $resultChosenCustomer['lname'];
                }

            ?>

            <label for="chosenCustomer"> Customers name:   </label> <br>
            <input type="checkbox" name="chosenCustomer" id="chosenCustomer" value="<?=$chosenCustomerID?>" checked> 
                <?= $chosenCustomerFname . " " . $chosenCustomerLname ?> 
            </input>
            
        </fieldset>

     
        <fieldset>
            <legend>Store with available cars</legend>

            <select name="chosenStore" id="chosenStore">
                <?php
                    $cars = new Cars();

                    //Available cars
                    $result = $cars->listStoreWhitAvailableCar();

                    foreach ($result as $row) {
                        $storeID = $row['store'];
                        $currentCars = $row['current'];

                        //Get store cap are
                        $stores = new Stores();
                        $resultStores = $stores->getStoreByID($storeID);


                        foreach ($resultStores as $row) {

                            $name = $row['name'];
                            $storeID = $row['storeID'];

                            echo "<option value='$storeID'> $name, ($currentCars available cars) </option>";
                        }

                    }
           

                    
                ?>
            </select>
        </fieldset>

        <input type="submit" value="Check which car is available Status">

    </form>


</main>


<?php 
    include("include/footer.php");
?>
