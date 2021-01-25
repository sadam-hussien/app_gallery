const { src } = require("gulp");
const gulp = require("gulp"),

    sass = require("gulp-sass"),

    babel = require("gulp-babel"),

    minify = require("gulp-minify"),

    concat = require("gulp-concat"),

    prefix = require("gulp-autoprefixer"),

    imagemin = require("gulp-imagemin");

// start css task
gulp.task("css", function () {

    return gulp.src(["./stage/css/**/*.css", "./stage/css/**/*.scss"])

        .pipe(sass({outputStyle: "compressed"}).on("error", sass.logError))

        .pipe(prefix())

        .pipe(concat("style.min.css"))

        .pipe(gulp.dest("./dist/layout/css/"))

});

// start js task
gulp.task("js", function () {

    return gulp.src("./stage/js/*.js")

        .pipe(babel())

        .pipe(concat("main.js"))

        .pipe(minify({
            ext:{
                src:'.js',
                min:'.min.js'
            },
        }))

        .pipe(gulp.dest("./dist/layout/js/"))

});

// start js libs
gulp.task("jslibs", function () {

    return gulp.src("./stage/js/libs/*.js")

        .pipe(gulp.dest("./dist/layout/js/"))

});

// start img
gulp.task("img", function () {

    return gulp.src("./stage/imgs/**/*.*")

        .pipe(imagemin({
            interlaced: true,
            progressive: true,
            optimizationLevel: 5,
            svgoPlugins: [
                {
                    removeViewBox: true
                }
            ]
        }))

        .pipe(gulp.dest("./dist/layout/imgs/"))
});

// start watch task
gulp.task("watch", function () {

    gulp.watch(["./stage/css/**/*.css", "./stage/css/**/*.scss"], gulp.series("css"));

    gulp.watch(["./stage/js/*.js"], gulp.series("js"));

    gulp.watch(["./stage/js/libs/*.js"], gulp.series("jslibs"));

    gulp.watch(["./stage/imgs/**/*.*"], gulp.series("img"));

});


