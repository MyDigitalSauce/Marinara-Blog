<?php
/**
 * marinara_blog functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Marinara_Blog
 */

/* Working Protocal Variable */
$protocol = is_ssl() ? 'https' : 'http';

/* Working Premium Theme Variable */
$marinara_blog_premium = marinara_blog_is_premium();

function marinara_blog_is_premium(){
	return true;
}

/*
* Sanitize Text
=====================================*/
function marinara_blog_sanitize_text( $text ) {
    return sanitize_text_field( $text );
}
/*
* Sanitize TextArea
=====================================*/
// function marinara_blog_sanitize_textarea( $text ) {
//     return esc_textarea( $text );
// }

if ( ! function_exists( 'marinara_blog_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function marinara_blog_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on marinara_blog, use a find and replace
	 * to change 'marinara-blog' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'marinara-blog', get_template_directory() . '/languages' );

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

	/*
	 * Enable support for Page & Post Excerpt.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_post_type_support( 'page', 'excerpt' );
	add_post_type_support( 'post', 'excerpt' );
	function custom_excerpt_length( $length ) {
		return 80;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header-menu' => esc_html__( 'Header Menu', 'marinara-blog' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'marinara-blog' )
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'gallery',
		'image',
		'video',
		// 'audio',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'marinara_blog_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // marinara_blog_setup
add_action( 'after_setup_theme', 'marinara_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function marinara_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'marinara_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'marinara_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function marinara_blog_register_sidebar( $name, $id, $description) {
	register_sidebar( array(
		// 'name'          => esc_html__( $name, 'marinara-blog' ),
		'name'			=> $name,
		'id'            => $id,
		// 'description'   => esc_html__( $description, 'marinara-blog'),
		'description'	=> $description,
		'before_widget' => '<div class="panel-group widget-group %2$s" id="accordion%1$s" role="tablist" aria-multiselectable="true"><div class="panel panel-default">',
		'after_widget'  => '</div></div></div></div>',
		'before_title'  => '<div class="panel-heading" role="tab" id="heading"><h4 class="panel-title"><a role="button" data-toggle="collapse" href="#collapse" aria-expanded="true" aria-controls="collapse">',
		'after_title'   => '<i class="fa fa-caret-down float-right"></i></a></h4></div><div id="collapse" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading"><div class="panel-body">',
	) );
}
function marinara_blog_widgets_init() {
	marinara_blog_register_sidebar( 'Page Sidebar', 'page-sidebar-widget', 'Displays on the side of pages with a sidebar.' );
	marinara_blog_register_sidebar( 'Header Logged In User Options Dropdown', 'header-user-options-dropdown-widget', 'Displays in the header user dropdown are if a user is loged in.' );
	marinara_blog_register_sidebar( 'Single Sidebar', 'single-sidebar-widget', 'Displays on the side of single posts with a sidebar.' );
	marinara_blog_register_sidebar( 'Author Sidebar', 'author-sidebar-widget', 'Displays on the side of author pages with sidebar.' );
}

add_action( 'widgets_init', 'marinara_blog_widgets_init' );

function marinara_blog_remove_widget_title( $widget_title ) {
	if (!$widget_title):
		return 'Set Widget Title';
	else:
		return $widget_title;
	endif;
}
add_filter( 'widget_title', 'marinara_blog_remove_widget_title' );

// function my_jquery_enqueue() {
//    wp_deregister_script('jquery');
//    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
//    wp_enqueue_script('jquery');
// }
// if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);

/**
 * Enqueue scripts and styles.
 */
function marinara_blog_scripts() {

	wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0.5');

	wp_enqueue_style('marinara_blog-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '1.0.5');

	wp_enqueue_style('marinara_blog-google-fonts', get_template_directory_uri() . '/css/google-fonts.css', array(), '1.0.5');

	wp_enqueue_style('local-fonts', get_template_directory_uri(). '/css/fonts.css');

	wp_enqueue_style('marinara_blog-style', get_stylesheet_uri(),
    	array('bootstrap-css','marinara_blog-font-awesome', 'marinara_blog-google-fonts', 'local-fonts'),
    	'1.1.0'
    	);

	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0.5', true);

	wp_enqueue_script( 'marinara_blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.5', true );

	wp_enqueue_script( 'marinara_blog-general-theme-script', get_template_directory_uri() . '/js/theme-script.js', array('jquery'), '1.0.5', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'marinara_blog_scripts' );

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

/* Extend bootstrap menus for WP
* Register Custom Navigation Walker */
require_once( get_template_directory() . '/inc/wp_bootstrap_navwalker.php' );

// Enable the use of shortcodes in text widgets.
add_filter( 'widget_text', 'do_shortcode' );

/*
* Favicon
=====================================*/
function marinara_blog_fav() {
	if( get_theme_mod( 'marinara_blog_favicon') != "" ):
	  echo '<link rel="Favicon Icon" href="'; echo get_theme_mod( "marinara_blog_favicon" ); echo '" type="image/ico" sizes="32x32"/>';
	else:
	  echo '<link rel="Favicon Icon" href="'; echo get_template_directory_uri(); echo '/img/favicon/default.png" type="image/ico" sizes="32x32"/>';
	endif;
}
add_action( 'login_enqueue_scripts', 'marinara_blog_fav' );
add_action('wp_head', 'marinara_blog_fav');
add_action('admin_head', 'marinara_blog_fav');

/*
* Google Analytics
=====================================*/
function marinara_blog_google_analytics() {
	echo '<!-- =================================================================
		==================== Google Analytics Tracking ======================
		=================================================================== -->';
	?>
	<script type="text/javascript">
	<?php if( get_theme_mod('google_analytics_code') != '' ) {
		echo get_theme_mod('google_analytics_code'); ?>
		console.log('G Analytics Enabled');
	<?php } else { ?>
		
		console.log('G Analytics Not Enabled');
	<?php } ?>
	</script><?php
}
add_action('wp_footer', 'marinara_blog_google_analytics');

// theme func marinara_blog_social_shares() 
function marinara_blog_social_shares_buttons(){
	$post = get_post();

	// Get Twitter Handle
	$twitterHandle = str_replace('https://twitter.com/', '', get_theme_mod('marinara_blog_twitter'));

	// Get current page URL 
	$urlToShare = get_permalink();

	// Get current page title
	$titleToShare = str_replace( ' ', '%20', $post->post_title);

	// Get Post Thumbnail for pinterest
	$thumbnailToShare = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

	// Get Bloginfo Name
	$siteTitle = str_replace( ' ', '%20', get_bloginfo('name'));

	// Social Share URL
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$urlToShare;
	if ($twitterHandle){  
	  $twitterURL = 'https://twitter.com/intent/tweet?text='.$titleToShare.'&amp;url='.$urlToShare.'&amp;via='.$twitterHandle;
	} else {
	  $twitterURL = 'https://twitter.com/intent/tweet?text='.$titleToShare.'&amp;url='.$urlToShare.'&amp;via='.$siteTitle;
	}
	$googleURL = 'https://plus.google.com/share?url='.$urlToShare;
	$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$urlToShare.'&amp;media='.$thumbnailToShare[0].'&amp;description='.$titleToShare;
	$output_string = '<ul id="oneday-social-shares" class="social-shares clearfix">
	  <li class="facebook-share col-xs-3">
	    <a href="<?php echo $facebookURL; ?>"  type="button" data-toggle="tooltip" data-placement="top" title="Share On Facebook" target="_blank">
	      <i class="fa fa-facebook"></i>
	    </a>
	  </li>
	  <li class="twitter-share col-xs-3">
	    <a href="<?php echo $twitterURL; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Share On Twitter" rel="nofollow" target="_blank">
	      <i class="fa fa-twitter"></i>
	    </a>
	  </li>
	  <li class="pinterest-share col-xs-3">
	    <a href="<?php echo $pinterestURL; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Share On Pinterest" target="_blank">
	      <i class="fa fa-pinterest"></i>
	    </a>
	  </li>
	  <li class="google-share col-xs-3">
	    <a href="<?php echo $googleURL; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Share On Google Plus" target="_blank">
	      <i class="fa fa-google"></i>
	    </a>
	  </li>
	</ul>';
	echo $output_string;
}

function marinara_blog_authors_func(  ){
	ob_start(); ?>
	<div class="author-listing-wrapper clearfix">
	<?php
	$args = array(
		'blog_id'      => $GLOBALS['blog_id'],
		'role'         => '',
		'role__in'     => array(),
		'role__not_in' => array(),
		'meta_key'     => '',
		'meta_value'   => '',
		'meta_compare' => '',
		'meta_query'   => array(),
		'date_query'   => array(),        
		'include'      => array(),
		'exclude'      => array(),
		'orderby'      => 'login',
		'order'        => 'ASC',
		'offset'       => '',
		'search'       => '',
		'number'       => '',
		'count_total'  => false,
		'fields'       => 'all',
		'who'          => '',
	 ); 
	$authors = get_users( $args );

	foreach( $authors as $author ){
		
		$author_avatar_url = esc_attr( get_the_author_meta( 'profile_img', $author->ID ) );
		if ( $author_avatar_url == '') {
			$author_avatar = get_avatar($author->ID,200);
		}
		$author_posted_articles_cnt = count_user_posts( $author->ID , 'post' );
		$author_email = esc_html($author->user_email);
		$author_name = $author->display_name;
		$author_url = get_site_url().'/blog/author/'.$author->user_nicename;
		?>
		<div class="col-xs-12 col-md-6">
			<div class="author-row author-row-<?php echo $author->ID; ?> row">
				<a href="<?php echo $author_url; ?>" title="<?php echo $author_name; ?>" class="author-avatar-col col-xs-4" style="padding-right: 0;">
					<?php if ($author_avatar_url != ''): ?>
						<img src="<?php echo $author_avatar_url; ?>" class="avatar" alt="<?php echo $author_name; ?> Avatar"/>
					<?php else: ?>
						<?php echo $author_avatar; ?>
					<?php endif; ?>
				</a>
				<div class="col-xs-8">
					<h4 class="author-name"><a href="<?php echo $author_url; ?>" title="<?php echo $author_name; ?>"><?php echo $author_name; ?></a></h4>
					<p class="author-website-count"><i class="fa fa-pencil"></i>&nbsp;<?php echo $author_posted_articles_cnt; ?>&nbsp;<?php echo ($author_posted_articles_cnt==1?'Article':'Articles');?> Written</p>
				</div>
			</div>
		</div>
	<?php }
	if( empty( $authors ) ) { ?>
		<div class="no-authors-col col-xs-12"><h4>There are no users with the role: Author</h4></div>
	<?php } ?>
	</div><!-- end of <div class="author-listing-wrapper"> -->
	<?php
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string; ?>
<?php
}

/* BreadCrumb Function
======================================== */
function marinara_blog_breadcrumb() {
    // Settings
    $separator          = '&raquo;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Home';
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
        // Build the breadcrums
        echo '<ul id="'.$breadcrums_id.'" class="'. $breadcrums_class.'">';
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {              
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {           
            // If post is a custom post type
            $post_type = get_post_type();
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';              
            }
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>'; 
        } else if ( is_single() ) {
            // If post is a custom post type
            $post_type = get_post_type();
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
            }
            // Get post category info
            $category = get_the_category();
            if(!empty($category)) {
                // Get last category post is in
                $last_category = end(array_values($category));
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
            }
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {  
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
            }
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';     
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
            } else {
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
            }
        } else if ( is_category() ) {  
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
        } elseif ( is_day() ) {
            // Day archive
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
        } else if ( is_month() ) {
            // Month Archive
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
        } else if ( is_year() ) {
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
            // Auhor archive
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
        } else if ( get_query_var('paged') ) {
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page', 'marinara-blog') . ' ' . get_query_var('paged') . '</strong></li>';
        } else if ( is_search() ) {
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
        } elseif ( is_404() ) {      
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
        echo '</ul>';
    } 
}

/* ============================================================
Adding Disqus Comment Count Theme Support
 ============================================================ */
function disqus_count_script() {
	$marinara_blog_is_disqus_enabled = false;
	if ($marinara_blog_is_disqus_enabled){
	    echo '<script id="dsq-count-scr" src="//marinara_blog.disqus.com/count.js" async></script>';	
	}
}
add_action('wp_head', 'disqus_count_script');

/* ============================================================
Pagination
 ============================================================ */
function marinara_blog_numeric_posts_nav( $query = NULL, $paged = NULL ) {

	if ( empty( $query ) ) {
		global $wp_query;
	} else {
		$wp_query = $query;
	}

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	if ( empty( $paged ) ) {
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	}

	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="pagination-navigation clearfix"><ul style="margin: 0; padding: 0;">' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() ) {
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );		
	}

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>...</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) ) {
			echo '<li>...</li>' . "\n";			
		}

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() ) {
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );		
	}

	echo '</ul></div>' . "\n";

}

function strip_shortcode_gallery( $content ) {
    preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

    if ( ! empty( $matches ) ) {
        foreach ( $matches as $shortcode ) {
            if ( 'gallery' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if( false !== $pos ) {
                    return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
                }
            }
        }
    }

    return $content;
}