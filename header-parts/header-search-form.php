<?php
/**
 * The template for displaying search the WordPress search widget.
 *
 * @link http://codex.wordpress.org/Function_Reference/get_search_form
 *
 * @package marinara_blog
 */
?>
<form id="searchform" class="" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
    <div class="header-search-inner-col col-xs-12">
        <input class="full-width" type="text" value="" placeholder="Search Blog" name="s" id="s" />
        <button id="searchsubmit" class="btn-search-icon" type="submit"  value="Search"><i class="fa fa-search"></i></button>
    </div>
</form>