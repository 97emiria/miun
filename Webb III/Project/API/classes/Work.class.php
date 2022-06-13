<?php 

class Work {
    private $workID;
    private $title;
    private $workplace;
    private $date;
    private $city;
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


    public function getWorks() : array {
        $sql = 'SELECT * from work ORDER BY date';
        $result = mysqli_query($this->db, $sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getWorksByID($workID) : array {
        $sql = "SELECT * from work where workID='$workID'";
        $result = mysqli_query($this->db, $sql);
        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function editWork($workID, $title, $workplace, $date, $comment) : bool {
        $sql = "UPDATE work SET title='$title', workplace='$workplace', date='$date', comment='$comment', updated=CURRENT_TIMESTAMP() WHERE workID='$workID' ";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    //Delete
    public function deleteWork($workID) : bool {
        $sql = "DELETE from work WHERE workID='$workID'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function addWork($title, $workplace, $date, $comment) : bool {
        $sql = "INSERT INTO work(title, workplace, date, comment, updated) VALUES('$title', '$workplace', '$date', '$comment', CURRENT_TIMESTAMP());";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }


    //Exsit 
    public function existWorkID($workID) {
        $sql = "SELECT workID FROM work WHERE workID='$workID'";
        $result = mysqli_query($this->db, $sql);

        //Chech if writer exist
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    //Setters
    public function setTitle($title) : bool {
        if($title != "" && strlen($title) < 64 ) {
            return true;
        } else {
            return false;
        }
    }

    public function setWorkplace($workplace) : bool {
        if($workplace != "" && strlen($workplace) < 64 ) {
            return true;
        } else {
            return false;
        }
    }

    public function setDate($date) : bool {
        if($date != "") {
            return true;
        } else {
            return false;
        }
    }

    public function setComment($comment) : bool {
        if(strlen($comment) < 1000 && strlen($comment) > 1 ) {
            return true;
        } else {
            return false;
        }
    }
}