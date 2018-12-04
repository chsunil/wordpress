<?php
/**
* Plugin Name: wp snippets
* Plugin URI: #
* Description: short scripts for WordPress and Woocommerce.
* Version: 0.1
* Author: Sunil
* Author URI: http://psd2web.in
* License: GPL12
*/
?>

<?php
// disable Yith key errors
add_action('admin_enqueue_scripts', 'ds_admin_theme_style');
function ds_admin_theme_style() {
	if (is_user_logged_in()) {
		echo '<style> .notice-error { display: none; }</style>';
	}
}
?>

<?php

// Remove admin bar for all users except for admin
function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
?>
<?php
// add Bootstrap to theme 

add_action('wp_enqueue_scripts', 'enqueue_load_fa');
function enqueue_load_fa()
{
    wp_enqueue_style('load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
}
?>
<?php


//  Hide shipping rates when free shipping is available.

function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );

?>