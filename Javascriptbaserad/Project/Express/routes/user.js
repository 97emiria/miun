const express = require('express');
const router = express.Router();
const bcrypt = require('bcrypt');

//Get module
const userModel = require('../models/User');


//Get by id
router.get('/:id', getUserById, (req, res) => {
    res.status(200).send(res.user);
});

//Edit (PUT update all, Patch update only what it get (or what u send to it)) REMEBER ASYNC!!
router.patch('/:id', getUserById, async (req, res) => {

    //Collect data from user
    const oldPassword = req.body.oldPassword;

    //Preparing new password for database
    const newPassword = req.body.newPassword;
    const hashedPassword = await bcrypt.hash(newPassword, bcrypt.genSaltSync(10));

    const userResult = await userModel.findOne({ _id: req.params.id })

    // bcrypt.compare(oldPassword, userResult.password, async function (err, result) {
    //     if (err) {
    //         console.log(err)
    //     }

        // if (!result) {
        //     //400 Users sending wrong/bad data 
        //     return res.status(400).send({ message: "Old password wrong" })

        // } else {
            await userModel.findByIdAndUpdate({ _id: req.params.id }, { password: hashedPassword })
            res.status(200).json({ message: 'Success' })
        // }
    // })

});


//Delete
router.delete('/:id', getUserById, async (req, res) => {
    try {
        await res.user.remove()
        res.json({ message: "Deleteded success" })

    } catch (err) {
        res.status(500).json({ message: err.message })

    }
});



//Middleware function, that get users by id
async function getUserById(req, res, next) {
    let user
    try {
        //user = await userModel.findOne(req.params.id)
        user = await userModel.findById(req.params.id)

        //If no user is find 
        if (user == null) {
            //404 users not found
            return res.status(404).json({ message: "Cannot find user" });
        }

    } catch (err) {
        //500 API problems
        res.status(500).json({ message: err.message })
    }

    //Send result as variabel user
    res.user = user;
    next()
}




//Export module
module.exports = router; 