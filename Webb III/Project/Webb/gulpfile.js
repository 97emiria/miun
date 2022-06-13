const { src, dest, parallel, series, watch } = require('gulp');

//Overall/Other 
const browserSync = require('browser-sync').create();       //En "live server"
const concat = require('gulp-concat');                      //Slår ihop filer
const sourcemaps = require('gulp-sourcemaps');              //Karta efter filer slåtts ihop

//SASS
const sass = require('gulp-sass')(require('sass'));         //Sass --> css
const autoprefixer = require('gulp-autoprefixer');          //Gör CSS anpassad till olika webbläsare 
const cssnano = require('gulp-cssnano');                    //Komprimerar css fil(er)

//Typescritp
const ts = require('gulp-typescript');                      //Hanterar TypeScript-kompileringsarbetsflödet
const tsProject = ts.createProject("tsconfig.json");
const terser = require('gulp-terser');                      //Komprimera js filer
const babel = require('gulp-babel');                        //Gör koden bakåtkompatibel 

//Image
const imagemin = require('gulp-imagemin');                  //Komprimerar bilder


//File paths
const files = {
    htmlPath: "src/**/*.html",
    jsPath: "src/javascript/*.js",
    sassPath: "src/style/*.scss",
    tsPath: "src/typescript/*.ts",
    imagePath: "src/images/*"
}

//Html task
function htmlTask() {
    return src(files.htmlPath)
        .pipe(dest('pub'));
}

//Sass->css function
function sassTask() {
    return src(files.sassPath)
        .pipe(sourcemaps.init())                    //Kartlägger
        .pipe(sass().on("error", sass.logError))    //Fixar scss -> css
        .pipe(autoprefixer('last 2 versions'))      //Fixar så CSS kod fungerar på alla webbläsare
        .pipe(cssnano())                            //Komprimerar 
        .pipe(sourcemaps.write('../maps'))          //Kartlägger
        .pipe(dest('pub/style'))                    //Lägger till i pub mappen
        .pipe(browserSync.stream());
}

//Typescritp
function tsTask() {
    return src(files.tsPath)
        .pipe(sourcemaps.init())                    
        .pipe(tsProject())
        .pipe(babel())
        .pipe(concat('main.js'))
        .pipe(terser())
        .pipe(sourcemaps.write('../sourcemap'))
        .pipe(dest('pub/javascript'));
}

//image
function imageTask() {
    return src(files.imagePath)
    .pipe(imagemin())
    .pipe(dest('pub/images'))
}


function watchTask() {
   /**
    * 
    *  browserSync.init({
        server: "./pub"
    });
    */
    watch([files.htmlPath, files.sassPath, files.tsPath, files.imagePath], parallel(htmlTask, sassTask, tsTask, imageTask)); //.on('change', browserSync.reload)
}

    exports.default = series(
        parallel(htmlTask, sassTask, tsTask, imageTask),
        watchTask
    );