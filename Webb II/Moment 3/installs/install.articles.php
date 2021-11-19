<?php

/* Anslut med nytt konto för varor */
//$db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');
$db = new mysqli("localhost", "newsDB", "password", "newsDB");

if($db->connect_errno > 0){
    die('Fel vid anslutning [' . $db->connect_error . ']');
} 



/* SQL-fråga för att skapa tabell */
$sql = "DROP TABLE IF EXISTS articles;
    CREATE TABLE articles(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(128) NOT NULL,
    content VARCHAR(5000) NOT NULL,
    img VARCHAR(128),
    imgText VARCHAR(128) NOT NULL,
    author VARCHAR(128) NOT NULL,
    postdate timestamp NOT NULL DEFAULT current_timestamp()
);";

/* Skicka SQL-frågan till DB */
if($db->multi_query($sql)) {
    echo "Tabell installerad.";
    echo "<pre> $sql </pre>";
} else {
    echo "Fel vid installation av Tabell.";
}




