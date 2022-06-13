"use strict";  

/*
    Code from w3school
    https://www.w3schools.com/howto/howto_js_collapsible.asp
*/

let btn = document.getElementsByClassName("admin_collapsibleBtn");
let iii;

for (iii = 0; iii < btn.length; iii++) {
  
  btn[iii].addEventListener("click", function() {
    this.classList.toggle("collUp");
    
    let content = this.nextElementSibling;

    //Close
    if (content.style.display === "block") {
      content.style.display = "none";

    //Open
    } else {
      content.style.display = "block";
    }  
  });
  
}