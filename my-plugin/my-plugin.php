<?php
/**
 * Plugin Name: Excel_Ary
 * Version: 1.0
 * Description: Excel reading tool for all your excel data with a single click.
 * Author: Vedant Mulherkar
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    wp_die('You are not allowed to access this page directly.');
}

// Activation function
function my_plugin_activation() {
    // Add the menu item on plugin activation
    add_menu_page('File Upload', 'Upload Files', 'manage_options', 'my-plugin-page', 'my_plugin_page_func', '', 6);
}
register_activation_hook(__FILE__, 'my_plugin_activation');

// Deactivation function
function my_plugin_deactivation() {
    // Remove the menu item on plugin deactivation
    remove_menu_page('my-plugin-page');
}
register_deactivation_hook(__FILE__, 'my_plugin_deactivation');



//Adding plugin to menu
function my_plugin_page_func(){
    include 'admin/upload.php';
}

function my_plugin_menu(){
    $iconUrl = plugin_dir_url(__FILE__) . 'assets/Icon.png';
    add_menu_page('File Upload', 'Upload Files', 'manage_options', 'my-plugin-page', 'my_plugin_page_func', $iconUrl, 65);
 
    add_action('admin_enqueue_scripts', 'my_plugin_admin_styles');
function my_plugin_admin_styles() {
    wp_enqueue_style('my-plugin-admin-css', plugin_dir_url(__FILE__) . 'assets/Icon.css');
}

    // add_submenu_page('my-plugin-page','File Upload','PDF Upload','manage_options','my-plugin-subpage','my_plugin_subpage_func');
}
add_action('admin_menu', 'my_plugin_menu');




// // Shortcode function
// function my_shortcode($atts) {
//     // Set default attributes for the shortcode
//     $atts = shortcode_atts(array(
//         'type' => 'assets/upload' // Default 'type' value is 'upload'
//     ), $atts, 'vedant');

//     // Safely include the PHP file based on 'type' attribute
//     $type = sanitize_text_field($atts['type']); // Sanitize the 'type' attribute
//     $file_path = plugin_dir_path(__FILE__) . $type . '.php'; // Build the file path

//     // Check if the file exists before including it to avoid errors
//     if (file_exists($file_path)) {
//         include $file_path;
//     } else {
//         return ' 404';
//     }
// }

// // Register the shortcode [vedant]
// add_shortcode('vedant', 'my_shortcode');
