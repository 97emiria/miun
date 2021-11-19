<?php

$devMode = true;

if($devMode) {
    error_reporting(-1);
    ini_set('display_errors', 1);
}


//Dosent work
//Load in classes
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});


//Display error messages
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);


//Database
if($devMode) {
    //Local
    define("DBHOST", "localhost");
    define("DBUSER", "courses");
    define("DBPASS", "radikal");
    define("DBDATABASE", "courses");
} else {
    //Miun
    define("DBHOST", 'studentmysql.miun.se');
    define("DBUSER", 'emho2003');
    define("DBPASSWORD", 'b@@d5XVfZG');
    define("DBDATABASE", 'emho2003');
}
