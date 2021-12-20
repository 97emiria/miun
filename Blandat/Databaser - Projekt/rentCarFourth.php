<?php 
    $pageTitle = "Startsida";
    include("include/header.php");
    include("include/classes/Stores.class.php");
    include("include/classes/Cars.class.php");
    include("include/classes/Rented.class.php");
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
        if(isset($_GET['chosenStore'])) {
            $chosenStoreID = $_GET['chosenStore'];
        }

        if(isset($_GET['chosenCar'])) {
            $chosenCarID = $_GET['chosenCar'];
        }

        if(isset($_GET['chosenCustomer'])) {
            $chosenCustomerID = $_GET['chosenCustomer'];
        }


    ?> 

<main> 


    <h1>Rent a Car - step 3</h1>

    <form method="POST" action="">

    <fieldset class="finishInfo">
            <legend>Finished info </legend>

            <?php
                $customers = new Customers();
                $resultChosenCustomer = $customers->getCustomerByID($chosenCustomerID);

                foreach ($resultChosenCustomer as $resultChosenCustomer) {
                    $chosenCustomerFname = $resultChosenCustomer['fname'];
                    $chosenCustomerLname = $resultChosenCustomer['lname'];
                }

                $store = New Stores();
                $resultStore = $store->getStoreByID($chosenStoreID);

                foreach($resultStore as $rowStore) { 
                    $chosenStore = $rowStore['name'];
                    $chosenStoreID = $rowStore['storeID'];
                }

                $cars = New Cars();
                $resultChosenCar = $cars->getCarByID($chosenCarID);

                foreach($resultChosenCar as $rowCar) { 
                    $chosenCarName = $rowCar['name'];
                    $chosenCarModel = $rowCar['model'];
                    $chosenCarID = $rowCar['carID'];
                }

            ?>

            <label for="chosenCustomer"> Customers name:   </label> <br>
            <input type="checkbox" name="chosenCustomer" id="chosenCustomer" value="<?=$chosenCustomerID?>" checked> 
                <?= $chosenCustomerFname . " " . $chosenCustomerLname ?> 
            </input>
            
            <br>
            <br>
            
            <label for="chosenStore"> Get car from store:   </label> <br>
            <input type="checkbox" name="chosenStore" id="chosenStore" value="<?=$chosenStoreID?>" checked> 
                <?= $chosenStore ?> 
            </input>
            
            <br>
            <br>
            
            <label for="chosenCar"> Chosen car:   </label> <br>
            <input type="checkbox" name="chosenCar" id="chosenCar" value="<?=$chosenCarID?>" checked> 
                <?= $chosenCarName . " " . $chosenCarModel ?> 
            </input>
        </fieldset>

        <?php

            //Registration to database
            if(isset($_POST['storeTo'])) {

                $storeTo = $_POST['storeTo'];
                $dateFrom = $_POST['dateFrom'];
                $dateTo = $_POST['dateTo'];
                $employeeID = $_SESSION['employeeID'];
                $rentCar = new Rented();
                $rentID = $rentCar->rentCar($chosenCustomerID, $chosenCarID, $chosenStoreID, $storeTo, $dateFrom, $dateTo, $employeeID);
                $cars->updateRentCar($storeTo, $chosenCarID);

                header("Location: rentCarEnd.php?rentID=$rentID");

            }

        ?>

        <fieldset>
            <legend>Välj butik</legend>

            <select name="storeTo" id="storeTO">
                <?php

                    //Get where car are
                    $cars = New Cars();
                    $resultCars = $cars->countCarsAtStore();

                    //Get store cap are
                    $stores = New Stores();
                    $resultStores = $stores->getStores();

                    foreach ($resultCars as $resultCars) {
                        $currentCars = $resultCars['current'];
                        $carAtStore = $resultCars['store'];

                        $resultStoresTwo = $stores->getStoreByID($carAtStore); 

                        foreach ($resultStoresTwo as $two) {
                            $storeName = $two['name'];
                            $storeCapacity = $two['maxCapacity'];
                            $storeID = $two['storeID'];
                            $storeID = $two['storeID'];

                            $availableLot = $storeCapacity - $currentCars;

                            if ($currentCars >= $two['maxCapacity']) {

                                //Check if the store the car rent from is chosen, then display it
                                if ($chosenStoreID == $storeID) {
                                    echo "<option value='$storeID' > $storeName, ($availableLot available lots) </option>";

                                } else {
                                    echo "<option value='$storeID' disabled>$storeName, ($availableLot available lots) </option>";
                                }

                            } else {
                                echo "<option value='$storeID' >$storeName, ($availableLot available lots) </option>";

                            }
                        }
                    }
                    
                ?>
            </select>
        </fieldset>



        <fieldset>
            <legend>Uthyrning - datum</legend>

                <label for="dateFrom"> From </label> <br>
                <input type="date" id="dateFrom" name="dateFrom" min="2021-06-01" max="2021-09-30" />

                <label for="dateTo"> To </label> <br>
                <input type="date" id="dateTo" name="dateTo" min="2021-06-01" max="2021-09-30" />

        </fieldset>


        <input type="submit" value="Rent car">

    </form>





</main>


<?php 
    include("include/footer.php");
?>
