<?php 

class Webbpages {
    private $webbpageID;
    private $title;
    private $link;
    private $description;
    private $imgPath;
    private $imgName;
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


    public function getWebbpages() : array {
        $sql = 'SELECT * from webbpages';
        $result = mysqli_query($this->db, $sql);
        return $result->fetch_all(MYSQLI_ASSOC);
        
    }

    public function getWebbpagesByID($webbpageID) : array {
        $sql = "SELECT * from webbpages where webbpageID='$webbpageID'";
        $result = mysqli_query($this->db, $sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getImage($webbpageID) : array {
        $sql = "SELECT imgName from webbpages where webbpageID='$webbpageID'";
        $result = mysqli_query($this->db, $sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Delete
    public function deleteWebbpage($webbpageID) : bool {
        $sql = "DELETE from webbpages WHERE webbpageID='$webbpageID'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }


    public function editWebbpage($webbpageID, $title, $link, $description) : bool {
        $sql = "UPDATE webbpages SET title='$title', link='$link', description='$description', updated=CURRENT_TIMESTAMP() WHERE webbpageID='$webbpageID' ";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }
    
    public function editWebbpageWithImage($webbpageID, $title, $link, $description, $imgPath, $imgName) : bool {
        $sql = "UPDATE webbpages SET title='$title', link='$link', description='$description', imgPath='$imgPath', imgName='$imgName', updated=CURRENT_TIMESTAMP() WHERE webbpageID='$webbpageID' ";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    //Add 
    public function addWebbpage($title, $link, $description, $imgPath, $imgName) : bool {
        $sql = "INSERT INTO webbpages(title, link, description, imgPath, imgName, updated) VALUES('$title', '$link', '$description', '$imgPath', '$imgName', CURRENT_TIMESTAMP());";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }



    //Exist
    public function existWebbpageID($webbpageID) {
        $sql = "SELECT webbpageID FROM webbpages WHERE webbpageID='$webbpageID'";
        $result = mysqli_query($this->db, $sql);

        //Chech if writer exist
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }



    public function setTitle($title) : bool {
        if($title != "") {
            return true;
        } else {
            return false;
        }
    }

    public function setDescription($description) : bool {
        if(strlen($description) > 1 && strlen($description) < 2500 ) {
            return true;
        } else {
            return false;
        }
    }

    public function setLink($link) :bool {
        if($link != "") {
            return true;
        } else {
            return false;
        }
    }

}