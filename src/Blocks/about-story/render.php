<?php
/**
 * About Story block render template.
 *
 * @package GrosharpCore
 */

$eyebrow = $attributes['eyebrow'] ?? __( 'Our Story', 'grosharp' );
$quote   = $attributes['quote']   ?? __( 'Great digital work isn\'t built on templates. It\'s crafted on understanding.', 'grosharp' );
$p1      = $attributes['p1']      ?? '';
$p2      = $attributes['p2']      ?? '';
$p3      = $attributes['p3']      ?? '';
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-about-story bg-white' ) ); ?>>
	<div class="gs-container">

		<!-- Eyebrow -->
		<p class="gs-eyebrow" data-gs-eyebrow>
			<span class="h-1.5 w-1.5 rounded-full bg-brand-violet" aria-hidden="true"></span>
			<?php echo esc_html( $eyebrow ); ?>
		</p>

		<!-- Two-column layout -->
		<div class="about-story-grid">

			<!-- Left: pulled quote (sticky on desktop) -->
			<div class="about-story-left">
				<div class="about-story-quote-wrap">
					<span class="about-story-quote-mark" aria-hidden="true">"</span>
					<blockquote class="about-story-quote">
						<?php echo esc_html( $quote ); ?>
					</blockquote>
				</div>
			</div>

			<!-- Right: narrative -->
			<div class="about-story-right">
				<?php if ( $p1 ) : ?>
					<p class="about-story-p"><?php echo esc_html( $p1 ); ?></p>
				<?php endif; ?>
				<?php if ( $p2 ) : ?>
					<p class="about-story-p"><?php echo esc_html( $p2 ); ?></p>
				<?php endif; ?>
				<?php if ( $p3 ) : ?>
					<p class="about-story-p"><?php echo esc_html( $p3 ); ?></p>
				<?php endif; ?>
			</div>

		</div>

	</div>
</section>
