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
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-hero relative overflow-hidden pt-[8rem] pb-[6rem]' ) ); ?>>

	<!-- ── Decorative background layer ──────────────────────────────────── -->
	<div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">

		<!-- Subtle dot grid -->
		<div class="absolute inset-0 opacity-[0.045]"
		     style="background-image:radial-gradient(circle,#9b72f5 1px,transparent 1px);background-size:28px 28px;"></div>

		<!-- Soft glow behind content (not a visible circle, just ambience) -->
		<div class="absolute left-1/2 top-[38%] h-[480px] w-[700px] -translate-x-1/2 -translate-y-1/2 blur-[140px] opacity-35"
		     style="background:rgba(172,137,242,0.7);"></div>

		<!-- Top-right corner: large outlined square, slightly rotated -->
		<div class="absolute -right-16 -top-16 h-[220px] w-[220px] border border-[#9b72f5]/18"
		     style="transform:rotate(12deg);"></div>
		<!-- Top-right corner: smaller square inside -->
		<div class="absolute right-4 top-4 h-[120px] w-[120px] border border-[#654cff]/12"
		     style="transform:rotate(12deg);"></div>

		<!-- Bottom-left corner: large square -->
		<div class="absolute -bottom-10 -left-10 h-[180px] w-[180px] border border-[#9b72f5]/15"
		     style="transform:rotate(-8deg);"></div>

		<!-- Top-left: small accent square -->
		<div class="absolute left-[6%] top-16 h-10 w-10 border-2 border-[#654cff]/20"
		     style="transform:rotate(20deg);"></div>

		<!-- Bottom-right: small accent square -->
		<div class="absolute bottom-16 right-[7%] h-7 w-7 border-2 border-[#9b72f5]/22"
		     style="transform:rotate(-15deg);"></div>

		<!-- Thin horizontal line accent — top area -->
		<div class="absolute left-[5%] top-[28%] h-px w-24 bg-[#654cff]/15"></div>
		<div class="absolute left-[5%] top-[28%] mt-2 h-px w-14 bg-[#654cff]/10" style="margin-top:8px;"></div>

		<!-- Thin horizontal line accent — bottom-right -->
		<div class="absolute bottom-[22%] right-[5%] h-px w-20 bg-[#9b72f5]/15"></div>
		<div class="absolute bottom-[22%] right-[5%] h-px w-12 bg-[#9b72f5]/10" style="margin-top:8px;"></div>

	</div>

	<div class="gs-container relative z-10">

		<!-- Hero copy -->
		<div class="gs-reveal mx-auto max-w-[1000px] text-center">
			<p class="mb-8 inline-flex items-center gap-3 rounded-full border border-black/[0.08] bg-white/90 py-1 pl-1 pr-5 text-[16px] font-semibold leading-none text-[#30313d] shadow-[0_8px_24px_rgba(101,76,255,0.10)]">
				<span class="rounded-full bg-[#0d0d12] px-3 py-2 text-[16px] font-bold uppercase tracking-wide text-white"><?php echo esc_html( $attributes['badge'] ); ?></span>
				<?php echo esc_html( $attributes['eyebrow'] ); ?>
			</p>
			<h1 class="mx-auto max-w-[980px] font-heading text-[75px] font-semibold leading-[1.06] tracking-[-0.02em] text-[#0d0d12]">
				<?php echo esc_html( $attributes['heading'] ); ?>
			</h1>
			<p class="mx-auto mt-8 max-w-[820px] font-body text-lg font-medium leading-[1.5] text-[#5c5d6d] md:text-[21px]">
				<?php echo esc_html( $attributes['text'] ); ?>
			</p>
			<div class="mt-10 flex flex-wrap justify-center gap-3">
				<a class="inline-flex min-h-[56px] flex-none items-center justify-center gap-3 whitespace-nowrap rounded-full bg-[#654cff] py-3 pl-7 pr-3 font-body text-[17px] font-semibold text-white no-underline shadow-[0_18px_48px_rgba(101,76,255,0.38),inset_0_-2px_0_rgba(0,0,0,0.14)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_24px_60px_rgba(101,76,255,0.45)]"
				   href="<?php echo esc_url( $attributes['primaryUrl'] ); ?>">
					<?php echo esc_html( $attributes['primaryLabel'] ); ?>
					<span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white text-[16px] text-[#0d0d12]" aria-hidden="true">→</span>
				</a>
				<a class="inline-flex min-h-[56px] flex-none items-center justify-center whitespace-nowrap rounded-full border border-black/[0.08] bg-white/80 px-7 font-body text-[17px] font-semibold text-[#111] no-underline shadow-[0_4px_20px_rgba(101,76,255,0.08)] backdrop-blur-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-white hover:shadow-[0_8px_32px_rgba(101,76,255,0.12)]"
				   href="<?php echo esc_url( $attributes['secondaryUrl'] ); ?>">
					<?php echo esc_html( $attributes['secondaryLabel'] ); ?>
				</a>
			</div>
		</div>

		<!-- Hero visual -->
		<div class="mx-auto mt-16 max-w-[1060px] md:mt-20" data-gs-hero-visual>

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
							<p class="text-[16px] font-semibold tracking-wide text-[#654cff]/50">Upload your team / office photo</p>
							<p class="text-[16px] text-[#654cff]/35">Recommended: 1600 × 700 px</p>
						</div>
					</div>
				<?php endif; ?>

				<!-- Caption bar -->
				<div class="flex items-center justify-between px-4 py-3">
					<p class="text-[16px] font-semibold text-[#09090f]">The GroSharp team — building what others only promise.</p>
					<span class="inline-flex items-center gap-1.5 rounded-full bg-[#f4f2ff] px-3 py-1 text-[16px] font-bold uppercase tracking-widest text-[#654cff]">
						<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]"></span>
						Est. 2022
					</span>
				</div>
			</div>

		</div><!-- /hero visual -->

	</div><!-- /gs-container -->

</section>
