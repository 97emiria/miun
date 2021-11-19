"use strict";

let bankID = document.getElementById("bankID");
let pword = document.getElementById("password");

let bankBtn = document.getElementById("bankBtn");
let pwordBtn = document.getElementById("pwordBtn");

let logInText = document.getElementById("logInText");


bankBtn.addEventListener("click", function() {

        //Reveal bankID box (and hide password box)
        bankID.style.display = "block";
        pword.style.display = "none";

        //Change style on active btn
        bankBtn.classList.add("loginSelected");
        pwordBtn.classList.remove("loginSelected");

});

pwordBtn.addEventListener("click", function() {
    
        //Reveal passeord box (and hide bankID box)
        pword.style.display = "block";
        bankID.style.display = "none";

        //Change style on not selected btn 
        pwordBtn.classList.add("loginSelected");
        bankBtn.classList.remove("loginSelected");

});