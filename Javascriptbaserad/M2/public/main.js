let t = new Date();
document.getElementById('timestamp').innerHTML = t.getUTCHours()+1 + ":" + t.getUTCMinutes() + ":" + t.getUTCSeconds() + ", " + t.getUTCDate() + "/" + (t.getUTCMonth() + 1) + "/" + t.getUTCFullYear();


//Get elements
let coursesList = document.getElementById('coursesList');
let message = document.getElementById('message');


let getCourses = () => {
    
    fetch('http://localhost:3000/courses/')

    .then(response => {

        response.json().then(data => {

            data.forEach(data => {

                coursesList.innerHTML += 
                `
                    <li> 
                        ${data.name} 
                        <button onclick="deleteCourse(${data.id})">
                            <img src="images/iconDelete.png" alt="">
                        </button> 
                    </li>
                `
            })

        });
    });

}


getCourses();


let deleteCourse = id => {

    fetch(`http://localhost:3000/courses/${id}`, {
        method: 'DELETE'
    })
    .then(response => {

        response.json().then(data => {

            let string = JSON.stringify(data);
            let parse = JSON.parse(string);

            //if http status is okey, update list and show message
            if(response.ok) {

                //Remove all elements in ul-list
                while (coursesList.firstChild) {
                    coursesList.removeChild(coursesList.firstChild);
                }
                
                setTimeout(() => {getCourses(); }, 1000);

                //Print out message from server
                message.innerHTML = parse.message;
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


let clearMessage = () => {
    
    setTimeout(() => {
        message.innerHTML = ""; 
        message.removeAttribute('class');
    }, 3000);

}


