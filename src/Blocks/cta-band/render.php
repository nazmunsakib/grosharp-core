<?php
/**
 * CTA band block render template.
 *
 * @package GrosharpCore
 */

// When placed as a global block (isGlobal:true) in the footer template,
// suppress the CTA on the front page and contact page to avoid duplication.
if ( ! empty( $attributes['isGlobal'] ) ) {
	if ( is_front_page() || is_page( array( 'contact', 'contact-us' ) ) ) {
		return;
	}
}

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
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-cta' ) ); ?>>
	<div class="gs-container">
		<div class="grosharp-cta-card">
			<div class="mx-auto max-w-[840px] text-center">

				<!-- Eyebrow badge -->
				<p class="cta-eyebrow mb-8 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-[16px] font-semibold uppercase tracking-widest text-white/60">
					<?php esc_html_e( "Let's work together", 'grosharp' ); ?>
				</p>

				<!-- Heading -->
				<h2 class="cta-heading font-heading text-[40px] font-semibold leading-[1.1] tracking-[-0.02em] text-white md:text-[52px] lg:text-[60px]">
					<?php echo esc_html( $attributes['heading'] ); ?>
				</h2>

				<!-- Body text -->
				<p class="cta-sub mx-auto mt-6 max-w-xl text-lg leading-relaxed text-white/60">
					<?php echo esc_html( $attributes['text'] ); ?>
				</p>

				<!-- CTAs -->
				<div class="cta-actions mt-10 flex flex-wrap justify-center gap-3">
					<a class="inline-flex min-h-[56px] flex-none items-center justify-center gap-3 whitespace-nowrap rounded-full bg-white py-3 pl-7 pr-3 font-body text-[17px] font-semibold text-brand-dark no-underline shadow-[0_8px_32px_rgba(255,255,255,0.12)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_12px_40px_rgba(255,255,255,0.18)]"
					   href="<?php echo esc_url( $attributes['buttonUrl'] ); ?>">
						<?php echo esc_html( $attributes['buttonLabel'] ); ?>
						<span class="inline-flex h-9 w-9 items-center justify-center rounded-full text-[16px] text-white" style="background:var(--grosharp-primary)" aria-hidden="true">→</span>
					</a>
					<a class="inline-flex min-h-[56px] flex-none items-center justify-center whitespace-nowrap rounded-full border border-white/15 bg-white/5 px-7 font-body text-[17px] font-semibold text-white/80 no-underline backdrop-blur-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-white/10 hover:text-white"
					   href="<?php echo esc_url( $attributes['secondaryUrl'] ); ?>">
						<?php echo esc_html( $attributes['secondaryLabel'] ); ?>
					</a>
				</div>

			</div>
		</div>
	</div>
</section>

