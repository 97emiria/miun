const express = require('express');
const courses = require('../models/courses');
const router = express.Router();
const coursesModle = require('../models/courses')



//Show all saved courses
router.get('/', async (req, res) => {
    try {
        const courses = await coursesModle.find()
        res.json(courses)
      } catch (err) {
        res.status(500).json({ message: err.message })
      }
});


//Show one courses
router.get('/:id', getCourse, (req, res) => {
    res.send(res.course);
});

//Creat 
router.post('/', async (req, res) => {

    //Get the new values
    const course = new coursesModle({
        code: req.body.code,
        name: req.body.name,
        progression: req.body.progression,
        semester: req.body.semester,
        syllabus: req.body.syllabus
    })

    try {
        const newCourse = await course.save()
        res.status(201).json(newCourse)

    } catch (err) {
        res.status(500).json({message: err.message})
    
    }

})

//Update
router.patch('/:id', getCourse, async (req, res) => {

    //Validate input
    if (req.body.code != null) {
        res.course.code = req.body.code
    }
    if (req.body.name != null) {
        res.course.name = req.body.name
    }
    if (req.body.progression != null) {
        res.course.progression = req.body.progression
    }
    if (req.body.semester != null) {
        res.course.semester = req.body.semester
    }
    if (req.body.syllabus != null) {
        res.course.syllabus = req.body.syllabus
    }

    try {
        const updateCourse = await res.course.save()
        res.json(updateCourse)

    } catch (err) {
        res.status(400).json({ message: err.message })

    }
});

//Delete a courses
router.delete('/:id', getCourse, async (req, res) => {
    try {
        await res.course.remove()
        /*res.json({ message: `${req.body.name} is now deleted`})*/
        res.json({ message: "Deleteded success"})

      } catch (err) {
        res.status(500).json({ message: err.message })

      } 
});




async function getCourse (req, res, next) {
    let course
    try {
        course = await coursesModle.findById(req.params.id)
        if(course == null) {
            return res.status(404).json({message: "Cannot find course"});
        } 

    } catch (err) {
        res.status(500).json({message: err.message})
    
    }

    res.course = course;
    next()
}






module.exports = router; 