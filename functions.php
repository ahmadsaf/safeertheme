<?php
/**
 * safeertheme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package safeertheme
 */

if ( ! function_exists( 'safeertheme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function safeertheme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on safeertheme, use a find and replace
	 * to change 'safeertheme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'safeertheme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'safeertheme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'safeertheme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'safeertheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function safeertheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'safeertheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'safeertheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function safeertheme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'safeertheme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'safeertheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'safeertheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function safeertheme_scripts() {
	wp_enqueue_style( 'safeertheme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'safeertheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'safeertheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'safeertheme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* Options page
**/
require get_stylesheet_directory() .'/inc/options.php';


function child_enqueue_scripts(){
wp_enqueue_style('parent-css', get_template_directory_uri().'/style.css');
}

add_action('wp_enqueue_scripts', 'child_enqueue_scripts');


function cd_child_widgets_init(){
register_sidebar (array(
'name' =>'Sidebar',
'id' =>'the_sidebar',
'before_widget' =>'<aside id="%1$s" class="widget %2$s">',
'after_widget' =>'</aside>',
'before_title' =>'<h1 class="widget-title">',
'after_title' =>'</h1>',

));

}
add_action( 'widgets_init', 'cd_child_widgets_init');

register_nav_menus( array( 'secondary'=>'Footer Menu' ) );

//Adding a signature  
function safeer_signature(){
echo 'Safeer Ahmad'; 
}

//Gravatar 
add_filter( 'avatar_defaults', 'safeergravatar' );
function safeergravatar ($avatar_defaults) {
$myavatar = get_stylesheet_directory_uri() . '/image/gravatar.png';
$avatar_defaults[$myavatar] = "Safeer Football";
return $avatar_defaults;
}

//Sited Gravatar from http://www.wpbeginner.com/wp-tutorials/how-to-change-the-default-gravatar-on-wordpress/

//Excerpt Change
function CCT_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> end the mystery and find out more...</a>';
}
add_filter('excerpt_more', 'CCT_excerpt_more');

//Newer and older Posts 
function cd_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 1 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'codediva' ); ?></h2>
		<div class="nav-links">

			
			<div class="nav-previous"><?php next_posts_link(__( '&larr; Previous Posts', 'codediva' ) ); ?></div>
			
			
			<div class="nav-next"><?php previous_posts_link( __( 'Recent Posts &rarr;', 'codediva' ) ); ?></div>
			<a href="http://phoenix.sheridanc.on.ca/~ccit3682/index.php/2016/08/03/shortcode/" rel="next">Next</a>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

//Sited from https://codex.wordpress.org/Customizing_the_Read_More

//Sited from https://codex.wordpress.org/Post_Thumbnails

//How to Add a Thumbnail 

add_theme_support ( 'post-thumbnails' ) ; 


//Establishing the size of a Thumbnail 

set_post_thumbnail_size ( 90, 90 ) ; 