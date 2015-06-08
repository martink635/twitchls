var gulp = require('gulp');
var less = require('gulp-less');
var minifyCSS = require('gulp-minify-css');
var mainBowerFiles = require('main-bower-files');

gulp.task('bower', function() {
  return gulp.src(mainBowerFiles(), {
      base: 'bower_components'
    })
    .pipe(gulp.dest('resources/lib'));
});

gulp.task('bootstrap', function() {
  return gulp.src('resources/lib/bootstrap/less/bootstrap.less')
    .pipe(less())
    .pipe(minifyCSS())
    .pipe(gulp.dest('public/css'));
});

gulp.task('watch', function() {
  gulp.watch(['resources/lib/bootstrap/less/*'], 
      ['bootstrap']);
});