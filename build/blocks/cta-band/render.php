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
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-cta bg-transparent py-12 md:py-[clamp(4rem,7vw,6rem)]' ) ); ?>>
	<div class="gs-container">

		<div class="cta-card relative overflow-hidden rounded-2xl md:rounded-[2rem] bg-brand-violet">

			<!-- Subtle radial glow -->
			<div class="pointer-events-none absolute inset-0" aria-hidden="true"
			     style="background:radial-gradient(ellipse at 60% 120%, rgba(255,255,255,0.12) 0%, transparent 60%);"></div>

			<!-- Content -->
			<div class="cta-card-inner relative z-10 mx-auto max-w-[740px] px-6 py-12 md:px-[clamp(1.5rem,5vw,4rem)] md:py-[clamp(3rem,6vw,5rem)] text-center">

				<!-- Eyebrow -->
				<p class="cta-eyebrow inline-flex items-center gap-2 rounded-control border border-white/25 bg-white/10 px-4 py-1.5 font-body text-[0.75rem] font-semibold uppercase tracking-[0.08em] text-white/85 mb-5 md:mb-7" data-gs-eyebrow>
					<span class="w-1.5 h-1.5 rounded-full bg-white/70 flex-shrink-0" aria-hidden="true"></span>
					<?php esc_html_e( "Let's work together", 'grosharp' ); ?>
				</p>

				<!-- Heading -->
				<h2 class="cta-heading font-heading text-[clamp(1.625rem,4.5vw,3.25rem)] font-extrabold tracking-[-0.035em] leading-[1.1] text-white mt-0 mb-4 md:mb-5">
					<?php echo esc_html( $attributes['heading'] ); ?>
				</h2>

				<!-- Body text -->
				<p class="cta-sub font-body text-[0.9375rem] md:text-[clamp(1rem,1.5vw,1.125rem)] leading-[1.7] text-white/70 max-w-[46ch] mx-auto m-0">
					<?php echo esc_html( $attributes['text'] ); ?>
				</p>

				<!-- CTAs -->
				<div class="cta-actions flex flex-col sm:flex-row flex-wrap justify-center gap-3 mt-8 md:mt-10">
					<a class="inline-flex items-center justify-center gap-3 min-h-[52px] pl-6 pr-2.5 py-2.5 rounded-control bg-white text-brand-dark font-body text-[0.9375rem] md:text-base font-bold no-underline whitespace-nowrap shadow-[0_8px_32px_rgba(0,0,0,0.18)] transition-all duration-200 hover:-translate-y-[2px] hover:shadow-[0_14px_40px_rgba(0,0,0,0.24)] hover:text-brand-dark hover:no-underline"
					   href="<?php echo esc_url( $attributes['buttonUrl'] ); ?>">
						<?php echo esc_html( $attributes['buttonLabel'] ); ?>
						<span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-brand-dark text-white text-base flex-shrink-0" aria-hidden="true">→</span>
					</a>
					<a class="inline-flex items-center justify-center min-h-[52px] px-6 md:px-7 rounded-control border border-white/30 bg-white/[0.08] text-white/90 font-body text-[0.9375rem] md:text-base font-semibold no-underline whitespace-nowrap transition-all duration-200 hover:bg-white/[0.15] hover:-translate-y-[2px] hover:text-white hover:no-underline"
					   href="<?php echo esc_url( $attributes['secondaryUrl'] ); ?>">
						<?php echo esc_html( $attributes['secondaryLabel'] ); ?>
					</a>
				</div>

			</div>
		</div>

	</div>
</section>
