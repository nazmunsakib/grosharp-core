<?php
/**
 * Hero block render template.
 *
 * @package GrosharpCore
 */

$attributes = wp_parse_args(
	$attributes,
	array(
		'badge'          => __( 'New', 'grosharp' ),
		'eyebrow'        => __( 'Digital growth systems for ambitious brands', 'grosharp' ),
		'heading'        => __( 'Design, build, and grow your digital presence.', 'grosharp' ),
		'text'           => __( 'Grosharp brings development, design, and marketing together to launch sharper websites, stronger brands, and smarter growth campaigns.', 'grosharp' ),
		'primaryLabel'   => __( 'Start your growth project', 'grosharp' ),
		'primaryUrl'     => '/contact/',
		'secondaryLabel' => __( 'See case studies', 'grosharp' ),
		'secondaryUrl'   => '/case-studies/',
		'imageId'        => 0,
		'imageUrl'       => '',
		'imageAlt'       => __( 'Grosharp growth dashboard preview', 'grosharp' ),
	)
);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-hero pb-28 pt-32 md:pb-36 md:pt-44' ) ); ?>>
	<div class="gs-container">

		<!-- Hero copy -->
		<div class="gs-reveal mx-auto max-w-[1000px] text-center">
			<p class="mb-8 inline-flex items-center gap-3 rounded-full border border-black/[0.08] bg-white/90 py-1 pl-1 pr-5 text-sm font-semibold leading-none text-[#30313d] shadow-[0_8px_24px_rgba(101,76,255,0.10)]">
				<span class="rounded-full bg-[#0d0d12] px-3 py-2 text-[12px] font-bold uppercase tracking-wide text-white"><?php echo esc_html( $attributes['badge'] ); ?></span>
				<?php echo esc_html( $attributes['eyebrow'] ); ?>
			</p>
			<h1 class="mx-auto max-w-[980px] font-heading text-[38px] font-semibold leading-[1.06] tracking-[-0.02em] text-[#0d0d12] sm:text-[52px] lg:text-[68px]">
				<?php echo esc_html( $attributes['heading'] ); ?>
			</h1>
			<p class="mx-auto mt-8 max-w-[820px] font-body text-lg font-medium leading-[1.5] text-[#5c5d6d] md:text-[21px]">
				<?php echo esc_html( $attributes['text'] ); ?>
			</p>
			<div class="mt-10 flex flex-wrap justify-center gap-3">
				<a class="inline-flex min-h-[56px] flex-none items-center justify-center gap-3 whitespace-nowrap rounded-full bg-[#654cff] py-3 pl-7 pr-3 font-body text-[17px] font-semibold text-white no-underline shadow-[0_18px_48px_rgba(101,76,255,0.38),inset_0_-2px_0_rgba(0,0,0,0.14)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_24px_60px_rgba(101,76,255,0.45)]"
				   href="<?php echo esc_url( $attributes['primaryUrl'] ); ?>">
					<?php echo esc_html( $attributes['primaryLabel'] ); ?>
					<span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white text-[15px] text-[#0d0d12]" aria-hidden="true">→</span>
				</a>
				<a class="inline-flex min-h-[56px] flex-none items-center justify-center whitespace-nowrap rounded-full border border-black/[0.08] bg-white/80 px-7 font-body text-[17px] font-semibold text-[#111] no-underline shadow-[0_4px_20px_rgba(101,76,255,0.08)] backdrop-blur-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-white hover:shadow-[0_8px_32px_rgba(101,76,255,0.12)]"
				   href="<?php echo esc_url( $attributes['secondaryUrl'] ); ?>">
					<?php echo esc_html( $attributes['secondaryLabel'] ); ?>
				</a>
			</div>
		</div>

		<!-- Hero visual -->
		<div class="gs-reveal mx-auto mt-16 max-w-[1060px] md:mt-20" data-gs-hero-visual>

			<!-- Team image card -->
			<div class="overflow-hidden rounded-[28px] border border-black/[0.06] bg-white p-2.5 shadow-[0_32px_100px_rgba(101,76,255,0.14)] md:p-3">
				<?php if ( ! empty( $attributes['imageUrl'] ) ) : ?>
					<img class="block aspect-[16/7] h-auto w-full rounded-[20px] object-cover object-center" src="<?php echo esc_url( $attributes['imageUrl'] ); ?>" alt="<?php echo esc_attr( $attributes['imageAlt'] ); ?>" loading="eager" decoding="async" />
				<?php else : ?>
					<!-- Placeholder: upload your team/office photo via block settings -->
					<div class="relative aspect-[16/7] overflow-hidden rounded-[20px] bg-[#f0eeff]">
						<!-- Ambient gradient -->
						<div class="absolute inset-0" style="background:radial-gradient(ellipse 70% 80% at 50% 60%,rgba(101,76,255,0.10) 0%,transparent 70%);"></div>
						<!-- Office scene sketch lines -->
						<div class="absolute inset-0 flex items-end justify-center pb-8">
							<svg class="w-full max-w-[480px] opacity-20" viewBox="0 0 480 160" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
								<!-- Table -->
								<rect x="60" y="110" width="360" height="8" rx="4" fill="#654cff"/>
								<rect x="80" y="118" width="8" height="32" rx="4" fill="#654cff"/>
								<rect x="392" y="118" width="8" height="32" rx="4" fill="#654cff"/>
								<!-- Person 1 -->
								<circle cx="150" cy="72" r="18" fill="#654cff"/>
								<rect x="126" y="94" width="48" height="20" rx="8" fill="#654cff"/>
								<!-- Person 2 -->
								<circle cx="240" cy="68" r="20" fill="#654cff"/>
								<rect x="214" y="92" width="52" height="20" rx="8" fill="#654cff"/>
								<!-- Person 3 -->
								<circle cx="330" cy="72" r="18" fill="#654cff"/>
								<rect x="306" y="94" width="48" height="20" rx="8" fill="#654cff"/>
								<!-- Laptop on table -->
								<rect x="192" y="96" width="96" height="60" rx="6" fill="#654cff" opacity="0.4"/>
								<rect x="198" y="102" width="84" height="48" rx="4" fill="#654cff" opacity="0.3"/>
							</svg>
						</div>
						<!-- Label -->
						<div class="absolute inset-0 flex flex-col items-center justify-center gap-2">
							<p class="text-[13px] font-semibold tracking-wide text-[#654cff]/50">Upload your team / office photo</p>
							<p class="text-[11px] text-[#654cff]/35">Recommended: 1600 × 700 px</p>
						</div>
					</div>
				<?php endif; ?>

				<!-- Caption bar -->
				<div class="flex items-center justify-between px-4 py-3">
					<p class="text-[13px] font-semibold text-[#09090f]">The GroSharp team — building what others only promise.</p>
					<span class="inline-flex items-center gap-1.5 rounded-full bg-[#f4f2ff] px-3 py-1 text-[11px] font-bold uppercase tracking-widest text-[#654cff]">
						<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]"></span>
						Est. 2022
					</span>
				</div>
			</div>

		</div><!-- /hero visual -->

	</div>
</section>
