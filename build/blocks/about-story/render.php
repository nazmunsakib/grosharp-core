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
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-about-story bg-white py-14 lg:py-20' ) ); ?>>
	<div class="gs-container">

		<p class="inline-flex items-center gap-2 rounded-full border border-[rgba(101,76,255,0.2)] bg-[rgba(101,76,255,0.07)] px-4 py-1.5 font-body text-[0.75rem] font-semibold uppercase tracking-[0.09em] text-brand-violet mb-8 lg:mb-14" data-gs-eyebrow>
			<span class="h-1.5 w-1.5 rounded-full bg-brand-violet" aria-hidden="true"></span>
			<?php echo esc_html( $eyebrow ); ?>
		</p>

		<div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-24 lg:items-start">

			<!-- Left: pull quote, sticky on desktop -->
			<div class="lg:sticky lg:top-[120px]">
				<div class="about-story-quote-wrap relative pl-5 md:pl-6 border-l-[3px] border-[#654cff]">
					<span class="about-story-quote-mark block font-heading text-[4rem] md:text-[6rem] leading-[0.75] text-[#654cff] opacity-[0.18] mb-2 select-none" aria-hidden="true">"</span>
					<blockquote class="about-story-quote font-heading text-[clamp(1.25rem,2.5vw,1.875rem)] font-bold leading-[1.3] tracking-[-0.025em] text-[#0d0d12] m-0">
						<?php echo esc_html( $quote ); ?>
					</blockquote>
				</div>
			</div>

			<!-- Right: narrative paragraphs -->
			<div class="flex flex-col gap-5 md:gap-6">
				<?php if ( $p1 ) : ?>
					<p class="about-story-p font-body text-[0.9375rem] md:text-[1.0625rem] leading-[1.8] text-[#5c5d6d] m-0"><?php echo esc_html( $p1 ); ?></p>
				<?php endif; ?>
				<?php if ( $p2 ) : ?>
					<p class="about-story-p font-body text-[0.9375rem] md:text-[1.0625rem] leading-[1.8] text-[#5c5d6d] m-0"><?php echo esc_html( $p2 ); ?></p>
				<?php endif; ?>
				<?php if ( $p3 ) : ?>
					<p class="about-story-p font-body text-[0.9375rem] md:text-[1.0625rem] leading-[1.8] text-[#5c5d6d] m-0"><?php echo esc_html( $p3 ); ?></p>
				<?php endif; ?>
			</div>

		</div>

	</div>
</section>
