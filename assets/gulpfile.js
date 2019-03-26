var gulp = require('gulp'),
sass = require('gulp-sass'),
minifyCSS = require('gulp-minify-css');

gulp.task('sass', function(){
  return gulp.src('./*.scss')
    .pipe(sass())
    .on('error', function (err) {
            console.log(err.toString());

            this.emit('end');
        })
    // .pipe(minifyCSS())
    .pipe(gulp.dest('.'))
});

gulp.task('watch', function(){
   	gulp.watch(['./*.scss'],function() {
        setTimeout(function () {
            gulp.start('sass');
        }, 300);
     });
});
