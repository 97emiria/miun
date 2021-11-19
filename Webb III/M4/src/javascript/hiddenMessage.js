"use strict";

//This code base come from w3school, https://www.w3schools.com/howto/howto_js_typewriter.asp

let txt = "En JavaScript hälsning till Malin och Mattias!";
let o = 0;
let speed = 50; /* The speed/duration of the effect in mioiseconds */

function typeWriter() {
    if (o < txt.length) {
        document.getElementById("hiddenMessage").innerHTML += txt.charAt(o);
        o++;
        setTimeout(typeWriter, speed);
    }
}

typeWriter();