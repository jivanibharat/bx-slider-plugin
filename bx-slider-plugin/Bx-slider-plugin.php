<?php
/*
    Plugin Name: BX Slider Plugin
	Plugin URI: http://bharat1990.wordpress.com/category/wordpress-plugin/
    Description: Simple implementation of a Bx slider into WordPress
    Author: Jivani Bharat
	Author URI: http://bharat1990.wordpress.com/
    Version: 1.0
*/

/* Setup the plugin. */
add_action( 'plugins_loaded','bx_slider_loadre_require_file');

/* Register plugin activation hook. */
register_activation_hook( __FILE__, 'bx_slider_activation' );
	
/* Register plugin deactivation hook. */
register_deactivation_hook( __FILE__, 'bx_slider_deactivation' );

/* Register plugin uninstall hook. */
register_uninstall_hook( __FILE__, 'bx_slider_uninstall' );

function bx_slider_loadre_require_file()
{	
	define( 'BX_SLIDER_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	require_once( plugin_dir_path( __FILE__ ) . 'bx-slider-function.php'); 
	add_action( 'init', 'bx_codex_slider_init' );
	add_action( 'init', 'create_bx_codex_slider_taxonomies', 0 );
	add_action( 'init', 'bx_slider_registered_shortcode' );
	add_action( 'admin_init', 'bx_slider_option_init' );
	add_action('admin_menu', 'bx_slider_menupage');
	add_action('wp_print_scripts', 'bx_register_scripts');
	add_action('wp_print_styles', 'bx_register_styles');
	/* ADD the admin stylesheet. */
	add_action( 'admin_enqueue_scripts', 'bx_slider_enqueue_admin_style' );
	add_action('wp_head','bx_slider_enqueue_jsandstylenew');  
}

function bx_slider_registered_shortcode()
{
	add_shortcode( 'bxslider', 'bxslider123' );
}
function bxslider123($atts)
{
	$category = "{$atts['cat']}";
	if(!$category) 
	{ $bx_slides = new WP_Query('showposts=-1&post_type=bxslider&order=DESC'); }
	else
	{ $bx_slides = new WP_Query('showposts=-1&post_type=bxslider&order=DESC&bx-slider-category='.$category); }
	
	$bx_slider = '';
	
	if ( $bx_slides->have_posts() )
	 { 
		$bx_slider = '<div class="slider">';
		$bx_slider.= '<ul class="bxslider">';
		
			while ( $bx_slides->have_posts() ) : $bx_slides->the_post();
					$img=wp_get_attachment_image_src(get_post_thumbnail_id ( $bx_slides->ID ), 'single-post-thumbnail'); 	
					$title = get_the_title();
        			$bx_slider.= '<li><img src="'.$img[0].'" alt="" title="'.$title.'" /></li>';
            endwhile;
		$bx_slider.= '</ul></div>';
		wp_reset_query();
		
		return $bx_slider;
	}
	else
	{
		if(!$category) 
		{return 'Not Any Slide Found. Please Insert Slide In Bx Slider.......'; }
		else
		{ return 'Not Any Slide Found In '.$category.' Category. Please Insert Slide In '.$category.' Category.......';}
	}
}
function bx_slider_activation() 
{
	require_once( plugin_dir_path( __FILE__ ) . 'bx-slider-function.php'); 
	add_action( 'admin_init', 'bx_slider_option_init' );
	bx_slider_default_settings();
}

function bx_slider_deactivation() { }

function bx_slider_uninstall() {	delete_option( 'bx_slider_options' );	}

function bx_register_scripts()
{
    if (!is_admin()) 
	{
        wp_register_script('bx_1script', BX_SLIDER_URI.'js/jquery.bxslider.js', __FILE__ );
		wp_register_script('bx_2script', BX_SLIDER_URI.'js/jquery.easing.1.3.js', __FILE__ );
        wp_register_script('bx_script', BX_SLIDER_URI.'js/bxjquery.js', __FILE__);
 		
        wp_enqueue_script('bx_script');
		wp_enqueue_script('bx_2script');
		wp_enqueue_script('bx_1script');
	}
}
 
function bx_register_styles() 
{
    	wp_register_style('bx_styles', BX_SLIDER_URI.'style/jquery.bxslider.css', __FILE__);
 		$options = get_option( 'bx_slider_options' );
		if($options['slider_useCSS']=='true'){	wp_enqueue_style('bx_styles'); }
}
function bx_slider_enqueue_admin_style()
{
	
		if ( ( isset( $post_type ) && $post_type == 'bxslider' ) || ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'bxslider' ) ) 
		{
			wp_register_style('admin_bx_styles', BX_SLIDER_URI.'style/admin/bx-slider-admin.css', __FILE__);
	 		wp_enqueue_style('admin_bx_styles');
		}
		
	
}
function bx_codex_slider_init() {
  $labels = array(
    'name'               => 'Slider',
    'singular_name'      => 'Slider',
    'add_new'            => 'Add Slide',
    'add_new_item'       => 'Add New Image',
    'edit_item'          => 'Edit Image',
    'new_item'           => 'New Image',
    'all_items'          => 'All Slides',
    'view_item'          => 'View Slide',
    'search_items'       => 'Search Image',
    'not_found'          => 'No Slide found',
    'not_found_in_trash' => 'No Slide found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'BX Slider'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'bxslider' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title', 'editor', 'thumbnail', )
  );

  register_post_type( 'bxslider', $args );
}
function create_bx_codex_slider_taxonomies() {
	$labels = array(
		'name'              => _x( 'Bx Slider Category', 'taxonomy general name' ),
		'singular_name'     => _x( 'Bx Slider Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Bx Slider Category' ),
		'all_items'         => __( 'All Bx Slider Category' ),
		'edit_item'         => __( 'Edit Bx Slider Category' ),
		'update_item'       => __( 'Update Bx Slider Category' ),
		'add_new_item'      => __( 'Add New Bx Slider Category' ),
		'new_item_name'     => __( 'New Bx Slider Category Name' ),
		'menu_name'         => __( 'Bx Slider Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'bx-slider-category' ),
	);

	register_taxonomy( 'bx-slider-category', 'bxslider', $args );
}
function bx_slider_menupage()
{
	add_submenu_page( 'edit.php?post_type=bxslider', 'My Custom Submenu Page', 'Setting', 'manage_options', 'setting', 'bx_slider_setting' ); 
}