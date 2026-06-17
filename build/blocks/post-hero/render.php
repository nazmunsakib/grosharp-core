<?php
/**
 * Post Hero block — dynamic hero for any CPT single page.
 *
 * @package GrosharpCore
 */

$eyebrow_taxonomy = $attributes['eyebrowTaxonomy']  ?? '';
$eyebrow_fallback = $attributes['eyebrowFallback']  ?? '';
$show_image       = (bool) ( $attributes['showImage']       ?? true );
$brief_meta_key   = $attributes['briefMetaKey']     ?? '';
$tech_stack_key   = $attributes['techStackMetaKey'] ?? '';

/* ── Post ID — robust in FSE / SSR context ──────────────────────────────── */
$post_id = get_the_ID();
if ( ! $post_id ) {
	$post_id = get_queried_object_id();
}
$post = get_post( $post_id );
if ( ! $post ) {
	return;
}

/* ── Eyebrow ────────────────────────────────────────────────────────────── */
$eyebrow = '';

if ( $eyebrow_taxonomy ) {
	$terms = get_the_terms( $post_id, $eyebrow_taxonomy );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		$eyebrow = $terms[0]->name;
	}
}

if ( ! $eyebrow && $eyebrow_fallback ) {
	$eyebrow = $eyebrow_fallback;
}

if ( ! $eyebrow ) {
	$taxonomies = get_object_taxonomies( $post->post_type, 'objects' );
	foreach ( $taxonomies as $tax ) {
		if ( ! $tax->public ) {
			continue;
		}
		$terms = get_the_terms( $post_id, $tax->name );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			$eyebrow = $terms[0]->name;
			break;
		}
	}
}

/* ── Date & read time ────────────────────────────────────────────────────── */
$date      = get_the_date( 'M j, Y', $post_id );
$date_iso  = get_the_date( 'c',      $post_id );
$words     = str_word_count( wp_strip_all_tags( $post->post_content ) );
$read_time = max( 1, (int) ceil( $words / 200 ) );

/* ── Category ────────────────────────────────────────────────────────────── */
$cats     = get_the_category( $post_id );
$cat      = ! empty( $cats ) ? $cats[0] : null;
$cat_name = $cat ? $cat->name : '';
$cat_url  = $cat ? get_category_link( $cat->term_id ) : '';

$cat_color_map = array(
	'Design'      => array( 'bg' => '#f0e9ff', 'text' => '#4f39c7' ),
	'Development' => array( 'bg' => '#e8f4ff', 'text' => '#1d4ed8' ),
	'Marketing'   => array( 'bg' => '#f0fdf4', 'text' => '#065f46' ),
	'Strategy'    => array( 'bg' => '#fff7ed', 'text' => '#9a3412' ),
	'Branding'    => array( 'bg' => '#fef3c7', 'text' => '#92400e' ),
	'News'        => array( 'bg' => '#f4f4f5', 'text' => '#3f3f46' ),
);
$cat_c = $cat_color_map[ $cat_name ] ?? array( 'bg' => '#f4f4f5', 'text' => '#3f3f46' );

/* ── Short brief (project CPT only — not shown on standard posts) ────────── */
$brief = '';
if ( $brief_meta_key ) {
	if ( function_exists( 'get_field' ) ) {
		$val = get_field( $brief_meta_key, $post_id );
		if ( $val && is_string( $val ) ) { $brief = $val; }
	}
	if ( ! $brief ) {
		$brief = (string) get_post_meta( $post_id, $brief_meta_key, true );
	}
}

/* ── Tech stack tags ────────────────────────────────────────────────────── */
$tech_tags = array();

if ( $tech_stack_key ) {
	$raw = '';
	if ( function_exists( 'get_field' ) ) {
		$val = get_field( $tech_stack_key, $post_id );
		if ( $val && is_string( $val ) ) {
			$raw = $val;
		}
	}
	if ( ! $raw ) {
		$raw = (string) get_post_meta( $post_id, $tech_stack_key, true );
	}
	if ( $raw ) {
		$tech_tags = array_values( array_filter( array_map( 'trim', explode( ',', $raw ) ) ) );
	}
}

/* ── Featured image ─────────────────────────────────────────────────────── */
$image_url = '';
$image_alt = '';

if ( $show_image && has_post_thumbnail( $post_id ) ) {
	$image_url = get_the_post_thumbnail_url( $post_id, 'grosharp-hero' );
	$thumb_id  = get_post_thumbnail_id( $post_id );
	$image_alt = (string) get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
	if ( ! $image_alt ) {
		$image_alt = $post->post_title;
	}
}
?>

<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-post-hero bg-white pt-24 md:pt-[clamp(5rem,10vw,8rem)]' ) ); ?> style="padding-bottom:30px;">
	<div class="gs-container">

		<div class="max-w-[860px]">

			<!-- Eyebrow -->
			<?php if ( $eyebrow ) : ?>
				<p class="mb-4 font-body text-[0.75rem] font-medium uppercase tracking-[0.06em] text-brand-muted opacity-0"
				   data-ph-eyebrow>
					<?php echo esc_html( $eyebrow ); ?>
				</p>
			<?php endif; ?>

			<!-- Title -->
			<h1 class="mb-6 block font-heading text-[clamp(2rem,5.5vw,4.6875rem)] font-extrabold leading-[1.05] tracking-[-0.04em] text-brand-dark"
			    data-ph-heading>
				<span class="ph-heading-dark"><?php echo esc_html( $post->post_title ); ?></span>
			</h1>

			<!-- Brief (project CPT only) -->
			<?php if ( $brief ) : ?>
				<p class="max-w-[56ch] font-body text-[1rem] leading-[1.75] text-[#5c5d6d] opacity-0 md:text-[1.125rem]"
				   data-ph-sub>
					<?php echo esc_html( $brief ); ?>
				</p>
			<?php endif; ?>

			<!-- Meta row: category · date · read time (blog posts) -->
			<?php if ( ! $brief_meta_key ) : ?>
				<div class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-2" data-ph-sub>
					<?php if ( $cat_name ) : ?>
						<a href="<?php echo esc_url( $cat_url ); ?>"
						   class="inline-flex items-center rounded-full px-3.5 py-1 font-body text-[0.75rem] font-semibold no-underline"
						   style="background:<?php echo esc_attr( $cat_c['bg'] ); ?>;color:<?php echo esc_attr( $cat_c['text'] ); ?>;">
							<?php echo esc_html( $cat_name ); ?>
						</a>
						<span class="h-3.5 w-px bg-black/10" aria-hidden="true"></span>
					<?php endif; ?>
					<time datetime="<?php echo esc_attr( $date_iso ); ?>"
					      class="font-body text-[0.875rem] text-[#9a9ab0]">
						<?php echo esc_html( $date ); ?>
					</time>
					<span class="h-3.5 w-px bg-black/10" aria-hidden="true"></span>
					<span class="font-body text-[0.875rem] text-[#9a9ab0]">
						<?php echo esc_html( $read_time ); ?> <?php esc_html_e( 'min read', 'grosharp' ); ?>
					</span>
				</div>
			<?php endif; ?>

			<!-- Tech stack tags -->
			<?php if ( ! empty( $tech_tags ) ) : ?>
				<div class="mt-6 flex flex-wrap gap-2" data-gs-ph-stack>
					<?php foreach ( $tech_tags as $tag ) : ?>
						<span class="inline-flex items-center rounded-full border border-black/15 px-3.5 py-1 font-body text-[0.8125rem] font-medium text-[#5c5d6d]">
							<?php echo esc_html( $tag ); ?>
						</span>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div>

		<!-- Thumbnail -->
		<?php if ( $image_url ) : ?>
			<div class="mt-10 md:mt-[clamp(2.5rem,5vw,4rem)]" data-ph-img>
				<figure class="m-0 overflow-hidden rounded-xl md:rounded-2xl">
					<img src="<?php echo esc_url( $image_url ); ?>"
					     alt="<?php echo esc_attr( $image_alt ); ?>"
					     class="block w-full object-cover"
					     style="height:clamp(200px,45vw,560px);"
					     loading="eager"
					     decoding="async" />
				</figure>
			</div>
		<?php endif; ?>

	</div>
</section>
