// Theme Folder
const url = "./wp-content/themes/nissanfest/";

// Include gulp
const { src, dest, parallel } = require('gulp');

// Include Our Plugins
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
  
function css() {
    return src(url+'css/src/**/*.scss')
      .pipe(sass())
      .pipe(dest(url+'css/'))
}
  
function js() {
    return src(url+'js/src/**/*.js', { sourcemaps: true })
        .pipe(concat('nf.min.js'))
        .pipe(uglify())
        .pipe(dest(url+'js/', { sourcemaps: true }))
}
  
exports.js = js;
exports.css = css;
exports.default = parallel(css, js);
exports.watch = parallel(css, js);

// Compile Our Sass
// gulp.task('sass', function() {
//     return gulp.src(url+'css/src/**/*.scss')
//         .pipe(sass())
//         .pipe(gulp.dest(url+'css/'))
// });

//Concatenate & Minify JS
// gulp.task('scripts', function() {
//     return gulp.src(url+'js/src/**/*.js')
//         .pipe(concat('nf.min.js'))
//         .pipe(uglify())
//         .pipe(gulp.dest(url+'js/'))
// });

// gulp.task('dev', ['sass', 'scripts']);

// // Production Task
// gulp.task('prod', ['sass', 'images', 'scripts']);