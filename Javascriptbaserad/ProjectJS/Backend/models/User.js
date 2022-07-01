const mongoose = require('mongoose');

var current = new Date();
const timeStamp = new Date(Date.UTC(current.getFullYear(), 
current.getMonth(),current.getDate(),current.getHours(), 
current.getMinutes(),current.getSeconds(), current.getMilliseconds()));

const UserSchema = new mongoose.Schema({
    email: {
        type: String,
        require: true,
        lowercase: true
    },
    username: {
        type: String,
        require: true,
        lowercase: true
    },
    password: {
        type: String,
        require: true
    },
    timestamp: {
        type: Date,
        default: timeStamp,
        require: true,
        lowercase: true
    }
})

module.exports = mongoose.model('User', UserSchema)