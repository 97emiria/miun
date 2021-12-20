<?php 
    $pageTitle = "Startsida";
    include("include/header.php");
    include("include/classes/Stores.class.php");
    include("include/classes/Cars.class.php");
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
    ?> 

<main> 


    <h1>Stores</h1>


    <!-- Get stores list -->
    <form method="GET">
        
        <select name="storeChoice" id="storeChoice">
            <option selected disabled>Choose store here</option>

        <?php

            $store = new Stores();
            $result = $store->getStores();
            foreach ($result as $row) {
                $storeName = $row['name'];
                $storeID = $row['storeID'];

                echo "<option value='$storeID'> $storeName </option>";
            }
        ?>
        </select>

        <input type="submit" value="Check Status">
    </form>


    <!-- Print out chosen store info-->

    <?php
        if(isset($_GET['storeChoice'])) {
               
            $store = new Stores();
            $resultStore = $store->getStoreByID($_GET['storeChoice']);

            foreach ($resultStore as $rowStore) { 
                $storeName = $rowStore['name'];
                $storeAddress = $rowStore['address'];
                $storePhone = $rowStore['phone'];
                $storeCapacity = $rowStore['maxCapacity'];
            }
    ?>
            <table>
                <tr>
                    <th>Store info</th>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?=$storeName?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?=$storeAddress?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><?=$storePhone?></td>
                </tr>
            </table>

        <h2>Status for cars at the store</h2>
        <dl>
        <?php

            $cars = new Cars();
            $resultCarStatus = $cars->carAtStore($_GET['storeChoice']);

            if (mysqli_num_rows($resultCarStatus) > 0) {

                echo "<dt> Lediga </dt>";

                //Lediga bilar            
                foreach($resultCarStatus as $rowCars) { 
                    $carName = $rowCars['name'];
                    $carStatus = $rowCars['status'];
                    
                    if ($carStatus == 1) {
                        echo "<dd> $carName <dd>";
                    } 

                } 
                
                echo "<dt> Rented out </dt>";
                
                foreach($resultCarStatus as $rowCars) { 
                    $carName = $rowCars['name'];
                    $carStatus = $rowCars['status'];
                    
                    if ($carStatus == 2) {
                        echo "<dd> $carName <dd>";
                    }
                }
                
                echo "<dt> Cars on service </dt>";

                
                foreach($resultCarStatus as $rowCars) { 
                    $carName = $rowCars['name'];
                    $carStatus = $rowCars['status'];
                    
                    if ($carStatus == 0) {
                        echo "<dd> $carName <dd>";
                    } 
                }
            } else {
                echo "<dd> No cars at store </dd>";
            }
        } //Ending if-statement 

    ?>

    </dl>

</main>

<?php 
    include("include/footer.php");
?>
