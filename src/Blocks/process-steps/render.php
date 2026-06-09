<?php
/**
 * Process steps block render template.
 *
 * @package GrosharpCore
 */

$steps = isset( $attributes['steps'] ) && is_array( $attributes['steps'] )
	? $attributes['steps']
	: array(
		array( 'title' => __( 'Discover', 'grosharp' ), 'text' => __( 'Map the business goal, audience, and opportunity.', 'grosharp' ) ),
		array( 'title' => __( 'Design', 'grosharp' ), 'text' => __( 'Shape a clear experience and visual direction.', 'grosharp' ) ),
		array( 'title' => __( 'Build', 'grosharp' ), 'text' => __( 'Develop the site, content system, and launch foundation.', 'grosharp' ) ),
	);

$heading = $attributes['heading'] ?? __( 'Process', 'grosharp' );
$text    = $attributes['text'] ?? __( 'A focused workflow from strategy to launch.', 'grosharp' );
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-process gs-section' ) ); ?>>
	<div class="gs-container">
		<div class="grosharp-section-header gs-reveal">
			<h2><?php echo esc_html( $heading ); ?></h2>
			<p><?php echo esc_html( $text ); ?></p>
		</div>
		<div class="grosharp-card-grid">
			<?php foreach ( $steps as $index => $step ) : ?>
				<article class="gs-card gs-reveal">
					<span class="grosharp-step-number"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<h3><?php echo esc_html( $step['title'] ?? '' ); ?></h3>
					<p><?php echo esc_html( $step['text'] ?? '' ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

