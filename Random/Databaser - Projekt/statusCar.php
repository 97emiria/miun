<?php 
    $pageTitle = "Startsida";
    include("include/header.php");
    include("include/classes/Cars.class.php");
    include("include/classes/Stores.class.php");
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

        $carName = "";

    ?> 

<main> 


    <h1>Check a car status</h1>

    <form method="GET">
        
        <datalist id="carsList">

        <?php

            $cars = new Cars();
            $result = $cars->getCars();
            foreach ($result as $row) {
                $carName = $row['name'];
                $carModel = $row['model'];
                $carID = $row['carID'];

                echo "<option value='$carID'> $carName $carModel </option>";
            }
        ?>
        </datalist>

        <label for="chosenCar"> Write a carID or search for a car </label>
        <input type="text" id="chosenCar" name="chosenCar" placeholder="rr-2355 or Kia rio" list="carsList">


        <input type="submit" value="Check Status">
    </form>


<br>
<br>
<br>

        <?php
            
            if(isset($_GET['chosenCar'])) {

                $cars = New Cars();

                $carID = $_GET['chosenCar'];

                $result = $cars->getCarByID($carID);

                foreach($result as $row) { 
                    $carName = $row['name']; 
                    $color = $row['color']; 
                    $status = $row['status']; 
                    $price = $row['price']; 
                    $model = $row['model']; 
                    $storeID = $row['store'];
                }


                $storeInfo = New Stores();
                $resultStore = $storeInfo->getStoreByID($storeID);

                foreach($resultStore as $rowStore) { 
                    $storeName = $rowStore['name'];
                }

                    ?>
                    <h2><?=$carName . " " . $model?></h2>
 
                    <table>
                        <tr>
                            <th>Car info</th>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?=$carName?></td>
                        </tr>
                        <tr>
                            <td>Model</td>
                            <td><?=$model?></td>
                        </tr>
                        <tr>
                            <td>Color</td>
                            <td><?=$color?></td>
                        </tr>
                        <tr>
                            <th>Info</th>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><?=$price?>	&euro; / day</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <?php
                                    if ($status == 1) {
                                        echo "Available";
                                    } elseif ($status == 2) {
                                        echo "Rent out";
                                    }
                                ?>
                            </td>
                            <tr>
                            <td>Current store</td>
                            <td><?=$storeName?>	</td>
                        </tr>
                        </tr>
                    </table>

                    <img class="carCheck" src="images/cars/<?=$carID?>.jpg" alt="">
        <?php } ?>

</main>


<?php 
    include("include/footer.php");
?>
