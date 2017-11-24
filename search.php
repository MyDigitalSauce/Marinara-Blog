<?php
/**
 * @version beta
 *
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package marinara_blog
 */
get_header();
/* Usable Variables */
global $wp_query;
$total_results = $wp_query->found_posts; ?>
<div id="inside-page-content-wrapper" class="search-page-content-wrapper-row content-wrapper-row row">
    <div id="inside-page-no-featured-img-wrapper" class="container">
        <div class="no-feat-img-inner-wrapper row">
            <div class="no-feat-img-caption-title">		
            	<h2 class=""><i class="fa fa-search"></i> <?php printf( esc_html__( 'Search Results for: %s', 'marinara_blog' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
                <h3 class="hidden"><?php echo $total_results; _e( ' Results', 'marinara_blog' ); ?></h3>
            </div>
       	</div>
    </div>
	<div class="inside-page-container search-page-container container">
		<div class="breadcrumb-search-photos-row sm-row clearfix grey-bg">
			<div class="breadcrumb-col col-xs-12 col-sm-6">
				<?php do_shortcode('[breadcrumb]'); ?>
			</div>
            <?php if ($total_results > 1): ?>
    			<div class="col-xs-12 col-sm-6 filter-results-search-col">
    				<input class="full-width filter-results-search" type="text" placeholder="Filter Search Results By Title:"/>
    			</div>
            <?php endif; ?>
			<div class="col-xs-12 no-search-results-found-col text-center">
				<p class="no-search-results-found"><i class="fa fa-warning"></i> No Results Found</p>
			</div>
		</div>
		<div class="clearfix" style="margin-bottom: 15px;"></div>
		<div class="search-blog-listing-col col-xs-12 col-sm-8">
			<?php get_template_part('template-parts/content', 'search-blog-post-listing'); ?>
		</div><!-- end of <div class="search-blog-listing-col -->
        <div class="page-sidebar-col col-xs-12 col-sm-4">
            <?php get_sidebar(); ?>
        </div><!-- end of <div class="page-sidebar-col -->
	</div>
	<div class="inside-page-footer-container search-page-footer-container container">
		<?php get_template_part( 'inside_page_container', 'footer' ); ?>
	</div>
</div><!-- end of <div id="inside-page-content-wrapper" -->
<?php if ($total_results > 1): ?>
    <script type="text/javascript">
    /*
    * Filter Search Results By Title
    ============================== */
    jQuery('input.filter-results-search').on('input', function() {
        var searchVal = this.value.toUpperCase();
        var matchFound = false;
        if(searchVal) {
            jQuery('.blog-listing-wrapper .article').each(function() {
                jQuery(this).hide();
                var articleTitle = jQuery(this).attr('data-article-title').toUpperCase();
                if (articleTitle.indexOf(searchVal) > -1) {
                    jQuery(this).show();
                    matchFound = true;
                    jQuery('.no-search-results-found-col').hide(500);
                }
            });
        } else if (jQuery('input.filter-results-search').val() == "") {
            jQuery('.blog-listing-wrapper .article').show();
            jQuery('.no-search-results-found-col').hide(500);
        }
        if (!matchFound) {
            if ( jQuery('input.filter-results-search').val().length >= 1 ){
                  jQuery('.no-search-results-found-col').show(500);
            }
        }
    });
    </script>
<?php endif; ?>
<div class="clearfix"></div>
<?php get_footer(); ?>
