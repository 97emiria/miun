let t = new Date();
document.getElementById('timestamp').innerHTML = t.getUTCHours()+1 + ":" + t.getUTCMinutes() + ":" + t.getUTCSeconds() + ", " + t.getUTCDate() + "/" + (t.getUTCMonth() + 1) + "/" + t.getUTCFullYear();


//Get input value index page
let codeInput = document.getElementById('code');
let nameInput = document.getElementById('name');
let progressionInput = document.getElementById('progression');
let semesterInput = document.getElementById('semester');
let syllabusInput = document.getElementById('syllabus');

let addFrom = document.getElementById('addFrom');

//Messages
let addMessage = document.getElementById('addMessage');

const apiLink = 'http://localhost:3000/courses/';


let getCourses = () => {

    fetch(apiLink)

    .then(response => {
        response.json().then(data => {

            data.forEach(data => {

                //Print out course list
                courseListTable.innerHTML += `
                    <tr> 
                        <td> ${data.code} </td>
                        <td> ${data.name} </td>
                        <td> ${data.semester} </td>
                        <td> ${data.progression} </td>
                        <td> <a href="${data.syllabus}" target="_blank"> Webblänk </a> </td>
                        <td> 
                            <button id="${data._id}" onclick="deleteCourse(id)"> 
                                <img src="images/iconDelete.png" alt="Trash can">
                            </button> 
                        </td>
                    </tr>
                `;
            })

        });
    });

}


getCourses();


let deleteCourse = id => {

    let alertReslut = confirm("Är du säker på att du vill radera kursen?");

    if (alertReslut == true) {
    
        fetch(apiLink+id, {
            method: 'DELETE'
        })
        .then(response => {

            response.json().then(data => {

                //if http status is okey, update list and show message
                if(response.ok) {

                    //Print out message from server
                    message.innerHTML = data.message;
                    message.classList.add("success");

                    //Remove message after 3s
                    clearMessage();


                //If http status not okey, print out message from server   
                } else {
                    message.innerHTML = parse.message;
                    message.classList.add("error");

                    //Remove message after 3s
                    clearMessage();
                }
                
            });

        });
    } 


}

let editCourse = id => {
    console.log(id)
}


let clearMessage = () => {
    
    setTimeout(() => {
        message.innerHTML = ""; 
        message.removeAttribute('class');
    }, 3000);

}



let addCourse = event => {
    //Stop form to reload page
    event.preventDefault();

    //Read the values from input
    let code = codeInput.value;
    let name = nameInput.value;
    let progression = progressionInput.value;
    let semester = semesterInput.value;
    let syllabus = syllabusInput.value;

    let course = {'code': code, 'name': name, 'progression': progression, 'semester': semester, 'syllabus': syllabus}; 

    //Connect to database
    fetch(apiLink, {
        method: 'POST', 
        body: JSON.stringify(course),
        headers: {
            'Content-Type': 'application/json'
          }
    })
    .then(response => {

        console.log(response.status);
        getCourses()
        message.innerHTML = "Kursen tillagd";
        message.classList.add("success");
        clearMessage()

        addFrom.reset();
    })
    .catch(error => {
        console.log('Error: ', error)
    })

}










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