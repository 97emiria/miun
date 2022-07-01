const express = require('express');
const router = express.Router();

//Hased password package
const bcrypt = require('bcrypt');

//Get module
const userModel = require('../models/User');


//Creat 

router.post('/', async (req, res) => {

    const email = req.body.email;
    const username = req.body.username;

    //Kollar om e-postadressen existerar, annars retunera det
    // await userModel.findOne({$or: [{email:username}, {username: username}]})


    try {

        await userModel.findOne({ $or: [{ email: email }] })
            .then(user => {
                if (user) {
                    res.status(400).send({ message: "Epostadressen finnns redan" })
                    die()
                }
            })
        await userModel.findOne({ $or: [{ username: username }] })
            .then(user => {
                if (user) {
                    res.status(400).send({ message: "Användarnamnet finnns redan" })
                    die()

                }
            })


        if (req.body.email == null) return res.status(400).send({ message: "Måste lämna en e-postadress" })
        if (req.body.username == null) return res.status(400).send({ message: "Måste lämna ett användarnamn" })
        if (req.body.password == null || req.body.password.length < 5) return res.status(400).send({ message: "Måste lämna en lösenord" })

        //Hash password
        const hashedPassword = await bcrypt.hash(req.body.password, bcrypt.genSaltSync(10));

        const user = new userModel({
            email: req.body.email,
            username: req.body.username,
            password: hashedPassword,
            timestamp: Date.now().toString()
        })

        const newUser = await user.save()
        return res.status(200).send({ message: "Du är nu registerad" })

    } catch (err) {
        res.status(500).send()
    }

})


//Export module
module.exports = router; 