<?php
        class Posts {

            //poroerites 
            private $db;
            private $postID;
            private $writer;
            private $title;
            private $content;
            private $img;
            private $imgText;


            function __construct() {
                //content to database 
                //$this->db = new mysqli("localhost", "momentfyra", "password", "momentfyra");
                
                $this->db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');
                
                
                if($this->db->connect_errno > 0) {
                   die("Fel vid anslutning: " . $this->db->connect_error);
                }
            }


            //add post
            public function addPost($title, $content, $img, $imgText, $writer, $userID) : bool {

                //Sql-fråga för att lägga till nya inlägget i databasen
                $sql = "INSERT INTO posts(title, content, img, imgtext, writer, userID) VALUES('$title', '$content', '$img', '$imgText', '$writer', '$userID');";
                $result = mysqli_query($this->db, $sql);
                $postID = mysqli_insert_id($this->db);

                header("Location: postSolo.php?postID=$postID");
            }



            public function updatePost($title, $content, $postID, $userID) {
                $sql = "UPDATE posts SET title='$title', content='$content' WHERE postID=$postID AND userID='$userID'";

                $result = mysqli_query($this->db, $sql);
                return $result;

            }


            //Get last postes
            public function getPosts() {
                $sql = "SELECT * FROM posts ORDER BY postdate DESC";
                $result = mysqli_query($this->db, $sql);
    
                return $result;
            }

            //Use in slideshow
            public function getRandomPosts() {
                $sql = "SELECT * FROM posts ORDER BY RAND() LIMIT 6";
                $result = mysqli_query($this->db, $sql);
    
                return $result;
            }


            //Get specifi post by ID postes
            public function getSingelPost($postID) {
                $sql = "SELECT * FROM posts WHERE postID='$postID'";
                $result = mysqli_query($this->db, $sql);
    
                return $result;
            }


            public function getUserPost($userID) {

                $sql = "SELECT * FROM posts WHERE userID='$userID' ORDER BY postdate DESC";
                $result = mysqli_query($this->db, $sql);
                
               return $result;
                
            }


            //Get img name 
            public function getImg($postID) {
                $sql = "SELECT img FROM posts WHERE postID='$postID'";
                $result = mysqli_query($this->db, $sql);
                return $result;
            }

          

            //Uses for admin to delete posts
            public function deleteUserPosts($userID) : bool {
                $sql = "DELETE FROM posts WHERE userID='$userID'";
                $result = mysqli_query($this->db, $sql);
                return $result;
            }

            //Uses when deleting/remove a account
            public function deletePost($postID, $userID) : bool {
                $sql = "DELETE FROM posts WHERE postID='$postID' AND userID='$userID'";
                $result = mysqli_query($this->db, $sql);
                return $result;
            }

            //Get img name from one User
            public function getImgUser($userID) {
                $sql = "SELECT img FROM posts WHERE userID='$userID'";
                $result = mysqli_query($this->db, $sql);
                return $result;
            }


            //To check postID exist
            public function existPostID($postID) {
                $sql = "SELECT postID FROM posts WHERE postID='$postID'";
                $result = mysqli_query($this->db, $sql);

                //Chech if writer exist
                if ($result->num_rows > 0) {
                    return true;
                } else {
                    return false;
                }
            }
            public function existPostIDWithUserID($postID, $userID) {
                $sql = "SELECT * FROM posts WHERE postID='$postID' AND userID='$userID'";
                $result = mysqli_query($this->db, $sql);

                if ($result->num_rows > 0) {
                    return true;
                } else {
                    return false;
                }
            }







            public function setTitle($title) : bool {
                if(str_word_count($title) > 0) {
                    $this->title = $title;
                    return true;
                } else {
                    return false;
                }
            }
            public function setMaxLength($title) : bool {
                if(strlen($title) < 64) {
                    $this->title = $title;
                    return true;
                } else {
                    return false;
                }
            }
            
            public function setMiniContent($content) : bool {
                if(str_word_count($content) > 3) {
                    $this->content = $content;
                    return true;
                } else {
                    return false;
                }
            }

            public function setMaxContentCh ($content) : bool {
                if(strlen($content) < 3000) {
                    return true;
                } else {
                    return false;
                }
            }

            public function setMaxContentWord ($content) : bool {
                if(str_word_count($content) < 500) {
                    return true;
                } else {
                    return false;
                }
            }


            public function setImg(string $img) : bool {
                if(strlen($img) != null) {
                    $this->img = $img;
                    return true;
                } else {
                    return false;
                }
            }

            public function setImgText(string $imgText) : bool {
                if(str_word_count($imgText) < 15 && strlen($imgText)) {
                    $this->imgText = $imgText;
                    return true;
                } else {
                    return false;
                }
            }


        }