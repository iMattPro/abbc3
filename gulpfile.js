var gulp = require('gulp'),
	cleancss = require('gulp-clean-css'),
	rename = require('gulp-rename'),
	uglify = require('gulp-uglify'),
	jshint = require('gulp-jshint'),
	csslint = require('gulp-csslint'),
	stylish = require('jshint-stylish'),
	watch = require('gulp-watch'),
	paths = {
		css: ['styles/all/theme/*.css', '!styles/all/theme/*.min.css'],
		js: ['styles/all/template/js/*.js', '!styles/all/template/js/*.min.js']
	},
	build = {
		css: 'styles/all/theme/',
		js: 'styles/all/template/js/'
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
		.pipe(gulp.dest(build.js));
});

// Lint CSS
gulp.task('csslint', function() {
	return gulp.src(paths.css)
		.pipe(csslint({
			'ids': false,
			'important': false,
			'box-model': false,
			'box-sizing': false,
			'order-alphabetical': false
		}))
		.pipe(csslint.formatter());
});

// Minify CSS
gulp.task('css', function() {
	return gulp.src(paths.css)
		.pipe(rename({suffix: '.min'}))
		.pipe(cleancss())
		.pipe(gulp.dest(build.css));
});

// Watch CSS and JS files with $ gulp watch
gulp.task('watchJS', function() {
	return watch(paths.js, 'js');
});
gulp.task('watchCSS', function() {
	return watch(paths.css, 'css');
});
gulp.task('watch', gulp.parallel('watchJS', 'watchCSS'), function(done) {
	done();
});

// Run linting tasks with $ gulp lint
gulp.task('lint', gulp.series('jshint', 'csslint'));

// Run default tasks with $ gulp
gulp.task('default', gulp.series('js', 'css'));
