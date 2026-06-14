<?php
/**
 * Services grid block render template.
 *
 * @package GrosharpCore
 */

$eyebrow = $attributes['eyebrow'] ?? __( 'Services', 'grosharp' );
$heading = $attributes['heading'] ?? __( 'We help you design and build better digital products.', 'grosharp' );
$text    = $attributes['text'] ?? __( 'You need a partner who gets your business and covers everything. From branding to UI/UX design and web development, you can rely on us.', 'grosharp' );
$cta_url = $attributes['ctaUrl'] ?? '/services/';
$cta_label = $attributes['ctaLabel'] ?? __( 'See All Services', 'grosharp' );

$query = new WP_Query(
	array(
		'post_type'      => 'grosharp_service',
		'posts_per_page' => absint( $attributes['count'] ?? 6 ),
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
		'post_status'    => 'publish',
	)
);

/* ── Fallback card data ────────────────────────────────────────────────────── */
$fallback = array(
	array(
		'title'       => __( 'WordPress Development', 'grosharp' ),
		'description' => __( 'Custom WordPress sites engineered for speed, scalability, and clean content editing.', 'grosharp' ),
		'pillar'      => __( 'Development', 'grosharp' ),
		'url'         => '/services/',
		'gradient'    => 'linear-gradient(145deg,#0c1445 0%,#1e3a8a 100%)',
	),
	array(
		'title'       => __( 'Custom Web Apps', 'grosharp' ),
		'description' => __( 'React and full-stack applications that solve real business problems beautifully.', 'grosharp' ),
		'pillar'      => __( 'Development', 'grosharp' ),
		'url'         => '/services/',
		'gradient'    => 'linear-gradient(145deg,#042f2e 0%,#134e4a 100%)',
	),
	array(
		'title'       => __( 'Brand & UI Design', 'grosharp' ),
		'description' => __( 'Identities and interfaces that turn visitors into believers from first glance.', 'grosharp' ),
		'pillar'      => __( 'Design', 'grosharp' ),
		'url'         => '/services/',
		'gradient'    => 'linear-gradient(145deg,#1e0a3c 0%,#4c1d95 100%)',
	),
	array(
		'title'       => __( 'UX & Product Design', 'grosharp' ),
		'description' => __( 'User flows, wireframes, and prototypes that remove friction and drive conversions.', 'grosharp' ),
		'pillar'      => __( 'Design', 'grosharp' ),
		'url'         => '/services/',
		'gradient'    => 'linear-gradient(145deg,#431407 0%,#9a3412 100%)',
	),
	array(
		'title'       => __( 'SEO & Content Strategy', 'grosharp' ),
		'description' => __( 'Organic strategies that build lasting authority, qualified traffic, and revenue.', 'grosharp' ),
		'pillar'      => __( 'Marketing', 'grosharp' ),
		'url'         => '/services/',
		'gradient'    => 'linear-gradient(145deg,#052e16 0%,#166534 100%)',
	),
	array(
		'title'       => __( 'Growth Campaigns', 'grosharp' ),
		'description' => __( 'Paid media, conversion funnels, and retention systems that compound results.', 'grosharp' ),
		'pillar'      => __( 'Marketing', 'grosharp' ),
		'url'         => '/services/',
		'gradient'    => 'linear-gradient(145deg,#450a0a 0%,#991b1b 100%)',
	),
);

/* ── Pillar badge colours ─────────────────────────────────────────────────── */
$pillar_colors = array(
	'Development' => 'bg-blue-500/20 text-blue-300 border-blue-500/20',
	'Design'      => 'bg-violet-500/20 text-violet-300 border-violet-500/20',
	'Marketing'   => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/20',
);

/* ── Build card list ─────────────────────────────────────────────────────── */
$cards = array();

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$pillar_terms = get_the_terms( get_the_ID(), 'service_pillar' );
		$pillar       = ( is_array( $pillar_terms ) && ! empty( $pillar_terms ) ) ? $pillar_terms[0]->name : '';
		$thumb_url    = get_the_post_thumbnail_url( get_the_ID(), 'large' );

		$cards[] = array(
			'title'       => get_the_title(),
			'description' => wp_strip_all_tags( get_the_excerpt() ),
			'pillar'      => $pillar,
			'url'         => get_permalink(),
			'thumb'       => $thumb_url ?: '',
			'gradient'    => '',
		);
	}
	wp_reset_postdata();
} else {
	$cards = $fallback;
}
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-services overflow-hidden bg-white' ) ); ?>>

	<!-- ── Section header ─────────────────────────────────────────────────── -->
	<div class="gs-container pb-14 pt-24 md:pb-16 md:pt-28">
		<div class="flex flex-col gap-10 md:flex-row md:items-end md:justify-between">

			<!-- Left: eyebrow + heading -->
			<div class="max-w-[580px]">
				<p class="inline-flex items-center gap-2 rounded-full border border-[#654cff]/20 bg-[#654cff]/[0.07] px-4 py-1.5 font-body text-xs font-semibold uppercase tracking-widest text-[#654cff]" data-gs-eyebrow>
					<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
					<?php echo esc_html( $eyebrow ); ?>
				</p>
				<h2 class="mt-6 font-heading text-[40px] font-bold leading-[1.1] tracking-[-0.025em] text-[#0d0d12] md:text-[48px]">
					<?php echo esc_html( $heading ); ?>
				</h2>
			</div>

			<!-- Right: body + CTA -->
			<div class="max-w-[360px] md:shrink-0 md:pb-2 md:text-right">
				<p class="font-body text-[20px] leading-[28px] text-[#5c5d6d]">
					<?php echo esc_html( $text ); ?>
				</p>
				<a href="<?php echo esc_url( $cta_url ); ?>"
				   class="mt-7 inline-flex min-h-[48px] items-center rounded-full border border-black/15 px-7 font-body text-sm font-semibold text-[#0d0d12] no-underline transition-all duration-300 hover:border-[#654cff] hover:bg-[#654cff] hover:text-white hover:shadow-[0_8px_24px_rgba(101,76,255,0.28)]">
					<?php echo esc_html( $cta_label ); ?>
				</a>
			</div>

		</div>
	</div>

	<!-- ── Horizontal marquee strip ───────────────────────────────────────── -->
	<!--
		PHP renders each card exactly once. JavaScript (initServicesScroll) clones
		the cards until there is enough content to fill 3× the viewport width, then
		runs the GSAP seamless loop. No visible duplicates in the HTML source.
	-->
	<div class="relative pb-24 md:pb-28" data-gs-services-marquee data-card-count="<?php echo count( $cards ); ?>">
		<div class="flex gap-4 will-change-transform" data-gs-services-track
		     style="padding-left:clamp(1.25rem,calc((100vw - 1280px)/2 + 1.5rem),6rem);padding-right:clamp(1.25rem,calc((100vw - 1280px)/2 + 1.5rem),6rem);">

			<?php foreach ( $cards as $card ) : ?>
				<?php $pillar_cls = $pillar_colors[ $card['pillar'] ] ?? 'bg-white/10 text-white/60 border-white/10'; ?>
				<article class="group relative flex-none cursor-pointer overflow-hidden rounded-[24px]"
				         style="width:max(260px,calc(25vw - 36px));height:500px;">

					<!-- Background: thumbnail or gradient -->
					<?php if ( $card['thumb'] ) : ?>
						<img
							src="<?php echo esc_url( $card['thumb'] ); ?>"
							alt="<?php echo esc_attr( $card['title'] ); ?>"
							class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
							loading="lazy"
						/>
					<?php else : ?>
						<div class="absolute inset-0 transition-transform duration-700 ease-out group-hover:scale-105"
						     style="background:<?php echo esc_attr( $card['gradient'] ); ?>;"></div>
					<?php endif; ?>

					<!-- Permanent bottom title gradient -->
					<div class="pointer-events-none absolute inset-x-0 bottom-0 z-10 bg-gradient-to-t from-black/85 via-black/25 to-transparent px-6 pb-7 pt-24 transition-opacity duration-300 group-hover:opacity-0">
						<h3 class="font-heading text-[36px] font-bold leading-[44px] text-white">
							<?php echo esc_html( $card['title'] ); ?>
						</h3>
					</div>

					<!-- Arrow button -->
					<a href="<?php echo esc_url( $card['url'] ); ?>"
					   class="absolute right-5 top-5 z-30 flex h-10 w-10 items-center justify-center rounded-full bg-white font-bold text-[#0d0d12] no-underline shadow-md transition-transform duration-300 group-hover:scale-110">
						↗
					</a>

					<!-- ── Glass overlay (slides up on hover) ──────────────── -->
					<div class="pointer-events-none absolute inset-x-0 bottom-0 z-20 flex translate-y-full flex-col justify-between rounded-b-[24px] border-t border-white/10 p-6 pt-7 transition-transform duration-[420ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:translate-y-0 group-hover:pointer-events-auto"
					     style="height:68%;backdrop-filter:blur(20px) saturate(1.5);background:rgba(10,10,16,0.68);">

						<div>
							<?php if ( $card['pillar'] ) : ?>
								<span class="inline-block rounded-full border px-3 py-1 font-body text-xs font-semibold <?php echo esc_attr( $pillar_cls ); ?>">
									<?php echo esc_html( $card['pillar'] ); ?>
								</span>
							<?php endif; ?>
							<h3 class="mt-3 font-heading text-[36px] font-bold leading-[44px] text-white">
								<?php echo esc_html( $card['title'] ); ?>
							</h3>
							<p class="mt-2.5 font-body text-[13.5px] leading-relaxed text-white/65">
								<?php echo esc_html( $card['description'] ); ?>
							</p>
						</div>

							<a href="<?php echo esc_url( $card['url'] ); ?>"
							   class="inline-flex items-center gap-2 self-start rounded-full border border-white/25 px-5 py-2.5 font-body text-sm font-semibold text-white no-underline transition-all duration-300 hover:bg-white hover:text-[#0d0d12]"
							   tabindex="0">
								<?php esc_html_e( 'See Details', 'grosharp' ); ?>
								<span aria-hidden="true">→</span>
							</a>

						</div>
					</article>
			<?php endforeach; ?>

		</div>
	</div>

</section>
