"use strict";

document.getElementById("shownumrows").style.display = "none"; // Radera denna rad för att visa antal träffar


/*This script is a radioplayer and schedule viewer from  Sveriges Radio, using their API
Creat of Emilia Holmström, made 2020-10-31 */




/*__________ Elements, buttons from HTML-document ______________________________________________________________________________*/

//Get elements to radio list and program schedule
let radioList = document.getElementById("mainnavlist");         //Ul list
let programScheduleBox = document.getElementById("info");       //Program schedule box

let radioPlayList = document.getElementById("playchannel");     //Select playchannel list 
let playBtn = document.getElementById("playbutton");            //Play button
/*_____________________________________________________________________________________________ HTLM-doc end ___________________*/






/*___________ Ajax call to Sveriges Radio _______________________________________________________________________________________*/

let xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        let jsonStr = JSON.parse(this.response);
        let channels = jsonStr.channels;

        printOutRadioList(channels);
        listRadioChannel(channels);
    }
};
xhttp.open('GET', "http://api.sr.se/api/v2/channels?format=json&pagination=false", true);
xhttp.send();
/*___________________________________________________________________________________________________ Ajax call end __________*/






/*___________ Channellist left, change header color dependent on channel & event listiner to get program schedule ___________*/

function printOutRadioList(channels) {
    //Write out radio list on left side
    for (let i = 0; i < channels.length; i++) {
        //Print out channel list left
        let newRadioChannel = document.createElement("li");              
        let newName = document.createTextNode(channels[i].name);         
        newRadioChannel.setAttribute("id", channels[i].id);                        
        newRadioChannel.setAttribute("title", channels[i].tagline);      
        newRadioChannel.appendChild(newName);                            
        radioList.appendChild(newRadioChannel);                          

        //Deisgn li buttons 
        newRadioChannel.style.fontSize = "1.2em"
        newRadioChannel.style.listStyleType = "none";
        newRadioChannel.style.margin = "0 2em 0.4em -1em";
        newRadioChannel.style.backgroundColor = "#ECF0F1";
        newRadioChannel.style.borderRadius = "0.3em";
        newRadioChannel.style.paddingLeft = "1em";
        newRadioChannel.style.color = "black";

        //To open radio channels schedule 
        newRadioChannel.addEventListener("click", getSchedule);

        //Change header color 
        newRadioChannel.addEventListener("click", function () {
            document.getElementById("mainheader").style.backgroundColor = "#" + channels[i].color;
            document.getElementById("player").style.backgroundColor = "#" + channels[i].color;
        });          //document.body
    }
}
/*______________________________________________________________________________________________ Channel list done __________*/







/*_______ Second Ajax call to Sveriges Radio to get individual schedules & it also clean program schedule box__________________*/

function getSchedule() {
    let xhttpTwo = new XMLHttpRequest();
    xhttpTwo.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let jsonStr = JSON.parse(this.response);
            let schedule = jsonStr.schedule;
            printOutSchedule(schedule);
        }
    };
    xhttpTwo.open('GET', "http://api.sr.se/v2/scheduledepisodes?channelid=" + this.id + "&format=json&pagination=false", true);
    xhttpTwo.send();

    //Change content i schudlebox to empty string
    programScheduleBox.innerHTML = "";
}
/*______________________________________________________________________________________________ Second Ajax call done ________*/







/*______ Convert function for milliseconds, needed for schedule time below ____________________________________________________*/

//Convert Time from Millisekunds to hours and minutes
function convertTime(calculate) {
    let minutes = Math.floor((calculate / (1000 * 60)) % 60),
        hours = Math.floor((calculate / (1000 * 60 * 60)) % 24);

    //If a number is lower then 10 a 0 is added
    hours = (hours < 10) ? "0" + hours : hours;
    minutes = (minutes < 10) ? "0" + minutes : minutes;

    return hours + ":" + minutes;
}


/*______ Get current time and add a hour to get Swedish time _____________________________________________________________________*/
let getTime = new Date();                                       //Get current UTC time
let timeNow = getTime.setHours(getTime.getHours() + 1);         //Convert UTC to GMT +1










/*______ Following script print a program name haeader and program scheudel ______________________________________________________*/

function printOutSchedule(schedule) {

    //Print out program channels name at top 
        let newChannelName = document.createElement("h1");
        let channelName = document.createTextNode(schedule[0].channel.name);
        newChannelName.appendChild(channelName);
        programScheduleBox.appendChild(newChannelName);

        //A little style so you can see the difference between program name and schedule
        newChannelName.style.backgroundColor = "#ECF0F1";
        newChannelName.style.padding = "1em";
        newChannelName.style.textAlign = "center"
        newChannelName.style.borderRadius = ".25rem"

    //To print out program schedule 
    for (let i = 0; i < schedule.length; i++) {

        //Take time and remove unnecessary character
        let programeStartTime = schedule[i].starttimeutc.substr(6, 13);
        let programeEndTime = schedule[i].endtimeutc.substr(6, 13);
        //The "clean" time runs in function convertTime to get readable time
        let startTime = convertTime(programeStartTime);
        let endTime = convertTime(programeEndTime);

        //Sort out and write current and upcoming progrems
        if (timeNow < programeEndTime) {
            //Create a articles where the objects below gonna be in
            let createNewArticle = document.createElement("article");

            //Main header - h3                                               //Explaining each step below
            let newMainHeader = document.createElement("h3");                //Creat a new element
            let mainTitel = document.createTextNode(schedule[i].title);      //Creat what gonna be in element 
            newMainHeader.appendChild(mainTitel);                            //Take the content and but in the new element 
            createNewArticle.appendChild(newMainHeader);                     //Take the element (with stored value) and put it where it should be (in this case, the new article element)

            //Subheading - h4 / Check if subheading is available or not, to print out if it exists 
            if (schedule[i].subtitle == null) {
            } else {
                let newSubheading = document.createElement("h4");
                let subTitel = document.createTextNode(schedule[i].subtitle);
                newSubheading.appendChild(subTitel);
                createNewArticle.appendChild(newSubheading);
            }

            //Start time and end time
            let newTimeHeader = document.createElement("h5");
            let timeTitel = document.createTextNode(startTime + " - " + endTime);
            newTimeHeader.appendChild(timeTitel);
            createNewArticle.appendChild(newTimeHeader);

            //Program description
            let newDescriptionText = document.createElement("p");
            let descriptionText = document.createTextNode(schedule[i].description);
            newDescriptionText.appendChild(descriptionText);
            createNewArticle.appendChild(newDescriptionText);

            //Writing out to DOM
            programScheduleBox.appendChild(createNewArticle);
        }
    }
}
/*_________________________________________________________________________ Schedule and header name script end __________*/







/*___________ A new box at top for an aduio player _______________________________________________________________________*/
let newBox = document.createElement('div');
document.querySelector(".left").parentNode.insertBefore(newBox, document.querySelector(".left"))
newBox.style.float = "right";   
newBox.style.height = "10em";
/*__________________________________________________________________________________________________ New box end _________*/








/*___________ Creat a new audioplayer and source _________________________________________________________________________*/

//Creat a new audioplayer but in the new box
let newAudioElement = document.createElement("AUDIO");
newAudioElement.setAttribute("controls", "controls");
newAudioElement.id = "audioID";
newBox.appendChild(newAudioElement);

//Creat a source with first radio station at src
let newSourceElement = document.createElement("source");
newSourceElement.setAttribute("type", "audio/mpeg");
newSourceElement.id = "sourceID";
newAudioElement.appendChild(newSourceElement);

//Creating variables for audio and source 
let audioID = document.getElementById("audioID");
let sourceID = document.getElementById("sourceID");

//Som audioplater style
audioID.style.width = "230px";
/*____________________________________________________________________________________________ Audio and Soure end _______*/








/*___________ Print out radioplaylist channels & activate radioplayer _____________________________________________________*/

function listRadioChannel(radioList) {
    //Loads first channels
    sourceID.src = radioList[0].liveaudio.url;
    
    //Crate new element with channels url/mp3 link as a value
    for (let i = 0; i < radioList.length; i++) {
        radioPlayList.innerHTML += "<option value=" + radioList[i].liveaudio.url + ">" + radioList[i].name + "</option>";
        //Put event listener that react on click, to change src to clicket elements value
        radioPlayList.addEventListener("click", function () {

            sourceID.src = this.value;
        });
    }
}

//To activate radioplayer an event listener is put och play(spela) button that activate function play Radio
playBtn.addEventListener("click", playRadio);

function playRadio() {
    audioID.load();
    audioID.play();
}

//Some playbutton style
playBtn.style.backgroundColor = "white";
playBtn.style.color = "black";
playBtn.style.fontWeight = "bold";

/*_______________________________________________________________________________________ Radioplayer end ________________*/








/*______ A button that clear program schedule box _________________________________________________________________________*/

//Creating a clear button
let clearScheduleBox = document.createElement("button");
let clearText = document.createTextNode("Rensa tablå");
clearScheduleBox.appendChild(clearText);
newBox.parentNode.insertBefore(clearScheduleBox, newBox)




//Put "some" style on it
clearScheduleBox.style.fontSize = "1.5em";
clearScheduleBox.style.margin = "1.8em 0 0.5em 0";
clearScheduleBox.style.backgroundColor = "#333";
clearScheduleBox.style.color = "white";
clearScheduleBox.style.border = "2px solid #333";
clearScheduleBox.style.borderRadius = "5px"
clearScheduleBox.style.padding = "0.5em"
clearScheduleBox.style.cursor = "pointer"


//Whats going to happend when clear box
clearScheduleBox.addEventListener("click", function () {
    //First clear it
    programScheduleBox.innerHTML = "";
    //Seond put in presentation text
    presentationText();
    //Change back header color
    document.getElementById("mainheader").style.backgroundColor = "#333"
    document.getElementById("player").style.backgroundColor = "#333";

});
/*________________________________________________________________________________________ Clear button end ______________*/







/*_________ Some extra design ____________________________________________________________________________________________*/

document.getElementById("mainheader").style.backgroundColor = "#333";   //Header color
document.getElementById("player").style.backgroundColor = "#333";       //To get grey color behanind radioslectplayer list 

document.getElementById("logo").addEventListener("click", function () { location.reload(true) });   //Make logo text refresh web page

/*________________________________________________________________________________________ extra design end ______________*/




/*_________ A presentation text in program schedule box ___________________________________________________________________*/
function presentationText() {

    //Presentation text
    let presentationTitle = "Sveriges Radio tablå och spellista";
    let presentationTextPage = "Välkommen till en alternativ sida för att kolla tablå och lyssna på Sveriges Radio."
    let presentationTextCreater = "Denna sida är ett projektarbete hos Mittuniversitets för kursen: Introduktion till programmering med JavaScript. Skapat av Emilia Holmström";


    //Presentation title
    let titleText = document.createElement("h3");
    let theTitleText = document.createTextNode(presentationTitle);
    titleText.appendChild(theTitleText);
    programScheduleBox.appendChild(titleText);

    //Create elements that use presentation text
    let introText = document.createElement("p");
    let theintroText = document.createTextNode(presentationTextPage);
    introText.appendChild(theintroText);

    //Line breaking
    theintroText = document.createElement("br");
    introText.appendChild(theintroText);
    theintroText = document.createElement("br");
    introText.appendChild(theintroText);

    theintroText = document.createTextNode(presentationTextCreater);
    introText.appendChild(theintroText);

    programScheduleBox.appendChild(introText);

    //some style
    titleText.style.marginTop = "1em";
    titleText.style.marginLeft = "3em";
    introText.style.marginLeft = "4.8em";
    introText.style.marginRight = "2em";
}

presentationText(); //run presentation funktion

/*__________________________________________________________________________________________ Presentation text end ________*/
