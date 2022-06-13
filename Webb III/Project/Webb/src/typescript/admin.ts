"use strict";


//Element in admin header
let header_left = document.getElementById('header_left');

//Get input (values) 
let emailInput = document.getElementById('email'); 
let passwordInput = document.getElementById('password');

//Other elements needed
let submitBtn = document.getElementById('submitBtn');
let loginTest = document.getElementById('login_test');
let signInMessage = document.getElementById('signInMessage');

//Form elements (admin)
let emailPassword = document.getElementById('emailPassword');
let passwordPassword = document.getElementById('passwordPassword');
let passwordForm = document.getElementById('passwordForm');

//Form message
let passwordMessage = document.getElementById('passwordMessage');




//Function to sign in admin user
let signInUser = async (event) => {

    //Stop form to reload
    event.preventDefault();

    //Collect Values from inputs
    let password = (<HTMLInputElement>passwordInput).value;
    let email = (<HTMLInputElement>emailInput).value;

    //Creat api link with input values
    let apiLinkWithValues = apiLinkSignIn + "?email=" + email + 
                            "&password=" + password;
    
    fetch(apiLinkWithValues)

    .then(response => {
        //If user can sign in
        if(response.ok) {

            response.json().then(data => {

                data.forEach(user => {
                    sessionStorage.setItem('name', user.firstname);
                    sessionStorage.setItem('id', user.userID);
                    sessionStorage.setItem('signIn', 'true'); 
    
                    location.replace("/admin/index.html");
                
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
                signInMessage.innerHTML = parse.message;
                signInMessage.classList.add("error");

            });

        } else {

            //Well, if something unexpectedly happend? 
            signInMessage.innerHTML = 'Kontakta administratören';
            signInMessage.classList.add("error");
        }
 
      
    });

};



let changePassword = (event) => {

    //Stop form to reload
    event.preventDefault();

    //collect input values
    let newPassword = (<HTMLInputElement>passwordPassword).value;
    let userEmail = (<HTMLInputElement>emailPassword).value;

    let updatePassword = {'password': newPassword, 'email': userEmail}; 

    
    let callURL = apiLinkSignIn;
    let callMethod = 'PUT';
    let callData = JSON.stringify(updatePassword);
    let callMessage = passwordMessage;
    let callWord = 'password'; //Not needed 
    
    //call fetch function
    callFetch(callURL, callMethod, callData, callMessage, callWord);

}


/*
    If random user get to admin page, check if its sign in or not throu local storge
    If not, send them to sign in page
    Or print out thier name in header
*/

let checkAdmin = () => {
    if (sessionStorage.getItem("signIn") != 'true' || sessionStorage.getItem("signIn") == 'false' || sessionStorage.getItem("signIn") === null ) {

        location.replace("login.html");

    } 
}


//Sign out admin user
let signOut = () => {
    sessionStorage.clear();
    location.replace("login.html");
}

