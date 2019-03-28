"use strict";

// Load plugins
const gulp         = require('gulp');
const concat       = require("gulp-concat");
const rename       = require("gulp-rename");
const uglify       = require("gulp-uglify");
const sourcemaps   = require("gulp-sourcemaps");
const autoprefixer = require("gulp-autoprefixer");
const sass         = require("gulp-sass");
const sequence     = require('run-sequence');
const sassLint     = require('gulp-sass-lint');
const eslint       = require("gulp-eslint");
const phpcs        = require('gulp-phpcs');

/**
 * File paths to various assets are defined here.
 */
const PATHS = {
  php: [
    '**/*.php',
    '!vendor/**/*.*'
  ],
  sass: [
    'assets/scss/*.scss',
    'assets/scss/**/*.scss'
  ],
  jsVendor: [
    'node_modules/bootstrap/dist/js/bootstrap.js'
  ],
  jsTheme: [
    'assets/js/theme/*.js',
    'assets/js/theme.js'
  ]
};

// Concatenate & Minify all bower dependency javascript files
function buildScriptsVendor() {
  return (
    gulp
      .src(PATHS.jsVendor)
      .pipe(concat('vendor.js'))
      .pipe(rename({
        suffix: '.min'
      }))
      .pipe(uglify())
      .pipe(gulp.dest('build/js'))
  );
}

// Concatenate & Minify all theme javascript files
function buildScriptsTheme() {
  return (
    gulp
      .src(PATHS.jsTheme)
      .pipe(concat('theme.js'))
      .pipe(rename({
        suffix: '.min'
      }))
      .pipe(uglify())
      .pipe(gulp.dest('build/js'))
  );
}

// run JS lint on theme scripts
function scriptsLint() {
  return gulp
    .src(PATHS.jsTheme)
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
}

// Compile min CSS
function buildStyles() {
  return (
    gulp
      .src('assets/scss/main.scss')
      .pipe(sourcemaps.init())
      .pipe(sass({
        includePaths: PATHS.sass,
        outputStyle: 'compressed'
      }))
      .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
      }))
      .pipe(rename({
        basename: "theme",
        suffix: '.min'
      }))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest('build/css'))
  );
}

// run SCSS lint on theme styles
function stylesLint() {
  return (
    gulp
      .src(PATHS.sass)
      .pipe(sassLint())
      .pipe(sassLint.format())
      .pipe(sassLint.failOnError())
  );
}

// run php code sniffer on theme files
function phpCodeSniffer() {
  return (
    gulp
      .src(PATHS.php)
      .pipe(phpcs({
        bin: 'vendor/squizlabs/php_codesniffer/bin/phpcs',
        standard: 'PSR2',
        warningSeverity: 0
      }))
      // Log all problems that was found
      .pipe(phpcs.reporter('log'))
  );
}

// Watch files
function watchFiles() {
  gulp.watch(PATHS.sass, gulp.series(stylesLint, buildStyles));
  gulp.watch(PATHS.jsTheme, gulp.series(scriptsLint, buildScriptsTheme));
  gulp.watch(PATHS.php, phpCodeSniffer);
}

// Build and minify the theme assets
gulp.task('build', function(done) {
  sequence([
    'lint',
    'build:scripts:vendor',
    'build:scripts:theme',
    'sass-lint',
    'phpcs',
    'build:styles'
  ], done);
});

// define complex tasks
const js    = gulp.series(scriptsLint, gulp.parallel(buildScriptsTheme, buildScriptsVendor));
const build = gulp.series(scriptsLint, stylesLint, phpCodeSniffer, gulp.parallel(buildScriptsVendor, buildScriptsTheme, buildStyles));
const watch = watchFiles;

// export tasks
exports.vendor      = buildScriptsVendor;
exports.theme       = buildScriptsTheme;
exports.styles      = buildStyles;
exports.scriptsLint = scriptsLint;
exports.sassLint    = stylesLint;
exports.phpcs       = phpCodeSniffer;
exports.js          = js;
exports.build       = build;
exports.watch       = watch;
exports.default     = build;