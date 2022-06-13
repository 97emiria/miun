<?php 

    class Texts {
        private $textID;
        private $title;
        private $theText;
        private $image;
        private $updated;
        private $timestamp;
        private $db;



        //Connect to database
        public function __construct() {
            $this->db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
            if($this->db->connect_errno > 0){
                die('<br> Connection error [' . $this->db->connect_error . ']');
            } 
        }


        public function getAllTexts() : array {
            $sql = 'SELECT * from texts';
            $result = mysqli_query($this->db, $sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getImage($textID) {
            $sql = "SELECT imgName from texts WHERE textID='$textID' ";
            $result = mysqli_query($this->db, $sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }


        public function getTextByID($textID) : array {
            $sql = "SELECT * FROM texts WHERE textID='$textID'";
            $result = mysqli_query($this->db, $sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function editText($textID, $theText) : bool {
            $sql = "UPDATE texts SET theText='$theText', updated=CURRENT_TIMESTAMP() WHERE textID='$textID' ";

            $result = mysqli_query($this->db, $sql);
            return $result;
        }


        public function editTextWithImg($textID, $theText, $imgPath, $imgName) : bool {
            $sql = "UPDATE texts SET theText='$theText', imgPath='$imgPath', imgName='$imgName', updated=CURRENT_TIMESTAMP() WHERE textID='$textID' ";

            $result = mysqli_query($this->db, $sql);
            return $result;
        }




        //Setters
        public function setTextLength($about) : bool {
            if(strlen($about) < 2500 && strlen($about) > 1 ) {
                return true;
            } else {
                return false;
            }
        }


        public function setImage($imageType, $imageSize) : bool {
            if(
            ($imageType == "image/jpeg") || 
            ($imageType == "image/jpeg") || 
            ($imageType == "image/png") || 
            ($imageType == "image/gif") && 
            ($imageSize < 500)
            ) {
                return true;
            } else {
                return false;
            }
        }

    }