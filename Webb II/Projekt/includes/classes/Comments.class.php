<?php
        class Comments {

            //poroerites 
            private $db;
            private $commentID;
            private $userID;
            private $comment;
            private $postID;
            private $postdate;



            function __construct() {
                //content to database 
                //$this->db = new mysqli("localhost", "momentfyra", "password", "momentfyra");
                
                $this->db = new mysqli('studentmysql.miun.se', 'emho2003', 'b@@d5XVfZG', 'emho2003');
                
                
                if($this->db->connect_errno > 0) {
                   die("Fel vid anslutning: " . $this->db->connect_error);
                }
            }

            //add comments
            public function addComments($comment, $userID, $postID, $writer) : bool {
                $sql = "INSERT INTO comments(comment, userID, postID, writer)VALUES('$comment', '$userID', '$postID', '$writer');";
                $result = mysqli_query($this->db, $sql);
                return $result;
            }

            //Get comments
            public function getComments($postID) {
                $sql = "SELECT * FROM comments WHERE postID='$postID' ORDER BY postdate DESC";
                $result = mysqli_query($this->db, $sql);
                
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    return false;
                }
            }

            public function getUsersComments($userID) {
                $sql = "SELECT * FROM comments WHERE userID='$userID' ORDER BY postdate DESC";
                $result = mysqli_query($this->db, $sql);
                
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    return false;
                }
            }

            public function getAllComment() {
                $sql = "SELECT * FROM comments ORDER BY postdate DESC";
                $result = mysqli_query($this->db, $sql);
                return $result;
            }




            //Uses on admin page
            public function existComment($commentID) : bool {
                $sql = "SELECT commentID FROM comments WHERE commentID='$commentID'";
                $result = mysqli_query($this->db, $sql);

                if ($result->num_rows > 0) {
                    return true;
                } else {
                    return false;
                }
            }
            public function existCommentWithUser($commentID, $userID) : bool {
                $sql = "SELECT commentID FROM comments WHERE commentID='$commentID' AND userID='$userID'";
                $result = mysqli_query($this->db, $sql);

                if ($result->num_rows > 0) {
                    return true;
                } else {
                    return false;
                }
            }



            //Används till när man tar bort inlägg
            public function deleteComment($postID) : bool {
                $sql = "DELETE FROM comments WHERE postID='$postID'";
                $result = mysqli_query($this->db, $sql);
                return $result;
            }

            //För att ta bort EN specifik kommentar
            public function deleteSpecificComment($commentID, $userID) : bool {
                $sql = "DELETE FROM comments WHERE commentID='$commentID' AND userID='$userID'";
                $result = mysqli_query($this->db, $sql);
                return $result;
            }

            //För att ta bort alla kommentarer från en specifik användare, används när konto tas bort
            public function deleteUserIDComments($userID) : bool {
                $sql = "DELETE FROM comments WHERE userID='$userID'";
                $result = mysqli_query($this->db, $sql);
                return $result;
            }




            //Sett
            public function setComment(string $comment) : bool {
                if(str_word_count($comment) < 50) {
                    $this->comment = $comment;
                    return true;
                } else {
                    return false;
                }
            }
            public function setCommentTwo (string $comment) : bool {
                if(strlen($comment) > 1) {
                    $this->comment = $comment;
                    return true;
                } else {
                    return false;
                }
            }

        }