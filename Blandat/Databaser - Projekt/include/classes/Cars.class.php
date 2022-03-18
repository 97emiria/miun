<?php

class Cars {

    private $carID;
    private $brand;
    private $color;
    private $miles;
    private $price;
    private $status;
    private $store;

    //content to database 
    function __construct() {
        //$this->db = new mysqli("localhost", "carRent", "password", "carRent");
        $this->db = new mysqli('DBHOST', 'DBUSER', 'DBPASSWORD', 'DBDATABASE');
        
        if($this->db->connect_errno > 0) {
           die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }


    //Get car list
    public function getCars() {

        $sql = "SELECT * FROM cars ";
        $result = mysqli_query($this->db, $sql);

        return $result;

    }

    public function getCarByID($carName) {

        $sql = "SELECT * FROM cars WHERE carID='$carName' ";
        $result = mysqli_query($this->db, $sql);

        return $result;

    }


    //Get cars from specific store
    public function carAtStore($storeID) {
        $sql = "SELECT * FROM cars WHERE store='$storeID' ";
        $result = mysqli_query($this->db, $sql);

        return $result;
    }

    
    //Get cars from specific store, which is available
    public function availableCarAtStore($storeID) {
        $sql = "SELECT * FROM cars WHERE store='$storeID' AND status='1' ";
        $result = mysqli_query($this->db, $sql);

        return $result;
    }

    /*public function availableStoreWithCars($storeID) {
        $sql = "SELECT * FROM cars WHERE storeID='$storeID' AND status='1' ";
        $result = mysqli_query($this->db, $sql);

        return $result;

    }*/
        
    //Count how many car a store have
    public function countCarsAtStore() {
        $sql = "SELECT store, COUNT(*) AS current FROM cars GROUP BY store";
        $result = mysqli_query($this->db, $sql);

        return $result;
    }

    //Check which store have available cars
    public function listStoreWhitAvailableCar() {
        $sql = "SELECT store, COUNT(*) AS current FROM cars WHERE status='1' GROUP BY store";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    //Get cars number from specific store, which is available
    public function tesst($storeID) {
        $sql = "SELECT store, COUNT(*) FROM cars WHERE store='$storeID' AND status='1' ";
        $result = mysqli_query($this->db, $sql);

        return $result;
    }


    //Update car info when booked 
    public function updateRentCar($storeTo, $chosenCarID) {
        $sql = "UPDATE cars SET status='2', store='$storeTo' WHERE carID='$chosenCarID' ";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    //Update car info when returned 
    public function updateRentedCar($carID) {
        $sql = "UPDATE cars SET status='1' WHERE carID='$carID' ";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

}