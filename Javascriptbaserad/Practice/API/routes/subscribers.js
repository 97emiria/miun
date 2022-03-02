const express = require('express');
const router = express.Router();

//Get mongoose schema for subscribers
const  Subscriber = require('../models/subscriber')

//Getting all 
router.get('/', async (req, res) => {
    try {
        const subscribers = await Subscriber.find()
        //200 success (dont needed thou)
        res.status(200).json(subscribers)
    } 
    catch (err) {
        //500 api fault, not user
        res.status(500).json({message: err.massage})
    }
})


//Get one by id (also using Middleware function)
router.get('/:id', getSubscriber, (req, res) => {
    res.send(res.subscriber.name)
})


//Create (its async function)
router.post('/', async (req, res) => {
    //Get users info (compare to schema)
    const subscriber = new Subscriber ({
        name: req.body.name,
        subscriberToChannel: req.body.subscriberToChannel,
        subscriberDate: req.body.subscriberDate
    })

    //Save it to database
    try {
        const newSubscriber = await subscriber.save()
        //201 success in creating new
        res.status(201).json(newSubscriber)
    }
    catch (err) {
        //400 Users sending wrong/bad data 
        res.status(400).json({message: err.message})

    }

})


//Edit (PUT update all, Patch update only what it get (or what u send to it)) REMEBER ASYNC!!
router.patch('/:id', getSubscriber, async (req, res) => {
    //If new name is sent, update
    if(req.body.name != null) {res.subscriber.name = req.body.name;}
    //If xx is sent, update
    if(req.body.subscriberToChannel != null) {res.subscriber.subscriberToChannel = req.body.subscriberToChannel;}
    
    //Update database
    try {
        const updateSubscriber = await res.subscriber.save();
        //204 mer lämpligt, men retunerar inte användaren
        res.status(200).json(updateSubscriber)
        //res.status(200).json({message: "User updated"})
    }
    catch (err) {
        //400 Users sending wrong/bad data 
        res.status(400).json({message: err.message})
    }

})


//Delete
router.delete('/:id', getSubscriber, async (req, res) => {
    try {
        await res.subscriber.remove();

        //200 success (dont needed thou)
        res.status(200).json({message: "Deleted success"})
    }
    catch (err) {
       //500 API problems
       return res.status(500).json({message: err.message})
    }
})


//Middleware function, that get users id 
async function getSubscriber (req, res, next) {
    let subscriber;

    try {
        subscriber = await Subscriber.findById(req.params.id)
        
        if(subscriber == null) {
            //404 users not found
            return res.status(404).json({message: "Cannot find user"})
        }
    }
    catch (err) {
        //500 API problems
        return res.status(500).json({message: err.message})
    }

    //Send result
    res.subscriber = subscriber;
    next()
}


//Export module
module.exports = router;