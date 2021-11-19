<?php 
    class Users {
        //porpertis 
        private $db;
        private $id;
        private $username;
        private $password;
        private $type;


        function __construct() {
            //content to database 
            $this->db = new mysqli("localhost", "newsDB", "password", "newsDB");
            //$this->db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');


            //if no errors proceed
            if($this->db->connect_errno > 0) {
                die("Fel vid anslutning: " . $this->db->connect_error);
            }
        }

        //Add article
        public function addUsers(string $username, string $password) : bool {
            //sql code to database 
            $username = $this->db->real_escape_string($username);
            $password = $this->db->real_escape_string($password);
            $type = 1;
            $sql = "INSERT INTO users (username, password, type) VALUES ('$username', '$password', '$type');";

            //Save to db
            $result = mysqli_query($this->db, $sql);

            return $result;
        }

        //Chech if username is taken 
        public function userExists($username) {
            $username = $this->db->real_escape_string($username);
            $sql = "SELECT username FROM users WHERE username='$username'";
            $result = mysqli_query($this->db, $sql);

            //Chech if username exist
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }



        //Chech if username exist and match with password
        public function logInUser($username, $password) {
            $username = $this->db->real_escape_string($username);
            $password = $this->db->real_escape_string($password);

            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = mysqli_query($this->db, $sql);

            //Chech if username exist
            if ($result->num_rows > 0) {
                $_SESSION['username'] = $username;
                header("Location: index.php");
                return true;
            } else {
                return false;
            }
        }


        public function setUsername ($username) {
            if (strlen($username) > 4) {
                $this->username = $username;
                return true;
            } else {
                return false;
            }
        }

        public function setPassword ($password) {
            if (strlen($password) > 4) {
                $this->password = $password;
                return true;
            } else {
                return false;
            }
        }




        
        //Chech if user is admin or not
        public function adminUser($username) : bool {
            $type = 0;
            $username = $this->db->real_escape_string($username);
            $sql = "SELECT * FROM users WHERE username='$username' and type='$type'";
            $result = mysqli_query($this->db, $sql);

            //Chech if username exist
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        //Uppdatera user to admin-rights
        public function updateUserToAdmin($username) : bool {

            $sql = "UPDATE users SET type='0' WHERE username='$username'";


            $result = mysqli_query($this->db, $sql);
            return $result;
        }

    }
?>