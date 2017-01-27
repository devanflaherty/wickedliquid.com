/*jslint node: true */
"use strict";

var $           = require('gulp-load-plugins')();
var argv        = require('yargs').argv;
var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var merge       = require('merge-stream');
var sequence    = require('run-sequence');
var colors      = require('colors');
var dateFormat  = require('dateformat');
var del         = require('del');
var cleanCSS    = require('gulp-clean-css');

// Enter URL of your local server here
// Example: 'http://localwebsite.dev'
var URL = 'http://wickedliquid:8888';
var HOST = 'wickedliquid';

// Check for --production flag
var isProduction = !!(argv.production);

// Browsers to target when prefixing CSS.
var COMPATIBILITY = [
  'last 2 versions',
  'ie >= 9',
  'Android >= 2.3'
];

// File paths to various assets are defined here.
var PATHS = {
  sass: [
    'node_modules/foundation-sites/scss',
    'node_modules/motion-ui/src',
    'node_modules/font-awesome/scss',
  ],
  javascript: [
    'node_modules/what-input/what-input.js',
    'node_modules/foundation-sites/js/foundation.core.js',
    'node_modules/foundation-sites/js/foundation.util.*.js',

    // Paths to individual JS components defined below
    'node_modules/foundation-sites/js/foundation.abide.js',
    'node_modules/foundation-sites/js/foundation.accordion.js',
    'node_modules/foundation-sites/js/foundation.accordionMenu.js',
    'node_modules/foundation-sites/js/foundation.drilldown.js',
    'node_modules/foundation-sites/js/foundation.dropdown.js',
    'node_modules/foundation-sites/js/foundation.dropdownMenu.js',
    'node_modules/foundation-sites/js/foundation.equalizer.js',
    'node_modules/foundation-sites/js/foundation.interchange.js',
    'node_modules/foundation-sites/js/foundation.magellan.js',
    'node_modules/foundation-sites/js/foundation.offcanvas.js',
    'node_modules/foundation-sites/js/foundation.orbit.js',
    'node_modules/foundation-sites/js/foundation.responsiveMenu.js',
    'node_modules/foundation-sites/js/foundation.responsiveToggle.js',
    'node_modules/foundation-sites/js/foundation.reveal.js',
    'node_modules/foundation-sites/js/foundation.slider.js',
    'node_modules/foundation-sites/js/foundation.sticky.js',
    'node_modules/foundation-sites/js/foundation.tabs.js',
    'node_modules/foundation-sites/js/foundation.toggler.js',
    'node_modules/foundation-sites/js/foundation.tooltip.js',

    // Motion UI
    'node_modules/motion-ui/motion-ui.js',

    // Include your own custom scripts (located in the custom folder)
    'assets/javascript/custom/*.js',

    // Custom ScrollMagic
    'assets/javascript/scrollmagic/*.js',
  ],
  phpcs: [
    '**/*.php',
    '!wpcs',
    '!wpcs/**',
  ],
  pkg: [
    '**/*',
    '!**/node_modules/**',
    '!**/components/**',
    '!**/scss/**',
    '!**/gulpfile.js',
    '!**/package.json',
    '!**/composer.json',
    '!**/composer.lock',
    '!**/codesniffer.ruleset.xml',
    '!**/packaged/*',
  ]
};

// Browsersync task
gulp.task('browser-sync', ['build'], function() {

  var files = [
            '**/*.php',
            'assets/images/**/*.{png,jpg,gif}',
          ];

  browserSync.init(files, {
    // Proxy address
    open: 'external',
    host: HOST,
    proxy: URL,

    // Port #
    // port: PORT
  });
});

// Compile Sass into CSS
// In production, the CSS is compressed
gulp.task('sass', function() {
  return gulp.src('assets/scss/foundation.scss')
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      includePaths: PATHS.sass
    }))
    .on('error', $.notify.onError({
        message: "<%= error.message %>",
        title: "Sass Error"
    }))
    .pipe($.autoprefixer({
      browsers: COMPATIBILITY
    }))
    // Minify CSS if run with --production flag
    .pipe($.if(isProduction, cleanCSS()))
    .pipe($.if(!isProduction, $.sourcemaps.write('.')))
    .pipe(gulp.dest('assets/stylesheets'))
    .pipe(browserSync.stream({match: '**/*.css'}));
});

// Lint all JS files in custom directory
gulp.task('lint', function() {
  return gulp.src([
      // Grab your custom scripts
		  'assets/javascript/custom/*.js',
      'assets/javascript/scrollmagic/*.js'
    ])
    .pipe($.jshint())
    .pipe($.notify(function (file) {
      if (file.jshint.success) {
        return false;
      }

      var errors = file.jshint.results.map(function (data) {
        if (data.error) {
          return "(" + data.error.line + ':' + data.error.character + ') ' + data.error.reason;
        }
      }).join("\n");
      return file.relative + " (" + file.jshint.results.length + " errors)\n" + errors;
    }));
});

// Combine JavaScript into one file
// In production, the file is minified
gulp.task('javascript', function() {
  var uglify = $.uglify()
    .on('error', $.notify.onError({
      message: "<%= error.message %>",
      title: "Uglify JS Error"
    }));

  return gulp.src(PATHS.javascript)
    .pipe($.sourcemaps.init())
    .pipe($.babel())
    .pipe($.concat('foundation.js', {
      newLine:'\n;'
    }))
    .pipe($.if(isProduction, uglify))
    .pipe($.if(!isProduction, $.sourcemaps.write()))
    .pipe(gulp.dest('assets/javascript'))
    .pipe(browserSync.stream());
});

// Copy task
gulp.task('copy', function() {
  // Motion UI
  var motionUi = gulp.src('node_modules/motion-ui/**/*.*')
    .pipe($.flatten())
    .pipe(gulp.dest('assets/javascript/vendor/motion-ui'));

  // What Input
  var whatInput = gulp.src('node_modules/what-input/**/*.*')
      .pipe($.flatten())
      .pipe(gulp.dest('assets/javascript/vendor/what-input'));

  // ScrollMagic
  var scrollMagic = gulp.src('node_modules/scrollmagic/**/*.*')
    .pipe($.flatten())
    .pipe(gulp.dest('assets/javascript/vendor/scrollmagic'));

  // Font Awesome
  var fontAwesome = gulp.src('node_modules/font-awesome/fonts/**/*.*')
      .pipe(gulp.dest('assets/fonts'));
  return merge(motionUi, whatInput, scrollMagic, fontAwesome);
});

// Package task
gulp.task('package', ['build'], function() {
  var fs = require('fs');
  var time = dateFormat(new Date(), "yyyy-mm-dd_HH-MM");
  var pkg = JSON.parse(fs.readFileSync('./package.json'));
  var title = pkg.name + '_' + time + '.zip';

  return gulp.src(PATHS.pkg)
    .pipe($.zip(title))
    .pipe(gulp.dest('packaged'));
});

// Build task
// Runs copy then runs sass & javascript in parallel
gulp.task('build', ['clean'], function(done) {
  sequence('copy',
          ['sass', 'javascript', 'lint'],
          done);
});

// PHP Code Sniffer task
gulp.task('phpcs', function() {
  return gulp.src(PATHS.phpcs)
    .pipe($.phpcs({
      bin: 'wpcs/vendor/bin/phpcs',
      standard: './codesniffer.ruleset.xml',
      showSniffCode: true,
    }))
    .pipe($.phpcs.reporter('log'));
});

// PHP Code Beautifier task
gulp.task('phpcbf', function () {
  return gulp.src(PATHS.phpcs)
  .pipe($.phpcbf({
    bin: 'wpcs/vendor/bin/phpcbf',
    standard: './codesniffer.ruleset.xml',
    warningSeverity: 0
  }))
  .on('error', $.util.log)
  .pipe(gulp.dest('.'));
});

// Clean task
gulp.task('clean', function(done) {
  sequence(['clean:javascript', 'clean:css'],
            done);
});

// Clean JS
gulp.task('clean:javascript', function() {
  return del([
      'assets/javascript/foundation.js'
    ]);
});

// Clean CSS
gulp.task('clean:css', function() {
  return del([
      'assets/stylesheets/foundation.css',
      'assets/stylesheets/foundation.css.map'
    ]);
});

// Default gulp task
// Run build task and watch for file changes
gulp.task('default', ['build', 'browser-sync'], function() {
  // Log file changes to console
  function logFileChange(event) {
    var fileName = require('path').relative(__dirname, event.path);
    console.log('[' + 'WATCH'.green + '] ' + fileName.magenta + ' was ' + event.type + ', running tasks...');
  }

  // Sass Watch
  gulp.watch(['assets/scss/**/*.scss'], ['clean:css', 'sass'])
    .on('change', function(event) {
      logFileChange(event);
    });

  // JS Watch
  gulp.watch(['assets/javascript/custom/**/*.js'], ['clean:javascript', 'javascript', 'lint'])
    .on('change', function(event) {
      logFileChange(event);
    });

  // Scroll Watch
  gulp.watch(['assets/javascript/scrollmagic/**/*.js'], ['clean:javascript', 'javascript', 'lint'])
    .on('change', function(event) {
      logFileChange(event);
    });
});
