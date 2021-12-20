"use strict";



function displayTimesBox() {

  //Elements for weeks
  var checkBoxWeek = document.getElementById("yesWeeks");
  var weekBox = document.getElementById("weeksBox");

  //Elements for days
  var checkBoxDays = document.getElementById("yesDays");
  var daysBox = document.getElementById("daysBox");

  let noBox =  document.getElementById("noBox");
  
  //Check if week is checked
  if (checkBoxWeek.checked == true) {

    //Disply week box, hide days box
    weekBox.style.display = "block";
    daysBox.style.display = "none";

    //Change checked box color to blue, other to white
    checkBoxWeek.parentElement.style.backgroundColor = "#e9f9ff";
    daysBox.parentElement.style.backgroundColor = "#fff";
    noBox.style.backgroundColor = "#fff";

  
    //Check if days is checked
  } else if (checkBoxDays.checked === true) {

    //Disply days box, hide week box
    daysBox.style.display = "block";
    weekBox.style.display = "none";

    //Change checked box color to blue, other to white
    daysBox.parentElement.style.backgroundColor = "#e9f9ff";
    checkBoxWeek.parentElement.style.backgroundColor = "#fff";
    noBox.style.backgroundColor = "#fff";


  } else {
    //Hide both week and days box
    daysBox.style.display = "none";
    weekBox.style.display = "none";

    //Change checked box color to blue, other to white
    checkBoxWeek.parentElement.style.backgroundColor = "#fff";
    daysBox.parentElement.style.backgroundColor = "#fff";
    noBox.style.backgroundColor = "#e9f9ff";

  }
  
}


