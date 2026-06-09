<?php
/**
 * Custom post type registration.
 *
 * @package GrosharpCore
 */

namespace GrosharpCore\PostTypes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers Grosharp content types.
 */
final class Registrar {
	/**
	 * Register hooks.
	 */
	public function hooks(): void {
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Register all post types.
	 */
	public function register(): void {
		$this->register_projects();
		$this->register_services();
		$this->register_testimonials();
		$this->register_team();
	}

	/**
	 * Register case studies / projects.
	 */
	private function register_projects(): void {
		register_post_type(
			'grosharp_project',
			array(
				'labels'       => array(
					'name'          => __( 'Case Studies', 'grosharp' ),
					'singular_name' => __( 'Case Study', 'grosharp' ),
					'add_new_item'  => __( 'Add New Case Study', 'grosharp' ),
					'edit_item'     => __( 'Edit Case Study', 'grosharp' ),
				),
				'public'       => true,
				'has_archive'  => 'case-studies',
				'menu_icon'    => 'dashicons-portfolio',
				'menu_position'=> 20,
				'rewrite'      => array( 'slug' => 'case-studies' ),
				'show_in_rest' => true,
				'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes' ),
			)
		);
	}

	/**
	 * Register services.
	 */
	private function register_services(): void {
		register_post_type(
			'grosharp_service',
			array(
				'labels'       => array(
					'name'          => __( 'Services', 'grosharp' ),
					'singular_name' => __( 'Service', 'grosharp' ),
					'add_new_item'  => __( 'Add New Service', 'grosharp' ),
					'edit_item'     => __( 'Edit Service', 'grosharp' ),
				),
				'public'       => true,
				'has_archive'  => 'services',
				'menu_icon'    => 'dashicons-hammer',
				'menu_position'=> 21,
				'rewrite'      => array( 'slug' => 'services' ),
				'show_in_rest' => true,
				'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes' ),
			)
		);
	}

	/**
	 * Register testimonials.
	 */
	private function register_testimonials(): void {
		register_post_type(
			'grosharp_testimonial',
			array(
				'labels'       => array(
					'name'          => __( 'Testimonials', 'grosharp' ),
					'singular_name' => __( 'Testimonial', 'grosharp' ),
					'add_new_item'  => __( 'Add New Testimonial', 'grosharp' ),
					'edit_item'     => __( 'Edit Testimonial', 'grosharp' ),
				),
				'public'       => false,
				'show_ui'      => true,
				'show_in_rest' => true,
				'menu_icon'    => 'dashicons-format-quote',
				'menu_position'=> 22,
				'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			)
		);
	}

	/**
	 * Register team members.
	 */
	private function register_team(): void {
		register_post_type(
			'grosharp_team',
			array(
				'labels'       => array(
					'name'          => __( 'Team', 'grosharp' ),
					'singular_name' => __( 'Team Member', 'grosharp' ),
					'add_new_item'  => __( 'Add New Team Member', 'grosharp' ),
					'edit_item'     => __( 'Edit Team Member', 'grosharp' ),
				),
				'public'       => false,
				'show_ui'      => true,
				'show_in_rest' => true,
				'menu_icon'    => 'dashicons-groups',
				'menu_position'=> 23,
				'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes' ),
			)
		);
	}
}

