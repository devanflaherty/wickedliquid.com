<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/menu-walkers.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** Convert color to hex */
/*
 * HOW TO USE
 * $primary = hex2rgba($color, 0.8);
 */
require_once( 'library/hex.php' );

/** Get singular taxonomy of a post */
/*
 * HOW TO USE
 * $taxName = getTaxonomy();
 */
require_once( 'library/get-taxonomy.php' );

/** Get site colors */
/*
 * HOW TO USE
 * $colors = getColors();
 * $primaryColor = $colors['primary'];
 * $secondaryColor = $colors['secondary'];
 */
require_once( 'library/colors.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/protocol-relative-theme-assets.php' );

// OPTIONS PAGE
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Station Profile',
		'menu_title'	=> 'Profile',
		'menu_slug' 	=> 'station',
		'icon_url' => 'dashicons-art',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Station Profile',
		'menu_title'	=> 'Profile',
		'parent_slug'	=> 'station',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Streaming Info',
		'menu_title'	=> 'Streaming',
		'parent_slug'	=> 'station',
		'redirect'		=> false
	));

}
