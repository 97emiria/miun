const mongoose = require('mongoose');

const coursesSchema = new mongoose.Schema({
    code: {
        type: String,
        require: true
    },
    name: {
        type: String,
        require: true
    },
    progression: {
        type: String,
        require: true
    },
    semester: {
        type: String,
        require: true
    },
    syllabus: {
        type: String,
        require: true
    }
})

module.exports = mongoose.model('Courses', coursesSchema)