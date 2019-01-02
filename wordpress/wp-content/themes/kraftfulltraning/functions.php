<?php

add_theme_support('custom-header', array(
    'default-image' => get_template_directory_uri() . 'images/alla-loggor.png',
    wid
));
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

