<?php 

//Sign out users. Made March 2021 of Emilia Holmstörm


session_start();
session_unset();
session_destroy();

header("Location: index.php");
exit();