const gulp = require('gulp');
const concat = require('gulp-concat');
const cleanCSS = require('gulp-clean-css');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const path = require('path');

const destPath = path.resolve('../../assets/components/leafmapx/');

const cssFiles = [
  './node_modules/leaflet/dist/leaflet.css'
]

const imagesFiles = [
  './node_modules/leaflet/dist/images/**/*'
]

const jsLeaflet = [
  './node_modules/leaflet/dist/leaflet.js',
  './node_modules/whatwg-fetch/dist/fetch.umd.js'
]

const jsSource = [
  './src/index.js'
]

function leaflet_style() {
  return gulp.src(cssFiles)
      .pipe(concat('leafmapx.css'))
      .pipe(cleanCSS({
        level: 2
      }))
      .pipe(gulp.dest(destPath + '/css/web'));
}

function leaflet_img() {
  return gulp.src(imagesFiles)
      .pipe(gulp.dest(destPath + '/css/web/images/'));
}

function leaflet_script() {
  return gulp.src(jsLeaflet)
      .pipe(concat('leaflet.js'))
      .pipe(gulp.dest(destPath + '/js/web/lib/'));
}

function leafmapx_script() {
  return gulp.src(jsSource)
      .pipe(concat('leafmapx.js'))
      .pipe(babel({
        presets: ['@babel/env']
      }))
      .pipe(uglify())
      .pipe(gulp.dest(destPath + '/js/web/'));
}

gulp.task('style',leaflet_style);
gulp.task('libs',leaflet_script);
gulp.task('script',leafmapx_script);
gulp.task('images',leaflet_img);

gulp.task('build',gulp.series('style','libs','script','images'));