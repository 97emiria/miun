<?php

//Anslut till databas
//$db = new mysqli('localhost', 'momentfyra', 'password', 'momentfyra');
$db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');
//$db = new mysqli( 'gsdmlmir_newsDB', 'FJX?gKRA*oQk', 'gsdmlmir_newsDB')

if($db->connect_errno > 0){
    die('Fel vid anslutning [' . $db->connect_error . ']');
} 


//Skapa tabell
$sql = "DROP TABLE IF EXISTS users;
    CREATE TABLE users (
    userID int(11) AUTO_INCREMENT PRIMARY KEY,
    type INT(2) NOT NULL, 
    email VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    firstname VARCHAR(32) NOT NULL,
    lastname VARCHAR(32) NOT NULL, 
    profileImg VARCHAR(26) NOT NULL,
    registration_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);";

//Skicka SQL-frågan till DB 
if($db->multi_query($sql)) {
    echo "Tabell installerad.";
    echo "<pre> $sql </pre>";
} else {
    echo "Fel vid installation av Tabell.";
} 