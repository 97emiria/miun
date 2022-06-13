<?php

include('../config.php');
$user = new Users();

header('Access-Control-Allow-Origin: *');              //Går endats nå från domänen
header('Content-Type: application/json');                               //Talar om att webbtjänsten skickar data i JSON-format
header('Access-Control-Allow-Methods: GET, PUT');                      //Vilka metoder som webbtjänsten accepterar, som standard tillåts bara GET.
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');//Vilka headers som är tillåtna vid anrop från klient-sidan, kan bli problem med CORS (Cross-Origin Resource Sharing) utan denna.


$method = $_SERVER['REQUEST_METHOD'];//Läser in vilken metod som skickats och lagrar i en variabel


//Collect user email
if(isset($_GET['email'])) {
    $email = $_GET['email'];
}
if(isset($_GET['password'])) {
    $password = $_GET['password'];
}

switch($method) {
    case 'GET':
           
            //Kollar om eposten finns i databasen
            if($user->emailExists($email)) {

                //Kollar om e-postadressen och angivna lösenordet finns i databasen
                if($user->logIn($email, $password)) {
                    
                    http_response_code(200); 
                    $response = $user->getUserInfo($email);

                //Om det inte macthar
                } else {
                    http_response_code(400); //User error
                    $response = array("message" => "Password incorrect");
                }

            //Om det inte finns någon sådan e-postadress i databasen
            } else {
                http_response_code(400); //User error
                $response = array("message" => "Email incorrect");
            }

        break;
    case 'PUT':
        //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
        $data = json_decode(file_get_contents("php://input"));
     
        if(!$user->emailExists($data->email)) {
            http_response_code(400);
            $response = array("message" => "E-postadressen existerar inte");

        } else if (!$user->setPassword($data->password)) {
            http_response_code(400);
            $response = array("message" => "Lösenordet uppfyller inte kraven");

        } else {

            if($user->updatePassword($data->email, $data->password)) {
                http_response_code(200);
                $response = array("message" => "Godkänt");
            } else {
                http_response_code(500);
                $response = array("message" => "Något gick fel");
            }
   
        }
        
        break;
    
}

//Skickar svar tillbaka till avsändaren
echo json_encode($response);