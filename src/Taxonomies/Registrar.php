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
			array( 'grosharp_project', 'grosharp_service' ),
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

		register_taxonomy(
			'service_category',
			array( 'grosharp_service' ),
			array(
				'labels'       => array(
					'name'          => __( 'Service Categories', 'grosharp' ),
					'singular_name' => __( 'Service Category', 'grosharp' ),
				),
				'hierarchical' => true,
				'public'       => true,
				'rewrite'      => array( 'slug' => 'service-category' ),
				'show_in_rest' => true,
			)
		);

		register_taxonomy(
			'service_pillar',
			array( 'grosharp_service', 'grosharp_project' ),
			array(
				'labels'       => array(
					'name'          => __( 'Service Pillars', 'grosharp' ),
					'singular_name' => __( 'Service Pillar', 'grosharp' ),
				),
				'hierarchical' => true,
				'public'       => true,
				'rewrite'      => array( 'slug' => 'service-pillar' ),
				'show_in_rest' => true,
			)
		);
	}
}

