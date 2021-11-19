//const gulp = require('gulp');

//Använd för src->pub
const {src, dest, parallel, series, watch} = require('gulp');

const concat = require('gulp-concat');                      //Slår ihop filer
const terser = require('gulp-terser');                      //Komprimera js filer
const cssnano = require('gulp-cssnano');                    //Komprimerar css fil(er)
const imagemin = require('gulp-imagemin');                  //Komprimerar bilder
const sourcemaps = require('gulp-sourcemaps');              //Karta
const browserSync = require('browser-sync').create();       //En "live server"
const cwebp = require('gulp-webp');                         //Converterar till webp
const dwebp = require('gulp-dwebp');                        //Converterar från webp till png
const autoprefixer = require('gulp-autoprefixer');          //Gör CSS mer anpassad till olika webbläsare 

//Sökväg till olika filer
const files = {
    htmlPath: "src/**/*.html",
    cssPath: "src/style/*.css",
    jsPath: "src/javascript/*.js",
    imagePath: "src/images/*"
}

//Hämtar HTML
function taskHTML() {
    return src(files.htmlPath)              //Hämtar fil
    .pipe(dest('pub'));                     //Lägger över till pub-mappen
} 

//Hämtar Css
function taskCSS() {
    return src(files.cssPath)
    .pipe(sourcemaps.init())                //Läser in för att lägga i mappar
    .pipe(concat('main.css'))               //Slår ihop
    .pipe(autoprefixer('last 2 versions'))  //Fixar så CSS kod fungerar på alla webbläsare
    .pipe(cssnano())
    .pipe(sourcemaps.write('../maps'))      //Lägger i mappar   
    .pipe(dest('pub/style'))
    .pipe(browserSync.stream());
} 



//Hämtar JavaScript
function taskJS() {
    return src(files.jsPath)
    .pipe(sourcemaps.init())              //Läser in för att lägga i mappar
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
    .pipe(dwebp())
    .pipe(dest('pub/images')); 
} 


//Watch-task
function watchTask() {

    //Öppnar en "live server"
    browserSync.init({
        server: "./pub"
    });

    watch([files.htmlPath, files.cssPath, files.jsPath, files.imagePath], parallel(taskHTML, taskCSS, taskJS, taskImg)).on('change', browserSync.reload);

}

exports.default = series(
    parallel(taskHTML, taskCSS, taskJS, taskImg),
    watchTask
);