"use strict";

//Elements for education page
let educationEl = document.getElementById("educationText");

//Element for admin
let textMessage = document.getElementById("textMessage");
let adminTextSubmit = document.getElementById('adminTextSubmit');

let adminListsText = document.getElementById("adminListsText");

//Form (admin)
let textTextarea = document.getElementById("textTextarea");
let textFrom = document.getElementById("textFrom");
let textImage = document.getElementById("textImage");
let textTitle = document.getElementById('textTitle');


//Div för förhandsvissning bild
let textImgDiv = document.getElementById('textFrom_imgDiv');


let getTextListAdmin = () => {

    textFrom.style.display = "none";

    fetch(apiLinkTexts)
    .then(response => response.json())
        .then(data => {

        data.forEach(texts => {

            adminListsText.innerHTML += `
                <li onclick="changeTexts('${texts.textID}')"> 
                    ${texts.title} 
                </li>
            `;

        })

    })
}




let changeTexts = (textID) => {

    textFrom.style.display = "block";

    fetch(apiLinkTextsWithID+textID)
    .then(response => response.json())
        .then(data => {
            data.forEach(data => {

                if(textTextarea != null) {
                    (<HTMLInputElement>textTitle).value = data.title;

                    textTextarea.innerHTML = data.theText;


                    if(data.imgPath != 'empty') {
                        let img = document.createElement("img");
                        img.src = data.imgPath;
                        
                        textImgDiv.innerHTML = ` 
                            <p> Nuvarande bild: </p>
                            <img src="${data.imgPath}" alt=""/>
                        `;

                    } else {

                        textImgDiv.innerHTML = "";
                    }

                    
                    adminTextSubmit.setAttribute("onclick","editTextAdmin('" + textID + "');");
                }
                
            })
        })

}





let editTextAdmin = (textID) => {

    //Stop form to reload page
    event.preventDefault();

    //Collect data
    let currentTextTitle = (<HTMLInputElement>textTitle).value;
    let newText = (<HTMLInputElement>textTextarea).value;
    let theImg = (<HTMLInputElement>textImage).files[0];

    //For PUT request
    let updatedTheText = {'title': currentTextTitle, 'theText': newText}; 

    //If image exist, lets do a PUT request, other way make POST
    if((<HTMLInputElement>textImage).files[0] == null) { 
        
 
        //Data to send to fetch call function
        let callURL = apiLinkTextsWithID+textID;
        let callMethod = 'PUT';
        let callData = JSON.stringify(updatedTheText);
        let callMessage = textMessage;
        let callWord = 'text';

        //call fetch function
        callFetch(callURL, callMethod, callData, callMessage, callWord);

    } else {

        //For POST request
        let formData = new FormData();

        formData.append('image', theImg);
        formData.append('theText', newText);
        formData.append('textID', textID);
        formData.append('title', currentTextTitle)

        //Data to send to fetch call function
        let callURL = apiLinkTexts;
        let callMethod = 'POST';
        let callData = formData;
        let callMessage = textMessage;
        let callWord = 'text';
        
        //call fetch function
        callFetch(callURL, callMethod, callData, callMessage, callWord);

    }

    
    
}