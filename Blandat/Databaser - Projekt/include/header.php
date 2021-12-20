<?php 
    include_once("include/config.php"); 
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                
    <title> <?php echo "&bull; " . $pageTitle . " &bull;" ?> </title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="images/x-icon" href="images/logo.png">

</head>

<body>
<header>

    <img src="../images/logo.png" alt="">


        <?php if(isset($_SESSION['employeeID'])) { ?>
        <ul>
            <li> <a href="index.php">Home</a> </li>
            <li> <a href="statusCar.php">Cars</a> </li>
            <li> <a href="statusStore.php">Stores</a> </li>
            <li><a href="rentCarFirst.php">Rent</a></li>
            <li><a href="returnCar.php">Return</a></li>
            <li> <a href="logout.php">Log out</a> </li>

        </ul>
        <?php } else { ?>

            <ul>
                <li> <a href="login.php">Logga in</a> </li>
            </ul>
        <?php } ?>

</header>

<div class="frameBox">
