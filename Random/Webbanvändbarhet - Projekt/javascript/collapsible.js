"use strict";


/*
    Code from w3school
    https://www.w3schools.com/howto/howto_js_collapsible.asp
*/


/*Boxes with img*/
let coll = document.getElementsByClassName("collBtn");
let i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {

    let collDropOpen = this.nextElementSibling;
    let collBoxOpen = this.parentElement;
    let imgBox = this.getElementsByClassName("collImgBox")[0];

    if (collDropOpen.classList.contains("collDropOpen")) {

      //Close
      collDropOpen.classList.remove("collDropOpen");
      collBoxOpen.classList.remove("collBoxOpen");
      imgBox.classList.remove("collChangeImg");


    } else {
      //Open
      collDropOpen.classList.add("collDropOpen");
      collBoxOpen.classList.add("collBoxOpen");
      imgBox.classList.add("collChangeImg");
      this.title.innerHTML = "Stäng svaret"
    }

  });

}
