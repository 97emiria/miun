"use strict";

//Elements
let webbpageList = document.getElementById('webbpageList'); //Ul-list
let webbpageMessage = document.getElementById('webbpageMessage');

//Form elements
let webbpageForm = document.getElementById('webbpageForm');
let titleWebbpage = document.getElementById('titleWebbpage');
let linkWebbpage = document.getElementById('linkWebbpage');
let descriptionWebbpage = document.getElementById('descriptionWebbpage');
let imageWebbpage = document.getElementById('imageWebbpage');
let webbpageLinkLink = document.getElementById('webbpageLinkLink');             //A-element to display a clickable link
let webbpageImage = document.getElementById('webbpageFrom_imgDiv');

let editWebbpageBtn = document.getElementById('editWebbpageBtn');               //Edit btn form
let deleteWebbpageBtn = document.getElementById('deleteWebbpageBtn');           //Delete btn from
let addWebbpageBtn = document.getElementById('addWebbpageBtn');                 //Add btn form



if (editWebbpageBtn != null) {
    //Hide all btns in the beginning
    editWebbpageBtn.style.display='none';
    deleteWebbpageBtn.style.display='none';
    addWebbpageBtn.style.display='none';
    webbpageForm.style.display='none';
}


let getWebbpageListAdmin = () => {

    fetch(apiLinkWebbpages)
    .then( response => {

        //If user can sign in
        if(response.ok) {

            response.json().then(data => {

                data.forEach(webbpages => {

                    webbpageList.innerHTML += `
                        <li onclick="changeWebbpageInfo('${webbpages.webbpageID}')"> ${webbpages.title} </li>
                    `;
                      
                  })

            });


        //If something is wrong
        } else if (!response.ok) {

            //Get info
            response.json().then(data => {

                //Take JSON info make to string
                let string = JSON.stringify(data);
                //Convert string to object
                let parse = JSON.parse(string);

                //Print out objekt message fom Rest
                webbpageMessage.innerHTML = parse.message;
                webbpageMessage.classList.add("error");

            });

        } else {

            webbpageMessage.innerHTML = 'Något gått snett, kolla koden';
            webbpageMessage.classList.add("message");
        }

        
    });

}



let changeWebbpageInfo = (webbpageID) => {

    fetch(apiLinkWebbpagesWithID+webbpageID)
    .then(response => response.json())
        .then(data => {
            data.forEach(webbpage => {

                    clearInputs('webbpage');

                    (<HTMLInputElement>titleWebbpage).value = webbpage.title;
                    (<HTMLInputElement>linkWebbpage).value  = webbpage.link;
                    webbpageLinkLink.setAttribute('href', webbpage.link);
                    webbpageLinkLink.innerHTML = webbpage.link;
                    (<HTMLInputElement>descriptionWebbpage).value  = webbpage.description;

                    if(webbpage.imgPath == "" || webbpage.imgPath == null || webbpage.imgPath == 'empty') {
                        
                        
                        webbpageImage.innerHTML = ` 
                            <img src="../images/missing.png" style="border: 2px solid #333;" alt=""> 
                        `;

                    } else {
                        
                        webbpageImage.innerHTML = `
                            <p> Nuvarande bild: </p>
                            <img src="${webbpage.imgPath}" alt=""/>
                        `;


                    }

                    editWebbpageBtn.setAttribute("onclick","editWebbpage(" + webbpageID + ");");
                    deleteWebbpageBtn.setAttribute("onclick","deleteWebbpage(" + webbpageID + ");");

                    editWebbpageBtn.style.display='block';
                    deleteWebbpageBtn.style.display='block';
                    webbpageForm.style.display='block';
                    addWebbpageBtn.style.display='none';

                    clearAllMessages('webbpage');

            })
        })
}



let deleteWebbpage = (webbpageID) => {
    //Stoppar formulär för att ladda om
    event.preventDefault();

    let title = (<HTMLInputElement>titleWebbpage).value;
    let deleteData = {'title': title, 'webbpageID': webbpageID};

    //To prevent mistake, do alert before
    let alertReslut = confirm("Är du säker på att du vill radera webbsidan?");

    if (alertReslut == true) {
    
        //Data to send to fetch call function
        let callURL = apiLinkWebbpagesWithID+webbpageID;
        let callMethod = 'DELETE';
        let callData = JSON.stringify(deleteData);
        let callMessage = webbpageMessage;
        let callWord = 'webbpage';
        
        //call fetch function
        callFetch(callURL, callMethod, callData, callMessage, callWord);

    }
}



let editWebbpage = (webbpageID) => {


       //Stoppar formulär för att ladda om
       event.preventDefault();

        //If image not exist, lets do a PUT request, other way make POST
        if((<HTMLInputElement>imageWebbpage).files[0] == null) {

            //collect input data
            let editWebbTitle = (<HTMLInputElement>titleWebbpage).value;
            let editWebbLink = (<HTMLInputElement>linkWebbpage).value;
            let editWebbDescription = (<HTMLInputElement>descriptionWebbpage).value;
        
            let updateWebbpage = {'webbpageID': webbpageID, 'title': editWebbTitle, 'link': editWebbLink, 'description': editWebbDescription}; 
        
            //Data to send to fetch call function
            let callURL = apiLinkWebbpagesWithID+webbpageID;
            let callMethod = 'PUT';
            let callData = JSON.stringify(updateWebbpage);
            let callMessage = webbpageMessage;
            let callWord = 'webbpage';
            
            //call fetch function
            callFetch(callURL, callMethod, callData, callMessage, callWord);

        } else {

            //collect input data
            let editWebbTitle = (<HTMLInputElement>titleWebbpage).value;
            let editWebbLink = (<HTMLInputElement>linkWebbpage).value;
            let editWebbDescription = (<HTMLInputElement>descriptionWebbpage).value;
            let editImageWebbpage = (<HTMLInputElement>imageWebbpage).files[0];

            //Creat formdata and put in infromation in it
            let formData = new FormData();
            formData.append('webbpageID', webbpageID);
            formData.append('title', editWebbTitle);
            formData.append('link', editWebbLink);
            formData.append('description', editWebbDescription);
            formData.append('image', editImageWebbpage);
            formData.append('mission', 'edit');
    
            //Data to send to fetch call function
            let callURL = apiLinkWebbpagesWithID+webbpageID;
            let callMethod = 'POST';
            let callData = formData;
            let callMessage = webbpageMessage;
            let callWord = 'webbpage';
            
            //call fetch function
            callFetch(callURL, callMethod, callData, callMessage, callWord);

        }

    
 
   
}




let prepareToAddWebbapge = () => {

    editWebbpageBtn.style.display='none';
    deleteWebbpageBtn.style.display='none';
    addWebbpageBtn.style.display='block';
    webbpageForm.style.display='block';

    clearInputs('webbpage');

    addWebbpageBtn.setAttribute("onclick","addWebbpage();")

    clearAllMessages('webbpage');
}




let addWebbpage = () => {

   //Stop form to reload page
   event.preventDefault();
    
    //collect input data
    let newWebbTitle = (<HTMLInputElement>titleWebbpage).value;
    let newWebbLink = (<HTMLInputElement>linkWebbpage).value;
    let newWebbDescription = (<HTMLInputElement>descriptionWebbpage).value;
    let newImageWebbpage = (<HTMLInputElement>imageWebbpage).files[0];

    //Creat formdata and put in infromation in it
    let formData = new FormData();
    formData.append('image', newImageWebbpage);
    formData.append('title', newWebbTitle);
    formData.append('link', newWebbLink);
    formData.append('description', newWebbDescription);
    formData.append('mission', 'add');


    //Data to send to fetch call function
    let callURL = apiLinkWebbpages;
    let callMethod = 'POST';
    let callData = formData;
    let callMessage = webbpageMessage;
    let callWord = 'webbpage';
    
    //call fetch function
    callFetch(callURL, callMethod, callData, callMessage, callWord);

}

