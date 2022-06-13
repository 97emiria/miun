<?php 

class Education {
    private $educationID;
    private $title;
    private $school;
    private $semester;
    private $date;
    private $status;
    private $comment;
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


    //Getters
    public function getEducationList() : array {
        $sql = 'SELECT * from education ORDER BY date AND status';
        $result = mysqli_query($this->db, $sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getEducationByID($educationID) : array {
        $sql = "SELECT * from education where educationID='$educationID'";
        $result = mysqli_query($this->db, $sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Edit
    public function editEducation($educationID, $title, $school, $semester, $date, $status, $comment) : bool {
        $sql = "UPDATE education SET title='$title', school='$school', semester='$semester', date='$date', status='$status', comment='$comment', updated=CURRENT_TIMESTAMP() WHERE educationID='$educationID' ";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    //Delete
    public function deleteEducation($educationID) : bool {
        $sql = "DELETE from education WHERE educationID='$educationID'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    //Add
    public function addEducation($title, $school, $semester, $date, $status, $comment)  : bool {
        $sql = "INSERT INTO education(title, school, semester, date, status, comment, updated) VALUES('$title', '$school', '$semester', '$date', '$status', '$comment', CURRENT_TIMESTAMP());";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    //Exist
    public function existEducationID($educationID) {
        $sql = "SELECT educationID FROM education WHERE educationID='$educationID'";
        $result = mysqli_query($this->db, $sql);

        //Chech if writer exist
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function existTitleAndSchool($title, $school) {
        $sql = "SELECT * FROM education WHERE title='$title' AND school='$school'";
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
        if($title != "" && strlen($title) < 64) {
            return true;
        } else {
            return false;
        }
    }

    public function setSchool($school) : bool {
        if($school != "" && strlen($school) < 128) {
            return true;
        } else {
            return false;
        }
    }

    public function setSemester($semester) : bool {
        if($semester == 'HT' || $semester == 'VT' || $semester == 'ST') {
            return true;
        } else {
            return false;
        }
    }

    public function setDate($date) : bool {
        if($date != "" && strlen($date) < 32) {
            return true;
        } else {
            return false;
        }
    }

    public function setStatus($status) : bool {
        if($status == 0 || $status == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function setComment($comment) : bool {
        if(strlen($comment) < 100 && strlen($comment) > 1 ) {
            return true;
        } else {
            return false;
        }
    }

}