<?php

class Stores {

    private $storeID;
    private $name;
    private $address;
    private $phone;
    private $maxCapacity;
    private $workAt;

    //content to database 
    function __construct() {
        //$this->db = new mysqli("localhost", "carRent", "password", "carRent");
        $this->db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');
        
        if($this->db->connect_errno > 0) {
           die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }

    //Get Store list
    public function getStores() {

        $sql = "SELECT * FROM stores ";
        $result = mysqli_query($this->db, $sql);

        return $result;

    }


    //Get Store info from storeID
    public function getStoreByID($storeChoice) {

        $sql = "SELECT * FROM stores WHERE storeID='$storeChoice' ";
        $result = mysqli_query($this->db, $sql);

        return $result;

    }


}