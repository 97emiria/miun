<?php
include('../config.php');

//Connection and check errors
$db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
if($db->connect_errno > 0){
    die('<br> Connection error [' . $db->connect_error . ']');
} 

//Creat tabell
$sql = "DROP TABLE IF EXISTS education;
    CREATE TABLE education (
    educationID int(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(64) NOT NULL UNIQUE,
    school VARCHAR(128) NOT NULL,
    semester VARCHAR(2) NOT NULL,
    date VARCHAR(32) NOT NULL,
    status INT(1) NOT NULL,
    comment VARCHAR(100) NOT NULL,
    updated VARCHAR(32) NOT NULL,
    timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);";

$sql .= "
    INSERT INTO education(title, school, semester, date, status, comment, updated) VALUES('Webbutveckling I',     'Mittuniversitetet',    'HT',    '2020', '1', 'Grunderna i HTML och CSS', CURRENT_TIMESTAMP() );
    INSERT INTO education(title, school, semester, date, status, comment, updated) VALUES('Webbutveckling II',    'Mittuniversitetet',    'VT',    '2021', '1', 'Grunderna i PHP och databaser', CURRENT_TIMESTAMP() );
    INSERT INTO education(title, school, semester, date, status, comment, updated) VALUES('Webbutveckling III',   'Mittuniversitetet',    'HT',    '2021', '0', 'Git, gulp, sass, typescript/ecmascript, rest/api', CURRENT_TIMESTAMP() );
    INSERT INTO education(title, school, semester, date, status, comment, updated) VALUES('Webbutveckling',       'Luleå',                'VT',    '2021', '1', 'Git, gulp, sass, typescript/ecmascript, rest/api', CURRENT_TIMESTAMP() );
    
    INSERT INTO education(title, school, semester, date, status, comment, updated) VALUES('Typografi',            'Mittuniversitetet', 'HT', '2020', '1', 'Detta är en kommentar om kursen!', CURRENT_TIMESTAMP() );
    INSERT INTO education(title, school, semester, date, status, comment, updated) VALUES('C#',                   'Mittuniversitetet', 'HT', '2021', '0', 'Detta är en kommentar om kursen!', CURRENT_TIMESTAMP() );
    INSERT INTO education(title, school, semester, date, status, comment, updated) VALUES('JavaScript-baserad',   'Mittuniversitetet', 'HT', '2021', '1', 'Detta är en kommentar om kursen!', CURRENT_TIMESTAMP() );
    
    
    ";



//Send sql request to create tabell in database and get response
if($db->multi_query($sql)) {
    echo "Sucess creating table with data";

    //Print out what u doing
    echo "<pre> $sql </pre>";
    
} else {
    echo "Error creating table with data";
}

