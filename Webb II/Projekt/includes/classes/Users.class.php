<?php

    class Users{

        //Properties 
        private $db;
        private $userID;
        private $type;
        private $email;
        private $password;
        private $firstname;
        private $lastname;
        private $profileImg;
        private $registration_date;


        function __construct() {
            //content to database 
            //$this->db = new mysqli("localhost", "momentfyra", "password", "momentfyra");
            $this->db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');
            
            
            if($this->db->connect_errno > 0) {
               die("Fel vid anslutning: " . $this->db->connect_error);
            }
        }




        //Add users
       //Add users
       public function addUsers($password, $firstname, $lastname, $email) : bool {

        $password = $this->db->real_escape_string($password);

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $type = 1; //All users is set to type 1, while all admin needs to be changed to type 0
        
        $arrImg = array("apple", "banana","cherry", "kiwi", "melon", "orange", "peach", "pear", "strawberry"); // Array with possible profile img
        $randomImg = array_rand($arrImg);   // get random index from arrayImg
        $profileImg = $arrImg[$randomImg];  //Get the random img from array

        $sql = "INSERT INTO users (password, type, profileImg, firstname, lastname, email) VALUES ('$hashPassword', '$type', '$profileImg', '$firstname', '$lastname', '$email');";
        
        $result = mysqli_query($this->db, $sql);
        
        $_SESSION['userID'] = mysqli_insert_id($this->db);
        $_SESSION['fname'] = $firstname;
        $_SESSION['lname'] = $lastname;

        header("Location: index.php?message=Välkommen till Mat%26GRAM, <b>$firstname</b>! <br> Du är nu registerad och inloggad!");
    }


        public function emailExists($email) : bool {
            $email = $this->db->real_escape_string($email);
            $sql = "SELECT email FROM users WHERE email='$email'";
            $result = mysqli_query($this->db, $sql);
            
            //Chech if email exist
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }


    public function logInUser($email, $password) {
            $password = $this->db->real_escape_string($password);

            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($this->db, $sql);
            $row = mysqli_fetch_array($result);

            //Chech if email exist
            if (password_verify($password, $row['password'])) {
                $_SESSION['userID'] = $row['userID'];
                $_SESSION['fname'] = $row['firstname'];
                $_SESSION['lname'] = $row['lastname'];


                header("Location: index.php?message=Välkommen tillbaka <b>" . $row['firstname'] . "</b>!");
                return true;
            } else {
                return false;
            }
        }



    


        //Get user info from userID
        public function getUserInfo($userID) {
            $sql = "SELECT * FROM users WHERE userID='$userID'";
            $result = mysqli_query($this->db, $sql);
            return $result;
        }
        //Get user info from email
        public function getUserInfoFromEmail($email) {
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($this->db, $sql);
            return $result;
        }

        //Get a list with only users (index-page)
        public function getUserList() {
            $sql = "SELECT userID, firstname, lastname FROM users ORDER BY registration_date DESC";
            $result = mysqli_query($this->db, $sql);
            return $result;
        }



        //Chech if user is admin or not
        public function adminExists($userID) : bool {
            $userID = $this->db->real_escape_string($userID);
            $sql = "SELECT * FROM users WHERE userID='$userID' and type=0";
            $result = mysqli_query($this->db, $sql);

            //Chech if userID exist
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
        public function userIDExists($userID) : bool {
            $userID = $this->db->real_escape_string($userID);
            $sql = "SELECT * FROM users WHERE userID='$userID'";
            $result = mysqli_query($this->db, $sql);

            //Chech if userID exist
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        //Update user to admin
        public function updateUserToAdmin($email) : bool {
            $sql = "UPDATE users SET type='0' WHERE email='$email'";
            $result = mysqli_query($this->db, $sql);
            return $result;
        }

        //Only admin 
        public function deleteUser($userID) : bool {
            $sql = "DELETE FROM users WHERE userID='$userID'";
            $result = mysqli_query($this->db, $sql);
            return $result;
        }




        //Chech if current password is right
        public function checkPassword($userID, $oldPassword) : bool {
            $password = $this->db->real_escape_string($oldPassword);

            $sql = "SELECT * FROM users WHERE userID='$userID'";
            $result = mysqli_query($this->db, $sql);
            $row = mysqli_fetch_array($result);

            //Chech if userID exist
            if (password_verify($password, $row['password'])) {
                return true;
            } else {
                return false;
            }
        }

        //Update password for users
        public function changePassword($newpassword, $userID) : bool {

            $hashPassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password='$hashPassword' WHERE userID='$userID';";
            $result = mysqli_query($this->db, $sql);
                
            return true;
        }

        //Update password for admins
        public function adminChangePassword($newpassword, $email) : bool {

            $hashPassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password='$hashPassword' WHERE email='$email';";
            $result = mysqli_query($this->db, $sql);
                
            return true;
        }


        //Update profilepic
        public function changeProfilePic($profilePic, $userID) : bool {
            $sql = "UPDATE users SET profileImg='$profilePic' WHERE userID='$userID';";
            $result = mysqli_query($this->db, $sql);
                
            return true;
        }





        public function setPassword ($password) : bool {
            if (strlen($password) > 4) {
                $this->password = $password;
                return true;
            } else {
                return false;
            }
        }

        public function setFirstname ($firstname) : bool {
            if (strlen($firstname) > 2) {
                $this->firstname = $firstname;
                return true;
            } else {
                return false;
            }
        }

        public function setLastname ($lastname) : bool {
            if (strlen($lastname) > 2) {
                $this->lastname = $lastname;
                return true;
            } else {
                return false;
            }
        }
        
    }