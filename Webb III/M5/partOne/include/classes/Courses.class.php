<?php 

class Courses {
    private $code;
    private $name;
    private $progression;
    private $syllabus;
    private $db;


    //Connect to database
    public function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
        if($this->db->connect_errno > 0){
            die('<br> Connection error [' . $this->db->connect_error . ']');
        } 
    }


    //Add
    public function addCourse($code,  $name, $progression, $syllabus) : bool {
        $sql = "INSERT INTO courses(code, name, progression, syllabus) VALUES('$code', '$name', '$progression', '$syllabus');";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }


    //Getters
    public function getAllCourses() : array {
        $sql = 'SELECT * from courses';
        $result = mysqli_query($this->db, $sql);
        
        //as Associattive array (gör iaf att de blir en array)
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCourse($code) : array {
        $sql = "SELECT * from courses WHERE code='$code'";
        $result = mysqli_query($this->db, $sql);
        
        //as Associattive array (gör iaf att de blir en array)
        return $result->fetch_all(MYSQLI_ASSOC);
    }



    //Delete
    public function deleteCourse($code) : bool {
        $sql = "DELETE from courses WHERE code='$code'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }



    //Update
    public function updateCourse($code, $name, $progression, $syllabus) : bool {
        $sql = "UPDATE courses SET code='$code', name='$name', progression='$progression', syllabus='$syllabus' WHERE code='$code' ";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }


    //Setters
    public function setCode($code) : bool {
     
        if(
            ctype_alpha(substr($code, 0, 2)) &&
            is_numeric(substr($code, 3, 2)) &&
            ctype_alpha(substr($code, 5, 1)) && 
            strlen($code) == 6
        ) {
            return true;
        } else {
            return false;
        }

    }

    public function setName($name) : bool {
        if($name != "") {
            return true;
        } else {
            return false;
        }
    }

    public function setProgression($progression) : bool {
        //if(ctype_alpha($progression) && strlen($progression) == 1 ) {
        if (strlen($progression) == 1 && $progression == 'A' || $progression == 'B') {
            return true;
        } else {
            return false;
        }
    }

    public function setSyllabus($syllabus) : bool {
        $url_headers = @get_headers($syllabus);
        if(!strpos($url_headers[0],'500') && $syllabus != "") {
            return true;
        }  else  {
            return false;
        }
    }

}