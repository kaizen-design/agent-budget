'use strict';

const themeAssetsPath = './web/app/themes/agentbudget/assets';

const gulp = require('gulp');
const sass = require('gulp-sass');
const cleanCSS = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');
const uglify = require('gulp-uglify');
const gulpBabel = require("gulp-babel");
const rename = require('gulp-rename');

const paths = {
  styles: {
    src: themeAssetsPath + '/sass/**/*.scss',
    dest: themeAssetsPath + '/css/'
  },
  scripts: {
    src: [
      themeAssetsPath + '/js/**/*.js',
      '!' + themeAssetsPath + '/js/**/*.min.js'
    ],
    dest: themeAssetsPath + '/js/dist/'
  }
};

function styles() {
  return gulp.src(paths.styles.src)
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({grid: 'autoplace'}))
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(gulp.dest(paths.styles.dest));
}

function scripts() {
  return gulp.src(paths.scripts.src)
    .pipe(
      gulpBabel({
        presets: ['es2015', 'node5', 'react', {
          'ignore': [
            '**/*.min.js'
          ]
        }],
        plugins: ['transform-object-rest-spread']
      }).on("error", function (e) {
        console.error({
          babelError: e
        });
      })
    )
    .pipe(uglify())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest(paths.scripts.dest));
}

function watch() {
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch(paths.styles.src, styles);
}

exports.styles = styles;
exports.scripts = scripts;
exports.watch = watch;