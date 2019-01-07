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
	'default-image' => get_template_directory_uri() . '/assets/images/alla-loggor.png',
    'uploads'       => true,
    'flex-height' => true,
    'flex-width' => true,
);
add_theme_support( 'custom-header', $args );
 
register_default_headers( array(
	'alla-loggor' => array(
		'url'           => '%s/assets/images/alla-loggor.png',
		'description'   => __( 'Allaloggor', 'kraftfulltraning' )
	),

) );
/*-------------------------------------------------------------------
--------------------------------------------------------------------*/
//Remove default css
define('WOOCOMMERCE_USE_CSS', false);
function add_theme_scripts(){
    wp_enqueue_style( 'style.css', get_stylesheet_uri() );
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');
//add woocommerce support
add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {
add_theme_support( 'woocommerce');
}

add_action('woocommerce_before_single_product_summary', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/*------------------------------------------------------------------
-------------------Single Product------------------------------------
------------------------------------------------------------------*/
//remove_action('woocommerce_before_single_product', 'wc_print_notices', 10);
//Remove image-gallery from the top of the page
//remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_images',20);

//add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_images' , 1);
//function kraftfulltraning_woocommerce_scripts


//Function that adds an productimage to the hook single_product_summary
function add_productimage_single_product_summary() {
    
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );?>

    <img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>">
    <?php
    
    
}
//add_action( 'woocommerce_single_product_summary', 'add_productimage_single_product_summary', 1);

function store_title() {

    ?>
    <h1 class="store-title">Kraftfullträning</h1>
    <?php
}

add_action('woocommerce_before_shop_loop','store_title', 5);

//remove_action( 'woocommerce_before_single_product_summary', 'wc_print_notices', 10);
//add_theme_support( 'wc-product-gallery-zoom' );
//add_theme_support( 'wc-product-gallery-lightbox' );
//add_theme_support( 'wc-product-gallery-slider' );

/*------------------------------------------------------------------
-------------------Products------------------------------------
------------------------------------------------------------------*/

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

?>

