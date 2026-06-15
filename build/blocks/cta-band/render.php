<?php
/**
 * CTA band block render template.
 *
 * @package GrosharpCore
 */

$attributes = wp_parse_args(
	$attributes,
	array(
		'heading'        => __( 'Ready to build sharper digital growth?', 'grosharp' ),
		'text'           => __( "Tell us what you're building and we'll help shape the next move.", 'grosharp' ),
		'buttonLabel'    => __( 'Start a Project', 'grosharp' ),
		'buttonUrl'      => '/contact/',
		'secondaryLabel' => __( 'See our work first', 'grosharp' ),
		'secondaryUrl'   => '/case-studies/',
	)
);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-cta' ) ); ?>>
	<div class="gs-container">
		<div class="cta-card">

			<div class="cta-card-inner">

				<!-- Eyebrow -->
				<p class="cta-eyebrow" data-gs-eyebrow>
					<span class="cta-eyebrow-dot" aria-hidden="true"></span>
					<?php esc_html_e( "Let's work together", 'grosharp' ); ?>
				</p>

				<!-- Heading -->
				<h2 class="cta-heading">
					<?php echo esc_html( $attributes['heading'] ); ?>
				</h2>

				<!-- Body text -->
				<p class="cta-sub">
					<?php echo esc_html( $attributes['text'] ); ?>
				</p>

				<!-- CTAs -->
				<div class="cta-actions">
					<a class="cta-btn-primary" href="<?php echo esc_url( $attributes['buttonUrl'] ); ?>">
						<?php echo esc_html( $attributes['buttonLabel'] ); ?>
						<span class="cta-btn-arrow" aria-hidden="true">→</span>
					</a>
					<a class="cta-btn-secondary" href="<?php echo esc_url( $attributes['secondaryUrl'] ); ?>">
						<?php echo esc_html( $attributes['secondaryLabel'] ); ?>
					</a>
				</div>

			</div>

		</div>
	</div>
</section>
