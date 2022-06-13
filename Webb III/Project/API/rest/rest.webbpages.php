<?php

//Connect databse and get class
include('../config.php');
$webb = new Webbpages();


header('Access-Control-Allow-Origin: *');                                           //Går endats nå från domänen
header('Content-Type: application/json');                                           //Talar om att webbtjänsten skickar data i JSON-format
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');                     //Vilka metoder som webbtjänsten accepterar, som standard tillåts bara GET.
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');//Vilka headers som är tillåtna vid anrop från klient-sidan, kan bli problem med CORS (Cross-Origin Resource Sharing) utan denna.


$method = $_SERVER['REQUEST_METHOD'];//Läser in vilken metod som skickats och lagrar i en variabel



//Collect user email
if(isset($_GET['webbpageID'])) {
    $webbID = $_GET['webbpageID'];
}

switch($method) {
    case 'GET':

        if(isset($webbID)) {

            http_response_code(200);
            $response = $webb->getWebbpagesByID($webbID);

            if(count($response) == 0) {
                http_response_code(400);
                $response = array("message" => "Finns inget att hämta med det IDt");
            }
        } else {

            http_response_code(200);
            $response = $webb->getWebbpages();

            if(count($response) == 0) {
                http_response_code(400);
                $response = array("message" => "Finns inget att hämta");
            }
        }

        break;

    case 'POST':

        if(isset($_FILES['image'])) {
            $response = array("message" => "gick inte att uppdatera");
            http_response_code(500); //Server error


            //Collect text data
            $mission = $_POST['mission'];
            $title = $_POST['title'];
            $link = $_POST['link'];
            $description = $_POST['description'];

            //Ger filen ett nytt namn
            $randomNum= rand(100000000, 10000000000);               //Creat set of random numbers
            $type = substr($_FILES['image']['type'], 6, 4);         //Get file type
            $imageName = $randomNum . "." . $type;                //Creat the new name
            $imagePath = pathUrlImg.$imageName;



            if($mission == 'add') {
                ;

                if($webb->addWebbpage($title, $link, $description, $imagePath, $imageName) && move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $imageName)){
                    
                    http_response_code(201); //Created
                    $response = array("message" => "$title är nu tillagd");

                } else {
                
                    http_response_code(500); //Server fel
                    $response = array("message" => "Det gick inte att lägga till i databasen");
                }
               
            } else if ($mission == 'edit') {


                //Remove image
                $result = $webb->getImage($webbID);
                foreach($result as $row) {
                    unlink("../uploads/" . $row['imgName']); 
                }

                if($webb->editWebbpageWithImage($webbID, $title, $link, $description, $imagePath, $imageName) && move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $imageName)){
                    
                    http_response_code(201); //Created
                    $response = array("message" => "$title är nu uppdaterad");

                } else {
                    http_response_code(500); //Server fel
                    $response = array("message" => "Det gick inte att göra en uppdatering till databasen");
                }

            }
            

        } else {
            http_response_code(400);
            $response = array("message" => "Du måste ha med en bild");
        }

        break;

    case 'PUT':

        $data = json_decode(file_get_contents("php://input"));

        if($webb->editWebbpage($webbID, $data->title, $data->link, $data->description)){
            http_response_code(201); //Created
            $response = array("message" => "$data->title updaterad");
        } else {
            http_response_code(500); //Server error
            $response = array("message" => "$data->title gick inte att uppdatera");
        }
    
        break;


    case 'DELETE':

        $data = json_decode(file_get_contents("php://input"));


        if(!isset($webbID)) {
            http_response_code(400);
            $response = array("message" => "No course code is sent");  

        } else {

            //Check if id exist in database
            if($webb->existWebbpageID($webbID)) {

                //Remove image
                $result = $webb->getImage($webbID);
                foreach($result as $row) {
                    unlink("../uploads/" . $row['imgName']); 
                }
                
                if($webb->deleteWebbpage($webbID)) {
                    http_response_code(200); //Success
                    $response = array("message" => "Deleted weppbage success, $data->title");

                } else {

                    http_response_code(500); //Success
                    $response = array("message" => "Deleted weppbage failed, $data->title");
                    
                }

            } else {
                http_response_code(500); //User error
                $response = array("message" => "webbplatsen ID finns inte i databasen");
            }

        }

    break;
        
}

//Skickar svar tillbaka till avsändaren
echo json_encode($response);