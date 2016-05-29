var gulp = require('gulp'),
	minifycss = require('gulp-minify-css'),
	rename = require('gulp-rename'),
	uglify = require('gulp-uglify'),
	jshint = require('gulp-jshint'),
	csslint = require('gulp-csslint'),
	stylish = require('jshint-stylish'),
	paths = {
		css: ['styles/all/theme/*.css', '!styles/all/theme/*.min.css'],
		js: ['styles/all/template/js/*.js', '!styles/all/template/js/*.min.js']
	};

// Lint JS
gulp.task('jshint', function() {
	return gulp.src(paths.js)
		.pipe(jshint({
			'globals': {
				'$': true,
				'is_ie': true,
				'form_name': true,
				'text_name': true,
				'baseHeight': true,
				'storeCaret': true,
				'bbfontstyle': true,
				'insert_text': true
			}
		}))
		.pipe(jshint.reporter(stylish));
});

// Minify JS
gulp.task('js', function() {
	return gulp.src(paths.js)
		.pipe(rename({suffix: '.min'} ))
		.pipe(uglify())
		.pipe(gulp.dest('styles/all/template/js/'));
});

// Lint CSS
gulp.task('csslint', function() {
	return gulp.src(paths.css)
		.pipe(csslint({
			'ids': false,
			'important': false,
			'box-model': false,
			'box-sizing': false
		}))
		.pipe(csslint.reporter());
});

// Minify CSS
gulp.task('css', function() {
	return gulp.src(paths.css)
		.pipe(rename({suffix: '.min'} ))
		.pipe(minifycss())
		.pipe(gulp.dest('styles/all/theme/'));
});

// Watch CSS and JS files with $ gulp watch
gulp.task('watch', function() {
	gulp.watch(paths.js, ['js']);
	gulp.watch(paths.css, ['css']);
});

// Run linting tasks with $ gulp lint
gulp.task('lint', ['jshint', 'csslint']);

// Run default tasks with $ gulp
gulp.task('default', ['js', 'css']);
