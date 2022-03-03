<?php
/**
 * ImArun Calculator plugin used to calculate Mortgage
 *
 * @package           ImArun\Calculator
 *
 * Plugin Name:       Mortgage Calculator Plugin 
 * Description:       Calculate mortgage stamp duty and land tax
 * Version:           1.1.2
 * Author:            Arun Sharma
 * Author URI:        http://www.imarun.me/
 * Text Domain: mcp
 */

namespace ImArun\Calculator;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Plugin version constants.
 */
define( 'IMARUN_CALCULATOR_PLUGIN_VERSION', '1.1.8' );
define( 'IMARUN_CALCULATOR_PLUGIN_PATH', __FILE__ );

if ( file_exists( WP_PLUGIN_DIR . '/vendor/autoload.php' ) ) {
	// phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant
	include_once WP_PLUGIN_DIR . '/vendor/autoload.php';
} elseif ( file_exists( plugin_dir_path( IMARUN_CALCULATOR_PLUGIN_PATH ) . '/vendor/autoload.php' ) ) {
	include_once plugin_dir_path( IMARUN_CALCULATOR_PLUGIN_PATH ) . '/vendor/autoload.php';
}

$config = new Plugin();

