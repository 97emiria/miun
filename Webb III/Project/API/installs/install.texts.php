<?php
include('../config.php');

//Connection and check errors
$db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
if($db->connect_errno > 0){
    die('<br> Connection error [' . $db->connect_error . ']');
} 

//Creat tabell
$sql = "DROP TABLE IF EXISTS texts;
    CREATE TABLE texts (
    textID int(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(32) NOT NULL,
    theText VARCHAR(2500) NOT NULL,
    imgPath VARCHAR(128) NOT NULL,
    imgName VARCHAR(128) NOT NULL,
    updated VARCHAR(32) NOT NULL,
    timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);";

$sql .= "
    INSERT INTO texts(title, theText, imgPath, imgName, updated) VALUES('About', 'Löksås ipsum dag upprätthållande helt vid rännil plats, är bra dimmhöljd och bäckasiner sista, som sjö av om plats sjö. Hwila sitt det träutensilierna sig och bäckasiner dock samtidigt varit olika, denna tidigare i inom strand miljoner åker hans nu, det lax tiden upprätthållande dimma vi där göras när. Ännu kanske flera oss blivit inom stora sitt groda på bland från där av, brunsås omfångsrik åker söka blev vi inom del varit nya år rännil.', 'empty', 'empty', CURRENT_TIMESTAMP() );
    INSERT INTO texts(title, theText, imgPath, imgName, updated) VALUES('Index', 'Välkommen till min portfoliosida', 'empty',' empty', CURRENT_TIMESTAMP() );
    INSERT INTO texts(title, theText, imgPath, imgName, updated) VALUES('Education', 'Läser en utbildning hos Mittuniversitet, högskoleexamen våren 2022. Nedan finns en lista på avslutade och kommande/pågående kurser som ingår i programmet. Därefter finns en lista på kurser som jag läst innan utbildning hos mitt universitet', 'empty',' empty', CURRENT_TIMESTAMP() );
    
    INSERT INTO texts(title, theText, imgPath, imgName, updated) VALUES('Mobile', '076321321', 'empty',' empty', CURRENT_TIMESTAMP() );
    INSERT INTO texts(title, theText, imgPath, imgName, updated) VALUES('Mail', 'hi@emiria.se', 'empty',' empty', CURRENT_TIMESTAMP() );
    INSERT INTO texts(title, theText, imgPath, imgName, updated) VALUES('Github', '97emiria', 'empty',' empty', CURRENT_TIMESTAMP() );
    
    ";



//Send sql request to create tabell in database and get response
if($db->multi_query($sql)) {
    echo "Sucess creating table with data";

    //Print out what u doing
    echo "<pre> $sql </pre>";
    
} else {
    echo "Error creating table with data";
}




