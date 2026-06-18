<?php
/**
 * Project Next block render template.
 * Dark section auto-linking to the next published grosharp_project post.
 *
 * @package GrosharpCore
 */

$current_id = get_the_ID();

/* Fetch next project by menu_order / date */
$next_query = new WP_Query(
	array(
		'post_type'      => 'grosharp_project',
		'posts_per_page' => 1,
		'post_status'    => 'publish',
		'post__not_in'   => array( $current_id ),
		'orderby'        => 'date',
		'order'          => 'ASC',
		'date_query'     => array(
			array(
				'after'  => get_the_date( 'c', $current_id ),
				'column' => 'post_date',
			),
		),
	)
);

/* If no newer post exists, wrap around to the first (oldest) project */
if ( ! $next_query->have_posts() ) {
	$next_query = new WP_Query(
		array(
			'post_type'      => 'grosharp_project',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'post__not_in'   => array( $current_id ),
			'orderby'        => 'date',
			'order'          => 'ASC',
		)
	);
}

if ( ! $next_query->have_posts() ) {
	return; /* Only one project exists — nothing to link to */
}

$next_query->the_post();

$next_id    = get_the_ID();
$next_title = get_the_title();
$next_url   = get_permalink();
$next_img   = get_the_post_thumbnail_url( $next_id, 'grosharp-card-lg' );
$next_cat   = '';

$terms = get_the_terms( $next_id, 'grosharp_project_type' );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
	$next_cat = $terms[0]->name;
}

wp_reset_postdata();
?>

<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-project-next relative overflow-hidden bg-brand-dark' ) ); ?>>

	<!-- Background image (if available) — subtle parallax target -->
	<?php if ( $next_img ) : ?>
		<div class="absolute inset-0 opacity-[0.12]" aria-hidden="true" data-gs-pn-bg>
			<img src="<?php echo esc_url( $next_img ); ?>"
			     alt=""
			     class="h-full w-full object-cover" />
		</div>
	<?php endif; ?>

	<a href="<?php echo esc_url( $next_url ); ?>"
	   class="gs-container relative z-10 flex flex-col items-start gap-6 py-20 no-underline md:flex-row md:items-center md:justify-between md:py-28"
	   data-gs-pn-link>

		<!-- Left: label + title -->
		<div>
			<p class="mb-4 font-body text-[11px] font-semibold uppercase tracking-[0.14em] text-brand-subtle">
				<?php esc_html_e( 'Next Project', 'grosharp' ); ?>
			</p>

			<h2 class="font-heading text-[clamp(1.75rem,4vw,3rem)] font-extrabold leading-[1.1] tracking-[-0.03em] text-white transition-colors duration-300 group-hover:text-brand-violet"
			    data-gs-pn-title>
				<?php echo esc_html( $next_title ); ?>
			</h2>

			<?php if ( $next_cat ) : ?>
				<p class="mt-3 font-body text-[0.9375rem] text-brand-muted">
					<?php echo esc_html( $next_cat ); ?>
				</p>
			<?php endif; ?>
		</div>

		<!-- Right: CTA arrow -->
		<div class="flex-none">
			<span class="inline-flex h-16 w-16 items-center justify-center rounded-full border-2 border-white/20 font-body text-2xl text-white transition-all duration-300 hover:border-brand-violet hover:bg-brand-violet"
			      aria-hidden="true"
			      data-gs-pn-arrow>
				→
			</span>
		</div>

	</a>

</section>
