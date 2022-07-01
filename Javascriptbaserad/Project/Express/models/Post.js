const mongoose = require('mongoose');

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
        default: new Date(),
        require: true,
        lowercase: true
    }
})

module.exports = mongoose.model('Post', PostSchema)