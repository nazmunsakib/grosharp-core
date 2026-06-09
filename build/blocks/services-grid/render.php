<?php
/**
 * Services grid block render template.
 *
 * @package GrosharpCore
 */

$query = new WP_Query(
	array(
		'post_type'      => 'grosharp_service',
		'posts_per_page' => absint( $attributes['count'] ?? 6 ),
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	)
);

$heading = $attributes['heading'] ?? __( 'Services', 'grosharp' );
$text    = $attributes['text'] ?? __( 'Development, design, and marketing services for growth-ready brands.', 'grosharp' );
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-services gs-section' ) ); ?>>
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
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>
					</article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( array( 'Development', 'Design', 'Marketing' ) as $service ) : ?>
					<article class="gs-card gs-reveal">
						<h3><?php echo esc_html( $service ); ?></h3>
						<p><?php esc_html_e( 'Add service posts to replace this placeholder card.', 'grosharp' ); ?></p>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

