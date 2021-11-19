<?php

/* This is a file exist to check thru methods if postID and userID are saved or not till tabel Save in database */ 

include("classes/Save.class.php");
include("classes/Posts.class.php");

include("config.php");


//adding
if(isset($_GET['save'])) {
    $postID = $_GET['save'];
    $userID = $_SESSION['userID'];

    $hejsan = new Save();

    $hejsan->savePost($postID, $userID);

    header("Location: ../postSolo.php?postID=$postID");
} elseif(isset($_GET['remove'])) {
    $postID = $_GET['remove'];
    $userID = $_SESSION['userID'];

    $hejsan = new Save();

    $hejsan->removeSaved($postID, $userID);

    header("Location: ../postSolo.php?postID=$postID");
} else {
    header("Location: ../index.php?message=Oj, hoppsan, något gick riktigt knasigt till nu, försök igen");
}

