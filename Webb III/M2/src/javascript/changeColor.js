"use strict";
//Code from: https://css-tricks.com/snippets/javascript/random-hex-color/

let colorBox = document.getElementById("colorBox");
let colorBtn = document.getElementById("colorBtn");

colorBtn.addEventListener("click", function(){
    let randomColor = Math.floor(Math.random()*16777215).toString(16);
    colorBox.style.backgroundColor = "#" + randomColor;
    colorBox.style.border = "3px solid #" + randomColor;
});