"use strict";

/* Made May 2021, of Emilia Holmström
The code brings out the menu */

//Get elements from header
let navBtn = document.getElementById("navBtn");             // Button
let navBtnImg = document.getElementById("navBtnImg");       // Button img
let navBox = document.getElementById("navMenu");            // Menu box

let profileBtn = document.getElementById("profileBtn");
let bookingBtn = document.getElementById("bookingBtn");
let infoBtn = document.getElementById("infoBtn");



    /*Check screen size, to decide whether change tabindex or not.*/
    const screenSize = window.matchMedia("(max-width: 1000px)");

    function changeTabIndex() {
        if (screenSize.matches) {
        //Change tabIndex on menu btns
        let profileBtn = document.getElementById("profileBtn");
        profileBtn.tabIndex = "-1";

        let bookingBtn = document.getElementById("bookingBtn");
        bookingBtn.tabIndex = "-1";

        let infoBtn = document.getElementById("infoBtn");
        infoBtn.tabIndex = "-1";
        } 
    }

    changeTabIndex();                             // Trigger function 
    screenSize.addListener(changeTabIndex);      // Attach listener function on state changes




    //Eventlistiner and its function to open and close nav menu
    navBtn.addEventListener("click", function() {
        
        if(navBtn.innerHTML == "Stäng meny") {

            //Hide menu
            navBox.classList.remove("navBoxMove");


            //Change img back to three lines
            navBtn.classList.remove("navButtonClose");
            navBtn.innerHTML = "Öppna meny";

            if (screenSize.matches) {
                //Change tabIndex on menu btns
                profileBtn.tabIndex = "-1";
                bookingBtn.tabIndex = "-1";
                infoBtn.tabIndex = "-1";
            } 

        } else {

            //Display
            navBox.classList.add("navBoxMove");

            //Change to close-btn
            navBtn.classList.add("navButtonClose");
            navBtn.innerHTML = "Stäng meny";

            if (screenSize.matches) {
                //Change tabIndex on menu btns
                profileBtn.tabIndex = "0";
                bookingBtn.tabIndex = "0";
                infoBtn.tabIndex = "0";
            } 
        }

    } );






    /*navBox.addEventListener( function() {

        if (navBox.hasFocus || profileBtn.hasFocus || bookingBtn.hasFocus || infoBtn.hasFocus ) {

            document.body.style.background = "orange";

        } else {
                        //Hide menu
                        navBox.classList.remove("navBoxMove");
            
                        //Change img back to three lines
                        navBtn.classList.remove("navButtonClose");
                        navBtn.innerHTML = "Öppna meny";
            
                        if (screenSize.matches) {
                            //Change tabIndex on menu btns
                            let profileBtn = document.getElementById("profileBtn");
                            profileBtn.tabIndex = "-1";
            
                            let bookingBtn = document.getElementById("bookingBtn");
                            bookingBtn.tabIndex = "-1";
            
                            let infoBtn = document.getElementById("infoBtn");
                            infoBtn.tabIndex = "-1";
                        } 
        }
    });*/
