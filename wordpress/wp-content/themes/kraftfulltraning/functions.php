<?php
//Remove default css
//define('WOOCOMMERCE_USE_CSS', false);

//add woocommerce support
add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {
add_theme_support( 'woocommerce');
}

//function kraftfulltraning_woocommerce_scripts

