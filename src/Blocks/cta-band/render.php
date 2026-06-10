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
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-cta overflow-clip bg-[radial-gradient(ellipse_at_50%_100%,rgba(101,76,255,0.35),transparent_65%),linear-gradient(180deg,#0d0d12_0%,#110d28_100%)] py-28 md:py-36' ) ); ?>>
	<div class="gs-container">
		<div class="gs-reveal mx-auto max-w-[840px] text-center">

			<!-- Eyebrow badge -->
			<p class="mb-8 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-xs font-semibold uppercase tracking-widest text-white/60">
				<?php esc_html_e( "Let's work together", 'grosharp' ); ?>
			</p>

			<!-- Heading -->
			<h2 class="font-heading text-[48px] font-semibold leading-[53px] tracking-[-0.02em] text-white">
				<?php echo esc_html( $attributes['heading'] ); ?>
			</h2>

			<!-- Body text -->
			<p class="mx-auto mt-6 max-w-xl text-lg leading-relaxed text-white/60">
				<?php echo esc_html( $attributes['text'] ); ?>
			</p>

			<!-- CTAs -->
			<div class="mt-10 flex flex-wrap justify-center gap-3">
				<a class="inline-flex min-h-[56px] flex-none items-center justify-center gap-3 whitespace-nowrap rounded-full bg-white py-3 pl-7 pr-3 font-body text-[17px] font-semibold text-[#0d0d12] no-underline shadow-[0_8px_32px_rgba(255,255,255,0.12)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_12px_40px_rgba(255,255,255,0.18)]"
				   href="<?php echo esc_url( $attributes['buttonUrl'] ); ?>">
					<?php echo esc_html( $attributes['buttonLabel'] ); ?>
					<span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-[#0d0d12] text-[15px] text-white" aria-hidden="true">→</span>
				</a>
				<a class="inline-flex min-h-[56px] flex-none items-center justify-center whitespace-nowrap rounded-full border border-white/15 bg-white/5 px-7 font-body text-[17px] font-semibold text-white/80 no-underline backdrop-blur-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-white/10 hover:text-white"
				   href="<?php echo esc_url( $attributes['secondaryUrl'] ); ?>">
					<?php echo esc_html( $attributes['secondaryLabel'] ); ?>
				</a>
			</div>

		</div>
	</div>
</section>
