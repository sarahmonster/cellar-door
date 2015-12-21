// Include Gulp
var gulp = require( 'gulp' );

// Include Plugins
var sass = require( 'gulp-ruby-sass' ),
	autoprefixer = require( 'gulp-autoprefixer' ),
	imagemin = require( 'gulp-imagemin' ),
	pngquant = require('imagemin-pngquant'),
	jshint = require( 'gulp-jshint' ),
	concat = require( 'gulp-concat' ),
	notify = require( 'gulp-notify' ),
	cache = require( 'gulp-cache' );

// File Paths
var paths = {
	scripts: 'assets/js/**/*.js',
};

// Tasks
// Styles
gulp.task( 'styles', function() {
	return sass( 'assets/sass/style.scss', { style: 'expanded' } )
		.pipe( autoprefixer( { browsers: ['last 2 versions', 'ie >= 9'], cascade: false } ) )
		.on('error', function (err) {
			console.error('Error!', err.message);
		})
		.pipe( gulp.dest( './' ) )
		//.pipe( notify( { message: 'Styles task complete' } ) );
});

// Scripts
gulp.task('scripts', function() {
	return gulp.src( 'assets/js/*.js' )
		.pipe( jshint.reporter( 'default' ) )
		.pipe( concat( 'main.js' ) )
		.pipe( gulp.dest( 'assets/js' ) )
		//.pipe( notify( { message: 'Scripts task complete' } ) );
});

// Images
gulp.task('images', function() {
  return gulp.src( 'assets/images/*' )
    .pipe( cache( imagemin( {
		optimizationLevel: 3,
		progressive: true,
		interlaced: true,
		svgoPlugins: [{ removeViewBox: false }],
		use: [pngquant()]
	} ) ) )
    .pipe( gulp.dest( 'assets/images' ) )
    //.pipe( notify( { message: 'Images task complete' } ) );
});

// Watch files for changes
gulp.task( 'watch', function() {

	// Watch .scss files
	gulp.watch( 'assets/sass/**/*.scss', ['styles'] );

	// Watch .js files
	gulp.watch( 'assets/js/**/*.js', ['scripts'] );

	// Watch image files
	gulp.watch( 'assets/images/*', ['images'] );
});

// Default Task
gulp.task( 'default', ['styles', 'scripts', 'images', 'watch'] );
