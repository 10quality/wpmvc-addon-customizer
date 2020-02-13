/**
 * Gulp
 *
 * @author 10 Quality <info@10quality.com>
 * @package wpmvc-addon-customizer
 * @license MIT
 * @version 1.0.4
 */

'use strict';

// Prepare
var gulp = require('gulp');

gulp.task('vendorcss', function() {
    return gulp.src([
            './node_modules/font-awesome/css/font-awesome.min.css',
        ])
        .pipe(gulp.dest('./assets/css'));
});

gulp.task('default', gulp.parallel('vendorcss'));