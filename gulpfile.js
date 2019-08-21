// Theme Folder
var url = "./wp-content/themes/nissanfest/";

// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
// var img = require('gulp-imagemin');

// Compile Images
// gulp.task('images', function() {
//     return gulp.src(url+'img/src/*')
//         .pipe(img())
//         .pipe(gulp.dest('../'))
// });

// Compile Our Sass
gulp.task('sass', function() {
    return gulp.src(url+'css/src/**/*.scss')
        .pipe(sass())
        .pipe(gulp.dest(url+'css/'))
});

//Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src(url+'js/src/**/*.js')
        .pipe(concat('nf.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(url+'js/'))
});

gulp.task('dev', ['sass', 'scripts']);

// Production Task
gulp.task('prod', ['sass', 'images', 'scripts']);