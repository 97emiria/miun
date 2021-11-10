//Get 
const express = require('express');

//Needed to avoid cors
let cors = require('cors');

//File way in varibale so only one needed to be change
const dataPathName = './data/courses.json';
//Get Json data, throu file-varibale
const data = require(dataPathName);

//Needed for files
const fs = require('fs');

//Creat
const app = express();
let courseData = data;

//Run neccety things
app.use(cors());
app.use(express.static("public"));


//Server CRUDs
app.get('/courses', (req, res) => {

    //Sending json data
    res.status(200).json(courseData);

});

//Show one course
app.get('/courses/:id', (req, res) => {

   let result = courseData.find( item => item.id == req.params.id ) 

   if (result) {
    res.status(200).json( result );

   } else {
    res.status(400).json( {message: `ID ${req.params.id} its not found`} );
   }


});

//Delete a course
app.delete('/courses/:id', (req, res) => {
    
    let result = courseData.find( item => item.id == req.params.id ) 

    if (result) {
        let updatedList = courseData.filter(item => item.id != req.params.id);
        let string = JSON.stringify(updatedList);

       fs.writeFile(dataPathName, string, (err) => {
            if (err) throw err;
            console.log('Removed object success or update json file success (depends on how u want to see it)!');
        });

        res.status(200).json( {message: 'Success'} );

    
    } else {
     res.status(400).json( {message: `ID ${req.params.id} its not found`} );
    }

});

app.listen(3000);