<?php
/**
 * About Values block render template.
 *
 * @package GrosharpCore
 */

$eyebrow = $attributes['eyebrow'] ?? __( 'What We Stand For', 'grosharp' );
$heading = $attributes['heading'] ?? __( 'Values that guide every decision.', 'grosharp' );
$text    = $attributes['text']    ?? __( 'Not a list of buzzwords. The actual principles that shape how we work, who we work with, and what we ship.', 'grosharp' );

$values = array(
	array(
		'number' => '01',
		'title'  => $attributes['value1Title'] ?? __( 'Craft over speed', 'grosharp' ),
		'desc'   => $attributes['value1Desc']  ?? __( "We'd rather take the time to get it right than ship something that's just good enough. Every pixel earns its place — or it doesn't make it through.", 'grosharp' ),
		'icon'   => '<svg width="24" height="24" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 4l2.8 8.6H28l-7.4 5.4 2.8 8.6L16 21.2l-7.4 5.4 2.8-8.6L4 12.6h9.2L16 4z"/></svg>',
	),
	array(
		'number' => '02',
		'title'  => $attributes['value2Title'] ?? __( 'Partnership, not transactions', 'grosharp' ),
		'desc'   => $attributes['value2Desc']  ?? __( "We work best with clients who see us as long-term partners. We're invested in your outcomes — not just delivering a file and moving on.", 'grosharp' ),
		'icon'   => '<svg width="24" height="24" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 20c0-2.2 1.8-4 4-4h4c2.2 0 4 1.8 4 4"/><circle cx="16" cy="11" r="4"/><path d="M4 24c0-2 1.4-3.7 3.3-4M28 24c0-2-1.4-3.7-3.3-4"/><circle cx="7" cy="14" r="3"/><circle cx="25" cy="14" r="3"/></svg>',
	),
	array(
		'number' => '03',
		'title'  => $attributes['value3Title'] ?? __( 'Purposeful simplicity', 'grosharp' ),
		'desc'   => $attributes['value3Desc']  ?? __( "Every element earns its place. We remove the noise so your message lands clearly. The best design is the kind visitors don't notice — they just convert.", 'grosharp' ),
		'icon'   => '<svg width="24" height="24" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="4" width="24" height="24" rx="3"/><line x1="10" y1="12" x2="22" y2="12"/><line x1="10" y1="16" x2="18" y2="16"/><line x1="10" y1="20" x2="14" y2="20"/></svg>',
	),
);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-about-values' ) ); ?>>
	<div class="gs-container">

		<!-- Section header -->
		<div class="about-values-header">
			<p class="gs-eyebrow" data-gs-eyebrow>
				<span class="h-1.5 w-1.5 rounded-full bg-brand-violet" aria-hidden="true"></span>
				<?php echo esc_html( $eyebrow ); ?>
			</p>
			<h2 class="about-values-heading mt-5">
				<?php echo esc_html( $heading ); ?>
			</h2>
			<p class="about-values-sub mt-4">
				<?php echo esc_html( $text ); ?>
			</p>
		</div>

		<!-- Values grid -->
		<div class="about-values-grid">
			<?php foreach ( $values as $value ) : ?>
				<div class="about-value-card" data-gs-value-card>

					<span class="about-value-number" aria-hidden="true"><?php echo esc_html( $value['number'] ); ?></span>

					<div class="about-value-icon">
						<?php echo $value['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>

					<h3 class="about-value-title mt-5">
						<?php echo esc_html( $value['title'] ); ?>
					</h3>
					<p class="about-value-desc mt-3">
						<?php echo esc_html( $value['desc'] ); ?>
					</p>

				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
