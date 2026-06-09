<?php
/**
 * Testimonials block render template.
 *
 * @package GrosharpCore
 */

$query = new WP_Query(
	array(
		'post_type'      => 'grosharp_testimonial',
		'posts_per_page' => absint( $attributes['count'] ?? 3 ),
		'post_status'    => 'publish',
	)
);

$heading = $attributes['heading'] ?? __( 'What clients say', 'grosharp' );
$text    = $attributes['text'] ?? __( 'Proof from teams that trusted Grosharp.', 'grosharp' );
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-post-grid gs-section' ) ); ?>>
	<div class="gs-container">
		<div class="grosharp-section-header gs-reveal">
			<h2><?php echo esc_html( $heading ); ?></h2>
			<p><?php echo esc_html( $text ); ?></p>
		</div>
		<div class="grosharp-card-grid">
			<?php if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : ?>
					<?php $query->the_post(); ?>
					<article class="gs-card gs-reveal">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
						<?php endif; ?>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>
					</article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<article class="gs-card gs-reveal">
					<h3><?php esc_html_e( 'Add content to populate this section.', 'grosharp' ); ?></h3>
					<p><?php esc_html_e( 'Create posts for this content type, then this block will render them automatically.', 'grosharp' ); ?></p>
				</article>
			<?php endif; ?>
		</div>
	</div>
</section>

