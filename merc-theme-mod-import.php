<?php
/*
Plugin Name: Mercenary Theme Modifications Automatic Importer
Plugin URI:  https://wpmercs.com/plugins/merc-theme-mod-import/
Description: Mercenary Parent Theme Modifications Automatic Importer for Custom Child Themes
Version:     1.0
Author:      raulillana, WPmercs
Author URI:  https://wpmercs.com/about-us/
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Tags: theme modifications, parent theme, child theme, modifications, importer, automatic importer, WPmercs, mercenary
*/
defined( 'ABSPATH' ) or die( 'No rest for the wicked!' );

/**
 * Child Theme Modifications Setup.
 *
 * Force Import Parent Theme Modification into Child Theme on the hook after_setup_theme.
 *
 * @since 1.0
 *
 * @see after_setup_theme
 * @see get_option
 * @see get_template
 * @see get_styleheet
 * @link https://codex.wordpress.org/Function_Reference/get_theme_mods
 */
function merc_plugin_child_theme_setup()
{
	// Use theme_mods_{theme-slug|child-slug}
	$parent = get_option( 'theme_mods_'. get_template() );
	$child  = get_option( 'theme_mods_'. get_stylesheet() );

	// If there are parent theme modifications
	// & check against child to setup just once
	if( ! empty( $parent ) && $parent[0] !== $child[0] )
		update_option( 'theme_mods_'. get_stylesheet(), $parent );
}
add_action( 'after_setup_theme', 'merc_plugin_child_theme_setup' );
?>