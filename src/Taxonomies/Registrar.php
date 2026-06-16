<?php
/**
 * Custom taxonomy registration.
 *
 * @package GrosharpCore
 */

namespace GrosharpCore\Taxonomies;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers Grosharp taxonomies.
 */
final class Registrar {
	/**
	 * Register hooks.
	 */
	public function hooks(): void {
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Register all taxonomies.
	 */
	public function register(): void {
		register_taxonomy(
			'project_type',
			array( 'grosharp_project' ),
			array(
				'labels'       => array(
					'name'          => __( 'Project Types', 'grosharp' ),
					'singular_name' => __( 'Project Type', 'grosharp' ),
				),
				'hierarchical' => true,
				'public'       => true,
				'rewrite'      => array( 'slug' => 'project-type' ),
				'show_in_rest' => true,
			)
		);

		register_taxonomy(
			'industry',
			array( 'grosharp_project' ),
			array(
				'labels'       => array(
					'name'          => __( 'Industries', 'grosharp' ),
					'singular_name' => __( 'Industry', 'grosharp' ),
				),
				'hierarchical' => true,
				'public'       => true,
				'rewrite'      => array( 'slug' => 'industry' ),
				'show_in_rest' => true,
			)
		);

	}
}

