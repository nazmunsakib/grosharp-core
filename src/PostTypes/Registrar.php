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
				'labels'          => array(
					'name'          => __( 'Services', 'grosharp' ),
					'singular_name' => __( 'Service', 'grosharp' ),
					'add_new_item'  => __( 'Add New Service', 'grosharp' ),
					'edit_item'     => __( 'Edit Service', 'grosharp' ),
				),
				'public'          => true,
				'has_archive'     => 'services',
				'menu_icon'       => 'dashicons-hammer',
				'menu_position'   => 21,
				'rewrite'         => array( 'slug' => 'services' ),
				'show_in_rest'    => true,
				'supports'        => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes' ),
			// Default block template — every section editable per service.
			// template_lock: false so users can add/remove/rearrange freely.
			'template'        => array(
				// Hero — edit eyebrow, heading, description, images in the block
				array( 'grosharp/page-hero', array( 'align' => 'full' ) ),
				// Service content — constrained to 860px, padded
				array(
					'core/group',
					array(
						'className' => 'gs-container',
					'layout'    => array( 'type' => 'default' ),
					'style'     => array(
						'spacing' => array(
							'padding' => array( 'top' => '4rem', 'bottom' => '4rem' ),
						),
					),
					),
					array(
						array(
							'core/paragraph',
							array( 'placeholder' => __( 'Write a brief intro about this service…', 'grosharp' ) ),
						),
						array(
							'core/heading',
							array( 'level' => 2, 'content' => __( "What's Included", 'grosharp' ) ),
						),
						array(
							'core/list',
							array(
								'values' => '<li>' . __( 'Feature one', 'grosharp' ) . '</li>'
									. '<li>' . __( 'Feature two', 'grosharp' ) . '</li>'
									. '<li>' . __( 'Feature three', 'grosharp' ) . '</li>',
							),
						),
						array(
							'core/heading',
							array( 'level' => 2, 'content' => __( 'Our Approach', 'grosharp' ) ),
						),
						array(
							'core/paragraph',
							array( 'placeholder' => __( 'Describe your process or methodology…', 'grosharp' ) ),
						),
						array( 'core/image', array() ),
					),
				),
				array( 'grosharp/process-steps', array( 'align' => 'wide' ) ),
				array( 'grosharp/faq',           array( 'align' => 'wide' ) ),
			),
			'template_lock'   => false,
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

