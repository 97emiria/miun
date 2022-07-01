const express = require('express');
const router = express.Router();
const bcrypt = require('bcrypt');

//Get module
const userModel = require('../models/User');

//Login
router.post('/', async (req, res) => {

    const userName = req.body.user;
    const password = req.body.password;

    await userModel.findOne({ $or: [{ email: userName }, { username: userName }] })
        .then(user => {
            //Kollar om e-postadressen existerar, annars retunera det
            if (user) {
                //Gemför lösenord
                bcrypt.compare(password, user.password, (err, result) => {

                    if (err) {
                        console.log(err)
                    }

                    if (result) {
                        // await userModel.findOne({$or: [{email:userName}, {username: userName}]})
                        return res.status(200).send({ message: "Login success", userID: user._id, username: user.username })

                    } else {
                        //400 Users sending wrong/bad data 
                        return res.status(400).send({ message: "Password wrong" })
                    }
                })


            } else {
                //400 Users sending wrong/bad data 
                return res.status(400).send({ message: "Email or Username dont exist" })
            }
        })

})



//Export module
module.exports = router; 