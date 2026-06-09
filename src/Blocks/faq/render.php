<?php
/**
 * FAQ block render template.
 *
 * @package GrosharpCore
 */

$items = isset( $attributes['items'] ) && is_array( $attributes['items'] ) ? $attributes['items'] : array();
$heading = $attributes['heading'] ?? __( 'FAQ', 'grosharp' );
$text    = $attributes['text'] ?? __( 'Answers to common project questions.', 'grosharp' );
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-faq gs-section' ) ); ?>>
	<div class="gs-container">
		<div class="grosharp-section-header gs-reveal">
			<h2><?php echo esc_html( $heading ); ?></h2>
			<p><?php echo esc_html( $text ); ?></p>
		</div>
		<div class="grosharp-faq__list">
			<?php foreach ( $items as $item ) : ?>
				<details class="gs-card gs-reveal">
					<summary><?php echo esc_html( $item['question'] ?? '' ); ?></summary>
					<p><?php echo esc_html( $item['answer'] ?? '' ); ?></p>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>

