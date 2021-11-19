"use strict";

/*
Creat during march 2021, Code is come from w3school: link https://www.w3schools.com/w3css/tryit.asp?filename=tryw3css_slideshow_rr
Code uses on index page and is a slideshow. The code switch between boxes whitin slideshowBox
*/


var myIndex = 0;
slideshow();

function slideshow() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(slideshow, 5000); // Change image every 5 seconds
}

