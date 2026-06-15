<?php
/**
 * Gutenberg block registration.
 *
 * @package GrosharpCore
 */

namespace GrosharpCore\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers Grosharp blocks from block metadata.
 */
final class Registrar {
	/**
	 * Block slugs.
	 *
	 * @var array<int, string>
	 */
	private array $blocks = array(
		'hero',
		'logo-strip',
		'services-grid',
		'process-steps',
		'featured-projects',
		'stats',
		'testimonials',
		'pricing',
		'faq',
		'contact',
		'cta-band',
		'latest-posts',
		'about-hero',
		'about-story',
		'about-values',
		'page-hero',
		'work-grid',
		'work-featured',
	);

	/**
	 * Register hooks.
	 */
	public function hooks(): void {
		add_action( 'init', array( $this, 'register' ) );
		add_filter( 'block_categories_all', array( $this, 'register_category' ) );
	}

	/**
	 * Register block category.
	 *
	 * @param array<int, array<string, string>> $categories Existing block categories.
	 *
	 * @return array<int, array<string, string>>
	 */
	public function register_category( array $categories ): array {
		array_unshift(
			$categories,
			array(
				'slug'  => 'grosharp',
				'title' => __( 'Grosharp', 'grosharp' ),
				'icon'  => 'art',
			)
		);

		return $categories;
	}

	/**
	 * Register all blocks from metadata.
	 */
	public function register(): void {
		foreach ( $this->blocks as $slug ) {
			$path = $this->block_path( $slug );

			if ( file_exists( $path . '/block.json' ) ) {
				register_block_type( $path );
			}
		}
	}

	/**
	 * Resolve block metadata path.
	 *
	 * @param string $slug Block slug.
	 */
	private function block_path( string $slug ): string {
		$build_path  = GROSHARP_CORE_DIR . 'build/blocks/' . $slug;
		$source_path = GROSHARP_CORE_DIR . 'src/blocks/' . $slug;

		return file_exists( $build_path . '/block.json' ) ? $build_path : $source_path;
	}
}

