const express = require('express');
var cors = require('cors');
const app = express();
const data = require('./data/courses');
let courseData = data.courses;

app.use(cors());
app.use(express.static("public"));

app.get('/courses', (req, res) => {

    //This is sending som data, wonder what thou
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
        res.status(200).json( {message: 'Success'} );
    
    } else {
     res.status(400).json( {message: `ID ${req.params.id} its not found`} );
    }


    /**
     * Det som behövs göras är att hitta hur du tar den nya datan och uppdaterar json filen
     */


});

app.listen(3000);