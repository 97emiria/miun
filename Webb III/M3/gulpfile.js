//const gulp = require('gulp');

//Använd för src->pub
const { src, dest, parallel, series, watch } = require('gulp');

const concat = require('gulp-concat');                      //Slår ihop filer
const terser = require('gulp-terser');                      //Komprimera js filer
const imagemin = require('gulp-imagemin');                  //Komprimerar bilder
const sourcemaps = require('gulp-sourcemaps');              //Karta
const browserSync = require('browser-sync').create();       //En "live server"
const cwebp = require('gulp-cwebp');                        //Converterar till webp

const sass = require('gulp-sass')(require('sass'));

const cssnano = require('gulp-cssnano');                    //Komprimerar css fil(er)
const autoprefixer = require('gulp-autoprefixer');          //Gör CSS mer anpassad till olika webbläsare 

//Sökväg till olika filer
const files = {
    htmlPath: "src/**/*.html",
    jsPath: "src/javascript/*.js",
    imagePath: "src/images/*",
    sassPath: "src/style/*.scss"
}

//Hämtar HTML
function taskHTML() {
    return src(files.htmlPath)                  //Hämtar fil
        .pipe(dest('pub'));                     //Lägger över till pub-mappen
}

function taskSASS() {
    return src(files.sassPath)
        .pipe(sourcemaps.init())                    //Kartlägger
        .pipe(sass().on("error", sass.logError))    //Fixar scss -> css
        //.pipe(autoprefixer('last 2 versions'))    //Fixar så CSS kod fungerar på alla webbläsare
        //.pipe(concat('main.css'))                 //Slår ihop filer
        //.pipe(cssnano())                          //Komprimerar 
        .pipe(sourcemaps.write('../maps'))          //Kartlägger
        .pipe(dest('pub/style'))                    //Lägger till i pub mappen
        .pipe(browserSync.stream());
}


//Hämtar JavaScript
function taskJS() {
    return src(files.jsPath)
        .pipe(sourcemaps.init())                    //Läser in för att lägga i mappar
        .pipe(concat('main.js'))
        .pipe(terser())
        .pipe(sourcemaps.write('../maps'))
        .pipe(dest('pub/javascript'));
}

//Hämtar Images
function taskImg() {
    return src(files.imagePath)
        .pipe(imagemin())
        .pipe(dest('pub/images'))
        .pipe(cwebp())
        .pipe(dest('pub/images'))
}


//Watch-task
function watchTask() {

    //Öppnar en "live server"
    browserSync.init({
        server: "./pub"
    });

    watch([files.htmlPath, files.sassPath, files.jsPath, files.imagePath], parallel(taskHTML, taskSASS, taskJS, taskImg)).on('change', browserSync.reload);

}

exports.default = series(
    parallel(taskHTML, taskSASS, taskJS, taskImg),
    watchTask
);