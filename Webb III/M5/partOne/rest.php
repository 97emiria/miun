
<?php
/*Headers med inställningar för din REST webbtjänst*/
include('config.php');
$c = new Courses();

//Different needed headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//Läser in vilken metod som skickats och lagrar i en variabel
$method = $_SERVER['REQUEST_METHOD'];

//Om en parameter av id finns i urlen lagras det i en variabel
if(isset($_GET['code'])) {
    $code = $_GET['code'];
}


switch($method) {
    case 'GET':
        //Skickar en "HTTP response status code"
        http_response_code(200); //Ok - The request has succeeded

        //Ifall man söker på enskild kurs
        if(isset($code)) {
            $response = $c->getCourse($code);

            if(count($response) == 0) {
                //Lagrar ett meddelande som sedan skickas tillbaka till anroparen
                $response = array("message" => "Kursen finns inte");
            }

        //Om det inte finns någon specifik kurs 
        } else {
            $response = $c->getAllCourses();

            if(count($response) == 0) {
                //Lagrar ett meddelande som sedan skickas tillbaka till anroparen
                $response = array("message" => "Finns inga kurses ännu");
            }
    
        }

        break;
    case 'POST':
        //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
        $data = json_decode(file_get_contents("php://input"));
        

        if (!$c->setCode($data->code) ) {
            http_response_code(400); //User error
            $response = array('message' => "Error code");

        } elseif (!$c->setName($data->name)) {
            http_response_code(400); //User error
            $response = array('message' => "Error name");

        } elseif (!$c->setProgression($data->progression) ) {
            http_response_code(400); //User error
            $response = array('message' => "Error progression");

        } elseif (!$c->setSyllabus($data->syllabus)) {
            http_response_code(400); //User error
            $response = array('message' => "Error syllabus");

        } else {
            
            if($c->addCourse($data->code, $data->name, $data->progression, $data->syllabus)){
                $response = array("message" => "Created");
                http_response_code(201); //Created
            } else {
                $response = array("message" => "Failed");
                http_response_code(500); //Server error
            }

        }

        break;
    case 'PUT':


        //Om inget id är med skickat, skicka felmeddelande
        /* 
            Överst i rest-koden finns denna kodsnutt:
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            Den kollar om det finns ett id

            Så först kollar vi om det finns ett ID, annars skickar vi ett felmeddelande att inget id fanns
        */
        if(!isset($id)) {
            http_response_code(400); //Bad Request - The server could not understand the request due to invalid syntax.
            $response = array("message" => "No course id is sent");
        //Om id är skickad   

        } else {
            /*
                Om id finns så hämtar/lägger vi datan i variabeln data
            */
            $data = json_decode(file_get_contents("php://input"));

            /*
                Denna delen är heeelt frivillig, men att rekommendera sen till projektet. Det jag gör 
                annars är kolla om datan är okej för databasen, exemple att de inte går att lägga in 
                tomma värden. Jag använde mig av set-metoder i klassen (men helt frivilligt)
            */
            if (!$c->setCode($data->id) ) {
                http_response_code(400); //User error
                $response = array('message' => "Error code");
    
            } elseif (!$c->setName($data->name)) {
                http_response_code(400); //User error
                $response = array('message' => "Error name");
    
            } elseif (!$c->setProgression($data->progression) ) {
                http_response_code(400); //User error
                $response = array('message' => "Error progression");
    
            } elseif (!$c->setSyllabus($data->syllabus)) {
                http_response_code(400); //User error
                $response = array('message' => "Error syllabus");
    
            } else {
                /*
                    Om datan klarar if-satserna så lägger jag till det i databasen. 

                    Det görs genom en "instant" till klassen. Dvs så lägger vi klassen i en variable (så jag tänker i alla fall)
                    För min del ser det ut såhär:
                    $c = new Courses();  (där Courses är namnet på min klass)
                */
                if($c->updateCourse($data->code, $data->name, $data->progression, $data->syllabus)){
                    $response = array("message" => "Updated");
                    http_response_code(201); //Created
                } else {
                    $response = array("message" => "Failed");
                    http_response_code(500); //Server error
                }
    
            }
        }

        break;


    case 'DELETE':


        if(!isset($code)) {
            http_response_code(400);
            $response = array("message" => "No course code is sent");  
        } else {

            http_response_code(200);

            $c->deleteCourse($code);

            $response = array("message" => "Course with $code is deleted");
        }
        break;
        
}

//Skickar svar tillbaka till avsändaren
echo json_encode($response);