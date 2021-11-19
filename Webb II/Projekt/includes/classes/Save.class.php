<?php
    class Save {

        //poroerites 
        private $db;
        private $saveID;
        private $postID;
        private $userID;
        private $postdate;

        function __construct() {
            //content to database 
            //$this->db = new mysqli("localhost", "momentfyra", "password", "momentfyra");
            $this->db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');
            
            if($this->db->connect_errno > 0) {
                die("Fel vid anslutning: " . $this->db->connect_error);
            }
        }


        //add favvo
        public function savePost($postID, $userID) : bool {
            $sql = "INSERT INTO save(postID, userID)VALUES('$postID', '$userID');";
            $result = mysqli_query($this->db, $sql);
            return $result;
        }

        //Remove
        public function removeSaved($postID, $userID) : bool {
            $sql = "DELETE FROM save WHERE postID='$postID' AND userID='$userID'";
            $result = mysqli_query($this->db, $sql);
            return $result;
        }

        //get 
        public function getSaved($userID) {
            $sql = "SELECT * FROM save WHERE userID='$userID' ORDER BY postdate DESC";
            $result = mysqli_query($this->db, $sql);
            return $result;
        }


        //Check if liked or not
        public function checkSaved($postID, $userID) : bool {

            $sql = "SELECT * FROM save WHERE postID='$postID' AND userID='$userID'";
            $result = mysqli_query($this->db, $sql);

            //Chech if userID exist
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }


        //Remove
        public function removeUserSaved($userID) : bool {
            $sql = "DELETE FROM save WHERE userID='$userID'";
            $result = mysqli_query($this->db, $sql);
            return $result;
        }
        
        
    }