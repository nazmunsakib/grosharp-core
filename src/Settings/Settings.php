<?php
/**
 * Brand and company settings.
 *
 * @package GrosharpCore
 */

namespace GrosharpCore\Settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers and sanitizes global Grosharp settings.
 */
final class Settings {
	public const OPTION_NAME = 'grosharp_settings';

	/**
	 * Default option values.
	 *
	 * @return array<string, mixed>
	 */
	public static function defaults(): array {
		return array(
			'primary_color'   => '#654cff',
			'secondary_color' => '#ff6b35',
			'accent_color'    => '#C9A96E',
			'dark_color'    => '#0d0d12',
			'ink_color'     => '#3a3a4c',
			'muted_color'   => '#5c5d6d',
			'subtle_color'  => '#9a9ab0',
			'surface_color' => '#FAFAF9',
			'soft_color'    => '#F4F3FF',
			'heading_font'  => 'Plus Jakarta Sans',
			'body_font'     => 'DM Sans',
			'logo_id'       => 0,
			'company_name'  => 'Grosharp',
			'tagline'       => 'Development, design, and marketing for sharper digital growth.',
			'email'         => '',
			'phone'         => '',
			'address'          => '',
			'working_hours'    => 'Mon – Fri, 9am – 6pm (GMT+6)',
			'calendly_url'     => '',
			'cta_label'        => 'Start a Project',
			'cta_url'          => '/contact/',
			'footer_text'      => 'Development, design, and marketing for brands that want sharper digital growth.',
			'social_whatsapp'  => '',
			'social_linkedin'  => '',
			'social_instagram' => '',
			'social_x'         => '',
			'social_dribbble'  => '',
			'social_links'     => array(),
		);
	}

	/**
	 * Register option with REST support for the React settings page.
	 */
	public function register(): void {
		add_action( 'init', array( $this, 'register_option' ) );
	}

	/**
	 * Register WordPress option.
	 */
	public function register_option(): void {
		register_setting(
			'grosharp_settings',
			self::OPTION_NAME,
			array(
				'type'              => 'object',
				'description'       => __( 'Grosharp global brand and company settings.', 'grosharp' ),
				'sanitize_callback' => array( $this, 'sanitize' ),
				'default'           => self::defaults(),
				'show_in_rest'      => array(
					'name'   => self::OPTION_NAME,
					'schema' => array(
						'type'                 => 'object',
						'additionalProperties' => true,
					),
				),
			)
		);
	}

	/**
	 * Sanitize settings before saving.
	 *
	 * @param mixed $value Incoming option value.
	 *
	 * @return array<string, mixed>
	 */
	public function sanitize( $value ): array {
		$value    = is_array( $value ) ? $value : array();
		$defaults = self::defaults();
		$clean    = array();

		foreach ( array( 'primary_color', 'secondary_color', 'accent_color', 'dark_color', 'ink_color', 'muted_color', 'subtle_color', 'surface_color', 'soft_color' ) as $key ) {
			$clean[ $key ] = sanitize_hex_color( $value[ $key ] ?? $defaults[ $key ] ) ?: $defaults[ $key ];
		}

		$clean['heading_font'] = sanitize_text_field( $value['heading_font'] ?? $defaults['heading_font'] );
		$clean['body_font']    = sanitize_text_field( $value['body_font'] ?? $defaults['body_font'] );
		$clean['logo_id']      = absint( $value['logo_id'] ?? 0 );
		$clean['company_name'] = sanitize_text_field( $value['company_name'] ?? $defaults['company_name'] );
		$clean['tagline']      = sanitize_text_field( $value['tagline'] ?? $defaults['tagline'] );
		$clean['email']        = sanitize_email( $value['email'] ?? '' );
		$clean['phone']        = sanitize_text_field( $value['phone'] ?? '' );
		$clean['address']       = sanitize_textarea_field( $value['address'] ?? '' );
		$clean['working_hours'] = sanitize_text_field( $value['working_hours'] ?? $defaults['working_hours'] );
		$clean['calendly_url']  = esc_url_raw( $value['calendly_url'] ?? '' );
		$clean['cta_label']     = sanitize_text_field( $value['cta_label'] ?? $defaults['cta_label'] );
		$clean['cta_url']      = esc_url_raw( $value['cta_url'] ?? $defaults['cta_url'] );
		$clean['footer_text']  = sanitize_text_field( $value['footer_text'] ?? $defaults['footer_text'] );

		foreach ( array( 'social_whatsapp', 'social_linkedin', 'social_instagram', 'social_x', 'social_dribbble' ) as $key ) {
			$clean[ $key ] = esc_url_raw( $value[ $key ] ?? '' );
		}

		// Sync logo_id → WP custom_logo theme mod so wp:site-logo picks it up.
		$logo_id = absint( $value['logo_id'] ?? 0 );
		if ( $logo_id && $logo_id !== (int) get_theme_mod( 'custom_logo' ) ) {
			set_theme_mod( 'custom_logo', $logo_id );
		} elseif ( ! $logo_id && get_theme_mod( 'custom_logo' ) ) {
			// Logo was cleared — remove the theme mod so the header falls back to site title.
			remove_theme_mod( 'custom_logo' );
		}

		$clean['social_links'] = array();
		if ( isset( $value['social_links'] ) && is_array( $value['social_links'] ) ) {
			foreach ( $value['social_links'] as $link ) {
				if ( ! is_array( $link ) ) {
					continue;
				}

				$clean['social_links'][] = array(
					'label' => sanitize_text_field( $link['label'] ?? '' ),
					'url'   => esc_url_raw( $link['url'] ?? '' ),
				);
			}
		}

		return wp_parse_args( $clean, $defaults );
	}
}
