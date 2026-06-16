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

/* ── Short brief ────────────────────────────────────────────────────────── */
$brief = '';

if ( $brief_meta_key ) {
	/* 1. ACF get_field() */
	if ( function_exists( 'get_field' ) ) {
		$val = get_field( $brief_meta_key, $post_id );
		if ( $val && is_string( $val ) ) {
			$brief = $val;
		}
	}
	/* 2. Direct post meta */
	if ( ! $brief ) {
		$brief = (string) get_post_meta( $post_id, $brief_meta_key, true );
	}
}

/* 3. Post excerpt field */
if ( ! $brief && $post->post_excerpt ) {
	$brief = $post->post_excerpt;
}

/* 4. Auto-generated from post content */
if ( ! $brief && $post->post_content ) {
	$brief = wp_trim_words( wp_strip_all_tags( $post->post_content ), 30, '…' );
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
	$image_url = get_the_post_thumbnail_url( $post_id, 'full' );
	$thumb_id  = get_post_thumbnail_id( $post_id );
	$image_alt = (string) get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
	if ( ! $image_alt ) {
		$image_alt = $post->post_title;
	}
}
?>

<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-post-hero bg-white pt-24 pb-0 md:pt-[clamp(5rem,10vw,8rem)]' ) ); ?>>
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

			<!-- Short brief -->
			<?php if ( $brief ) : ?>
				<p class="max-w-[56ch] font-body text-[1rem] leading-[1.75] text-[#5c5d6d] opacity-0 md:text-[1.125rem]"
				   data-ph-sub>
					<?php echo esc_html( $brief ); ?>
				</p>
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
