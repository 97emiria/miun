const { src, dest, parallel, series, watch } = require('gulp');

//Overall/Other 
const sourcemaps = require('gulp-sourcemaps');              //Karta efter filer slåtts ihop

//SASS
const sass = require('gulp-sass')(require('sass'));         //Sass --> css
const autoprefixer = require('gulp-autoprefixer');          //Gör CSS anpassad till olika webbläsare 
const cssnano = require('gulp-cssnano');                    //Komprimerar css fil(er)


//File paths
const files = {
    sassPath: "src/*.scss",
}

//Sass->css function
function sassTask() {
    return src(files.sassPath)
        .pipe(sourcemaps.init())                    //Kartlägger
        .pipe(sass().on("error", sass.logError))    //Fixar scss -> css
        .pipe(autoprefixer('last 2 versions'))      //Fixar så CSS kod fungerar på alla webbläsare
        .pipe(cssnano())                            //Komprimerar 
        .pipe(sourcemaps.write('../maps'))          //Kartlägger
        .pipe(dest('public/'))                      //Lägger till i pub mappen
}


exports.default = series(
    parallel(sassTask),
);