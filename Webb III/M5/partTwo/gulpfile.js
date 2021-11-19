const { src, dest, parallel, series, watch } = require('gulp');


//Collect all npm values 
const browserSync = require('browser-sync').create();       //En "live server"
const sourcemaps = require('gulp-sourcemaps');              //Karta
const concat = require('gulp-concat');                      //Slår ihop filer

const terser = require('gulp-terser');                      //Komprimera js filer
const cssnano = require('gulp-cssnano');                    //Komprimerar css fil(er)

const sass = require('gulp-sass')(require('sass'));

//Files 
const files = {
    htmlPath: "src/**/*.html",
    jsPath: "src/javascript/*.js",
    sassPath: "src/style/*.scss",
    restPath: "src/**/*.php",
    classesPath: "src/include/classes/*",
    imagePath: "src/images/*"
}

function htmlTask() {
    return src(files.htmlPath)
        .pipe(dest('pub'));
}

function sassTask() {
    return src(files.sassPath)
        .pipe(sourcemaps.init())                    //Kartlägger
        .pipe(sass().on("error", sass.logError))    //Fixar scss -> css
        .pipe(sourcemaps.write('../maps'))          //Kartlägger
        .pipe(dest('pub/style'))                    //Lägger till i pub mappen
        .pipe(browserSync.stream());
}

function jsTask() {
    return src(files.jsPath)
        .pipe(sourcemaps.init())                    //Läser in för att lägga i mappar
        .pipe(concat('main.js'))
        .pipe(terser())
        .pipe(sourcemaps.write('../maps'))
        .pipe(dest('pub/javascript'));
}

function restTask() {
    return src(files.restPath)
    .pipe(dest('pub/'))                    //Lägger till i pub mappen

}

function classesPaths() {
    return src(files.classesPath)
    .pipe(dest('pub/include/classes'))  
}


function imagePath() {
    return src(files.imagePath)
    .pipe(dest('pub/images'))
}


function watchTask() {
    browserSync.init({
        server: "./pub"
    });
    watch([files.htmlPath, files.sassPath, files.jsPath], parallel(htmlTask, sassTask, jsTask)).on('change', browserSync.reload);
}

exports.default = series(
    parallel(htmlTask, sassTask, jsTask, restTask, classesPaths, imagePath),
    watchTask
);