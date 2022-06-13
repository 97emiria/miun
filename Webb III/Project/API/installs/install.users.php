<?php
include('../config.php');

//Connection and check errors
$db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
if($db->connect_errno > 0){
    die('<br> Connection error [' . $db->connect_error . ']');
} 

//Creat tabell
$sql = "DROP TABLE IF EXISTS users;
    CREATE TABLE users (
    userID int(11) AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(32) NOT NULL,
    updated VARCHAR(32) NOT NULL,
    timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);";

$sql .= "
    INSERT INTO users(email, password, name, updated) VALUES('privat@emiria.se', 'passwordet', 'Emilia', CURRENT_TIMESTAMP());
    INSERT INTO users(email, password, name, updated) VALUES('admin@emiria.se', 'passwordet', 'Admin', CURRENT_TIMESTAMP());
    ";


    
//Send sql request to create tabell in database and get response
if($db->multi_query($sql)) {
    echo "Sucess creating table with data";

    //Print out what u doing
    echo "<pre> $sql </pre>";
    
} else {
    echo "Error creating table with data";
}




