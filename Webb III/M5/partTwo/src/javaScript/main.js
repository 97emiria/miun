"use strict";

//Get box for course list
let courseListTable = document.getElementById("courseListTable");

//Get input value index page
let codeInput = document.getElementById('code');
let nameInput = document.getElementById('name');
let progressionInput = document.getElementById('progression');
let syllabusInput = document.getElementById('syllabus');

//Form message box
let formMessage = document.getElementById('formMassage');

//Rest link
let restAPIlink = "https://studenter.miun.se/~emho2003/writeable/DT173G-m5/partTwo/pub/rest.php"

//Get api link with code values from url
let apiLinkWithCode = restAPIlink + window.location.search;

//Händelselyssnare
window.addEventListener("load", getCourseList);
//document.getElementById("addCourse").addEventListener("submit", addCourse(event));


//Use to remove "error" console messages, checkpage value is for now decides on html-pages
if (checkPage == false) {
    document.getElementById("editCourse").addEventListener("submit", editCourse);
    document.getElementById("deleteBtn").addEventListener("click", deleteCourse);
}


//Print out course list on index page
function getCourseList() {

    if (checkPage == true) {
        fetch(restAPIlink)
        .then(response => response.json())
            .then(data => {
                data.forEach(courses => {
                    courseListTable.innerHTML += `
                    <tr> 
                    <td> ${courses.code} </td>
                    <td> ${courses.name} </td>
                    <td> ${courses.progression} </td>
                    <td> <a href="${courses.syllabus}" target="_blank"> Webblänk </a> </td>
                    <td> <button id="${courses.code}"  onclick="window.location.href='edit.html?code=${courses.code}';" > Hantera </button> </td>
                    </tr>
                    `;
                })
            })

    //If url have a code, user is probably/hopefully on edit course page
    } else {

        //Get course info
        fetch(apiLinkWithCode)
        .then(response => response.json())
            .then(data => {
                data.forEach(course => {
                    codeInput.value = course.code;
                    nameInput.value = course.name;
                    progressionInput.value = course.progression;
                    syllabusInput.value = course.syllabus;
                })
            })
      
    }

}



//Add a new course
function addCourse(event) {

    //Stop form to reload page
    event.preventDefault();
    
    //Read the values from input
    let code = codeInput.value;
    let name = nameInput.value;
    let progression = progressionInput.value;
    let syllabus = syllabusInput.value;

    let course = {'code': code, 'name': name, 'progression': progression, 'syllabus': syllabus}; 
    

    //Connect to database
    fetch(restAPIlink, {
        method: 'POST', 
        body: JSON.stringify(course),
    })
    .then(response => response.json())
  
        .then(function(response) {
            //Check so information is correct
            if (!response.ok) {

                if(response.message == 'code') {
                    formMessage.classList.add("error");
                    formMessage.innerHTML = "Kurskoden är felaktig";
                } else if(response.message == 'name') {
                    formMessage.classList.add("error");
                    formMessage.innerHTML = "Kursnamnet är inte korrekt";

                } else if(response.message == 'progression') {
                    formMessage.classList.add("error");
                    formMessage.innerHTML = "Progressaionen är fel, <br> ange endast stort A eller B";
                } 

                //If everything is right, get the updated list
            }  else {
                getCourseList();
            }
        })
     
        .catch(error => {
            console.log('Message: ', error)
        })


} 


//Get input id
let codeInput = document.getElementById('code');
let nameInput = document.getElementById('name');
let progressionInput = document.getElementById('progression');
let syllabusInput = document.getElementById('syllabus');

//To edit a course on edit page
function editCourse() {

    //Samlar in värden från input fälten (och lägger dem i variabler) 
    let code = codeInput.value;
    let name = nameInput.value;
    let progression = progressionInput.value;
    let syllabus = syllabusInput.value;

    //Sedan lägger vi dem i ett objekt
    let course = {'code': code, 'name': name, 'progression': progression, 'syllabus': syllabus}; 

    //Connect to database
    fetch(apiLinkWithCode, {
        method: 'PUT', 
        body: JSON.stringify(course),   //Viktigt att de ligger i en json.stringify
    })
    .then(response => response.json())
    
        //Om det gick att lägga till data kommer jag att hämta in kurslistan igen 
        .then(data => {
            data.forEach(courses => {
                getCourseList();
            })
        })
        .catch(error => {
            console.log('Error: ', error)
        })

}

//To delete a course
function deleteCourse() {

    //To prevent mistake, do alert before
    let alertReslut = confirm("Är du säker på att du vill radera kursen?");

    if (alertReslut == true) {
    
        //Connect to database
        fetch(apiLinkWithCode, {
            method: 'DELETE', 
            body: JSON.stringify(window.location.search.substring(6)),
        })
        .then(response => response.json())
            .then(data => {
                window.location="index.html";
            })
            .catch(error => {
                console.log('Error: ', error)
            })
    
    } 

}