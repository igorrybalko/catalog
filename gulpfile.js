//base part
const { src, dest, parallel, series, watch } = require('gulp'),
 rename = require('gulp-rename'),
 sourcemaps = require('gulp-sourcemaps');

const postcss = require('gulp-postcss');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const tailwindcss = require('tailwindcss');

const include = require('gulp-include'),
 uglify = require('gulp-uglify-es').default;

const options = require('./config');

function swallowError(error) {
 console.log(error.toString());
 this.emit('end');
}

function styles() {
 return src('./src/scss/style.scss')
  .pipe(sourcemaps.init())
  .pipe(sass().on('error', sass.logError))
  .on('error', swallowError)
  .pipe(cleanCSS({ level: { 1: { specialComments: false } } }))
  .pipe(rename('style.min.css'))
  .pipe(sourcemaps.write('./'))
  .pipe(dest(options.path.build.css));
}

function vendorStyles() {
 return src('./src/scss/vendor.scss')
  .pipe(sourcemaps.init())
  .pipe(sass().on('error', sass.logError))
  .pipe(postcss([tailwindcss(options.config.tailwindjs)]))
  .on('error', swallowError)
  .pipe(cleanCSS({ level: { 1: { specialComments: false } } }))
  .pipe(rename('vendor.min.css'))
  .pipe(sourcemaps.write('./'))
  .pipe(dest(options.path.build.css));
}

function scripts() {
 return src('./src/js/index.js')
  .pipe(include())
  .pipe(rename('app.min.js'))
  .on('error', swallowError)
  .pipe(sourcemaps.init())
  .pipe(uglify())
  .pipe(sourcemaps.write('./'))
  .pipe(dest(options.path.build.js));
}

function gulpWatch(cb) {
 watch(options.path.src.css, styles);
 watch('./**/*.php', vendorStyles);
 watch(options.path.src.js, scripts);
 cb();
}

exports.vendorStyles = vendorStyles;
exports.styles = styles;
exports.scripts = scripts;
exports.gulpWatch = gulpWatch;

exports.default = series(styles, vendorStyles, scripts, gulpWatch);
