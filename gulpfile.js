'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var watch = require('gulp-watch');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync');

gulp.task('sass', function () {
    return gulp.src('./eks/sass/main.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./public/css/'))
        .pipe(browserSync.stream());
});

gulp.task('admin_sass', function () {
    return gulp.src('./eks/sass/admin.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./public/css/'))
        .pipe(browserSync.stream());
});

gulp.task('sass:watch', function () {
    browserSync.init({
        proxy: 'http://jamesoftheinternet.dev.com'
    });
    gulp.watch('./eks/sass/**/*.scss', ['sass', 'admin_sass']);
    gulp.watch([
        './**/*.php'
    ]).on('change', browserSync.reload);
});