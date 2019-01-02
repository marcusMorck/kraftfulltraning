<?php
/*------------------------------------------------------------------
-------------------Custom Menu------------------------------------
------------------------------------------------------------------*/

function register_menu() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
  }
  add_action( 'init', 'register_menu' );


/*------------------------------------------------------------------
-------------------Custom Header------------------------------------
------------------------------------------------------------------*/
$args = array(
	'width'         => 980,
	'height'        => 300,
	'default-image' => get_template_directory_uri() . '/images/alla-loggor.png',
    'uploads'       => true,
    'flex-height' => true,
    'flex-width' => true,
);
add_theme_support( 'custom-header', $args );
 
register_default_headers( array(
	'alla-loggor' => array(
		'url'           => '%s/images/alla-loggor.png',
		'description'   => __( 'Allaloggor', 'kraftfulltraning' )
	),

) );
/*-------------------------------------------------------------------
--------------------------------------------------------------------*/
//Remove default css
//define('WOOCOMMERCE_USE_CSS', false);
function add_theme_scripts(){
    wp_enqueue_style( 'style.css', get_stylesheet_uri() );
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');
//add woocommerce support
add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {
add_theme_support( 'woocommerce');
}


//function kraftfulltraning_woocommerce_scripts

?>