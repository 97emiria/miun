const mongoose = require('mongoose');

var current = new Date();
const timeStamp = new Date(Date.UTC(current.getFullYear(), 
current.getMonth(),current.getDate(),current.getHours(), 
current.getMinutes(),current.getSeconds(), current.getMilliseconds()));

const PostSchema = new mongoose.Schema({
    userID: {
        type: String,
        require: true,
        lowercase: true
    },
    username: {
        type: String,
        require: true,
        lowercase: true
    },
    text: {
        type: String,
        require: true
    },
    emotion: {
        type: String,
        require: true,
        lowercase: true
    },
    hashtags: {
        type: Array,
        lowercase: true
    },
    timestamp: {
        type: Date,
        default: timeStamp,
        require: true,
        lowercase: true
    }
})

module.exports = mongoose.model('Post', PostSchema)