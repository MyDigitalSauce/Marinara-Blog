<?php
/**
 * marinara_blog functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package marinara_blog
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
function marinara_blog_sanitize_textarea( $text ) {
    return esc_textarea( $text );
}

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
	 * to change 'marinara_blog' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'marinara_blog', get_template_directory() . '/languages' );

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
		'header-menu' => esc_html__( 'Header Menu', 'marinara_blog' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'marinara_blog' )
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
		// 'name'          => esc_html__( $name, 'marinara_blog' ),
		'name'			=> $name,
		'id'            => $id,
		// 'description'   => esc_html__( $description, 'marinara_blog'),
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

	wp_enqueue_style('marinara_blog-font-awesome', get_template_directory_uri() . 'font-awesome.min.css', array(), '1.0.5');

	wp_enqueue_style('marinara_blog-google-fonts', get_template_directory_uri() . 'google-fonts.css', array(), '1.0.5');

	wp_enqueue_style('local-fonts', get_template_directory_uri(). '/css/fonts.css');

	wp_enqueue_style('marinara_blog-style', get_stylesheet_uri(),
    	array('bootstrap-css','marinara_blog-font-awesome', 'marinara_blog-google-fonts', 'local-fonts'),
    	'1.0.5'
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

/* Creates shortcode [marinara_blog_social_shares] */
function marinara_blog_social_shares_func(){
	/**
	 *
	 * @package marinara_blog
	 */
	get_template_part( 'shortcodes/shortcode', 'social-shares' );
}
add_shortcode('marinara_blog_social_shares', 'marinara_blog_social_shares_func');

/* Creates shortcode [authors orderby=""] */
function marinara_blog_authors_func( $atts ){
	ob_start();
	/* orderby - Sort by 'ID', 'login', 'nicename', 'email', 'url', 'registered', 'display_name', 'post_count', 'include', or 'meta_value' (query must also contain a 'meta_key' - see WP_User_Query). */
    $orderBy = 'nicename'; /* default val */
    $a = shortcode_atts( array(
        'orderby' => $orderBy,
    ), $atts );
    $orderBy = $a['orderby'];
	/**
	 *
	 * @package marinara_blog
	 */
	// include( locate_template('shortcodes/shortcode-authors.php') );
	get_template_part( 'shortcodes/shortcode', 'authors.php' );
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string; ?>
<?php }
add_shortcode('authors', 'marinara_blog_authors_func');

/*BreadCrumb ShortCode
* Creates [breadcrumb]
======================================== */
/* BreadCrumb Function
======================================== */
get_template_part( 'shortcodes/shortcode', 'breadcrumb.php' );

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

/* ============================================================
Ajax Load More
 ============================================================ */
$ajaxurl = admin_url( 'admin-ajax.php');

add_action('wp_ajax_nopriv_marinara_blog_more_post_ajax', 'marinara_blog_more_post_ajax');
add_action('wp_ajax_marinara_blog_more_post_ajax', 'marinara_blog_more_post_ajax');
 
if (!function_exists('marinara_blog_more_post_ajax')) {
	function marinara_blog_more_post_ajax(){
 
	    $ppp     = (isset($_POST['ppp'])) ? $_POST['ppp'] : 3;
	    $cat     = (isset($_POST['cat'])) ? $_POST['cat'] : 0;
	    $offset  = (isset($_POST['offset'])) ? $_POST['offset'] : 5;
 
	    $args = array(
	        'post_type'      => 'post',
	        'posts_per_page' => $ppp,
	        'cat'            => $cat,
	        'offset'          => $offset,
	    );
 
	    $loop = new WP_Query($args);
 
	    $out = '';
 
	    if ($loop -> have_posts()) :
	    	while ($loop -> have_posts()) :
	    		$loop -> the_post();
		    	
		    	$category_out = array();
		    	$categories = get_the_category();
				foreach ($categories as $category_one) {
					$category_out[] ='<a href="'.esc_url( get_category_link( $category_one->term_id ) ).'" class="'.strtolower($category_one->name).'">' .$category_one->name.'</a>';
				}
				$category_out = implode(', ', $category_out);
 
				$cat_out = (!empty($categories)) ? '<span class="cat-links"><span class="screen-reader-text">'.esc_html__('Categories', 'marinara_blog').'</span>'.$category_out.'</span>' : '';
 
				$out .= '<div class="article article-count article-wrapper clearfix">
							<div class="col-sm-5 col-xs-12 article-img-col">
								<img src="'. wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) .'" alt="'. get_the_title() .'" alt="'. get_the_title() .'" class="full-width">
								<div class="article-desc">In <span class="category"><i class="fa fa-tag"></i>&nbsp;'. get_the_category( ", " ) .'</span> by <span class="author">';
								if (esc_attr( get_the_author_meta( 'profile_img', $author->ID ) ) != ''): 
									$out .= '<img src="'. esc_attr( get_the_author_meta( 'profile_img', $author->ID ) ) .'" class="avatar" alt="Avatar"/>';
								else:
									$out .= get_avatar($author->ID,200);
								endif;
								$out .= '&nbsp;'. get_the_author_posts_link() .'</span> on <span class="publish-date"><i class="fa fa-calendar"></i> ' . get_the_time( 'F j Y') .'</span></div>
					      	</div>
						  	<div class="col-sm-7 col-xs-12">
								<div class="article-title h3" style="margin-top: 0;"><a href="'. get_the_permalink() .'" title="View More">'. get_the_title() .'</a></div>
								<div class="article-excerpt">'. get_the_excerpt() .'</div>
								<div class="article-read-more"><a href="'. get_the_permalink() .'" title="Read More...">'. $post->comment_count . '&nbsp;';
								$out .= ($post->comment_count==1?'<i class="fa fa-comment"></i>':'<i class="fa fa-comments"></i>');
								$out .= '&nbsp;Read More</a></div>
							</div>
					    </div>';
 
	    	endwhile;
	    endif;
 
	    wp_reset_postdata();
 
	    wp_die($out);
	}
}

function marinara_blog_ajaxLoadMorePostsJs(){
	?>
	<script>
var jQuerycontent = jQuery('.ajax_posts');
var jQueryloader = jQuery('#more_posts');
var cat = jQueryloader.data('category');
var ppp = 3;
var offset = jQuery('.blog-listing-wrapper').find('.article').length;
 
jQueryloader.on( 'click', marinara_blog_load_ajax_posts );
 
function marinara_blog_load_ajax_posts() {
	if (!(jQueryloader.hasClass('post_loading_loader') || jQueryloader.hasClass('post_no_more_posts'))) {
		jQuery.ajax({
			type: 'POST',
			dataType: 'html',
			url: '<?php echo admin_url( 'admin-ajax.php'); ?>',
			data: {
				'cat': cat,
				'ppp': ppp,
				'offset': offset,
				'action': 'marinara_blog_more_post_ajax'
			},
			beforeSend : function () {
				jQueryloader.addClass('post_loading_loader').html('<i class="fa fa-cog fa-spin"></i>');
			},
			success: function (data) {
				var jQuerydata = jQuery(data);
				console.log(jQuerydata);
				if (jQuerydata.length) {
					var jQuerynewElements = jQuerydata.css({ opacity: 0 });
					jQuerycontent.append(jQuerynewElements);
					jQuerynewElements.animate({ opacity: 1 });
					jQueryloader.removeClass('post_loading_loader').html('Load More');
				} else {
					jQueryloader.removeClass('post_loading_loader').addClass('post_no_more_posts').html('No older posts found');
				}
			},
			error : function (jqXHR, textStatus, errorThrown) {
				jQueryloader.html(jQuery.parseJSON(jqXHR.responseText) + ' :: ' + textStatus + ' :: ' + errorThrown);
				console.log(jqXHR);
			},
		});
	}
	offset += ppp;
	return false;
}
	</script>
	<?php
}
add_action('wp_footer', 'marinara_blog_ajaxLoadMorePostsJs');

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