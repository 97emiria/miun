//Allows env
require('dotenv').config();

//Get whats needed
const express = require('express');
const mongoose = require('mongoose')

//Run express
const app = express();

//Connect db
mongoose.connect(process.env.DATABASE_URL, {useNewUrlParser: true})
const db = mongoose.connection

//Print out errors
db.on('error', (error) => console.error(error))
db.once('open', () => console.log("Connected to database :)"))

//Make Json body readable
app.use(express.json())

//Routes connection
const subscribersRouter = require('./routes/subscribers')
app.use("/subscribers", subscribersRouter)

//Run app
app.listen(3000, () => console.log("Server started :)"))