//Require mongoose so schema is possible 
const mongoose = require('mongoose');

//Schema
const subscriberSchema = new mongoose.Schema({

    //Propertis
    name: {
        type: String,
        required: true
    },
    subscriberToChannel: {
        type: String,
        required: true
    },
    subscriberDate: {

        //What form data should have
        type: Date,

        //User can not leave this one out
        required: true,

        //If nothing is sent, auto date
        default: Date.now
    }
})


//Export schema
module.exports = mongoose.model('Subscribers', subscriberSchema)