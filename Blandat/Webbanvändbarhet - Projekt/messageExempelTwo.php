<?php $pageTitle = "Boka resa"; ?>
<?php $activePage = basename($_SERVER["SCRIPT_FILENAME"]); ?>
<?php include("includes/header.php"); ?>

<main> 

    <h1>Kommande resor</h1>

    <section>
        <h2 class="infoHeadings">Kommande 7 dagarna</h2>

        <div class="collapsibleBox collTiny">

            <!--Question and js "btn" to display answer-->
            <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                <div>
                    <button class="removeBtnStyle">
                        8 juni, klockan 20.30 <br> Till Drottninggatan Åmål
                    </button>
                </div>

                <!-- Img box thru Css  -->
                <div class="collImgBox"></div>

            </div>   

            <!--To display-->
            <div class="collDrop">
                <p>
                <p>
                    <b>Till</b>: Drottninggatan 22, Åmål <br>
                    <b>Från:</b> Schölinsgatan 2, Åmål <br>
                    <br>
                    <b>Upphämtning:</b> 20.30 söndag den 8 juni <br>
                    <br>
                    <b>Hjälpmedel:</b> Ledhund <br>
                    <b>Resesällskap:</b> Ingen <br>
                    <br>
                </p>
                </p>
            
                <button class="cancelBtn" onclick="window.location.href='messageExempel.php'" >Avboka</button>
                <button class="rebookBtn" onclick="window.location.href='bookRebook.php'" >Omboka</button>
            </div>
        </div>


        <div class="collapsibleBox collTiny">

            <!--Question and js "btn" to display answer-->
            <div  class="collBtn collBtn_noBold" aria-expanded="false" aria-controls="que1"> 
                <div>
                    <button class="removeBtnStyle">
                        12 Juni, klockan 13.00 <br> Till Drottninggatan,  Åmål
                    </button>
                </div>

                <!-- Img box thru Css  -->
                <div class="collImgBox"></div>

            </div>   

            <!--To display-->
            <div class="collDrop">
                <p>
                    <b>Till</b>: Drottninggatan 22, Åmål <br>
                    <b>Från:</b> Schölinsgatan 2, Åmål <br>
                    <br>
                    <b>Upphämtning:</b> 20.30 söndag den 8 juni <br>
                    <br>
                    <b>Hjälpmedel:</b> Ledhund <br>
                    <b>Resesällskap:</b> Ingen <br>
                    <br>
                </p>
            
                <button class="cancelBtn" onclick="window.location.href='alertMessageExempel.php'" >Avboka</button>
                <button class="rebookBtn" onclick="window.location.href='bookRebook.php'" >Omboka</button>
            </div>
        </div>
        
        
        <div class="collapsibleBox collTiny">

            <!--Question and js "btn" to display answer-->
            <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                <div>
                    <button class="removeBtnStyle">
                        8 juni, klockan 20.30 <br> Till Drottninggatan, Åmål
                    </button>
                </div>

                <!-- Img box thru Css  -->
                <div class="collImgBox"></div>

            </div>   

            <!--To display-->
            <div class="collDrop">
                <p>
                    <b>Till</b>: Drottninggatan 22, Åmål <br>
                    <b>Från:</b> Schölinsgatan 2, Åmål <br>
                    <br>
                    <b>Upphämtning:</b> 20.30 söndag den 8 juni <br>
                    <br>
                    <b>Hjälpmedel:</b> Ledhund <br>
                    <b>Resesällskap:</b> Ingen <br>
                    <br>
                </p>
            
                <button class="cancelBtn" onclick="window.location.href='alertMessageExempel.php'" >Avboka</button>
                <button class="rebookBtn" onclick="window.location.href='bookRebook.php'" >Omboka</button>
            </div>
        </div>


    </section>

   


    <section>
        <h2 class="infoHeadings">Resor längre fram</h2>

        <div class="collapsibleBox collTiny">

            <!--Question and js "btn" to display answer-->
            <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                <div>
                    <button class="removeBtnStyle">
                        16 juni, klockan 12.30 <br> Till Hamngatan, Göteborg
                    </button>
                </div>

                <!-- Img box thru Css  -->
                <div class="collImgBox"></div>

            </div>   

            <!--To display-->
            <div class="collDrop">
                <p>
                    <b>Till</b>: Drottninggatan 22, Åmål <br>
                    <b>Från:</b> Schölinsgatan 2, Åmål <br>
                    <br>
                    <b>Upphämtning:</b> 20.30 söndag den 8 juni <br>
                    <br>
                    <b>Hjälpmedel:</b> Ledhund <br>
                    <b>Resesällskap:</b> Ingen <br>
                    <br>
                </p>
            
                <button class="cancelBtn" onclick="window.location.href='alertMessageExempel.php'" >Avboka</button>
                <button class="rebookBtn" onclick="window.location.href='bookRebook.php'" >Omboka</button>
            </div>
        </div>
        
        <div class="collapsibleBox collTiny">

            <!--Question and js "btn" to display answer-->
            <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                <div>
                    <button class="removeBtnStyle">
                        17 juni, klockan 11.00 <br> Till Drottninggatan, Göteborg
                    </button>
                </div>

                <!-- Img box thru Css  -->
                <div class="collImgBox"></div>

            </div>   

            <!--To display-->
            <div class="collDrop">
                <p>
                    <b>Till</b>: Drottninggatan 22, Åmål <br>
                    <b>Från:</b> Schölinsgatan 2, Åmål <br>
                    <br>
                    <b>Upphämtning:</b> 20.30 söndag den 8 juni <br>
                    <br>
                    <b>Hjälpmedel:</b> Ledhund <br>
                    <b>Resesällskap:</b> Ingen <br>
                    <br>
                </p>
            
                <button class="cancelBtn" onclick="window.location.href='alertMessageExempel.php'" >Avboka</button>
                <button class="rebookBtn" onclick="window.location.href='bookRebook.php'" >Omboka</button>
            </div>
        </div>        

        <div class="collapsibleBox collTiny">

            <!--Question and js "btn" to display answer-->
            <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                <div>
                    <button class="removeBtnStyle">
                        20 juni, klockan 16.45 <br> Till Drottninggatan, Åmål
                    </button>
                </div>

                <!-- Img box thru Css  -->
                <div class="collImgBox"></div>

            </div>   

            <!--To display-->
            <div class="collDrop">
                <p>
                    <b>Till</b>: Drottninggatan 22, Åmål <br>
                    <b>Från:</b> Schölinsgatan 2, Åmål <br>
                    <br>
                    <b>Upphämtning:</b> 20.30 söndag den 8 juni <br>
                    <br>
                    <b>Hjälpmedel:</b> Ledhund <br>
                    <b>Resesällskap:</b> Ingen <br>
                    <br>
                </p>
            
                <button class="cancelBtn" onclick="window.location.href='alertMessageExempel.php'" >Avboka</button>
                <button class="rebookBtn" onclick="window.location.href='bookRebook.php'" >Omboka</button>
            </div>
        </div>

        <div class="collapsibleBox collTiny">

            <!--Question and js "btn" to display answer-->
            <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                <div>
                    <button class="removeBtnStyle">
                        23 juni, klockan 14.00 <br> Till Tössegatan, Åmål
                    </button>
                </div>

                <!-- Img box thru Css  -->
                <div class="collImgBox"></div>
                    
            </div>   

            <!--To display-->
            <div class="collDrop">
                <p>
                    <b>Till</b>: Drottninggatan 22, Åmål <br>
                    <b>Från:</b> Schölinsgatan 2, Åmål <br>
                    <br>
                    <b>Upphämtning:</b> 20.30 söndag den 8 juni <br>
                    <br>
                    <b>Hjälpmedel:</b> Ledhund <br>
                    <b>Resesällskap:</b> Ingen <br>
                    <br>
                </p>
            
                <button class="cancelBtn" onclick="window.location.href='alertMessageExempel.php'" >Avboka</button>
                <button class="rebookBtn" onclick="window.location.href='bookRebook.php'" >Omboka</button>
            </div>
        </div>        


    </section>

</main>

    <!-- alert message-->
    <div class="alertMessageBox alertMessageBoxGreen">
        <div>
            <img src="images/iconCorrect.png" alt="">
            <p class="alertMessages" id="alertMessages">Din resa är nu avbokad!</p>
        </div>
        <br>
        <button class="alertBtn alertBtnGreen" style="max-width: 400px;" onclick="window.location.href='profileFutureBooking.php'">Tillbaka till kommande resor</button>
    </div>

<!-- Btn back tp profile -->
<button class="backBtn" onclick="window.location.href='profile.php'"> &#129064; Tillbaka</button>

<!-- JS for open and close -->
<script src="javascript/collapsible.js"></script>


<?php include("includes/footer.php"); ?>