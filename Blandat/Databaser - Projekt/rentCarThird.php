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


        //Get  previous info
        if(isset($_GET['chosenCustomer'])) {
            $chosenCustomerID = $_GET['chosenCustomer'];
        }
        if(isset($_GET['chosenStore'])) {
            $chosenStoreID = $_GET['chosenStore'];
        }
    ?> 

<main> 


    <h1>Rent a Car - Car</h1>


    <form method="GET" action="rentCarFourth.php">

        <fieldset class="finishInfo">
            <legend>Finished info </legend>

            <?php
                $customers = new Customers();
                $resultChosenCustomer = $customers->getCustomerByID($chosenCustomerID);

                foreach ($resultChosenCustomer as $rowCustomer) {
                    $chosenCustomerFname = $rowCustomer['fname'];
                    $chosenCustomerLname = $rowCustomer['lname'];
                }

                $store = New Stores();
                $resultStore = $store->getStoreByID($chosenStoreID);

                foreach($resultStore as $rowStore) { 
                    $chosenStore = $rowStore['name'];
                    $chosenStoreID = $rowStore['storeID'];
                }

            ?>

            <label for="chosenCustomer"> Customers name:   </label> <br>
            <input type="checkbox" name="chosenCustomer" id="chosenCustomer" value="<?=$chosenCustomerID?>" checked> 
                <?= $chosenCustomerFname . " " . $chosenCustomerLname ?> 
            </input>
            
            <br>
            <br>
            
            <label for="chosenStore"> Store:   </label> <br>
            <input type="checkbox" name="chosenStore" id="chosenStore" value="<?=$chosenStoreID?>" checked> 
                <?= $chosenStore ?> 
            </input>
        </fieldset>

        <?php

            //Get value from url bar
            if(isset($_GET['chosenStore'])) {
                $storeID = $_GET['chosenStore'];

                $store = New Stores();

                $resultStore = $store->getStoreByID($storeID);

                foreach($resultStore as $rowStore) { 
                    $chosenStore = $rowStore['name'];
                }



                $cars = New Cars();
                $result = "";
                
                //Get info from form
                $result = $cars->availableCarAtStore($storeID);

                ?>

                    <form method="GET" action="rentcarThird.php">

                        <p>Chose a one of the available cars </p>

                <?php

                    foreach($result as $row) { 
                        
                        echo "<input type='radio' id='" . $row['carID'] . "' name='chosenCar' value='" .$row['carID'] . "'> ";
                        echo "<label for='" .$row['carID']. "'>" .$row['name']. "</label> <br>";
                    }
                ?>

                    <input type="submit" value="Book this car">
                    </form>

                <?php
            } 
        ?>






</main>


<?php 
    include("include/footer.php");
?>
