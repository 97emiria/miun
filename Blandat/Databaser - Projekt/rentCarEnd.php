<?php 
    $pageTitle = "Startsida";
    include("include/header.php");
    include("include/classes/Stores.class.php");
    include("include/classes/Cars.class.php");
    include("include/classes/Customers.class.php");
    include("include/classes/Rented.class.php");
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

        if(isset($_GET['rentID'])) {
            $rentID = $_GET['rentID'];
        }
    ?> 

    <h1>Rental completed</h1>

    <?php
            $rentInfo = new Rented();
            $result = $rentInfo->getRentCarByID($rentID);

            foreach ($result as $row) {
                $storeFrom = $row['storeFrom'];
                $storeTo = $row['storeTo'];
                $dateFrom = $row['dateFrom'];
                $dateTo = $row['dateTo'];
                $carID = $row['carID'];
                $customerID = $row['customerID'];
                $dateFrom = $row['dateFrom'];
                $dateTo = $row['dateTo'];
                $orderTime = $row['orderTime'];
                $employeeID = $row['employeeID'];


                //Get info from other base

                $store = new Stores();
                $resultStoreFrom = $store->getStoreByID($storeFrom);

                foreach ($resultStoreFrom as $rowStoreFrom) {
                    $storeFrom = $rowStoreFrom['name'];
                }

                $store = new Stores();
                $resultStoreFrom = $store->getStoreByID($storeTo);

                foreach ($resultStoreFrom as $rowStoreTo) {
                    $storeTo = $rowStoreTo['name'];
                }

                $cars = new Cars();
                $resultCar = $cars->getCarByID($carID);

                foreach ($resultCar as $rowCar) {
                    $carName = $rowCar['name'];
                    $carModel = $rowCar['model'];
                    $carColor = $rowCar['color'];
                    $carPrice = $rowCar['price'];
                    $carID = $rowCar['carID'];
                }
            }        
    ?>

    <table>
        <tr>
            <th>Rental info</th>
        </tr>
        <tr>
            <td>Receipt number / rent ID</td>
            <td><?=$rentID?></td>
        </tr>

        <tr>
            <td>Price</td>
            <td><?=$carPrice?>	&euro; / day</td>
        </tr>


        <tr>
            <td>Pick up from </td>
            <td><?= $storeFrom ?> </td>
        </tr>
        <tr>
            <td> Earliest to get car </td>
            <td><?= $dateFrom ?> </td>
        </tr>
        <tr>
            <td>Leave car at </td>
            <td><?= $storeTo ?> </td>
        </tr>
        
        <tr>
            <td>Last to return car: </td>
            <td><?= $dateTo ?> </td>
        </tr>

    </table>
    
    <div class="flexBox">
        <div>
            <table>
                <tr>
                    <th> Car info </th>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?= $carName ?> </td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td><?=$carModel?></td>
                </tr>
                <tr>
                <tr>
                    <td>Color</td>
                    <td><?=$carColor?></td>
                </tr>
                <tr>
                    <td>CarID</td>
                    <td><?=$carID?></td>
                </tr>
            </table>
        </div>
        <div>
            <img src="images/cars/<?=$carID?>.jpg" alt="">
        </div>
    </div>
    
    

<?php 
    include("include/footer.php");
?>
