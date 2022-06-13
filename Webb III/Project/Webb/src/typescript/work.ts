"use strict";

//Get elemnts from form update work form
let workForm = document.getElementById('workForm');                     //Formuläret
let titleWork = document.getElementById('titleWork');                   //Input
let workplace = document.getElementById('workplace');                   //Input
let dateWork = document.getElementById('dateWork');                     //Input
let commentWork = document.getElementById('commentWork');               //Textarea

let editWorkBtn = document.getElementById('editWorkBtn');               //Edit btn form
let deleteWorkBtn = document.getElementById('deleteWorkBtn');           //Delete btn from
let addWorkBtn = document.getElementById('addWorkBtn');                 //Add btn form

let workMessage = document.getElementById('workMessage');               //Message to display whats going on
let workListAdmin = document.getElementById("workListAdmin");           //Div to put button element in


if (editWorkBtn != null) {
    //Hide all form btns and form in the beginning
    editWorkBtn.style.display='none';
    deleteWorkBtn.style.display='none';
    addWorkBtn.style.display='none';
    workForm.style.display='none';
}


//Print out a button for every work
let getWorkListAdmin = () => {
    
    fetch(apiLinkWork)
    .then(response => response.json())
        .then(data => {
            data.forEach(work => {

              if (workListAdmin != null) {
                    workListAdmin.innerHTML += `
                    <li onclick="changeWorkInfo('${work.workID}')"> ${work.title} </li>
                    `;
              }
                
            })
        })
}




//When button click, show info in input
let changeWorkInfo = (workID) => {

    fetch(apiLinkIDWork+workID)
    .then(response => response.json())
        .then(data => {
            data.forEach(work => {

                    clearInputs('work');

                    (<HTMLInputElement>titleWork).value = work.title;
                    (<HTMLInputElement>workplace).value  = work.workplace;
                    (<HTMLInputElement>dateWork).value  = work.date;
                    (<HTMLInputElement>commentWork).value = work.comment;

                    editWorkBtn.setAttribute("onclick","editWork(" + workID + ");");
                    deleteWorkBtn.setAttribute("onclick","deleteWork(" + workID + ");");

                    editWorkBtn.style.display='block';
                    deleteWorkBtn.style.display='block';
                    workForm.style.display='block';
                    addWorkBtn.style.display='none';

                    clearAllMessages('work');
            })
        })
}


let editWork = (workID) => {

    //Stoppar formulär för att ladda om
    event.preventDefault();

    //collect input data
    let newTitle = (<HTMLInputElement>titleWork).value;
    let newWorkplace = (<HTMLInputElement>workplace).value;
    let newDateWork = (<HTMLInputElement>dateWork).value;
    let newComment =  (<HTMLInputElement>commentWork).value;

    let updatedWork = {'workID': workID, 'title': newTitle, 'workplace': newWorkplace, 'date': newDateWork, 'comment': newComment}; 

    let callURL = apiLinkIDWork+workID;
    let callMethod = 'PUT';
    let callData = JSON.stringify(updatedWork);
    let callMessage = workMessage;
    let callWord = 'work';
    
    //call fetch function
    callFetch(callURL, callMethod, callData, callMessage, callWord);

}


let deleteWork = (workID) => {
       //Stoppar formulär för att ladda om
       event.preventDefault();
    
    //Collect value
    let workTitle = (<HTMLInputElement>titleWork).value;

    let deleteData = {'title': workTitle, 'workID': workID};

    //To prevent mistake, do alert before
    let alertReslut = confirm("Är du säker på att du vill radera erfarenheten?!");

    if (alertReslut == true) {
    
        let callURL = apiLinkIDWork+workID;
        let callMethod = 'DELETE';
        let callData = JSON.stringify(deleteData);
        let callMessage = workMessage;
        let callWord = 'work';
    
        //call fetch function
        callFetch(callURL, callMethod, callData, callMessage, callWord);
        
    } 
}



let prepareToAddWork = () => {
    editWorkBtn.style.display='none';
    deleteWorkBtn.style.display='none';
    addWorkBtn.style.display='block';
    workForm.style.display='block';

    clearInputs('work');

    addWorkBtn.setAttribute("onclick","addWork();")
    clearAllMessages('work')
}


let addWork = () =>{

    //Stop form to reload page
    event.preventDefault();
    
    //Read the values from input
    let addTitle: string        = (<HTMLInputElement>titleWork).value;
    let addWorkplace: string    = (<HTMLInputElement>workplace).value;
    let addDateWork: any        = (<HTMLInputElement>dateWork).value;
    let addCommentWork: string  =  (<HTMLInputElement>commentWork).value;

    let addWork = {'title': addTitle, 'workplace': addWorkplace, 'date': addDateWork, 'comment': addCommentWork}; 

    //Data to send to fetch call function
    let callURL = apiLinkWork;
    let callMethod = 'POST';
    let callData = JSON.stringify(addWork);
    let callMessage = workMessage;
    let callWord = 'work';
    
    //call fetch function
    callFetch(callURL, callMethod, callData, callMessage, callWord);
}