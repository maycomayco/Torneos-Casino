var gulp        = require('gulp');
var browserSync = require('browser-sync').create();

// Static server
gulp.task('serve', function() {
  browserSync.init({
    proxy: "localhost/wordpress"
  });

  // watcher PHP
  // gulp.watch("page/*.php").on('change', browserSync.reload);
  gulp.watch("*.php").on('change', browserSync.reload);
  
  // watcher JS
  // gulp.watch("js/*.js").on('change', browserSync.reload);
});