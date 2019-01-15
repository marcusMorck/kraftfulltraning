<?php
/*------------------------------------------------------------------
-------------------Custom Menu------------------------------------
------------------------------------------------------------------*/
function register_menu() { //Registers a custom wordpress menu
    register_nav_menu('main-menu',__( 'Main Menu' ));
  }
  add_action( 'init', 'register_menu' );//Executes the function
/*------------------------------------------------------------------
-------------------Custom Header------------------------------------
------------------------------------------------------------------*/
$args = array( //Registers a custom wordpress header
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
-----------------------Enqueue Styles and Scripts--------------------
-------------------------------------------------------------------*/

//define('WOOCOMMERCE_USE_CSS', false); //Remove default woocommerce css
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

function add_theme_scripts(){ //Function that adds scripts and stylesheets
    //Enqueue Styles
    wp_enqueue_style( 'style.css', get_stylesheet_uri() );

    //Enqueue Scripts
    wp_enqueue_script( 'menu.js', get_stylesheet_directory_uri() . '/assets/js/menu.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'add_theme_scripts'); //Executes the function add_theme_scripts
//add woocommerce support
add_action( 'after_setup_theme', 'woocommerce_support' );//Executes the function woocommerce_support, adds support for custom wc

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
    <h1 class="shop-title">Kraftfullträning Webbshop</h1>
    <?php
}

add_action('woocommerce_before_shop_loop','store_title', 5);

//remove_action( 'woocommerce_before_single_product_summary', 'wc_print_notices', 10);
add_theme_support( 'wc-product-gallery-zoom' );
//add_theme_support( 'wc-product-gallery-lightbox' );
//add_theme_support( 'wc-product-gallery-slider' );

/*------------------------------------------------------------------
-------------------Shop - Products----------------------------------
------------------------------------------------------------------*/
/*-----------------------------
--------Removed Actions--------
-----------------------------*/
	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
     * @removed hook woocommerce_result_count - 20
	 */
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20); //Removes total product count

	/**
	 * Hook: woocommerce_sidebar.
	 *
     * @removed hook woocommerce_get_sidebar - 10
	 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

	/**
	 * Hook: woocommerce_sidebar.
	 *
     * @removed hook woocommerce_get_sidebar - 10
	 */


/*-----------------------------
--------Added Actions----------
-----------------------------*/
	/**
	 * Hook: woocommerce_shop_loop.
	 *
     * @hooked product_grid - 11
	 */
    
add_action('woocommerce_shop_loop', 'product_grid', 11); //Adds the produ

function get_first_product_category_without_link(){ //Function that gets the first product category without link
    $productCategory = wc_get_product_category_list( get_the_id() ); //Gets the list of categories
    $productCategory = explode(",", $productCategory); //Split up the categories and put them in an array
    $productCategory = strip_tags($productCategory[0]); //Remove the <a> tags
    return $productCategory;
}

function get_brand($productData){ //Function that gets the brand
    $brands = wp_get_post_terms( $productData->get_id(), 'pwb-brand' ); //Get the brand of the product
    foreach( $brands as $brand ) {
        $getBrand = $brand->name;
    }
    return $getBrand;
}
//Function for the shops product grid
function product_grid() { 
    global $product; //Fix for the error: "Notice: id was called incorrectly. Product properties should not be accessed directly")
    ?>
    
        <div class="product-cards">
        <a class="card-inner" href="<?=the_permalink();?>">
            <img class="card-img" src=<?=get_the_post_thumbnail_url( $product->get_id(), 'full' ); //Get the product image ?> /> 
        
        <ul class="card-list">
            <li class="card-list-item"><?=get_first_product_category_without_link();?></li>
            <li class="card-list-item">|</li>
            <li class="card-list-item"><?=get_brand($product); //Output the brand?></li>
        </ul>

    <h3><?=$product->get_name();//The product name?></h3>


    <p class="price"><?=$product->get_price();?> <?=get_woocommerce_currency_symbol(); //Product price and currency symbol?></p>

    </a>
    </div>
 
    <?php
}
/*------------------------------------------------------------------
-------------------Shop - Single Product----------------------------
------------------------------------------------------------------*/
remove_action('woocommerce_shop_loop', 'WC_Structured_Data::generate_product_data()', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
?>

