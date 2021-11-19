<?php $pageTitle = "Information, vanliga frågor och kundtjänst"; ?>
<?php $activePage = basename($_SERVER["SCRIPT_FILENAME"]); ?>
<?php include("includes/header.php"); ?>

<main>
    <div class="iconHeader">
            <img src="images/iconInfoGrey.png" alt="">
            <h1>Information</h1>
    </div>
    <p style="margin-top: -1em;">
        Nedan finner du svar på de vanligaste och mest frågade 
        frågorna just nu. Kika på dem innan för underlätta för kundtjänst,
        hittar ni inte svar på din fråga kan du ringa eller skriva direkt till våran kundtjänst. 
    </p>

    <nav class="infoNavBtns">
        <button class="normalBtn" onclick="window.location.href='#questions'"> 
            <img src="images/iconQue.png" alt="">
            Vanliga frågor
        </button>
        <button class="normalBtn removeBtn" onclick="window.location.href='#support'"> 
            <img src="images/iconSupport.png" alt="">
            Kundtjänst
        </button>
        <button class="normalBtn" onclick="window.location.href='#contactForm'"> 
            <img src="images/iconLetterGrey.png" alt="">
            Skriv till oss
        </button>
    </nav>



    <section id="questions">
        <h2 class="infoHeadings">Vanliga frågor</h2>

        <ul style="list-style: none;" aria-label="Vanliga frågor">
            <li>
                <!-- Collapse box -->
                <div class="collapsibleBox">

                    <!--Question and js "btn" to display answer-->
                    <div class="collBtn" aria-expanded="false" role="button" aria-controls="que2" title="Tryck för se svar"> 
                            
                        <button class="removeBtnStyle"> 
                            Vad är Färdtjänst Väst?
                        </button>

                        <!-- Img box thru Css  -->
                        <div class="collImgBox"></div> 
                    
                    </div>

                    <!--Answer-->
                    <article class="collDrop" id="que2" role="region">
                        <p>
                            Färdtjänst Väst är en extra <strong> tillgänglighets anpassad bokningstjänst för färdtjänstresor </strong>.
                            Färdtjänst Väst är en del av Västtrafik och Västra Götalandsregionen samarbetet.
                        </p>
                    </article>
                </div>
            </li>

            <li>
                <!-- Collapse box -->
                <div class="collapsibleBox">

                    <!--Question and js "btn" to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que1"> 
                        
                        <button class="removeBtnStyle">
                            Hur länge är man beviljad färdtjänst?
                        </button>

                        <!-- Img box thru Css  -->
                        <button class="collImgBox"></button>
                    </div>


                    <!--Answer-->
                    <article class="collDrop" id="que1" role="region">
                        <p> 
                            Inom Västra Götalnadsregionen är vanligast att man beviljas <strong> tre månader </strong> i taget, 
                            men det finns också tillstånd för <strong> en viss period eller tillsvidare </strong> efter individuell prövning och 
                            kan återkallas. 
                        </p>
                    </article>
                </div>
            </li>
            <li>
                <!-- Collapse box -->
                <div class="collapsibleBox">

                    <!--Question and js "btn" to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que2"> 
                        <button class="removeBtnStyle">
                            Vem har rätt till färdtjänst? Hur får jag färdtjänst?
                        </button>

                        <!-- Img box thru Css  -->
                        <button class="collImgBox"></button>

                    </div>

                    <!--Answer-->
                    <article class="collDrop" id="que2" role="region">
                        <p>
                            Det är <strong> komunnen som ansvara </strong> och bestämer om färdtjänst, vilket kan skilja lite inom 
                            olika kommuner om vem som har rätt till Färdtjänst och hur man ansöker. <strong> Kolla 
                                med din kommun </strong>. 
                        </p>
                    </article>
                </div>
            </li>

            <li>
                <!-- Collapse box -->
                <div class="collapsibleBox">

                    <!--Question and js "btn" to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que3"> 
                        <button class="removeBtnStyle">
                            Vad kostar det att åka färdtjänst?
                        </button>

                        <!-- Img box thru Css  -->
                        <button class="collImgBox"></button>
                    
                    </div>

                    <!--Answer-->
                    <article class="collDrop" id="que3" role="region">
                        <p>
                            Det beror på vilken typ av resa du ska göra, hur gammal du är och hur många kommuner du ska åka igenom. 
                            Vanliga privata resor kan du <strong>kolla på västtrafiks priser 
                                <a href="https://www.amal.se/omsorg-och-stod/funktionsvariationer/fardtjanst/">här</a> </strong>. 
                            Resor som har med sjukhusvistelse går att ansöka reseersättning för efter resan. 
                        </p>
                    </article>
                </div>
            </li>
            <li>
                <!-- Collapse box -->
                <div class="collapsibleBox">

                    <!--Question and js "btn" to display answer-->
                    <div class="collBtn" aria-expanded="false" role="button" aria-controls="que2" title="Tryck för se svar"> 
                            
                        <button class="removeBtnStyle">
                            Hur tätt inpå resan kan jag boka?
                        </button>

                        <!-- Img box thru Css  -->
                        <button class="collImgBox"></button>
                    
                    </div>

                    <!--Answer-->
                    <article class="collDrop" id="que2" role="region">
                        <p>
                            Du kan boka <strong>30 minuter innan</strong> resans avgång. Skulle du boka närmare inpå
                            kommer systemet ändå registera 30 minuter. 
                        </p>
                    </article>
                </div>
            </li>
            <li>
                <!-- Collapse box -->
                <div class="collapsibleBox">

                    <!--Question and js "btn" to display answer-->
                    <div class="collBtn" aria-expanded="false" role="button" aria-controls="que2" title="Tryck för se svar"> 
                            
                        <button class="removeBtnStyle">
                            När jag jag ändra och avboka en resa?
                        </button>

                        <!-- Img box thru Css  -->
                        <button class="collImgBox"></button>
                    
                    </div>

                    <!--Answer-->
                    <article class="collDrop" id="que2" role="region">
                        <p>
                            Du kan ändra och avboka en resa <strong>30 minuter innan</strong> resans avgång. 
                            <strong>Sedan försvinner möjligheten </strong> 
                            hos Färdtjänst Väst att ändra och avboka. 
                        </p>
                    </article>
                </div>
            </li>
            <li>
                <!-- Collapse box -->
                <div class="collapsibleBox">

                    <!--Question and js "btn" to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que4"> 
                        <button class="removeBtnStyle">
                            Jag är sjuk med förkylningssymtom. Får jag åka färdtjänst eller sjukresa?
                        </button>

                        <!-- Img box thru Css  -->
                        <button class="collImgBox"></button>
                    
                    </div>

                    <!--Answer-->
                    <article class="collDrop" id="que4" role="region">
                        <p>Nej, det får du inte. Finns det en risk att du smittar så får du inte åka med färdtjänst eller sjukresor. Samma sak gäller om det är konstaterat att du bär på Covid-19</p>
                    </article>
                </div>
            </li>
            <li>
                <!-- Collapse box -->
                <div class="collapsibleBox">

                    <!--Question and js "btn" to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que4"> 
                        <button class="removeBtnStyle">
                            Vad är en återkommande resa?
                        </button>

                        <!-- Img box thru Css  -->
                        <button class="collImgBox"></button>
                    
                    </div>

                    <!--Answer-->
                    <article class="collDrop" id="que4" role="region">
                        <p>
                            Om du vet att <strong> resan du bokar kommer att upprepas, kan du boka alla biljeter på en gång </strong>. 
                            Att tänka på när du bokar en återkommande resa, bokar du enskilda biljeter för varje enskilda åk-tillfälle. 
                            Därför rekommenderar vi att du bokar max 10 återkommande resor åt gången.  
                        </p>
                    </article>
                </div>
            </li>
            <li class="anchor">
                <!-- Collapse box -->
                <div class="collapsibleBox" id="forgetPassword">

                    <!--Question and js "btn" to display answer-->
                    <div  class="collBtn" aria-expanded="false" aria-controls="que5"> 
                        <button class="removeBtnStyle">
                            Jag har glömt bort mitt lösenord, vad gör jag?
                        </button>

                        <!-- Img box thru Css  -->
                        <button class="collImgBox"></button>
                    
                    </div>

                    <!--Answer-->
                    <article class="collDrop" id="que5" role="region">
                        <p>
                            Om du har glömt ditt lösenord kan du antingne kontakta <strong> Färdstjänst Väst 
                            kundtjänst </strong>  på numret: <a href="tel:073456789">073 456 78 9 </a> eller <strong>din 
                            kommun</strong>.
                        </p>
                    </article>
                </div>
            </li>
            
        </ul>

    </section>  


    <section id="support">
        <h2 class="infoHeadings">Support</h2>
        
        <div class="supportFlex">
            <div>
                <a href="tel:073456789">
                    <img src="images/iconPhone.png" alt="">
                </a>
            </div>
            <div>
                <p>
                    Telefon: <a href="tel:073456789">073 456 78 9 </a> <br>
                </p>
            </div>
        </div>
        
        <br>
        <br>

        <h2>Supporten är öppen mellan</h2>
        <p>
            Öppet mellan: <br>
            Mån-tos 09.00 - 16.00<br>
            Fre 09.00-14.30<br>
            <br>
            Lunchstängt 12.30-13.30
        </p>

    </section>

    <section id="contactForm">
        <h2 class="infoHeadings">Skriv till oss</h2>
        <p>Om du har några funderingar kan du skriva ett mail till oss. Vanlig svars tid är mellan 1-3 arbetsdagar, 
            viktiga ärnden och sekretsärenden hänvisas till kundtjänst via telefon. </p>

        <div class="supportFlex">
            <div>
                <a href="mailto:someone@example.com">
                    <img src="images/iconLetter.png" alt="">
                </a>
            </div>
            <div>
                <p>
                    E-post: <a href="mailto:someone@example.com">someone@example.com </a> <br>
                </p>
            </div>
        </div>

        <br>
        <br>
        <?php 
    
        ?>
        <form method="POST" class="contactForm" >
            
            <fieldset>
                <legend>Dina uppgifter</legend>
                <label for="fname"> Ditt namn </label>
                <input type="text" id="fname" name="fname" placeholder="För- och efternamn">

                <label for="email"> Din email </label>
                <input type="email" id="email" name="email" placeholder="En e-post">
            </fieldset>
                
            <fieldset>
                <legend>Meddelande</legend>

                <label for="title"> Rubrik </label>
                <input type="text" id="title" name="title" placeholder="En passande rubrik">

                <label for="message">Meddelande</label>
                <textarea name="message" id="message"></textarea>

                <input type="checkbox" id="sendCopy" name="sendCopy" value="sendCopy">
                <label for="sendCopy" class="toolFormStyle"> Skicka mig en kopia </label>
            </fieldset>

            <input type="submit" value="Skicka">
        </form>
 
    </section>

    <p class="updateText">Denna webbsidan uppdaterades senast 2021-06-06</p>

 </main>

<!-- JS for open and close -->
<script src="javascript/collapsible.js"></script>

<?php include("includes/footer.php"); ?>