<?php
/**
 * Work Featured block — editorial case study spotlight.
 *
 * @package GrosharpCore
 */

$eyebrow    = $attributes['eyebrow']    ?? __( 'Featured Case Study', 'grosharp' );
$featured_id = absint( $attributes['featuredId'] ?? 0 );
$stat1_val  = $attributes['stat1Value'] ?? '+340%';
$stat1_lab  = $attributes['stat1Label'] ?? __( 'Organic traffic', 'grosharp' );
$stat2_val  = $attributes['stat2Value'] ?? '4.9/5';
$stat2_lab  = $attributes['stat2Label'] ?? __( 'Client rating', 'grosharp' );
$stat3_val  = $attributes['stat3Value'] ?? '3×';
$stat3_lab  = $attributes['stat3Label'] ?? __( 'Revenue growth', 'grosharp' );

/* ── Resolve the post ───────────────────────────────────────────────── */
$post = null;
if ( $featured_id ) {
	$post = get_post( $featured_id );
}
if ( ! $post || $post->post_type !== 'grosharp_project' || $post->post_status !== 'publish' ) {
	$latest = get_posts( array(
		'post_type'      => 'grosharp_project',
		'posts_per_page' => 1,
		'post_status'    => 'publish',
	) );
	$post = ! empty( $latest ) ? $latest[0] : null;
}

$title     = $post ? get_the_title( $post )     : __( 'Elevance — Brand & Website Redesign', 'grosharp' );
$excerpt   = $post ? get_the_excerpt( $post )   : __( 'A complete identity and digital overhaul for a fast-growing fintech startup. We took them from generic SaaS to a brand people remember — and a site that converts.', 'grosharp' );
$permalink = $post ? get_permalink( $post )      : '#';
$img_url   = $post && has_post_thumbnail( $post ) ? get_the_post_thumbnail_url( $post, 'grosharp-card-lg' ) : '';
$type_terms = $post ? get_the_terms( $post->ID, 'project_type' ) : array();
$type_name  = ( is_array( $type_terms ) && ! empty( $type_terms ) ) ? $type_terms[0]->name : __( 'Web Design', 'grosharp' );

$stats = array(
	array( 'value' => $stat1_val, 'label' => $stat1_lab ),
	array( 'value' => $stat2_val, 'label' => $stat2_lab ),
	array( 'value' => $stat3_val, 'label' => $stat3_lab ),
);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-work-featured' ) ); ?>>
	<div class="gs-container">
		<div class="wf-inner">

			<!-- Left: image -->
			<div class="wf-image-col" data-wf-img-col>
				<div class="wf-image-wrap">
					<?php if ( $img_url ) : ?>
						<img class="wf-image" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" />
					<?php else : ?>
						<div class="wf-image wf-image--placeholder"></div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Right: content -->
			<div class="wf-content-col">

				<!-- Eyebrow -->
				<p class="wf-eyebrow" data-wf-eyebrow>
					<span class="wf-eyebrow-dot" aria-hidden="true"></span>
					<?php echo esc_html( $eyebrow ); ?>
				</p>

				<!-- Type tag -->
				<span class="wf-type-tag"><?php echo esc_html( $type_name ); ?></span>

				<!-- Title -->
				<h2 class="wf-title" data-wf-title>
					<?php echo esc_html( $title ); ?>
				</h2>

				<!-- Excerpt -->
				<p class="wf-excerpt" data-wf-excerpt>
					<?php echo esc_html( $excerpt ); ?>
				</p>

				<!-- Result stats -->
				<div class="wf-stats" data-wf-stats>
					<?php foreach ( $stats as $stat ) : ?>
						<div class="wf-stat">
							<span class="wf-stat-value"><?php echo esc_html( $stat['value'] ); ?></span>
							<span class="wf-stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>

				<!-- CTA -->
				<a class="wf-cta" href="<?php echo esc_url( $permalink ); ?>" data-wf-cta>
					<?php esc_html_e( 'Read the case study', 'grosharp' ); ?>
					<span class="wf-cta-arrow" aria-hidden="true">→</span>
				</a>

			</div><!-- /.wf-content-col -->

		</div><!-- /.wf-inner -->
	</div>
</section>
