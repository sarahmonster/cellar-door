// Include Gulp
var gulp = require( 'gulp' );

// Include Plugins
var sass = require( 'gulp-sass' );
var autoprefixer = require( 'gulp-autoprefixer' );
var imagemin = require( 'gulp-imagemin' );
var pngquant = require( 'imagemin-pngquant' );
var jshint = require( 'gulp-jshint' );
var concat = require( 'gulp-concat' );
var notify = require( 'gulp-notify' );
var cache = require( 'gulp-cache' );
var sourcemaps = require( 'gulp-sourcemaps' );
var csscomb = require( 'gulp-csscomb' );
var livereload = require( 'gulp-livereload' );

// Styles tasks
gulp.task( 'styles', function() {
	return gulp.src('assets/sass/style.scss')
		.pipe(sass( { style: 'expanded', sourcemap: true } ).on( 'error', sass.logError ) )
		.pipe( autoprefixer( { browsers: ['last 2 versions', 'ie >= 9'], cascade: false } ) )
		.pipe( sourcemaps.write( './', { includeContent: false, sourceRoot: 'source' } ) )
		.pipe( csscomb() )
		.on( 'error', function ( err ) { console.error( 'Error!', err.message ); } )
		.pipe( gulp.dest( './' ) )
		.pipe( livereload() );
		//.pipe( notify( { message: 'Styles task complete' } ) );
});

// Scripts
gulp.task( 'scripts', function() {
	return gulp.src( 'assets/js/*.js' )
		.pipe( jshint.reporter( 'default' ) )
		//.pipe( concat( 'main.js' ) )
		.pipe( gulp.dest( 'assets/js' ) );
		//.pipe( notify( { message: 'Scripts task complete' } ) );
});

// Images
gulp.task( 'images', function() {
  return gulp.src( 'assets/images/*' )
    .pipe( cache( imagemin( {
		optimizationLevel: 3,
		progressive: true,
		interlaced: true,
		svgoPlugins: [{ removeViewBox: false }],
		use: [pngquant()]
	} ) ) )
    .pipe( gulp.dest( 'assets/images' ) );
    //.pipe( notify( { message: 'Images task complete' } ) );
});

// Watch files for changes
gulp.task( 'watch', function() {
	livereload.listen();
	gulp.watch( 'assets/sass/**/*.scss', ['styles'] );
	gulp.watch( 'assets/js/**/*.js', ['scripts'] );
	gulp.watch( 'assets/images/*', ['images'] );
});

// Default Task
gulp.task( 'default', ['styles', 'scripts', 'images', 'watch'] );