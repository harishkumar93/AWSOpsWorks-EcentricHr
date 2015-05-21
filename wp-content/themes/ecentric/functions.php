<?php
add_filter('widget_text', 'do_shortcode');
function ecentric_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep";

	return $title;
}
add_filter( 'wp_title', 'ecentric_wp_title', 10, 2 );

function twentytwelve_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'ecentric' ),
		'id' => 'sidebar-1',
		'description' => __('Find a job section in home page', 'ecentric' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(980,9999); // Unlimited height, soft crop

add_action( 'admin_menu', 'my_create_post_meta_box' );
add_action( 'save_post', 'my_save_post_meta_box', 10, 2 );

function my_create_post_meta_box() {
add_meta_box( 'my-meta-box', 'Short Description', 'my_post_meta_box', 'page', 'normal', 'high' );
}

function my_post_meta_box( $object, $box ) { ?>
<p>
<label for="second-excerpt">Short Description</label>
<br />
<textarea name="short-description" id="short-description" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo wp_specialchars( get_post_meta( $object->ID, 'Short Description', true ), 1 ); ?></textarea>
<input type="hidden" name="my_meta_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }

function my_save_post_meta_box( $post_id, $post ) {

if ( !wp_verify_nonce( $_POST['my_meta_box_nonce'], plugin_basename( __FILE__ ) ) )
return $post_id;

if ( !current_user_can( 'edit_post', $post_id ) )
return $post_id;

        $meta_value = get_post_meta($post_id, 'Short Description');
 	$new_meta_value = stripslashes( $_POST['short-description'] );

	 if($new_meta_value && empty($meta_value)){
	  add_post_meta( $post_id, 'Short Description', $new_meta_value, true );
	 }else{
	  update_post_meta( $post_id, 'Short Description', $new_meta_value );
	 }
}
?>