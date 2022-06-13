<?php

//Connect databse and get class
include('../config.php');
$text = new Texts();

header('Access-Control-Allow-Origin: *');              //Går endats nå från domänen
header('Content-Type: application/json');                               //Talar om att webbtjänsten skickar data i JSON-format
header('Access-Control-Allow-Methods: GET, PUT, POST');                      //Vilka metoder som webbtjänsten accepterar, som standard tillåts bara GET.
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');//Vilka headers som är tillåtna vid anrop från klient-sidan, kan bli problem med CORS (Cross-Origin Resource Sharing) utan denna.


//Läser in vilken metod som skickats och lagrar i en variabel
$method = $_SERVER['REQUEST_METHOD'];

//Collect user email
if(isset($_GET['textID'])) {
    $textID = $_GET['textID'];
}

switch($method) {
    case 'GET':
        
        http_response_code(200);
        
        if(isset($textID)) {
            $response = $text->getTextByID($textID);

            if(count($response) == 0) {
                //Lagrar ett meddelande som sedan skickas tillbaka till anroparen
                http_response_code(200); //Created
                $response = array("message" => "Gick att hämta");
            }

        //Om det inte finns någon specifik id i url 
        } else {
            $response = $text->getAllTexts();

            if(count($response) == 0) {
                //Lagrar ett meddelande som sedan skickas tillbaka till anroparen
                http_response_code(500); 
                $response = array("message" => "Fanns inget att hämta");
            }

        }
        
        break;

    case 'POST':

        if(isset($_FILES['image'])) {
    
            //Collect values
            $theText = $_POST['theText'];
            $textID = $_POST['textID'];
            $title = $_POST['title'];

            if($text->setTextLength($theText)) {

                //Ger filen ett nytt och unikt namn
                $randomNumber = rand(100000000, 10000000000);
                $type = substr($_FILES['image']['type'], 6, 4);
                $imgName = $randomNumber . "." . $type;
                $imgPath = pathUrlImg . $imgName;

                 //Remove image
                 $result = $text->getImage($textID);
                 foreach($result as $row) {
                     $oldImage = $row['imgName'];
                    unlink("../uploads/" . $oldImage); 
                 }

                if($text->editTextWithImg($textID, $theText, $imgPath, $imgName)){
                    
                    //Put new image in folder
                    move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $imgName);

                    $response = array("message" => "$title uppdaterad och bilden är tillagd i mappen");
                    http_response_code(201); //Created
                    
                } else {
                    $response = array("message" => "Oh no, server fel");
                    http_response_code(500); //Server error
                }

            }
            
        }


        break;
    case 'PUT':

        //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
        $data = json_decode(file_get_contents("php://input"));

        if($text->setTextLength($data->theText)) {

            if($text->editText($textID, $data->theText)){
                $response = array("message" => "$data->title uppdaterad");
                http_response_code(201); //Created
                
            } else {
                $response = array("message" => "Oh no, server fel");
                http_response_code(500); //Server error
            }

        }

        break;           
}

//Skickar svar tillbaka till avsändaren
echo json_encode($response);