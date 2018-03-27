const gulp = require('gulp')
const sass = require('gulp-sass')
const sourcemaps = require('gulp-sourcemaps')
const cleanCSS = require('gulp-clean-css')
const purify = require('gulp-purifycss')
const concat = require('gulp-concat')
const plumber = require('gulp-plumber')
const optimizejs = require('gulp-optimize-js')
const uglifyjs = require('uglify-es')
const rename = require('gulp-rename')
const composer = require('gulp-uglify/composer')

const uglify = composer(uglifyjs, console)

gulp.task('css', function() {
  return gulp.src('./scss/main.scss')
	  .pipe(plumber())
		.pipe(sourcemaps.init())
	  .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
		.pipe(sourcemaps.write())
    //.pipe(purify(['./_comparison/**/*.php']))
		.pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(gulp.dest('./dist/'));
});

gulp.task('javascript', () => {
	return gulp.src(

	)
		.pipe(plumber())
		.pipe(concat('bundled.js'))
		.pipe(uglify())
    .pipe(optimizejs())
		.pipe(rename('bundled.min.js'))
		.pipe(gulp.dest('./app'))
})
