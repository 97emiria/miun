//?? - Import .env file 
require('dotenv').config();

//Get 
const express = require('express');
const mongoose = require('mongoose');
const app = express();
let cors = require('cors');            

//Db Connection
mongoose.connect(process.env.DATABASE_URL, {
    useUniFiedTopology: true,
    useNewUrlParser: true,
}).then(console.log('Connected to mongodb'))
.catch(error => {
    console.log('Error: ', error)
})

//Run neccety things
app.use(express.json())
app.use(cors());
app.use(express.static("public"));


//Routes connection
const coursesRouter = require('./routes/courses')
app.use('/courses', coursesRouter)


//Listning to server
app.listen(3000, () => console.log('Server started'));
