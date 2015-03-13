(function() {
    var clean, coffee, concat, cssmin, gulp, htmlmin, imagemin, jshint, jade, livereload, sass, rev, stylish, uglify, usemin, watch;
    gulp = require("gulp");
    concat = require("gulp-concat");
    uglify = require("gulp-uglify");
    usemin = require("gulp-usemin");
    imagemin = require("gulp-imagemin");
    cssmin = require("gulp-minify-css");
    sass = require("gulp-sass");
    htmlmin = require("gulp-minify-html");
    rev = require("gulp-rev");
    coffee = require("gulp-coffee");
    jade = require("gulp-jade");
    watch = require("gulp-watch");
    livereload = require("gulp-livereload");
    clean = require("gulp-clean");
    jshint = require("gulp-jshint");
    stylish = require("jshint-stylish");

    gulp.task("watch", function() {
        var server;
        server = livereload();
        gulp.watch("app/*.html", function(evt) {
            server.changed(evt.path);
        });
    });

    gulp.task("default", function() {
        gulp.src("public/preassets/coffee/*.coffee")
          .pipe(watch())
          .pipe(coffee())
          .pipe(gulp.dest("public/assets/js/"))
          .pipe(livereload());

        gulp.src("public/preassets/scss/*.scss")
          .pipe(watch())
          .pipe(sass())
          .pipe(gulp.dest("public/assets/css/"))
          .pipe(livereload());
    });

    gulp.task("clean", function() {
        gulp.src("dist/**/*", {
            read: false
        }).pipe(clean());
    });

    gulp.task("jshint", function() {
        return gulp.src("app/assets/scripts/*.js")
          .pipe(jshint())
          .pipe(jshint.reporter(stylish));
    });

    gulp.task("build", ["clean", "jshint"], function() {
        gulp.src("app/assets/image/*")
          .pipe(imagemin())
          .pipe(gulp.dest("dist/assets/image/"));

        gulp.src("app/*.html").pipe(usemin({
            css: [cssmin(), "concat", rev()],
            html: [
                htmlmin({
                    empty: true
                })
            ],
            js: [uglify(), rev()]
        })).pipe(gulp.dest("dist/"));
    });
}).call(this);