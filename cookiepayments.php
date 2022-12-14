<?php
/*
 * Plugin Name: WooCommerce CookiePayments Gateway
 * Plugin URI: https://softtechiit.com
 * Description: Take payment by cookiepayments on your store.
 * Author: Sabbir Hossain
 * Author URI: https://github.com/devsabbirhossain
 * Version: 1.0.0
 */

if(file_exists(plugin_dir_path( __FILE__ ) . '/include/card-payment.php')){
	require_once(plugin_dir_path( __FILE__ ) . '/include/card-payment.php');
}

if(file_exists(plugin_dir_path( __FILE__ ) . '/include/vacct-payment.php')){
	require_once(plugin_dir_path( __FILE__ ) . '/include/vacct-payment.php');
}
 

/**
 * Enqueue a script in the WordPress admin .
 *
 */
function wpdocs_selectively_enqueue_admin_script() {
    wp_enqueue_script( 'cookiepayment_custom_js', plugin_dir_url( __FILE__ ) . 'assets/js/custom.js', array('jquery'), '1.0' );
    wp_enqueue_style( 'cookiepayment_custom_css', plugin_dir_url( __FILE__ ) . 'assets/css/custom.css', '', time());
}
add_action( 'admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script' );