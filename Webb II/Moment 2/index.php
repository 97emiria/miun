<?php   
$pageTitle = "Startsida";
include("includes/header.php"); 
include("includes/classes/StoreTasks.classes.php");
?>



<section id="addTasks">
    <div>

        <h2> Lägg till i listan </h2>

        <?php
            //Ger inmantingen från formuläret ett värde
            if (isset($_POST['task'])) {
                //Gather input data
                $task = $_POST['task'];
                $color = $_POST['color'];
                $deadline = $_POST['deadline'];
                
                //Check its atleast 5 character
                if (strlen($task) > 4) {

                //Creat new class
                $storeTask = new StoreTasks(); 
                
                //Save to class
                $storeTask->setTask($task);
                $storeTask->setColor($color);
                $storeTask->setDeadline($deadline);
                

                $storeTask->saveInfo();
                
                //Pretend same task add automatically and put task in url name
                header("Location: index.php?addedTask=" . $task);

                } else {
                    echo "<p style='color:red' class='message'> Fältet måste innehålla minst 5 tecken </p>";
                }
            }

            //If it exist a addedTask in url, a message will show
            if(isset($_GET['addedTask'])) { 
                echo "<p style='color:#44b848' class='message'> <strong>" . $_GET['addedTask'] . "</strong> är tillagd i listan </p>"; 
            }
        ?>


        <!--Form to sign tasks -->
        <form method="POST" action="index.php">

            <div class="first">
                <label for="task"> Lägg till: </label> <br>
                <input type="text" id="task" name="task" placeholder="Skriv här...">
            </div>

            <div class="second">
                <p> Färg kordinera dina taks: </p>
                <div class="radioBoxes">
                    <div style='background-color: #fff;'>
                        <label for="#fff">Vit</label>
                        <input type="radio" id="#fff" value="#fff" name="color" checked>
                    </div>

                    <div style='background-color: #fafa96;'>
                        <label for="#fafa96">Gul</label>
                        <input type="radio" id="#fafa96" value="#fafa96" name="color">
                    </div>

                    <div style='background-color: #7bd67e;'>
                        <label for="#7bd67e">Grön</label>
                        <input type="radio" id="#7bd67e" value="#7bd67e" name="color">
                    </div>
                    <div style='background-color: #ff6961;'>
                        <label for="#ff6961">Röd</label>
                        <input type="radio" id="#ff6961" value="#ff6961" name="color">
                    </div>
                    <div style='background-color: lightblue;'>
                        <label for="lightblue">Blå</label>
                        <input type="radio" id="lightblue" value="lightblue" name="color">
                    </div>
                    <div style='background-color: #ffb347 ;'>
                        <label for="#ffb347">Orange</label>
                        <input type="radio" id="#ffb347" value="#ffb347" name="color">
                    </div>
                </div>
            </div>

            <div class="third">
                <label for="deadline">Deadline:</label> <br>
                <input type="date" id="deadline" name="deadline" value="" min="2021-02-01">
            </div>

            <input type="submit" value="Lägg till">
        </form>
    </div>
</section>


<section id="taskList">
    <div>

        <!-- Task table to print out -->
        <h2> Att göra: </h2>
        <table>
            <thead>
                <tr>
                    <th>Klart</th>
                    <th>Task</th>
                    <th>Deadline</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                    $getInfo = new storeTasks();

                    //Check if a taskNbr is in url, if so it run function that deletes the task from array
                    if(isset($_GET['taskNbr'])) {
                        $taskNbr = intval($_GET['taskNbr']);
                        $getInfo->deleteTask($taskNbr);

                        header("Location: index.php#taskList");
                        die();
                    }
                    

                    $info = $getInfo->getInfo();
                    $taskNbr = 0;

                //Get info from JSON then loop throu it 
                foreach ( $info as $tasks) {
                    echo    "<tr style='background-color:" . $tasks->color . "'> 
                                <td> 
                                    <a href='index.php?taskNbr=$taskNbr'>
                                        <img src='images/delete.svg' class='deleteBtn' title='Radera uppdrag' alt='En fyrkant med ett kryss inuti'>
                                    </a>
                                </td>
                                <td>" . $tasks->task . "</td> 
                                <td>" . $tasks->deadline . "</td> 
                            </tr>";

                        $taskNbr++;
            }
                    //print_r($info);
                    

                ?>
            </tbody>
        </table>
    </div>

    <div id="removeAllTasks">
        <?php 

            //Check if url have removeAll, then run function that delete all tasks 
            if(isset($_GET['removeAll'])) {

                if ($info != null) {
                    $removeAll = intval($_GET['removeAll']);
                    $getInfo->deleteAllTasks($removeAll);

                    //Function dont refresh page so a message show that page need to be reloaded to see result
                    echo "<p style='color:red;' class='message'>  Din lista är nu raderad &#129497; Ladda om sidan 
                    <a href='index.php#taskList'>här</a> för att se resultatet 
                    </p>";
                } else {
                    echo "<p style='color:red;' class='message'> Det finns inget i listan att radera</p>";
                }
            }

        ?>
            <!-- Form solution-->
            <form method="Get" action="index.php#removeAllTasks">
            <input type="submit" id="removeAll" name="removeAll" class="button" value="Rensa alla task">
            </form>

        <!-- Button solution
            <button class="button" onclick="window.location.href='index.php?removeAll'"> Rensa alla task </button> -->
        </div> 

</section>





<?php $webpageUpdate = "2020/02/15"; include("includes/footer.php"); ?>