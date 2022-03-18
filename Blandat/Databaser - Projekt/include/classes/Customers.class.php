<?php

    class Customers {

        private $customerID;
        private $fname;
        private $lanme;
        private $email;
        private $phone;
        private $address;
        private $zip;
        private $city;

        //content to database 
        function __construct() {
        //$this->db = new mysqli("localhost", "carRent", "password", "carRent");
        $this->db = new mysqli('DBHOST', 'DBUSER', 'DBPASSWORD', 'DBDATABASE');
            
            if($this->db->connect_errno > 0) {
            die("Fel vid anslutning: " . $this->db->connect_error);
            }
        }


            
        public function emailExists($email) : bool {
            $email = $this->db->real_escape_string($email);
            $sql = "SELECT email FROM customers WHERE email='$email' OR phone='$email' ";
            $result = mysqli_query($this->db, $sql);
            
            //Chech if email exist
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function getCustomerByEmailOrPhone($email) {
            $sql = "SELECT * FROM customers WHERE email='$email' OR phone='$email' "; 
            $result = mysqli_query($this->db, $sql);

            return $result;
        
        }

        public function getCustomerByID($customerID) {
            $sql = "SELECT * FROM customers WHERE customerID='$customerID' "; 
            $result = mysqli_query($this->db, $sql);

            return $result;
        
        }
    }
    