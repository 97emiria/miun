<?php

$devMode = false;

if($devMode) {
    //Display error messages
    error_reporting(-1);
    ini_set('display_errors', 1);
    //error_reporting(E_ALL);
}

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});


//Database
if($devMode == true) {
    //Local
    define("DBHOST", 'localhost');
    define("DBUSER", 'portfolio');
    define("DBPASSWORD", 'password');
    define("DBDATABASE", 'portfolio');

    define("pathUrlImg", 'http://localhost/Portfolio/API/uploads/');

} else if($devMode == false) {
    //emiria.se
    define("DBHOST", 'emiria.se.mysql');
    define("DBUSER", 'emiria_semain');
    define("DBPASSWORD", 'r6bOroiMJaF8KnJfThh4ppwzh');
    define("DBDATABASE", 'emiria_semain');  

    define("pathUrlImg", 'https://emiria.se/admin/API/uploads/');

} 


