<?php
/**
 * Plugin Name: Grosharp Core
 * Plugin URI: https://grosharp.local
 * Description: Core functionality for the Grosharp digital agency website: custom post types, Gutenberg blocks, and brand settings.
 * Version: 0.1.0
 * Requires at least: 6.5
 * Requires PHP: 8.0
 * Author: Grosharp
 * Author URI: https://grosharp.local
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: grosharp
 * Domain Path: /languages
 *
 * @package GrosharpCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GROSHARP_CORE_VERSION', '0.1.0' );
define( 'GROSHARP_CORE_FILE', __FILE__ );
define( 'GROSHARP_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'GROSHARP_CORE_URL', plugin_dir_url( __FILE__ ) );

$grosharp_autoload = GROSHARP_CORE_DIR . 'vendor/autoload.php';

if ( ! file_exists( $grosharp_autoload ) ) {
	add_action(
		'admin_notices',
		static function (): void {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			echo '<div class="notice notice-error"><p>';
			echo esc_html__( 'Grosharp Core requires Composer dependencies. Run `composer install` inside the grosharp-core plugin folder.', 'grosharp' );
			echo '</p></div>';
		}
	);

	return;
}

require_once $grosharp_autoload;

register_activation_hook(
	__FILE__,
	static function (): void {
		\GrosharpCore\Plugin::activate();
	}
);

register_deactivation_hook(
	__FILE__,
	static function (): void {
		\GrosharpCore\Plugin::deactivate();
	}
);

add_action(
	'plugins_loaded',
	static function (): void {
		\GrosharpCore\Plugin::instance()->boot();
	}
);

