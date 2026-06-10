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
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-hero overflow-clip bg-[radial-gradient(circle_at_50%_72%,rgba(101,76,255,0.18),transparent_34rem),linear-gradient(180deg,#fafaff_0%,#ece7ff_50%,#ddd5ff_100%)] pb-28 pt-32 md:pb-36 md:pt-44' ) ); ?>>
	<div class="gs-container">

		<!-- Hero copy -->
		<div class="gs-reveal mx-auto max-w-[1000px] text-center">
			<p class="mb-8 inline-flex items-center gap-3 rounded-full border border-black/[0.08] bg-white/90 py-1 pl-1 pr-5 text-sm font-semibold leading-none text-[#30313d] shadow-[0_8px_24px_rgba(101,76,255,0.10)]">
				<span class="rounded-full bg-[#0d0d12] px-3 py-2 text-[12px] font-bold uppercase tracking-wide text-white"><?php echo esc_html( $attributes['badge'] ); ?></span>
				<?php echo esc_html( $attributes['eyebrow'] ); ?>
			</p>
			<h1 class="mx-auto max-w-[980px] font-heading text-[54px] font-semibold leading-[0.94] tracking-[-0.02em] text-[#0d0d12] sm:text-[72px] lg:text-[92px]">
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
		<div class="gs-reveal relative mx-auto mt-20 max-w-[1060px] pb-8 md:mt-24" data-gs-hero-visual>

			<!-- Main dashboard card -->
			<div class="overflow-hidden rounded-[32px] border border-black/[0.06] bg-white p-3 shadow-[0_32px_100px_rgba(101,76,255,0.18)] md:p-4">
				<?php if ( ! empty( $attributes['imageUrl'] ) ) : ?>
					<img class="block aspect-[16/9] h-auto w-full rounded-[24px] object-cover" src="<?php echo esc_url( $attributes['imageUrl'] ); ?>" alt="<?php echo esc_attr( $attributes['imageAlt'] ); ?>" loading="eager" decoding="async" />
				<?php else : ?>
					<!-- Premium placeholder dashboard UI -->
					<div class="aspect-[16/9] overflow-hidden rounded-[24px] bg-[#0f1117]">
						<!-- Top bar -->
						<div class="flex items-center gap-3 border-b border-white/[0.06] px-5 py-3">
							<span class="flex gap-1.5">
								<i class="block h-3 w-3 rounded-full bg-[#ff5f57]"></i>
								<i class="block h-3 w-3 rounded-full bg-[#febc2e]"></i>
								<i class="block h-3 w-3 rounded-full bg-[#28c840]"></i>
							</span>
							<span class="mx-auto flex h-5 w-44 items-center justify-center rounded-full bg-white/[0.05] text-[10px] font-medium text-white/30">grosharp.com/dashboard</span>
							<span class="flex gap-1.5 opacity-0">
								<i class="block h-2 w-2 rounded-full bg-white/10"></i>
							</span>
						</div>
						<!-- Layout -->
						<div class="flex h-[calc(100%-37px)]">
							<!-- Sidebar -->
							<div class="hidden w-44 flex-none border-r border-white/[0.06] p-4 md:block">
								<div class="mb-5 h-7 w-28 rounded-lg bg-[#654cff]/30"></div>
								<div class="space-y-2">
									<div class="flex h-7 w-full items-center gap-2 rounded-lg bg-[#654cff]/15 px-2">
										<div class="h-2 w-2 rounded-full bg-[#654cff]/60"></div>
										<div class="h-2 w-16 rounded-full bg-white/20"></div>
									</div>
									<div class="h-7 w-full rounded-lg bg-white/[0.04]"></div>
									<div class="h-7 w-3/4 rounded-lg bg-white/[0.04]"></div>
									<div class="h-7 w-full rounded-lg bg-white/[0.04]"></div>
									<div class="h-7 w-5/6 rounded-lg bg-white/[0.04]"></div>
									<div class="h-7 w-4/5 rounded-lg bg-white/[0.04]"></div>
								</div>
							</div>
							<!-- Main -->
							<div class="grow p-4 md:p-5">
								<!-- Stat cards -->
								<div class="mb-4 grid grid-cols-3 gap-3">
									<div class="rounded-xl bg-white/[0.04] p-4">
										<div class="mb-2 h-2.5 w-14 rounded-full bg-white/15"></div>
										<div class="h-7 w-16 rounded-lg bg-white/20"></div>
									</div>
									<div class="rounded-xl bg-[#654cff]/20 p-4">
										<div class="mb-2 h-2.5 w-14 rounded-full bg-[#654cff]/40"></div>
										<div class="h-7 w-16 rounded-lg bg-[#654cff]/60"></div>
									</div>
									<div class="rounded-xl bg-white/[0.04] p-4">
										<div class="mb-2 h-2.5 w-14 rounded-full bg-white/15"></div>
										<div class="h-7 w-16 rounded-lg bg-white/20"></div>
									</div>
								</div>
								<!-- Chart -->
								<div class="rounded-xl bg-white/[0.04] p-4">
									<div class="mb-4 flex items-center justify-between">
										<div class="h-2.5 w-24 rounded-full bg-white/15"></div>
										<div class="h-2.5 w-14 rounded-full bg-white/10"></div>
									</div>
									<div class="flex h-[90px] items-end gap-1.5 md:h-[110px]">
										<div class="flex-1 rounded-t-md bg-[#654cff]/20" style="height:38%"></div>
										<div class="flex-1 rounded-t-md bg-[#654cff]/25" style="height:55%"></div>
										<div class="flex-1 rounded-t-md bg-[#654cff]/20" style="height:42%"></div>
										<div class="flex-1 rounded-t-md bg-[#654cff]/35" style="height:70%"></div>
										<div class="flex-1 rounded-t-md bg-[#654cff]/50" style="height:60%"></div>
										<div class="flex-1 rounded-t-md bg-[#654cff]/75" style="height:88%"></div>
										<div class="flex-1 rounded-t-md bg-[#654cff]" style="height:100%"></div>
										<div class="flex-1 rounded-t-md bg-[#654cff]/85" style="height:94%"></div>
										<div class="flex-1 rounded-t-md bg-[#654cff]/60" style="height:72%"></div>
										<div class="flex-1 rounded-t-md bg-[#654cff]/45" style="height:58%"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<!-- Floating proof card: bottom-left -->
			<div class="absolute bottom-0 left-4 hidden rounded-2xl border border-black/[0.06] bg-white/95 px-5 py-4 shadow-[0_8px_36px_rgba(0,0,0,0.10)] backdrop-blur-sm md:block lg:left-8" aria-hidden="true">
				<p class="mb-1 text-[11px] font-semibold uppercase tracking-widest text-[#9a9aaa]">Projects shipped</p>
				<div class="flex items-baseline gap-2">
					<span class="font-heading text-2xl font-bold text-[#0d0d12]">32+</span>
					<span class="inline-flex items-center gap-0.5 rounded-full bg-emerald-50 px-2 py-0.5 text-[11px] font-bold text-emerald-600">↑ 100%</span>
				</div>
			</div>

			<!-- Floating proof card: bottom-right -->
			<div class="absolute bottom-0 right-4 hidden rounded-2xl border border-black/[0.06] bg-white/95 px-5 py-4 shadow-[0_8px_36px_rgba(0,0,0,0.10)] backdrop-blur-sm md:block lg:right-8" aria-hidden="true">
				<div class="mb-1.5 flex items-center gap-0.5">
					<?php for ( $i = 0; $i < 5; $i++ ) : ?>
						<svg width="13" height="13" viewBox="0 0 24 24" fill="#f59e0b" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
					<?php endfor; ?>
				</div>
				<p class="text-sm font-semibold text-[#0d0d12]">4.9 · Client satisfaction</p>
			</div>

		</div><!-- /hero visual -->

	</div>
</section>
