"use strict";

/*
    Code made during march 2021, of Emilia Holmström
    Code function is when mouse come over a button box is suppose to show a box, 
    to quit the box user need to remove mouse from either box or button
*/



// Post inlägg meny

let postRulsBox = document.getElementById("postRulsBox");
let postRulsBtn = document.getElementById("postRulsBtn");


window.onload = postRulsBox.style.display = "none";

postRulsBtn.onmouseover = function(){
    postRulsBox.style.display = "block";
    postRulsBtn.innerHTML = "Ta bort musen från knappen eller rutan för att stänga";
};
postRulsBtn.onmouseout = function(){
    postRulsBox.style.display = "none";
    postRulsBtn.innerHTML = "Kolla vad som krävs för att posta ett inlägg"
};
postRulsBox.onmouseover = function(){
    postRulsBox.style.display = "block";
    postRulsBtn.innerHTML = "Ta bort musen från knappen eller rutan för att stänga";
};
postRulsBox.onmouseout = function(){
    postRulsBox.style.display = "none";
    postRulsBtn.innerHTML = "Kolla vad som krävs för att posta ett inlägg"
};
