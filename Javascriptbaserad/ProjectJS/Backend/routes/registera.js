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
                    res.status(400).send({ message: "Email already exist" })
                    die()
                }
            })
        await userModel.findOne({ $or: [{ username: username }] })
            .then(user => {
                if (user) {
                    res.status(400).send({ message: "Username already exist" })
                    die()

                }
            })


        if (req.body.email == null) return res.status(400).send({ message: "An email is required" })
        if (req.body.username == null) return res.status(400).send({ message: "An username is required" })
        if (req.body.password == null || req.body.password.length < 5) return res.status(400).send({ message: "A password is required" })

        //Hash password
        const hashedPassword = await bcrypt.hash(req.body.password, bcrypt.genSaltSync(10));

        const user = new userModel({
            email: req.body.email,
            username: req.body.username,
            password: hashedPassword,
            timestamp: Date.now().toString()
        })

        const newUser = await user.save()
        return res.status(200).send({ message: "You are now registered" })

    } catch (err) {
        res.status(500).send()
    }

})


//Export module
module.exports = router; 