<?php
include('../config.php');

//Connection and check errors
$db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
if($db->connect_errno > 0){
    die('<br> Connection error [' . $db->connect_error . ']');
} 

//Creat tabell
$sql = "DROP TABLE IF EXISTS webbpages;
    CREATE TABLE webbpages (
    webbpageID int(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(32) NOT NULL,
    link VARCHAR(64) NOT NULL,
    description VARCHAR(2500) NOT NULL,
    imgPath VARCHAR(128) NOT NULL,
    imgName VARCHAR(128) NOT NULL,
    updated VARCHAR(64) NOT NULL,
    timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);";

$sql .= "
            INSERT INTO webbpages(title, link, description, imgPath, imgName, updated) VALUES('Test ett', 'www.linkett.se', 'kommentaren', 'www.filväfg.se', '4631563.jpg', CURRENT_TIMESTAMP());    
            INSERT INTO webbpages(title, link, description, imgPath, imgName, updated) VALUES('Test two', 'www.linktwo.se', 'kommentaren', 'www.filväfg.se', '4631563.jpg', CURRENT_TIMESTAMP());    
            INSERT INTO webbpages(title, link, description, imgPath, imgName, updated) VALUES('Test tre', 'www.linktre.se', 'kommentaren', 'www.filväfg.se', '4631563.jpg', CURRENT_TIMESTAMP());    
    ";



//Send sql request to create tabell in database and get response
if($db->multi_query($sql)) {
    echo "Sucess creating table with data";

    //Print out what u doing
    echo "<pre> $sql </pre>";

} else {
    echo "Error creating table with data";
}




