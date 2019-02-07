<?php
/*-------------------------------------------------------------------
-----------------------Enqueue Styles and Scripts--------------------
-------------------------------------------------------------------*/
function add_theme_scripts(){ //Function that adds scripts and stylesheets
    //Enqueue Styles
    wp_enqueue_style( 'style.css', get_stylesheet_uri() ); 
    wp_enqueue_style( 'main.css', get_stylesheet_directory_uri() . '/main.css' ); 

    //Enqueue Scripts
    wp_enqueue_script( 'menu.js', get_stylesheet_directory_uri() . '/assets/js/menu.js', array('jquery'), null, true);
    wp_enqueue_script( 'select.js', get_stylesheet_directory_uri() . '/assets/js/select.js', array('jquery'), null, true);
    wp_enqueue_script( 'thumbnail.js', get_stylesheet_directory_uri() . '/assets/js/thumbnail.js', array('jquery'), null, true);

}
add_action('wp_enqueue_scripts', 'add_theme_scripts'); //Executes the function add_theme_scripts

//add woocommerce support
function woocommerce_support() {
    add_theme_support( 'woocommerce');
}
add_action( 'after_setup_theme', 'woocommerce_support' );//Executes the function woocommerce_support, adds support for custom wc



/*------------------------------------------------------------------
-------------------Custom Menu------------------------------------
------------------------------------------------------------------*/
function register_menu() { //Registers a custom wordpress menu
    register_nav_menu('main-menu',__( 'Main Menu'));
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
	 * Hook: woocommerce_before_shop_loop.
	 *
     * @hooked store-title - 5
	 */
	/**
	 * Hook: woocommerce_shop_loop.
	 *
     * @hooked product_grid - 11
	 */
    add_action('woocommerce_before_shop_loop','store_title', 5);//Adds the store title
    add_action('woocommerce_shop_loop', 'product_grid', 11); //Adds the product grid


/*----------------------------------
-----------Functions----------------
-----------------------------------*/
/*-------------------
-----Store Title-----
---------------------*/
function store_title() {//Function for the shops title
    ?>
        <h1 class="shop-title">Kraftfullträning Webbshop</h1>
    <?php
}
/*--------------------
-----Product Grid-----
----------------------*/
//Function that gets the first product category without link
function get_first_product_category_without_link(){ 
    $productCategory = wc_get_product_category_list( get_the_id() ); //Gets the list of categories
    $productCategory = explode(",", $productCategory); //Split up the categories and put them in an array
    $productCategory = strip_tags($productCategory[0]); //Remove the <a> tags
    return $productCategory;
}

function get_brand($productData){ //Function that gets the brand of the product
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
                <div class="card-img">
                    <img src=<?=get_the_post_thumbnail_url( $product->get_id(), 'full' ); //Get the product image ?> /> 
                </div>
            <ul class="card-list">
                <li class="card-list-item"><?=get_first_product_category_without_link();?></li>
                <li class="card-list-item">|</li>
                <li class="card-list-item"><?=get_brand($product); //Output the brand?></li>
            </ul>

            <h3 class="card-title"><?=$product->get_name();//The product name?></h3>
            <p class="price"><?=$product->get_price();?> <?=get_woocommerce_currency_symbol(); //Product price and currency symbol?></p>
    
            </a>
        </div>
    <?php
}
/*------------------------------------------------------------------
-------------------Shop - Single Product----------------------------
------------------------------------------------------------------*/
/*---------------------
-----Breadcrumb--------
----------------------*/
function filter_breadcrumb(){//Filter for the breadcrumb
    return $args = array(
        'delimiter' => '<span>></span>',
        'before' => '',
        'after' => '',
        'wrap_before' => '<nav class="woocommerce-breadcrumb">',
        'wrap_after' => '</nav>'
);
}
add_filter('woocommerce_breadcrumb_defaults', 'filter_breadcrumb');


function remove_breadcrumb(){//Removes breadcrumb from specific pages
    if(is_shop() || is_product_category()){//Check if you are in shop or product categery
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20); //Remove breadcrumb
    }
}
add_filter('woocommerce_before_main_content', 'remove_breadcrumb');


//Function that adds an productimage to the hook single_product_summary
function add_productimage_single_product_summary() {
    
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );?>

    <img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>">
    <?php
}

function get_product_thumbnails($product){//Function that gets the product thumbnail images
    ?><div class="thumbnails">
    <?php
       $attachment_ids = $product->get_gallery_image_ids();
    foreach( $attachment_ids as $attachment_id ) {
            $image_link = wp_get_attachment_url( $attachment_id );
            ?>
                <div class="thumbnail">
                    <img src="<?=$image_link?>" />
                </div>
            <?php
    }
    ?>
    </div>
    <?php
}
function get_product_image($product){//Function that gets the product image
    $attachment_ids = $product->get_gallery_image_ids();
    ?>
    <div class="product-image">
        <img src="<?=wp_get_attachment_url($product->get_image_id());?>"/>
    </div>
    <?php
    
}
function product_image_gallery(){//function for the product image gallery
    global $product;
    ?>

    <div class="product-image-gallery">
    <?php
        get_product_thumbnails($product);
        get_product_image($product);
    ?>
    </div>
    <?php    
}
function product(){
    ?>
    <div class="product-sum">
        <?php
}
add_action('woocommerce_before_single_product_summary', 'product_image_gallery', 2);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);



//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

add_action('woocommerce_single_product_summary', 'get_product_categories', 6);
function get_product_categories(){
    global $product;

    $productCategories = wc_get_product_category_list( $product->get_id());
    $productCategories = explode(',',$productCategories);
    //$productCategories = strip_tags($productCategories);
    ?>
    <ul class="product-meta">
    <?php
    foreach ($productCategories as $productCategory){
       ?> <li class="product-meta-item"><?= strip_tags($productCategory); ?></li><?php
    }
    
    ?>
    <li class="product-meta-item"><?=get_brand($product)?></li>
    </ul>
    <?php

}

add_action( 'woocommerce_before_add_to_cart_quantity', 'echo_qty_front_add_cart' );
 
function echo_qty_front_add_cart() {
 echo '<div class="qty">Antal </div>'; 
}




?>


