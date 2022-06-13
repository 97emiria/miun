<?php
include('../config.php');

//Connection and check errors
$db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
if($db->connect_errno > 0){
    die('<br> Connection error [' . $db->connect_error . ']');
} 

//Creat tabell
$sql = "DROP TABLE IF EXISTS work;
    CREATE TABLE work (
    workID int(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(64) NOT NULL,
    workplace VARCHAR(64) NOT NULL,
    date VARCHAR(32) NOT NULL,
    comment VARCHAR(1000) NOT NULL,
    updated VARCHAR(32) NOT NULL,
    timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);";

$sql .= "
    INSERT INTO work(title, workplace, date, comment, updated) VALUES('Servitris', 'SmörgåsKöket', 'sommrarna 2014-2015', 'Ett jobb som kräver effektivitet, självständig och stresstålig. Att hitta balansen mellan självständighet och teamwork är och a och o.', CURRENT_TIMESTAMP());
    INSERT INTO work(title, workplace, date, comment, updated) VALUES('Lärarvikarie, elevassistent och fritidsledare', 'Södra skolan, Åmåls kommun', '2016-2021', 'Att jobba inom skolan kräver att man tar initiativ och är problemlösare där snabba beslut krävs och kunna prioritera. Ett ansvarsfullt jobb där man måste kunna jobba både självständighet men samtidigt vara bra lagspelare.', CURRENT_TIMESTAMP());
    INSERT INTO work(title, workplace, date, comment, updated) VALUES('Köksassistent & Servitris', 'Torgboden', '-2015', 'För att hålla bästa servicen måste man hålla ett högt tempo samtidigt som man behåller sitt lugn och kunna prioritera. Samarbeta är också viktigt men att vara självgående och se vad som behövs göras är minst lika viktigt.', CURRENT_TIMESTAMP());
    ";


//Send sql request to create tabell in database and get response
if($db->multi_query($sql)) {
    echo "Sucess creating table with data";

    //Print out what u doing
    echo "<pre> $sql </pre>";
    
} else {
    echo "Error creating table with data";
}




