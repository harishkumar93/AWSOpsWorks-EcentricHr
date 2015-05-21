<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Ecentric
 * @since Ecentric 1.0
 */

get_header(); ?>
<div class="content-wrapper">
 <div class="content-main">
 	<div class="banner">
        <!-- Start BODY section -->
        <div id="wowslider-container1">
        <div class="ws_images">
        <a href="javascript:void(0);" style="cursor:default;"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner-img.png" alt="" id="wows0"/></a>
        <a href="javascript:void(0);" style="cursor:default;"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner-img-1.png" alt="" id="wows1"/></a>
        <a href="javascript:void(0);" style="cursor:default;"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner-img-2.png" alt="" id="wows2"/></a>
        <a href="javascript:void(0);" style="cursor:default;"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner-img-3.png" alt="" id="wows3"/></a>
        <a href="javascript:void(0);" style="cursor:default;"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner-img-4.png" alt="" id="wows4"/></a>
        </div>
        <div class="ws_bullets"><div>
        <a href="#wows0"></a>
        <a href="#wows1"></a>
        <a href="#wows2"></a>
        <a href="#wows3"></a>
        <a href="#wows4"></a>
        </div></div>
        </div>
        <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/script.js"></script>
        <!-- End BODY section --> 
       </div>
    
    
    <?php get_sidebar('sidebar-1'); ?>
     
    
    
    
    
 </div>
</div>
<?php get_footer(); ?>