<?php
/**
 * Stats block render template.
 *
 * @package GrosharpCore
 */

$items = isset( $attributes['items'] ) && is_array( $attributes['items'] )
	? $attributes['items']
	: array(
		array( 'value' => '32+', 'label' => __( 'Projects shipped', 'grosharp' ) ),
		array( 'value' => '148%', 'label' => __( 'Average reach lift', 'grosharp' ) ),
		array( 'value' => '4.9/5', 'label' => __( 'Client satisfaction', 'grosharp' ) ),
	);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-stats gs-section' ) ); ?>>
	<div class="gs-container">
		<div class="grosharp-stats__grid">
			<?php foreach ( $items as $item ) : ?>
				<div class="gs-card gs-reveal">
					<strong><?php echo esc_html( $item['value'] ?? '' ); ?></strong>
					<span><?php echo esc_html( $item['label'] ?? '' ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

