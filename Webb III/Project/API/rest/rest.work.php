<?php

//Connect databse and get class
include('../config.php');
$work = new Work();

header('Access-Control-Allow-Origin: *');                                           //Går endats nå från domänen
header('Content-Type: application/json');                                           //Talar om att webbtjänsten skickar data i JSON-format
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');                     //Vilka metoder som webbtjänsten accepterar, som standard tillåts bara GET.
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');//Vilka headers som är tillåtna vid anrop från klient-sidan, kan bli problem med CORS (Cross-Origin Resource Sharing) utan denna.

$method = $_SERVER['REQUEST_METHOD'];//Läser in vilken metod som skickats och lagrar i en variabel


//Collect user email
if(isset($_GET['workID'])) {
    $workID = $_GET['workID'];
}

switch($method) {
    case 'GET':

        http_response_code(200);

        if(isset($workID)) {
            $response = $work->getWorksByID($workID);


        } else {
            $response = $work->getWorks();

            if(count($response) == 0) {
                $response = array("message" => "Finns inget att hämta");
            }
        }

        

        break;
    case 'POST':
        //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
        $data = json_decode(file_get_contents("php://input"));
        
        if(!$work->setTitle($data->title) || 
            !$work->setWorkplace($data->workplace) ||
            !$work->setDate($data->date) ||
            !$work->setComment($data->comment)
            
        ) {
            http_response_code(400); //User error
            $response = array("message" => "Uppfyller inte kraven");

        } else {

            if($work->addWork($data->title, $data->workplace, $data->date, $data->comment)){
                $response = array("message" => "$data->title är tillagd");
                http_response_code(201); //Created
            } else {
                $response = array("message" => "Upps, något gått fel");
                http_response_code(500); //Server error
            }
            
        }


            break;
    case 'PUT':
        //Get data
        $data = json_decode(file_get_contents("php://input"));

        
        if(!$work->setTitle($data->title) || 
            !$work->setWorkplace($data->workplace) ||
            !$work->setDate($data->date) ||
            !$work->setComment($data->comment)
            
            ) {
                http_response_code(400); //User error
                $response = array("message" => "Uppfyller inte kraven");

        } else {

            if($work->editWork($workID, $data->title, $data->workplace, $data->date, $data->comment)){
                $response = array("message" => "$data->title är nu uppdaterad");
                http_response_code(201); //Created
            } else {
                $response = array("message" => "Opps, något gått fel");
                http_response_code(500); //Server error
            }
            
            
        }

        break;


    case 'DELETE':
       
        $data = json_decode(file_get_contents("php://input"));


        if(!isset($workID)) {
            http_response_code(400);
            $response = array("message" => "No course code is sent");  
        } else {

            //Check if id exist in database
            if($work->existWorkID($workID)) {

                http_response_code(200);
                $work->deleteWork($workID);
                $response = array("message" => "Raderade arbetserfarenheten $data->title");

            } else {
                http_response_code(500); //User error
                $response = array("message" => "Selected work id dont exist");
            }

        }



        break;
        
}

//Skickar svar tillbaka till avsändaren
echo json_encode($response);