<?php

class Employee {

    private $employeeID;
    private $fname;
    private $lanme;
    private $email;
    private $password;
    private $workAt;

    //content to database 
    function __construct() {
        //$this->db = new mysqli("localhost", "carRent", "password", "carRent");
        $this->db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');
        
        if($this->db->connect_errno > 0) {
           die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }


    //Chech if email exist
    public function emailExists($email) : bool {
        $email = $this->db->real_escape_string($email);
        $sql = "SELECT email FROM employee WHERE email='$email'";
        $result = mysqli_query($this->db, $sql);
        
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function logInEmployee($email, $password) {
        $email = $this->db->real_escape_string($email);
        $password = $this->db->real_escape_string($password);

        $sql = "SELECT * FROM employee WHERE email='$email' AND password='$password'";
        $result = mysqli_query($this->db, $sql);
        $row = mysqli_fetch_array($result);


        //Chech if email exist
        if ($result->num_rows > 0) {

            $_SESSION['employeeID'] = $row['employeeID'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];

            header("Location: index.php?message=Välkommen tillbaka <b>" . $row['fname'] . "</b>!");
            return true;

        } else {
            return false;
        }
    }


}