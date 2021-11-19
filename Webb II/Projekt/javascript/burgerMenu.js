"use strict";

/* Made mars 2021, of Emilia Holmström
The code reads in screen size and shows various elements based on it, in addition 
there is an event listener who opens and closes the menu (on smaller screens)*/

//Get elements from header
let navBtn = document.getElementById("navBtn");
let navBoxSmall = document.getElementById("navBoxSmall");

//Eventlistiner and its function to open and close nav menu
navBtn.addEventListener("click", function() {
    if(navBoxSmall.style.display === "none") {
        navBoxSmall.style.display = "block";
    } else {
        navBoxSmall.style.display = "none";
    }
});


/*Chech screen size, to decide whether the menu should be displayed or not - made 2020-10-26*/
const screenSize = window.matchMedia("(max-width: 750px), (max-height:550px)")

//Load bruger menu
function loadMenu() {
    if (screenSize.matches) {
        navBtn.style.display = "block";
        navBoxSmall.style.display = "none";

        //window.onload = navbar.style.display = "none";
    } else {
        navBtn.style.display = "none";
        navBoxSmall.style.display = "block";

    }
}

loadMenu();                             // Trigger function 
screenSize.addListener(loadMenu);      // Attach listener function on state changes
