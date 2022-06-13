

//Use to post, put and delete
let callFetch = (callURL, callMethod, callData, callMessage, callWord) => {

    //Connect to database
    fetch(callURL, {
        method: callMethod, 
        body: callData,
    })
    .then(response => {

        response.json().then(data => {

            //Take JSON info make to string
            let string = JSON.stringify(data);
            //Convert string to object
            let parse = JSON.parse(string);

            //Print out objekt message fom Rest
            if(response.ok) {
                callMessage.innerHTML = parse.message;
                callMessage.classList.add("success");

                updateListAdmin(callWord);
                clearAllMessages(callWord);

            } else {
                callMessage.innerHTML = parse.message;
                callMessage.classList.add("error");
            }
            
        });

    });
}



