<?php 

class StoreTasks {

    //Properties 
    private $task;
    private $color;
    private $deadline;
    private $info;

    //Constructor 
    function __construct() {

        if(file_exists("todolist.json")) {

            $this->info = json_decode(file_get_contents("todolist.json"));
        
        } else {
            $this->info = [];
        }
    }


    //Saving task
    public function saveInfo() : bool {
        if (isset($this->task) || isset($this->color) || isset($this->deadline)) {

            //Gather info
            $data['task'] = $this->task;
            $data['color'] = $this->color;
            $data['deadline'] = $this->deadline;

            
            //Add to array
            array_push($this->info, $data);

            //Convert to JSON
            $jsonData = json_encode($this->info, JSON_PRETTY_PRINT);

            //Save to json file
            if(file_put_contents("todolist.json", $jsonData)) {
                return true;
            } else {
                return false;
            }


        } else {
            return false;
        }

    }



    //Get task infromation as array
    public function getInfo() : array {
        return $this->info;
    }



    //delete individual task
    public function deleteTask(int $taskNbr) : bool {

        if(isset($_GET['taskNbr'])) {
            $taskNbr = intval($_GET['taskNbr']);

            unset($this->info[$taskNbr]);
            $this->info = array_values($this->info);

            //Convert to JSON
            $jsonData = json_encode($this->info, JSON_PRETTY_PRINT);

            //Save to json file
            if(file_put_contents("todolist.json", $jsonData)) {
                return true;
            } else {
                return false;
            }

        }   else {
            return false; 
        }
    } 


    //delete all tasks
    public function deleteAllTasks(int $removeAll) : bool {

        if(isset($_GET['removeAll'])) {
            
            //Remove task from array 0 (which is all)
            array_splice($this->info, 0);
            $this->info = array_values($this->info);

            //Convert to JSON
            $jsonData = json_encode($this->info, JSON_PRETTY_PRINT);


            //Save to json file
            if(file_put_contents("todolist.json", $jsonData)) {
                return true;
            } else {
                return false;
            }

        }   else {
            return false;
        }
    }



    //Give conditions
    public function setTask(string $task) : bool {
        if (strlen($task) > 4) {
            $this->task = $task;
            return true;
        } else {
            return false;
        }
    }

    public function setColor(string $color) : bool {
        if(strlen($color) > 0) {
            $this->color = $color;
            return true;
        } else {
            return false;
        }
    }

    //If users dont want a date, set date to empty string instead of null
    public function setDeadline(string $deadline) : bool {
        if(strlen($deadline) != null) {
            $this->deadline = $deadline;
            return true;
        } else {
            $this->deadline = "";
            return false;
        }
    }




    //Get individual task info
    public function getTask() : string {
        return $this->task;
    }

    public function getColor() : string {
        return $this->color;
    }

    public function getDeadline() : string {
        return $this->deadline;
    }
}