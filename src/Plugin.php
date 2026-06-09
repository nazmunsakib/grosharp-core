<?php
/**
 * Main plugin container.
 *
 * @package GrosharpCore
 */

namespace GrosharpCore;

use GrosharpCore\Admin\SettingsPage;
use GrosharpCore\Blocks\Registrar as BlocksRegistrar;
use GrosharpCore\PostTypes\Registrar as PostTypesRegistrar;
use GrosharpCore\Settings\Settings;
use GrosharpCore\Taxonomies\Registrar as TaxonomiesRegistrar;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Coordinates plugin services.
 */
final class Plugin {
	/**
	 * Singleton instance.
	 *
	 * @var self|null
	 */
	private static ?self $instance = null;

	/**
	 * Get the plugin instance.
	 */
	public static function instance(): self {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Plugin activation.
	 */
	public static function activate(): void {
		( new PostTypesRegistrar() )->register();
		( new TaxonomiesRegistrar() )->register();

		if ( false === get_option( Settings::OPTION_NAME ) ) {
			add_option( Settings::OPTION_NAME, Settings::defaults() );
		}

		flush_rewrite_rules();
	}

	/**
	 * Plugin deactivation.
	 */
	public static function deactivate(): void {
		flush_rewrite_rules();
	}

	/**
	 * Boot plugin services.
	 */
	public function boot(): void {
		load_plugin_textdomain( 'grosharp', false, dirname( plugin_basename( GROSHARP_CORE_FILE ) ) . '/languages' );

		( new Settings() )->register();
		( new PostTypesRegistrar() )->hooks();
		( new TaxonomiesRegistrar() )->hooks();
		( new BlocksRegistrar() )->hooks();
		( new SettingsPage() )->hooks();
	}

	/**
	 * Prevent direct construction.
	 */
	private function __construct() {}
}
