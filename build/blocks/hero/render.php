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
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-hero overflow-clip bg-[radial-gradient(circle_at_50%_72%,rgba(111,76,255,0.16),transparent_32rem),linear-gradient(180deg,#fbfaff_0%,#eee9ff_46%,#dcd4ff_100%)] pb-20 pt-32 md:min-h-screen md:pb-28 md:pt-44' ) ); ?>>
	<div class="gs-container">
		<div class="gs-reveal mx-auto max-w-[980px] text-center">
			<p class="mb-8 inline-flex items-center gap-3 rounded-full border border-black/10 bg-white/90 py-1 pl-1 pr-4 text-sm font-bold leading-none text-[#30313d] shadow-[0_10px_30px_rgba(91,73,255,0.08)]">
				<span class="rounded-full bg-[#111] px-3 py-2 text-white"><?php echo esc_html( $attributes['badge'] ); ?></span>
				<?php echo esc_html( $attributes['eyebrow'] ); ?>
			</p>
			<h1 class="mx-auto max-w-[980px] font-heading text-[56px] font-semibold leading-[0.94] text-[#0d0d12] sm:text-[72px] lg:text-[90px]"><?php echo esc_html( $attributes['heading'] ); ?></h1>
			<p class="mx-auto mt-8 max-w-[860px] font-body text-lg font-semibold leading-[1.45] text-[#5c5d6d] md:text-[22px]"><?php echo esc_html( $attributes['text'] ); ?></p>
			<div class="mt-9 flex flex-wrap justify-center gap-3">
				<a class="inline-flex min-h-14 flex-none items-center justify-center gap-3 whitespace-nowrap rounded-full bg-[#654cff] py-3 pl-7 pr-3 font-body text-[18px] font-medium text-white no-underline shadow-[0_18px_40px_rgba(83,62,215,0.34),inset_0_-2px_0_rgba(0,0,0,0.12)] transition hover:-translate-y-0.5" href="<?php echo esc_url( $attributes['primaryUrl'] ); ?>">
					<?php echo esc_html( $attributes['primaryLabel'] ); ?>
					<span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white text-[#111]" aria-hidden="true">&rarr;</span>
				</a>
				<a class="inline-flex min-h-14 flex-none items-center justify-center whitespace-nowrap rounded-full border border-black/10 bg-white/85 px-7 font-body text-[18px] font-medium text-[#111] no-underline shadow-[0_12px_32px_rgba(91,73,255,0.08)] transition hover:-translate-y-0.5 hover:bg-white" href="<?php echo esc_url( $attributes['secondaryUrl'] ); ?>">
					<?php echo esc_html( $attributes['secondaryLabel'] ); ?>
				</a>
			</div>
		</div>
		<div class="gs-reveal mx-auto mt-24 max-w-[1070px]" data-gs-hero-visual>
			<div class="overflow-hidden rounded-[30px] bg-white p-4 shadow-[0_30px_100px_rgba(91,73,255,0.16)] md:p-6">
				<?php if ( ! empty( $attributes['imageUrl'] ) ) : ?>
					<img class="block aspect-[16/9] h-auto w-full rounded-[22px] object-cover" src="<?php echo esc_url( $attributes['imageUrl'] ); ?>" alt="<?php echo esc_attr( $attributes['imageAlt'] ); ?>" loading="eager" decoding="async" />
				<?php else : ?>
					<div class="aspect-[16/9] rounded-[22px] bg-[linear-gradient(135deg,#081018_0%,#151827_48%,#f4f7fb_48%,#ffffff_100%)]"></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
