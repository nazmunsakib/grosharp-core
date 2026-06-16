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
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-about-values bg-[#f4f3ff] py-14 lg:py-20' ) ); ?>>
	<div class="gs-container">

		<!-- Section header -->
		<div class="max-w-[640px] mb-10 lg:mb-16">
			<p class="inline-flex items-center gap-2 rounded-full border border-[rgba(101,76,255,0.2)] bg-[rgba(101,76,255,0.07)] px-4 py-1.5 font-body text-[0.75rem] font-semibold uppercase tracking-[0.09em] text-brand-violet mb-4 md:mb-5" data-gs-eyebrow>
				<span class="h-1.5 w-1.5 rounded-full bg-brand-violet" aria-hidden="true"></span>
				<?php echo esc_html( $eyebrow ); ?>
			</p>
			<h2 class="font-heading text-[clamp(2rem,4vw,3.375rem)] font-extrabold leading-[1.1] tracking-[-0.035em] text-[#0d0d12] mt-0 mb-3 md:mb-4">
				<?php echo esc_html( $heading ); ?>
			</h2>
			<p class="font-body text-[1.25rem] leading-[1.7] text-brand-ink m-0">
				<?php echo esc_html( $text ); ?>
			</p>
		</div>

		<!-- Values grid -->
		<div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-5">
			<?php foreach ( $values as $value ) : ?>
				<div class="relative overflow-hidden rounded-2xl md:rounded-panel border border-[rgba(101,76,255,0.12)] bg-white p-6 md:p-10 transition-all duration-300 hover:border-[rgba(101,76,255,0.35)] hover:shadow-[0_12px_40px_rgba(101,76,255,0.1)] hover:-translate-y-[3px]" data-gs-value-card>

					<span class="pointer-events-none select-none absolute -top-2 right-3 font-heading text-[5rem] md:text-[7rem] font-black leading-none tracking-[-0.05em] text-[rgba(101,76,255,0.05)]" aria-hidden="true">
						<?php echo esc_html( $value['number'] ); ?>
					</span>

					<div class="about-value-icon inline-flex items-center justify-center w-[48px] h-[48px] md:w-[52px] md:h-[52px] rounded-[12px] md:rounded-[14px] bg-[rgba(101,76,255,0.08)] border border-[rgba(101,76,255,0.15)] text-brand-violet">
						<?php echo $value['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>

					<h3 class="font-heading text-[1.125rem] md:text-[1.25rem] font-bold tracking-[-0.02em] text-brand-dark leading-[1.25] mt-4 md:mt-5 mb-0">
						<?php echo esc_html( $value['title'] ); ?>
					</h3>
					<p class="font-body text-[0.875rem] md:text-[0.9375rem] leading-[1.75] text-brand-ink mt-2 md:mt-3 mb-0">
						<?php echo esc_html( $value['desc'] ); ?>
					</p>

				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
