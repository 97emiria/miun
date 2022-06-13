"use strict";

//Get elemnts from work form
let eduForm = document.getElementById('eduForm');                   //Formuläret
let titleEdu = document.getElementById('titleEdu');                   //Input
let school = document.getElementById('school');                     //Input
let semester = document.getElementById('semester');                 //Input
let dateEdu = document.getElementById('dateEdu');                   //Input
let statusEdu = document.getElementById('statusEdu');               //Number
let commentEdu = document.getElementById('commentEdu');             //Textarea

//Form buttons
let editEduBtn = document.getElementById('editEduBtn');             //Edit btn form
let deleteEduBtn = document.getElementById('deleteEduBtn');         //Delete btn from
let addEduBtn = document.getElementById('addEduBtn');               //Add btn form

//Other elements
let educationMessage = document.getElementById('educationMessage'); //Message to display whats going on
let eduListAdmin = document.getElementById("eduListAdmin");         //Div to put li element in


if (editEduBtn != null) {
    editEduBtn.style.display='none';
    deleteEduBtn.style.display='none';
    addEduBtn.style.display='none';
    eduForm.style.display='none';
}


let getEducationListAdmin = () => {

    fetch(apiLinkEducation)
    .then(response => response.json())
        .then(data => {

            data.forEach(education => {

                eduListAdmin.innerHTML += `
                    <li onclick="changeEducationInfo('${education.educationID}')"> ${education.title} </li>
                `;
            
            })

        })
}


let changeEducationInfo = (educationID) => {

    fetch(apiLinkEducationWithID+educationID)
    .then(response => response.json())
        .then(data => {
            data.forEach(education => {

                clearInputs('education');

                    (<HTMLInputElement>titleEdu).value = education.title;
                    (<HTMLInputElement>school).value  = education.school;
                    (<HTMLInputElement>semester).value  = education.semester;
                    (<HTMLInputElement>dateEdu).value  = education.date;
                    (<HTMLInputElement>statusEdu).value = education.status;
                    (<HTMLInputElement>commentEdu).value = education.comment;

                    editEduBtn.setAttribute("onclick","editEducation(" + educationID + ");");
                    deleteEduBtn.setAttribute("onclick","deleteEducation(" + educationID + ");");

                    editEduBtn.style.display='block';
                    deleteEduBtn.style.display='block';
                    eduForm.style.display='block';
                    addEduBtn.style.display='none';

                    clearAllMessages('education');


            })
        })
}



let editEducation = (educationID) => {

    //Stoppar formulär för att ladda om
    event.preventDefault();

    //collect input data
    let newTitleEdu = (<HTMLInputElement>titleEdu).value;
    let newSchool = (<HTMLInputElement>school).value ;
    let newSemester = (<HTMLInputElement>semester).value ;
    let newDateEdu = (<HTMLInputElement>dateEdu).value ;
    let newSatusEdu = (<HTMLInputElement>statusEdu).value;
    let newCommentEdu = (<HTMLInputElement>commentEdu).value;

    let updatedEducation = {'educationID': educationID, 'title': newTitleEdu, 'school': newSchool, 'semester': newSemester, 'date': newDateEdu, 'status': newSatusEdu, 'comment': newCommentEdu}; 

    //Data to send to fetch call function
    let callURL = apiLinkEducationWithID+educationID;
    let callMethod = 'PUT';
    let callData = JSON.stringify(updatedEducation);
    let callMessage = educationMessage;
    let callWord = 'education';
    
    //call fetch function
    callFetch(callURL, callMethod, callData, callMessage, callWord);

}


let deleteEducation = (educationID) => {
    //Stoppar formulär för att ladda om
    event.preventDefault();

    let title = (<HTMLInputElement>titleEdu).value;
    let deleteData = {'title': title, 'educationID': educationID};

    //To prevent mistake, do alert before
    let alertReslut = confirm("Är du säker på att du vill radera kursen?");

    if (alertReslut == true) {
    
        //Data to send to fetch call function
        let callURL = apiLinkEducationWithID+educationID;
        let callMethod = 'DELETE';
        let callData = JSON.stringify(deleteData);
        let callMessage = educationMessage;
        let callWord = 'education';
        
        //call fetch function
        callFetch(callURL, callMethod, callData, callMessage, callWord);
    
    } 
}

let prepareToAddEducation = () => {
    editEduBtn.style.display='none';
    deleteEduBtn.style.display='none';
    addEduBtn.style.display='block';
    eduForm.style.display='block';

    clearInputs('education');
    addEduBtn.setAttribute("onclick","addEducation();")
    clearAllMessages('education');
}


let addEducation = () => {
    //Stop form to reload page
    event.preventDefault();
    
    //Read the values from input
    let addTitleEdu = (<HTMLInputElement>titleEdu).value;
    let addSchool = (<HTMLInputElement>school).value ;
    let addSemester = (<HTMLInputElement>semester).value ;
    let addDateEdu = (<HTMLInputElement>dateEdu).value ;
    let addSatusEdu = (<HTMLInputElement>statusEdu).value;
    let addCommentEdu = (<HTMLInputElement>commentEdu).value;

    let addEducation = {'title': addTitleEdu, 'school': addSchool, 'semester': addSemester, 'date': addDateEdu, 'status': addSatusEdu, 'comment': addCommentEdu}; 

    //Data to send to fetch call function
    let callURL = apiLinkEducation;
    let callMethod = 'POST';
    let callData = JSON.stringify(addEducation);
    let callMessage = educationMessage;
    let callWord = 'education';

    //call fetch function
    callFetch(callURL, callMethod, callData, callMessage, callWord);
}


