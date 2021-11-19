<?php

//Anslut till databas
//$db = new mysqli('localhost', 'momentfyra', 'password', 'momentfyra');
$db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');

if($db->connect_errno > 0){
    die('Fel vid anslutning [' . $db->connect_error . ']');
} 


//Skapa tabell
$sql = "DROP TABLE IF EXISTS save;
    CREATE TABLE save (
    saveID int(11) PRIMARY KEY AUTO_INCREMENT,
    postID int(11) NOT NULL,
    userID int(11) NOT NULL,
    postdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);";

//Skicka SQL-frågan till DB 
if($db->multi_query($sql)) {
    echo "Tabell installerad.";
    echo "<pre> $sql </pre>";
} else {
    echo "Fel vid installation av Tabell.";
} 
