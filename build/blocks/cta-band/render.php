<?php
/**
 * CTA band block render template.
 *
 * @package GrosharpCore
 */

$attributes = wp_parse_args(
	$attributes,
	array(
		'heading'     => __( 'Ready to build sharper digital growth?', 'grosharp' ),
		'text'        => __( 'Tell us what you are building and we will help shape the next move.', 'grosharp' ),
		'buttonLabel' => __( 'Start a Project', 'grosharp' ),
		'buttonUrl'   => '/contact/',
	)
);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-cta gs-section' ) ); ?>>
	<div class="gs-container">
		<div class="grosharp-cta__inner gs-card gs-reveal">
			<h2><?php echo esc_html( $attributes['heading'] ); ?></h2>
			<p><?php echo esc_html( $attributes['text'] ); ?></p>
			<a class="gs-button-primary" href="<?php echo esc_url( $attributes['buttonUrl'] ); ?>"><?php echo esc_html( $attributes['buttonLabel'] ); ?></a>
		</div>
	</div>
</section>

