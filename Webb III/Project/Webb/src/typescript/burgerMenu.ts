"use strict";


//Get elements from header
let menuBtn = document.getElementById("menuBtn");
let menuList = document.getElementById("menuList");

//Eventlistiner and its function to open and close nav menu
menuBtn.addEventListener("click", () => {
    if(menuList.style.display === "none") {

        menuList.style.display = "block";
        menuList.style.transition = "0.2s";
    } else {
        
        menuList.style.display = "none";
        menuList.style.transition = "0.2s";
    }
});



/*Chech screen size, to decide whether the menu should be displayed or not - made 2020-10-26*/
const screenSize = window.matchMedia("(max-width: 800px), (max-height:550px)")

//Load bruger menu
let loadMenu = () => {
    if (screenSize.matches) {
        menuBtn.style.display = "block";
        menuList.style.display = "none";

    } else {
        menuBtn.style.display = "none";
        menuList.style.display = "block";
    }
}

loadMenu();                             // Trigger function 
screenSize.addListener(loadMenu);      // Attach listener function on state changes


if (sessionStorage.getItem("signIn") == 'true') {
    let liEl = document.createElement("LI");
    liEl.innerHTML = `<a href="/admin">Admin</a>`;
    menuList.prepend(liEl);
} 