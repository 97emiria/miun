const express = require('express');
const router = express.Router();
const bcrypt = require('bcrypt');

//Get module
const PostModel = require('../models/Post');


//Get ALL users
router.get('/', async (req, res) => {
    try {
        const post = await PostModel.find()
        res.status(200).json(post.reverse())
    }
    catch (err) {
        //500 api fault, not user
        res.status(500).json({ message: err.massage })
    }
})


//Get one by id (also using Middleware function)
router.get('/:id', getPostsById, (req, res) => {
    res.send(res.post)
})


//Add new post
router.post('/', async (req, res) => {

    const post = new PostModel({
        userID: req.body.userID,
        username: req.body.username,
        text: req.body.text,
        emotion: req.body.emotion,
        hashtags: req.body.hashtags
    })

    //Save it to database
    try {
        const newPost = await post.save()
        //201 success in creating new
        res.status(201).json(newPost)
    }
    catch (err) {
        //400 Users sending wrong/bad data 
        res.status(400).json({ message: err.message })

    }

})

//Delete
router.delete('/:id', async (req, res) => {

    try {
        await PostModel.findByIdAndDelete(req.params.id);
        res.status(200).json({ message: "Deleted success" })
    }

    catch (err) {
        //500 API problems
        return res.status(500).json({ message: err.message })
    }

})



//Edit (PUT update all, Patch update only what it get (or what u send to it)) REMEBER ASYNC!!
router.patch('/:id', getPostsById, async (req, res) => {

    //If xx is sent, update
    if (req.body.text != null) { res.post.text = req.body.text; }
    if (req.body.emotion != null) { res.post.emotion = req.body.emotion; }

    //Update database
    try {
        const updatePost = await res.post.save();
        //204 mer lämpligt, men retunerar inte användaren
        res.status(200).json(updatePost)
    }
    catch (err) {
        //400 Users sending wrong/bad data 
        res.status(400).json({ message: err.message })
    }
})





//Middleware function, that get post by id 
async function getPostsById(req, res, next) {
    let post;

    try {
        post = await PostModel.find({ userID: req.params.id });

        if (post == null) {
            //404 users not found
            return res.status(404).json({ message: "Cannot find user" })
        }
    }
    catch (err) {
        //500 API problems
        return res.status(500).json({ message: err.message })
    }

    //Send result
    res.post = post.reverse();
    next()
}





//Export module
module.exports = router; 