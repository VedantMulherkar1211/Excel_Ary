<?php

// To avoid any insertion into plugin file directly
if(!defined('WP_UNINSTALL_PLUGIN')){ 
    header("Location: /vedant");
    die();
}

// To uninstall

// global $wpdb, $table_prefix;

// $wp_emp=$table_prefix.'emp';

// $q="DROP TABLE `$wp_emp`;";
// $wpdb->query($q);