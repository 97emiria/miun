let t = new Date();
document.getElementById('timestamp').innerHTML = t.getUTCHours()+1 + ":" + t.getUTCMinutes() + ":" + t.getUTCSeconds() + ", " + t.getUTCDate() + "/" + (t.getUTCMonth() + 1) + "/" + t.getUTCFullYear();


let getCourses = () => {
    
    fetch('http://localhost:3000/courses/')

    .then(response => {

        console.log(response.status);

        response.json().then(data => {

            //console.log( data.find( c => c.id == parseInt( 1 ) ) )

            data.forEach(data => {

                document.getElementById('indexList').innerHTML += 
                `
                    <li> 
                        ${data.namn} 
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

            //Print out objekt message fom Rest
            if(response.ok) {
                console.log(parse.message);

            } else {
                console.log(parse.message);
            }
            
        });

    });

    console.log(id)
}


