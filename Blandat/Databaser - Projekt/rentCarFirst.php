<?php 
    $pageTitle = "Startsida";
    include("include/header.php");
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

<main> 


    <h1>Rent a Car - Customer</h1>
   
    <div id="existing">

        <?php

            //Check if customer already exist 
            if(isset($_GET['userTest'])) {
                
                $userTest= $_GET['userTest'];
                $customers = new Customers();

                if($customers->emailExists($userTest)) {

                    $hideForm = "style='display: none;'";
                    
                    $customersInfo = $customers->getCustomerByEmailOrPhone($userTest);

                    foreach ($customersInfo as $info) {
                        $userFname = $info['fname'];
                        $userLname = $info['lname'];
                        $userEmail = $info['email'];
                        $userPhone = $info['phone'];
                        $userAddress = $info['address'];
                        $userZip = $info['zip'];
                        $userCity = $info['city'];
                        $userEmail = $info['email'];
                        $customerID = $info['customerID'];

                    } 
            ?>
<table>
                <tr>
                    <th>Customer Info</th>
                </tr>
                <tr>
                    <td>Name: </td>
                    <td><?= $userFname . " " . $userLname ?> </td>
                </tr>
                <tr>
                    <td>Phone: </td>
                    <td><?= $userPhone ?> </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><?= $userEmail ?> </td>
                </tr>
                <tr>
                    <td>CustomerID: </td>
                    <td><?= $customerID ?> </td>
                </tr>
            </table>

        

                    <button class="btnWhite" onclick="window.location.href='rentCarFirst.php'">Ändra</button>
                    <button class="btnGray" onclick="window.location.href='rentCarSecond.php?chosenCustomer=<?=$customerID?>'">Boka åt denne kund</button>

            <?php        
                } else {

                    echo "<p class='error'> There is no customer with that email or phone number </p> <br> <br>";
                }
            }

            ?>


        <form <?=$hideForm?> >

            <label for="userTest"> Customers e-mail address or Phone number</label>
            <input type="text" id="userTest" name="userTest" placeholder="E-mail address or phone number">

            <input type="submit" value="Check for customer">

        </form>


</main>


<?php 
    include("include/footer.php");
?>
