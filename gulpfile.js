const path = require('path');
const del = require('del');

const gulp = require('gulp');
const util = require('gulp-util');
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const uglify = require('gulp-uglify');

const autoprefixer = require('autoprefixer');
const flexbugsFixes = require('postcss-flexbugs-fixes');
const groupMediaQueries = require('postcss-move-media');
const cssnano = require('cssnano');

const ASSETS = 'themes/demo/assets';
const DIST = 'themes/demo/dist';

gulp.task('default', ['dev:build']);
gulp.task('release', ['clean'], () => gulp.start(['release:scripts', 'release:styles', 'vender-scripts',]));
gulp.task('dev:build', ['clean'], () => gulp.start(['dev:scripts', 'dev:styles', 'vender-scripts',]));

gulp.task('clean', () => del([DIST]));

gulp.task('release:scripts', () => {
    return gulp.src(path.join(ASSETS, 'scripts/**/*.js'))
        .pipe(concat('app.js'))
        .pipe(uglify())
        .pipe(gulp.dest(DIST));
});

gulp.task('dev:scripts', () => {
    return gulp.src(path.join(ASSETS, 'scripts/**/*.js'))
        .pipe(sourcemaps.init())
        .pipe(concat('app.js'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(DIST));
});

gulp.task('release:styles', () => {
    return gulp.src(path.join(ASSETS, 'styles/*.scss'))
        .pipe(sass({
            importer: (url, prev, done) => {
                done({file: url.replace('~', './node_modules/')});
            }
        }))
        .pipe(postcss([
            autoprefixer({browsers: ['last 3 version']}),
            flexbugsFixes(),
            groupMediaQueries(),
            cssnano()
        ]))
        .pipe(gulp.dest(DIST));
});

gulp.task('dev:styles', () => {
    return gulp.src(path.join(ASSETS, 'styles/*.scss'))
        .pipe(sourcemaps.init())
        .pipe(sass({
            importer: (url, prev, done) => {
                done({file: url.replace('~', './node_modules/')});
            }
        }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(DIST));
});

gulp.task('vender-scripts', () => {
    return gulp.src([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
    ])
        .pipe(gulp.dest(DIST));
});