<?php

/*
Plugin Name: Awesome Coming Soon 
Plugin URI: www.hashwp.com
Description: Flat Coming Soon WP Plugin
Version: 1.0.
Author: AliiRaja
Copyright: 2015  
*/


require_once ('inc/acs-plugin-options.php' );
require_once ('inc/acs-front-view.php' );

//$options = get_option('sample_theme_options');


add_action('admin_menu', 'acs_plugin_menu');
function acs_plugin_menu() {

add_menu_page('Awesome Coming Soon Settings', 'AS Coming Soon', 'administrator', 'awesome-comingsoon-settings', 'acs_plugin_settings_page', 'dashicons-admin-generic');
}


function acs_plugin_settings_page() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-form');


	acs_admin_settings();

	
}

function acs_plugin_enable() {
    
    if(is_admin()){
        return;
    }
    
    $status = get_option('awesome_comingsoon_options_settings');
    $options = get_option('awesome_comingsoon_options');
    if ($status['radioinput'] === 'disabled'){
        return;
    }

    if (!current_user_can('edit_posts') && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ))) {
        $protocol = "HTTP/1.0";
        if ("HTTP/1.1" == $_SERVER["SERVER_PROTOCOL"]) {
            $protocol = "HTTP/1.1";
        }
        header("$protocol 503 Service Unavailable", true, 503);
        header("Retry-After: 3600");
         wp_enqueue_script('jquery');
        acs_front_view();
    
        exit();
    }
}


add_action('init', 'acs_plugin_enable');


?>
