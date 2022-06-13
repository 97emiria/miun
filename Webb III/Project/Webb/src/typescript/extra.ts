"use strict";

let updateListAdmin = value => {

    if(value == 'work') {
        //Remove all elment in a div
        while (workListAdmin.firstChild) {
            workListAdmin.removeChild(workListAdmin.firstChild);
        }

        //Get all ul-list again
        getWorkListAdmin();
        clearInputs(value);

    } else if (value == 'education') {

        //Remove all elment in a div
        while (eduListAdmin.firstChild) {
            eduListAdmin.removeChild(eduListAdmin.firstChild);
        }
        //Get all ul-list again
        getEducationListAdmin();
        clearInputs(value);


    } else if (value == 'webbpage') {
        //Remove all elment in a div
        while (webbpageList.firstChild) {
            webbpageList.removeChild(webbpageList.firstChild);
        }
        //Get all ul-list again
        getWebbpageListAdmin();
        clearInputs(value);

    } else if (value == 'text') {
        //Remove all elment in a div
        while (adminListsText.firstChild) {
            adminListsText.removeChild(adminListsText.firstChild);
        }
        
        //Get all ul-list again
        getTextListAdmin();
        clearInputs(value);
    } 

}


let clearInputs = (values: string) => {
    
    if (values == 'work') {
        (<HTMLInputElement>titleWork).value = "";
        (<HTMLInputElement>workplace).value  = "";
        (<HTMLInputElement>dateWork).value  = "";
        (<HTMLInputElement>commentWork).value = "";

    } else if (values == 'education') {
        (<HTMLInputElement>titleEdu).value = "";
        (<HTMLInputElement>school).value  = "";
        (<HTMLInputElement>semester).value  = "";
        (<HTMLInputElement>dateEdu).value  = "";
        (<HTMLInputElement>statusEdu).value = "";
        (<HTMLInputElement>commentEdu).value = "";

    } else if (values == 'webbpage') {
        (<HTMLInputElement>titleWebbpage).value = "";
        (<HTMLInputElement>linkWebbpage).value  = "";
        (<HTMLInputElement>descriptionWebbpage).value  = "";
        (<HTMLInputElement>imageWebbpage).value  = "";
        webbpageLinkLink.setAttribute('href', "");
        webbpageLinkLink.innerHTML = "";
        webbpageImage.innerHTML = "";

    } else if (values == 'text') {
        (<HTMLInputElement>textTextarea).value = "";
        (<HTMLInputElement>textTitle).value = "";
        (<HTMLInputElement>textImage).value = "";
        textImgDiv.innerHTML = "";
    }
}





let clearAllMessages = (values: string) => {

    setTimeout(() => {

        if(values == 'work') {
            workMessage.innerHTML = "";
            workMessage.removeAttribute('class');

        } else if (values == 'education') {
            educationMessage.innerHTML = "";
            educationMessage.removeAttribute('class');

        } else if (values == 'text') {
            textMessage.innerHTML = "";
            textMessage.removeAttribute('class');
            
        } else if (values == 'webbpage') {
            webbpageMessage.innerHTML = "";
            webbpageMessage.removeAttribute('class');
            
        } else if (values == 'signIn') {
            signInMessage.innerHTML = "";
            signInMessage.removeAttribute('class');

        } else if (values == 'password') {
            passwordMessage.innerHTML = "";
            passwordMessage.removeAttribute('class');
        } 

    }, 6000);
}