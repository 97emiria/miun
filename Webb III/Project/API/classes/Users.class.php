<?php 

class Users {
    private $userID;
    private $email;
    private $password;
    private $name;
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

    //Check if users exist in
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

    public function logIn($email, $password) : bool {
        $password = $this->db->real_escape_string($password);

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($this->db, $sql);
        $row = mysqli_fetch_array($result);

        //Chech if email exist
        if (password_verify($password, $row['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserInfo($email) : array {
        $sql = "SELECT * from users where email='$email'";
        $result = mysqli_query($this->db, $sql);
        
        //as Associattive array (gör iaf att de blir en array)
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    //Update password
    public function updatePassword($email, $password) : bool {

        //Hash
        $password = $this->db->real_escape_string($password);
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password='$hashPassword', updated=CURRENT_TIMESTAMP() WHERE email='$email' ";
        $result = mysqli_query($this->db, $sql);
        
        return $result;
    }


    public function setPassword($password) : bool {
        if(strlen($password) > 8) {
            return true;
        } else {
            return false;
        }
    }

}