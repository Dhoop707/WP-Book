<?php
/**
 * @package WpBook
 */

/*
    Plugin Name: WP Book
    Description: A plugin that contains lots of features to manage your book posts.
    Author: Dhoop
    Version: 1.0.0
    Text Domain: rt-book
    License: GPLv2 or later
*/

/*

WP-Book is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
WP-Book is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

*/

// Not allowd direct access
if( ! defined( 'ABSPATH' ) ) {
    die;
}

// include composer autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * called when user activate the plugin
 */
function activate_wp_book() {
    Inc\Base\Activate::activate();
}

/**
 * called when user deactivate the plugin
 */
function deactivate_wp_book() {
    Inc\Base\Deactivate::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_book' );
register_deactivation_hook( __FILE__, 'deactivate_wp_book' );

// Register All the Services of our plugin
if( class_exists( 'Inc\\init' ) ) {
    Inc\init::register_services();
}

