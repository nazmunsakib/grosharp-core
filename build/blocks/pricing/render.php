<?php
/**
 * Pricing block render template.
 *
 * @package GrosharpCore
 */

$items = isset( $attributes['items'] ) && is_array( $attributes['items'] ) ? $attributes['items'] : array();
$heading = $attributes['heading'] ?? __( 'Engagement models', 'grosharp' );
$text    = $attributes['text'] ?? __( 'Choose the support level that fits your growth stage.', 'grosharp' );
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-pricing gs-section' ) ); ?>>
	<div class="gs-container">
		<div class="grosharp-section-header gs-reveal">
			<h2><?php echo esc_html( $heading ); ?></h2>
			<p><?php echo esc_html( $text ); ?></p>
		</div>
		<div class="grosharp-card-grid">
			<?php foreach ( $items as $item ) : ?>
				<article class="gs-card gs-reveal">
					<h3><?php echo esc_html( $item['title'] ?? '' ); ?></h3>
					<p><?php echo esc_html( $item['text'] ?? '' ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

