<?php
/**
 * React settings page registration.
 *
 * @package GrosharpCore
 */

namespace GrosharpCore\Admin;

use GrosharpCore\Settings\Settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds the Grosharp settings page.
 */
final class SettingsPage {
	/**
	 * Register hooks.
	 */
	public function hooks(): void {
		add_action( 'admin_menu', array( $this, 'register_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	/**
	 * Register admin menu page.
	 */
	public function register_page(): void {
		add_menu_page(
			__( 'Grosharp Settings', 'grosharp' ),
			__( 'Grosharp', 'grosharp' ),
			'manage_options',
			'grosharp-settings',
			array( $this, 'render_page' ),
			'dashicons-art',
			58
		);
	}

	/**
	 * Render React root.
	 */
	public function render_page(): void {
		echo '<div class="wrap grosharp-settings-wrap"><div id="grosharp-settings-root"></div></div>';
	}

	/**
	 * Enqueue settings app only on this page.
	 *
	 * @param string $hook Current admin hook suffix.
	 */
	public function enqueue_assets( string $hook ): void {
		if ( 'toplevel_page_grosharp-settings' !== $hook ) {
			return;
		}

		wp_enqueue_media();
		wp_enqueue_style(
			'grosharp-settings',
			GROSHARP_CORE_URL . 'assets/build/admin/settings.css',
			array(),
			$this->asset_version( 'assets/build/admin/settings.css' )
		);

		wp_enqueue_script(
			'grosharp-settings',
			GROSHARP_CORE_URL . 'assets/build/admin/settings.js',
			array( 'wp-api-fetch', 'wp-components', 'wp-element', 'wp-i18n', 'wp-notices' ),
			$this->asset_version( 'assets/build/admin/settings.js' ),
			true
		);

		wp_localize_script(
			'grosharp-settings',
			'grosharpSettingsApp',
			array(
				'optionName' => Settings::OPTION_NAME,
				'settings'   => wp_parse_args( get_option( Settings::OPTION_NAME, array() ), Settings::defaults() ),
				'defaults'   => Settings::defaults(),
			)
		);
	}

	/**
	 * File modification version helper.
	 *
	 * @param string $relative_path Relative plugin file path.
	 */
	private function asset_version( string $relative_path ): string {
		$path = GROSHARP_CORE_DIR . ltrim( $relative_path, '/' );

		return file_exists( $path ) ? (string) filemtime( $path ) : GROSHARP_CORE_VERSION;
	}
}

