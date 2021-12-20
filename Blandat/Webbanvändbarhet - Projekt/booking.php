<?php $pageTitle = "Boka resa"; ?>
<?php $activePage = basename($_SERVER["SCRIPT_FILENAME"]); ?>
<?php include("includes/header.php"); ?>

<main> 
    <div class="iconHeader">
            <img src="images/iconCarGrey.png" alt="">
            <h1>Boka resa</h1>
    </div>

    <div class="bookingTopBox">

        <div class="yellowBookingBox">
            <img src="images/iconWarning.png" alt="">
            <h2>
                Att tänka på när du bokar din resa: 
            </h2>
        </div>
      
            <ul>
                <li>Dubbel kolla alltid din information</li>
                <li>Ändringar av resan går att göra i efterhand under <br> min sida &#8594; bokade resor</li>
                <li>Du kan ändas boka resor för 3 månader framåt </li>
                <li>Resan betalas hos chauffören</li>
                <li>Priser hittar du på din kommuns hemsida eller via västtrafik</li>
                <li>Du kan scrolla, använda pilarna på både boxen och tagentbordet samt skriva in siffrorna när du väljer
                    gatuadress, resesällskap och upprepning intervall. 
                </li>

                <li>Mer information om färdtjänst hittar du under <a href="info.php" title="Till Info">info sidan</a></li>
            </ul>

    </div>


    <form class="bookingForm" id="bookingForm" action="bookConfirm.php">

        <datalist id="addresslist">
            <option> Kungsgatan, Göteborg </option>
            <option> Hamngatan, Göteborg </option>
            <option> Stora gatan, Göteborg </option>

            <option> Domstolsgatan, Vänersborg </option>
            <option> Drottninggatan, Vänersborg </option>

            <option> Drottninggatan, Åmål </option>
            <option> Kungsgatan, Åmål </option>
            <option> Kyrkogatan, Åmål </option>
            <option> Schölinsgatan, Åmål </option>
            <option> Torggatan, Åmål </option>
            <option> Tössegatan, Åmål </option>
        </datalist>
        
            <fieldset>
                <legend>Resväg</legend>

                <!-- Address from -->
                <div class="formQuarter">
                    <div>
                        <label for="tripFrom_street"> Från </label> <br>
                        <input type="text" id="tripFrom_street" name="tripFrom_street" list="addresslist" > 
                    </div>

                    <div>
                        <label for="tripFrom_nbr"> Gatu nr. </label> <br>
                        <input placeholder="0" type="number" id="tripFrom_nbr" name="tripFrom_nbr" min="1">
                    </div>
                </div>
            
                <!-- Address to -->
                <div class="formQuarter">
                    <div>
                        <label for="tripTo_street"> Till </label> <br>
                        <input type="text" id="tripTo_street" name="tripTo_street" list="addresslist" >
                    </div>

                    <div>
                        <label for="tripTo_nbr"> Gatu nr. </label> <br>
                        <input placeholder="0" type="number" id="tripTo_nbr" name="tripTo_nbr" min="1">
                    </div>
                </div>

                <!-- Date and time -->
                <div class="formQuarter">
                   
                </div>
                
            </fieldset>

            <fieldset>
                <!-- A Question -->
                <div class="collapsibleBox">

                    <!--Question and js "btn" to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                        <div>
                            <button type="button" class="removeBtnStyle">
                                Boka återresa
                            </button>
                        </div>

                        <!-- Img box thru Css  -->
                        <div class="collImgBox"></div>
                    
                    </div>   
                    
                    <!--Answer-->
                    <div class="collDrop">

                        <div class="formQuarter">

                            <div>
                                <label for="returnTripFrom_street"> Från </label> <br>
                                <input type="text" id="returnTripFrom_street" name="returnTripFrom_street" list="addresslist"> 
                            </div>

                            <div>
                                <label for="returnTripFrom_nbr"> Gatu nr. </label> <br>
                                <input placeholder="0" type="number" id="returnTripFrom_nbr" name="returnTripFrom_nbr" min="0" max="5">
                            </div>
                        </div>


                        <div class="formQuarter">
                            <div>
                                <label for="returnTripTo_street"> Till </label> <br>
                                <input type="text" id="returnTripTo_street" name="returnTripTo_street" list="addresslist">
                            </div>

                            <div>
                                <label for="returnTripTo_nbr"> Gatu nr. </label> <br>
                                <input placeholder="0" type="number" id="returnTripTo_nbr" name="returnTripTo_nbr" min="0" max="5">
                            </div>
                        </div>


                        <!-- Date and time -->
                        <div class="formQuarter">
                            <div>
                                <label for="returnTripTo_tripDate"> Datum </label> <br>
                                <input type="date" id="returnTripTo_tripDate" name="returnTripTo_tripDate" min="2021-06-01" max="2021-09-30" />
                            </div>
                            <div>
                                <label for="returnTripTo_tripTime"> Tid </label> <br>
                                <input type="time" id="returnTripTo_tripTime" name="returnTripTo_tripTime"/>
                            </div>
                        </div>          
                    </div>
                </div>
            </fieldset>


            <fieldset>
                <!-- A Question -->
                <div class="collapsibleBox">

                    <!--Question and js "btn" to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                        <button type="button" class="removeBtnStyle">
                            Återkommande resa
                        </button>

                        <!-- Img box thru Css  -->
                        <div class="collImgBox"></div>
                    
                    </div>      

                    <!--Answer-->
                    <div class="collDrop">

                    <div class="formQuarter_reverse">
                        <div> 
                            <label for="recurrentDays"> Upprepa </label> <br>
                            <input placeholder="0" type="number" id="recurrentDays" name="recurrentDays" min="0" max="14">
                        </div>
                        
                        <div>
                            <label for="pinapple">Dag, vecka elle månad</label>
                            <select id="pinapple" name="pinapple">
                                <option value="days">Dagar</option>
                                <option value="weeks">Veckor</option>
                                <option value="months">Månader</option>
                            </select>
                        </div>
                    </div>
                       
                        <p><b>För veckodagarna:<b></p>
                        <div class="">
                            <input type="checkbox" id="weekday-mon" class="weekday" />
                            <label for="weekday-mon">Måndag</label>
                            <br>
                            <input type="checkbox" id="weekday-tue" class="weekday" />
                            <label for="weekday-tue">Tisdag</label>
                            <br>
                            <input type="checkbox" id="weekday-wed" class="weekday" />
                            <label for="weekday-wed">Onsdag</label>
                            <br>
                            <input type="checkbox" id="weekday-thu" class="weekday" />
                            <label for="weekday-thu">Torsdag</label>
                            <br>
                            <input type="checkbox" id="weekday-fri" class="weekday" />
                            <label for="weekday-fri">Fredag</label>
                            <br>
                            <input type="checkbox" id="weekday-sat" class="weekday" />
                            <label for="weekday-sat">Lördag</label>
                            <br>
                            <input type="checkbox" id="weekday-sun" name="weekday-sun" class="weekday" />
                            <label for="weekday-sun">Sönsdag</label>
                        </div>

                    </div>
                </div>
            </fieldset>


            <fieldset>
                 <!-- A Question -->
                <div class="collapsibleBox">

                    <!--Question and js "btn" to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                        <div>
                            <button type="button" class="removeBtnStyle">
                                Hjälpmedel
                            </button>
                        </div>

                        <!-- Img box thru Css  -->
                        <div class="collImgBox"></div>
                    
                    </div>                    

                    <!--Answer-->
                    <div class="collDrop">

                        <input type="checkbox" id="toolHelp_dog" name="toolHelp_dog" value="dog">
                        <label for="toolHelp_dog" class="toolFormStyle"> Ledhund </label>

                        <br>

                        <input type="checkbox" id="toolHelp_walker" name="toolHelp_walker" value="walker">
                        <label for="toolHelp_walker" class="toolFormStyle"> Rullator </label>
                       
                        <br>

                        <input type="checkbox" id="toolHelp_wheelchair" name="toolHelp_wheelchair" value="wheelchair">
                        <label for="toolHelp_wheelchair" class="toolFormStyle"> Rullstol </label>


                        <br>

                        <input type="checkbox" id="toolHelp_escorts" name="toolHelp_escorts" value="escorts">
                        <label for="toolHelp_escorts" class="toolFormStyle"> Sagledare </label>
                        
                        <br>

                        <label for="toolHelpOther"> Annat hjälpmedel: </label> <br>
                        <input type="text" id="toolHelpOther" name="toolHelpOther">    

                    </div>
                </div>
            </fieldset>


            <fieldset>
                 <!-- A Question -->
                <div class="collapsibleBox">

                    <!--Question and js "btn" to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                        <div>
                            <button type="button" class="removeBtnStyle">
                                Resesällskap
                            </button>
                        </div>

                        <!-- Img box thru Css  -->
                        <div class="collImgBox"></div>
                    
                    </div>

                    <!--Answer-->
                    <div class="collDrop">
                        <div class="inputNumberResponsiveness">
                            <input placeholder="0" type="number" id="quantity_adult" name="quantity_adult" min="1">
                            <label for="quantity_adult"> Antal vuxna </label>
                        </div>
                        
                        <div class="inputNumberResponsiveness">
                            <input placeholder="0" type="number" id="quantity_child" name="quantity_child" min="1">
                            <label for="quantity_child"> Antal barn eller ungdomar </label>
                        </div>

                        <div class="inputNumberResponsiveness">
                            <input placeholder="0" type="number" id="quantity_baby" name="quantity_baby" min="0" max="2">
                            <label for="quantity_baby"> Antal barn under 3 år </label>
                        </div>
                       
                    </div>
                </div>
            </fieldset>

            <input type="submit" value="Granska resan" >
    </form>
</main>

<!-- JS so user get message before leaving page -->
<script src="javascript/dontLeave.js"></script> 

<!-- JS for open and close -->
<script src="javascript/collapsible.js"></script>

<!-- Next step function -->
<script src="javascript/formScript.js"></script>

<?php include("includes/bodyEnd.php"); ?>

