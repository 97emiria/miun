<?php 
    class Articles {
        //porpertis 
        private $db;
        private $id;
        private $title;
        private $content;
        private $img;
        private $imgText;
        private $author;
        private $postdate;


        function __construct() {
            //content to database 
            //$this->db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');
            $this->db = new mysqli("localhost", "newsDB", "password", "newsDB");



            //if no errors proceed
            if($this->db->connect_errno > 0) {
                die("Fel vid anslutning: " . $this->db->connect_error);
            }
        }

        //Add article
        public function addArticle($title, $content, $img, $imgText, $author) : bool {
            //sql code to database 
            $sql = "INSERT INTO articles(title, content, img, imgText, author)VALUES('$title', '$content', '$img', '$imgText', '$author');";

            //Save to db
            $result = mysqli_query($this->db, $sql);
            
            return $result; 
        }


        //Remove article
        public function removeArticle(int $id) : bool{
            //sql code that listens to input
            $sql = "DELETE FROM articles WHERE id=$id;";
            //save to database
            $result = mysqli_query($this->db, $sql);

            return $result;
        }

        //Uppdatera Article
        public function updateArticle(int $id, string $title, string $content, string $img, string $imgText, string $author) : bool {
            $sql = "UPDATE articles SET title='$title', content='$content', img='$img', imgText='$imgText' author='$author' WHERE id=$id;";

            $result = mysqli_query($this->db, $sql);
            return $result;
        }




        //For for-loops
        public function getArticles() {
            $sql = "SELECT * FROM `articles` ORDER BY postdate DESC";
            $result = mysqli_query($this->db, $sql);

            return $result;
        }

        //Get single article with ID
        public function getSingelArticles($id) {
            $sql = "SELECT * FROM `articles` WHERE id=$id";
            $result = mysqli_query($this->db, $sql);

            return $result;
        }

     


        //Sets
        public function setTitle(string $title) : bool { 
            if (strlen($title) > 3) {
                $this->title = $title;
                return true;
            } else {
                return false;
            }
        }

        public function setContent(string $content) : bool { 
            if (strlen($content) > 50) {
                $this->content = $content;
                return true;
            } else {
                return false;
            }
        }

        public function setImg(string $img) : bool { 
            if (strlen($img) != null) {
                $this->img = $img;
                return true;
            } else {
                return false;
            }
        }

        public function setImgText(string $imgText) : bool { 
            if (strlen($imgText) > 3) {
                $this->imgText = $imgText;
                return true;
            } else {
                return false;
            }
        }

        public function setAuthor(string $author) : bool { 
            if (strlen($author) > 2) {
                $this->author = $author;
                return true;
            } else {
                return false;
            }
        }


     
}
 
?>