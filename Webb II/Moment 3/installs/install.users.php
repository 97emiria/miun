<?php

//Anslut med nytt konto för varor 
//$db = new mysqli("localhost", "newsDB", "password", "newsDB");
$db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');

if($db->connect_errno > 0){
    die('Fel vid anslutning [' . $db->connect_error . ']');
} 

//SQL-fråga för att skapa tabell 
$sql = "DROP TABLE IF EXISTS users;
    CREATE TABLE users(
    type INT(2) NOT NULL, 
    username VARCHAR(32) PRIMARY KEY NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    firstname VARCHAR(32) NOT NULL,
    lastname VARCHAR(32) NOT NULL, 
    email VARCHAR(32) NOT NULL UNIQUE,
    profileImg VARCHAR(26) NOT NULL,
    registration_date timestamp NOT NULL DEFAULT current_timestamp()
);";

//Skicka SQL-frågan till DB 
if($db->multi_query($sql)) {
    echo "Tabell installerad.";
    echo "<pre> $sql </pre>";
} else {
    echo "Fel vid installation av Tabell.";
} 