//Allows env
require('dotenv').config();

//Get whats needed
const express = require('express');
const mongoose = require('mongoose')
let cors = require('cors');
var bodyParser = require('body-parser')

//Heroku
// const cool = require('cool-ascii-faces');

//Run express
const app = express()

//Connect db
mongoose.connect(process.env.DATABASE_URL, {
    useUniFiedTopology: true,
    useNewUrlParser: true,
}).then(console.log('Connected to mongodb'))
    .catch(error => {
        console.log('Error: ', error)
    })

//Make Json body readable
app.use(express.json())
app.use(cors());
// app.use(express.static("public"));
app.use(bodyParser.json())


app.get('/', (req, res) => {
    res.status(200).send('Hello to vibba express server');
});

//Routes connection
const userRouter = require('./routes/user')
app.use('/user', userRouter)

const loginRouter = require('./routes/login')
app.use('/login', loginRouter)

const registeraRouter = require('./routes/registera')
app.use('/registera', registeraRouter)

const postsRouter = require('./routes/posts')
app.use('/posts', postsRouter)

// //Heroku
// app.get('/cool', (req, res) => res.send(cool()))
// app.set('views', path.join(__dirname, 'views'))
// app.set('view engine', 'ejs')
// app.use(express.static(path.join(__dirname, 'public')))

//Run app
app.listen(process.env.PORT || 5000, () => console.log("Server started :)"))