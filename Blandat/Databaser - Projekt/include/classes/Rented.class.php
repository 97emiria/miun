<?php

class Rented {

    private $carID;
    private $storeID;
    private $timestamp;

    //content to database 
    function __construct() {
               //$this->db = new mysqli("localhost", "carRent", "password", "carRent");
               $this->db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');
        
        if($this->db->connect_errno > 0) {
           die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }


    public function rentCar($chosenCustomerID, $chosenCarID, $chosenStoreID, $storeTo, $dateFrom, $dateTo, $employeeID) {
         //Sql-fråga för att lägga till nya rent 
         $sql = "INSERT INTO rented(customerID, carID, storeFrom, storeTo, dateFrom, dateTo, active, employeeID) VALUES('$chosenCustomerID', '$chosenCarID', '$chosenStoreID', '$storeTo', '$dateFrom', '$dateTo', '1', '$employeeID');";
         $result = mysqli_query($this->db, $sql);
        
         $rentID = mysqli_insert_id($this->db);

         return $rentID;
    }

    public function getRentCarByID($rentID) {
        $sql = "SELECT * FROM rented WHERE rentID='$rentID'";

        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function getRentCarByCarID($carID) {
        $sql = "SELECT * FROM rented WHERE carID='$carID'";

        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    //Update rented info when returned 
    public function updateRentedCar($rentID) {
        $sql = "UPDATE rented SET active='0' WHERE rentID='$rentID' ";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

}