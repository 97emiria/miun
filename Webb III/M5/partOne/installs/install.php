<?php
include('../include/config.php');

//Connection and check errors
$this->db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
if($this->db->connect_errno > 0){
    die('<br> Connection error [' . $this->db->connect_error . ']');
} 

//Creat tabell
$sql = "DROP TABLE IF EXISTS courses;
    CREATE TABLE courses(
    code VARCHAR(11) PRIMARY KEY,
    name VARCHAR(128) NOT NULL,
    progression VARCHAR(5000) NOT NULL,
    syllabus VARCHAR(5000) NOT NULL,
    postdate timestamp NOT NULL DEFAULT current_timestamp()
);";

$sql .= "
    INSERT INTO courses(code, name, progression, syllabus) VALUES('DT057G', 'Webbutveckling I', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22782');
    INSERT INTO courses(code, name, progression, syllabus) VALUES('DT093G', 'Webbutveckling II', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=27133');
    INSERT INTO courses(code, name, progression, syllabus) VALUES('DT173G', 'Webbutveckling III', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22706');
    ";


//Print out what u doing
echo "<pre> $sql </pre>";

//Send sql request to create tabell in database and get response
if($db->multi_query($sql)) {
    echo "Sucess creating table with data";
} else {
    echo "Error creating table with data";
}




