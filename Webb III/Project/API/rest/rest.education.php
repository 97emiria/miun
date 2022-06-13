<?php

//Connect databse and get class
include('../config.php');
$education = new Education();


header('Access-Control-Allow-Origin: *');                                           //Går endats nå från domänen
header('Content-Type: application/json');                                           //Talar om att webbtjänsten skickar data i JSON-format
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');                     //Vilka metoder som webbtjänsten accepterar, som standard tillåts bara GET.
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');//Vilka headers som är tillåtna vid anrop från klient-sidan, kan bli problem med CORS (Cross-Origin Resource Sharing) utan denna.


$method = $_SERVER['REQUEST_METHOD'];//Läser in vilken metod som skickats och lagrar i en variabel


//Collect user email
if(isset($_GET['educationID'])) {
    $educationID = $_GET['educationID'];
}

switch($method) {
    case 'GET':
        http_response_code(200);

        if(isset($educationID)) {
            $response = $education->getEducationByID($educationID);

            if(count($response) == 0) {
                $response = array("message" => "Finns inget att hämta med det IDt");
            }
        } else {
            $response = $education->getEducationList();

            if(count($response) == 0) {
                $response = array("message" => "Finns inget att hämta");
            }
        }

        break;

    case 'POST':
        //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
        $data = json_decode(file_get_contents("php://input"));

        if( !$education->setTitle($data->title) || 
            !$education->setSchool($data->school) ||
            !$education->setSemester($data->semester) ||
            !$education->setDate($data->date) ||
            !$education->setStatus($data->status) ||
            !$education->setComment($data->comment)
            
        ) {
            http_response_code(400); //User error
            $response = array("message" => "Uppfyller inte kraven");

        } else {
            
            if($education->existTitleAndSchool($data->title, $data->school)) {
                http_response_code(400); //User error
                $response = array("message" => "Hallå där, skulle du ha läst samma kurs två gånger??");

            } else {

                if($education->addEducation($data->title, $data->school, $data->semester, $data->date, $data->status, $data->comment) ){
                    $response = array("message" => "$data->title är tillagd");
                    http_response_code(201); //Created
                } else {
                    $response = array("message" => "Något gick snett");
                    http_response_code(500); //Server error
                }

            }
            
        }


        break;

    case 'PUT':
        //Get data
        $data = json_decode(file_get_contents("php://input"));

        if( !$education->setTitle($data->title) 
            
        ) {
            http_response_code(400); //User error
            $response = array("message" => "Uppfyller inte kraven");

        } else {
                       
            if($education->editEducation($educationID, $data->title, $data->school, $data->semester, $data->date, $data->status, $data->comment) ){
                $response = array("message" => "$data->title är uppdaterad");
                http_response_code(201); //Created

            } else {
                $response = array("message" => "Ajdå, gick inte att lägga till i databasen");
                http_response_code(500); //Server error
            }
            
        }
       


        break;


    case 'DELETE':

         //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
         $data = json_decode(file_get_contents("php://input"));

        //Check if id exist in url
        if(!isset($educationID)) {
            http_response_code(400); //User error
            $response = array("message" => "No course code id found ");  
        
        } else {

            //Check if id exist in database
            if($education->existEducationID($educationID)) {
                http_response_code(200);
                $education->deleteEducation($educationID);
                $response = array("message" => "Deletes course succes, $data->title");

            } else {
                http_response_code(500); //User error
                $response = array("message" => "Selected education id dont exist");
            }

        }

        break;
        
}

//Skickar svar tillbaka till avsändaren
echo json_encode($response);