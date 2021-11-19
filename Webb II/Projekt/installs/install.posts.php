<?php

//Anslut till databas
//$db = new mysqli('localhost', 'momentfyra', 'password', 'momentfyra');
$db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');

if($db->connect_errno > 0){
    die('Fel vid anslutning [' . $db->connect_error . ']');
} 


//Skapa tabell
$sql = "DROP TABLE IF EXISTS posts;
    CREATE TABLE posts (
    postID int(11) PRIMARY KEY AUTO_INCREMENT,
    userID int(11),
    writer VARCHAR(32) NOT NULL,
    title VARCHAR(64) NOT NULL,
    content VARCHAR(3200), 
    img VARCHAR(64),
    imgText VARCHAR(64),
    postdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);";

//Skicka SQL-frågan till DB 
if($db->multi_query($sql)) {
    echo "Tabell installerad.";
    echo "<pre> $sql </pre>";
} else {
    echo "Fel vid installation av Tabell.";
} 
