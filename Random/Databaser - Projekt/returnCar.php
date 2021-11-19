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

        $hideForm = "";

    ?> 

    <h1>Return car</h1>

    <?php

            if(isset($_POST['lookFor'])) {
                $lookFor = $_POST['lookFor'];
                

                    $rented = new Rented();
                    $rentInfo = $rented->getRentCarByID($lookFor);

                    if(mysqli_num_rows($rentInfo) == 0 ) {

                        echo "<p class='error'> There is no receipt with that number </p>";

                    } else {
                        $hideForm = "style='display: none;'";

                        foreach ($rentInfo as $rentInfo) {
                            $rentID = $rentInfo['rentID'];
                            $customerID = $rentInfo['customerID'];
                            $carID = $rentInfo['carID'];

                            $rentStoreTo = $rentInfo['storeTo'];
                            $rentDateTo = $rentInfo['dateTo'];

                            $rentActive = $rentInfo['active'];
                            if ($rentActive == 1) {
                                $rentActive = "Rented out";
                            } else {
                                $rentActive = "Already returned";
                            }

                            $customer = new Customers();
                            $resultCustomer = $customer->getCustomerByID($customerID);

                            foreach ($resultCustomer as $resultCustomer) {
                                $customerName = $resultCustomer['fname'] . " " . $resultCustomer['lname'];
                                $customerPhone = $resultCustomer['phone'];
                            }

                            $cars = new Cars();
                            $resultCar = $cars->getCarByID($carID);

                            foreach ($resultCar as $resultCar) {
                                $carName = $resultCar['name'];
                                $carModel = $resultCar['model'];
                                $carColor = $resultCar['color'];
                            }
                        }
    ?>
             
            <table>
                <tr>
                    <th>Customer Info</th>
                </tr>
                <tr>
                    <td>Name: </td>
                    <td><?= $customerName ?> </td>
                </tr>
                <tr>
                    <td>Phone: </td>
                    <td><?= $customerPhone ?> </td>
                </tr>
            </table>

            <table>
                <tr>
                    <th> Rental info</th>
                </tr>
                <tr>
                    <td>Store runt car to: </td>
                    <td><?= $rentStoreTo ?> </td>
                </tr>
                <tr>
                    <td>Date to return on: </td>
                    <td
                        <?php
                            $todaysDate = date('Y-m-d');
                            if($todaysDate > $rentDateTo) {
                                echo "class='red'";
                            }
                        ?>
                    ><?= $rentDateTo ?> </td> 
                </tr>
            </table>


            <div class="flexBox">
                <div>
                    <table>
                        <tr>
                            <th>Car info</th>
                        </tr>
                        <tr>
                            <td>Name: </td>
                            <td><?= $carName ?> </td>
                        </tr>
                        <tr>
                            <td>Model: </td>
                            <td><?= $carModel ?> </td>
                        </tr>
                        <tr>
                            <td>Color: </td>
                            <td><?= $carColor ?> </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <img src="images/cars/<?=$carID?>.jpg" alt="">
                </div>
            </div>

         <br>
         <br>
         <br>
            <button class="btnWhite" onclick="window.location.href='returnCar.php?'">Go back</button>
            <button class="btnGray" onclick="window.location.href='returnCarMiddle.php?rentID=<?=$rentID?>&carID=<?=$carID?>'">Return Car</button>
           
    <?php 
                   }

                }
    ?>

    <form method="POST" action="" <?=$hideForm?>>

        <label for="lookFor"> Enter the receipt number  </label>
        <input type="text" id="lookFor" name="lookFor" placeholder="Receipt number" >

        <input type="submit" value="Look for rent info">

    </form>

<?php 
    include("include/footer.php");
?>
