<?php

include('include/config.php');

$c = new Courses();


$code = "DT057G";
$name = "Webbutveckling I";
$progression = "A";
$syllabus = "https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22782";
$oldCode = "DT057G";

if (
    $c->setCode($code) &&
    $c->setName($name) &&
    $c->setProgression($progression) &&
    $c->setSyllabus($syllabus)
) {
    
    if ($c->updateCourse($code, $name, $progression, $syllabus)) {
        echo "Sucess";

    }else {
        echo "Error two";
    }


} else {
    echo "Error";
}




/*
$code = "DT093G";
$name = "Webbutveckling II";
$progression = "B";
$syllabus = "https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=27133";


$code = "DT057G";
$name = "Webbutveckling I";
$progression = "A";
$syllabus = "https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22782";




if (
    $c->setCode($code) &&
    $c->setName($name) &&
    $c->setProgression($progression) &&
    $c->setSyllabus($syllabus)
) {
    $c->addCourse($code, $name, $progression, $syllabus);
    echo "Sucess";

} else {
    echo "Error";
}
*/


