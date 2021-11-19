<?php $pageTitle = "Boka resa"; ?>
<?php $activePage = basename($_SERVER["SCRIPT_FILENAME"]); ?>
<?php include("includes/header.php"); ?>


<main> 

    <div class="iconHeader">
            <img src="images/iconCarGrey.png" alt="">
            <h1>Ändra resa</h1>
    </div>
    
    <div class="bookingTopBox">

        <div class="yellowBookingBox">
            <img src="images/iconWarning.png" alt="">
            <h2>
                Att tänka på när du ändrar din bokade resa: 
            </h2>
        </div>
      
        <ul>
            <li>Du behöver ändas ändra de uppgfiter du vill ändra</li>
            <li>Mer information om färdtjänst hittar du <a href="info.php">här</a></li>
        </ul>

    </div>

    <form class="rebookForm" action="bookConfirm.php">

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

            <div>

                <!-- A Question -->
                <div class="collapsibleBox collapsibleBox_NoBorder">

                    <!--Question-->
                    <!--JS btn to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                        <div>
                            <button type="button" class="collText">
                                Drottninggatan, till Torggatan den 11 maj 12.30
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
                                <input placeholder="0" type="number" id="returnTripFrom_nbr" name="returnTripFrom_nbr" min="1">
                            </div>
                        </div>


                        <div class="formQuarter">
                            <div>
                                <label for="returnTripTo_street"> Till </label> <br>
                                <input type="text" id="returnTripTo_street" name="returnTripTo_street" list="addresslist">
                            </div>

                            <div>
                                <label for="returnTripTo_nbr"> Gatu nr. </label> <br>
                                <input placeholder="0" type="number" id="returnTripTo_nbr" name="returnTripTo_nbr" min="1">
                            </div>
                        </div>


                        <!-- Date and time -->
                        <div class="formQuarter">
                            <div>
                                <label for="tripDate"> Datum </label> <br>
                                <input type="date" id="tripDate" name="tripDate" min="2021-06-01" max="2021-09-30" />
                            </div>
                            <div>
                                <label for="tripTime"> Tid </label> <br>
                                <input type="time" id="tripTime" name="tripTime"/>
                            </div>
                        </div>           
                    </div>

                </div>

            </div>

        </fieldset>

        <fieldset>
            <legend>Hjälpmedel</legend>

            <div id="return">

                <!-- A Question -->
                <div class="collapsibleBox collapsibleBox_NoBorder">

                    <!--Question-->
                    <!--JS btn to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                        <div>
                            <button type="button" class="collText">
                                Rullator, svårt att röra på sig
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
                    </div> <!-- end collDrop/answer -->

                </div> <!-- end collapsibleBox -->

            </div> <!-- end sectionsBoxesFromSmall -->

        </fieldset>


        <fieldset>
            <legend>Sällskap</legend>

            <div id="return">

                <!-- A Question -->
                <div class="collapsibleBox collapsibleBox_NoBorder">

                    <!--Question-->
                    <!--JS btn to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                        <div>
                            <button type="button" class="collText">
                                Inget
                            </button>

                        </div>

                        <!-- Img box thru Css  -->
                        <div class="collImgBox"></div>
                    
                    </div>

                    <!--Answer-->
                    <div class="collDrop">
                        <input placeholder="0" type="number" id="quantity_adult" name="quantity_adult" min="0" max="5">
                        <label for="quantity_adult"> Antal vuxna </label> <p>
                        <br>
                        <input placeholder="0" type="number" id="quantity_child" name="quantity_child" min="0" max="5">
                        <label for="quantity_child"> Antal barn eller ungdomar </label>
                        <br>
                        <input placeholder="0" type="number" id="quantity_baby" name="quantity_baby" min="0" max="2">
                        <label for="quantity_baby"> Antal barn under 3 år </label>

                        
                    </div> <!-- end collDrop/answer -->

                </div> <!-- end collapsibleBox -->

            </div> <!-- end sectionsBoxesFromSmall -->

        </fieldset>
       
        <input type="submit" value="Bekräfta resan" >

    </form>
</main>


<!-- JS for open and close -->
<script src="javascript/collapsible.js"></script>


<?php include("includes/footer.php"); ?>

