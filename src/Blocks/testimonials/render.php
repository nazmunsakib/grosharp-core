<?php
/**
 * Testimonials block render template.
 *
 * @package GrosharpCore
 */

/* Enqueue Swiper (queued into footer; safe to call inside render callback) */
wp_enqueue_style(
	'swiper',
	'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
	array(),
	'11'
);
wp_enqueue_script(
	'swiper',
	'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
	array(),
	'11',
	true
);

$eyebrow = $attributes['eyebrow'] ?? __( 'Client Stories', 'grosharp' );
$heading = $attributes['heading'] ?? __( "Words from the People We've Worked With", 'grosharp' );
$count   = absint( $attributes['count'] ?? 6 );

$query = new WP_Query(
	array(
		'post_type'      => 'grosharp_testimonial',
		'posts_per_page' => $count,
		'post_status'    => 'publish',
	)
);

/* ── Fallback slides ────────────────────────────────────────────────────────── */
$fallback = array(
	array(
		'headline' => __( '"The team delivered beyond what we imagined. Results came faster than expected."', 'grosharp' ),
		'body'     => __( 'Within two months of launch our inbound lead volume doubled. Grosharp brought ideas we never would have thought of, then executed them flawlessly.', 'grosharp' ),
		'name'     => 'Sarah Okeke',
		'role'     => 'CEO',
		'company'  => 'Elevance',
		'rating'   => '5.0',
		'initials' => 'EL',
		'color'    => '#e9e5ff',
		'text'     => '#4f39c7',
	),
	array(
		'headline' => __( '"Six months later, organic traffic is up 148%. Couldn\'t be happier."', 'grosharp' ),
		'body'     => __( 'We hired Grosharp for SEO and ended up getting a full content strategy that changed how we think about our brand. Game changing.', 'grosharp' ),
		'name'     => 'James Whitfield',
		'role'     => 'Head of Marketing',
		'company'  => 'Foliocraft',
		'rating'   => '5.0',
		'initials' => 'FC',
		'color'    => '#eef2ff',
		'text'     => '#3730a3',
	),
	array(
		'headline' => __( '"Support tickets dropped 40% the week we launched. Fast, reliable, they listened."', 'grosharp' ),
		'body'     => __( 'The new client portal Grosharp built replaced a tool we had been struggling with for years. Launch week changed everything for our support team.', 'grosharp' ),
		'name'     => 'Priya Nair',
		'role'     => 'Product Manager',
		'company'  => 'Meridian',
		'rating'   => '5.0',
		'initials' => 'ME',
		'color'    => '#ede9ff',
		'text'     => '#4f39c7',
	),
	array(
		'headline' => __( '"Conversion rate jumped 60% after the redesign. The ROI was immediate."', 'grosharp' ),
		'body'     => __( 'We expected a visual refresh and got a complete rethinking of our user journey. The data speaks for itself — we\'ve never seen numbers like this.', 'grosharp' ),
		'name'     => 'Daniel Cross',
		'role'     => 'Founder',
		'company'  => 'Vizerto',
		'rating'   => '5.0',
		'initials' => 'VZ',
		'color'    => '#f5f3ff',
		'text'     => '#6d28d9',
	),
	array(
		'headline' => __( '"Our new brand finally matches the quality of our product. Proud to show it off."', 'grosharp' ),
		'body'     => __( 'The Grosharp team took the time to understand what makes us different before opening Figma. That showed in every single design decision they made.', 'grosharp' ),
		'name'     => 'Anika Mensah',
		'role'     => 'CMO',
		'company'  => 'Aria Studio',
		'rating'   => '5.0',
		'initials' => 'AS',
		'color'    => '#e0e7ff',
		'text'     => '#4338ca',
	),
);

/* ── Build slides array ─────────────────────────────────────────────────────── */
$slides = array();

if ( $query->have_posts() ) {
	$i = 0;
	while ( $query->have_posts() ) {
		$query->the_post();
		$fb         = $fallback[ $i % count( $fallback ) ];
		$logo_url   = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
		$content    = get_the_content();
		$excerpt    = get_the_excerpt();
		$slides[]   = array(
			'headline' => $excerpt ? '"' . wp_strip_all_tags( $excerpt ) . '"' : $fb['headline'],
			'body'     => $content ? wp_strip_all_tags( $content ) : $fb['body'],
			'name'     => get_the_title(),
			'company'  => get_post_meta( get_the_ID(), '_testimonial_company', true ) ?: $fb['company'],
			'role'     => get_post_meta( get_the_ID(), '_testimonial_role', true ) ?: $fb['role'],
			'rating'   => get_post_meta( get_the_ID(), '_testimonial_rating', true ) ?: '5.0',
			'logo_url' => $logo_url ?: '',
			'initials' => $fb['initials'],
			'color'    => $fb['color'],
			'text'     => $fb['text'],
		);
		$i++;
	}
	wp_reset_postdata();
} else {
	foreach ( $fallback as $fb ) {
		$slides[] = $fb;
	}
}

$block_id = 'gs-testi-' . substr( md5( $attributes['heading'] ?? 'testi' ), 0, 6 );
?>

<style>
	#<?php echo esc_attr( $block_id ); ?> .gs-testi-swiper { overflow: visible; }
	#<?php echo esc_attr( $block_id ); ?> .gs-testi-swiper .swiper-wrapper { align-items: stretch; }
	#<?php echo esc_attr( $block_id ); ?> .swiper-slide { height: auto; }
	#<?php echo esc_attr( $block_id ); ?> .gs-testi-prev.swiper-button-disabled,
	#<?php echo esc_attr( $block_id ); ?> .gs-testi-next.swiper-button-disabled { opacity: 0.35; cursor: not-allowed; }
</style>

<section id="<?php echo esc_attr( $block_id ); ?>" <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-testimonials overflow-hidden bg-[#f4f3ff] py-[8rem]' ) ); ?>>

	<!-- ── Section header ──────────────────────────────────────────────────── -->
	<div class="gs-container">
		<div class="mx-auto mb-14 max-w-2xl text-center md:mb-16">

			<p class="inline-flex items-center gap-2 rounded-full border border-[#654cff]/20 bg-[#654cff]/[0.07] px-4 py-1.5 font-body text-[16px] font-semibold uppercase tracking-widest text-[#654cff]" data-gs-eyebrow>
				<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
				<?php echo esc_html( $eyebrow ); ?>
			</p>

			<h2 class="mt-6 font-heading text-[40px] font-bold leading-[1.1] tracking-[-0.025em] text-[#0d0d12] md:text-[48px]">
				<?php echo esc_html( $heading ); ?>
			</h2>

		</div>
	</div>

	<!-- ── Swiper (breaks out of container to bleed right) ─────────────────── -->
	<div class="gs-testi-swiper swiper"
	     style="padding-left:max(1.25rem,calc((100vw - 1280px)/2 + 1.5rem));padding-right:0;">

		<div class="swiper-wrapper">

			<?php foreach ( $slides as $slide ) : ?>
				<div class="swiper-slide" style="max-width:540px;">
					<article class="flex h-full flex-col rounded-[24px] bg-white p-8 md:p-10">

						<!-- Top: logo + company name   |   rating -->
						<div class="mb-8 flex items-center justify-between gap-4">
							<div class="flex items-center gap-3">
								<?php if ( ! empty( $slide['logo_url'] ) ) : ?>
									<div class="h-12 w-12 flex-none overflow-hidden rounded-full border border-black/[0.07]">
										<img src="<?php echo esc_url( $slide['logo_url'] ); ?>"
										     alt="<?php echo esc_attr( $slide['company'] ); ?>"
										     class="h-full w-full object-cover" loading="lazy" />
									</div>
								<?php else : ?>
									<div class="flex h-12 w-12 flex-none items-center justify-center rounded-full font-heading text-[16px] font-bold"
									     style="background:<?php echo esc_attr( $slide['color'] ); ?>;color:<?php echo esc_attr( $slide['text'] ); ?>;">
										<?php echo esc_html( $slide['initials'] ); ?>
									</div>
								<?php endif; ?>
								<div>
									<p class="font-body text-[16px] font-semibold text-[#0d0d12]">
										<?php echo esc_html( $slide['company'] ); ?>
									</p>
									<?php if ( ! empty( $slide['role'] ) && ! empty( $slide['name'] ) ) : ?>
										<p class="font-body text-[16px] text-[#9a9ab0]">
											<?php echo esc_html( $slide['name'] . ' · ' . $slide['role'] ); ?>
										</p>
									<?php endif; ?>
								</div>
							</div>
							<div class="flex flex-none items-center gap-1">
								<span class="font-body text-[16px] font-bold text-[#0d0d12]">
									<?php echo esc_html( $slide['rating'] ); ?>
								</span>
								<span class="text-amber-400 text-base" aria-label="stars">★</span>
							</div>
						</div>

						<!-- Bold short quote (headline) -->
						<p class="font-heading text-[20px] font-bold leading-[1.3] tracking-[-0.015em] text-[#0d0d12] md:text-[22px]">
							<?php echo esc_html( $slide['headline'] ); ?>
						</p>

						<!-- Body text -->
						<?php if ( ! empty( $slide['body'] ) ) : ?>
							<p class="mt-4 grow font-body text-[14.5px] leading-relaxed text-[#5c5d6d]">
								<?php echo esc_html( $slide['body'] ); ?>
							</p>
						<?php endif; ?>

					</article>
				</div>
			<?php endforeach; ?>

		</div><!-- /.swiper-wrapper -->
	</div><!-- /.swiper -->

	<!-- ── Navigation: arrows + progress bar ──────────────────────────────── -->
	<div class="gs-container mt-10">
		<div class="flex items-center gap-5">

			<!-- Prev button -->
			<button class="gs-testi-prev flex h-12 w-12 flex-none items-center justify-center rounded-full border-2 border-[#0d0d12] bg-transparent font-body text-lg text-[#0d0d12] transition-all duration-200 hover:bg-[#0d0d12] hover:text-white"
			        aria-label="<?php esc_attr_e( 'Previous testimonial', 'grosharp' ); ?>">
				←
			</button>

			<!-- Next button -->
			<button class="gs-testi-next flex h-12 w-12 flex-none items-center justify-center rounded-full border-2 border-[#0d0d12] bg-transparent font-body text-lg text-[#0d0d12] transition-all duration-200 hover:bg-[#0d0d12] hover:text-white"
			        aria-label="<?php esc_attr_e( 'Next testimonial', 'grosharp' ); ?>">
				→
			</button>

			<!-- Progress bar -->
			<div class="h-[2px] flex-1 overflow-hidden rounded-full bg-black/10">
				<div class="gs-testi-progress-fill h-full rounded-full bg-[#0d0d12] transition-[width] duration-300 ease-out" style="width:0%"></div>
			</div>

		</div>
	</div>

</section>

<script>
(function () {
	function initTesti() {
		if (typeof Swiper === 'undefined') { return; }

		var section  = document.getElementById('<?php echo esc_js( $block_id ); ?>');
		if (!section) { return; }

		var swiperEl = section.querySelector('.gs-testi-swiper');
		var prevBtn  = section.querySelector('.gs-testi-prev');
		var nextBtn  = section.querySelector('.gs-testi-next');
		var fill     = section.querySelector('.gs-testi-progress-fill');

		if (!swiperEl) { return; }

		function setProgress(sw) {
			if (!fill) { return; }
			var p = sw.isEnd ? 1 : sw.progress;
			fill.style.width = (p * 100) + '%';
		}

		var sw = new Swiper(swiperEl, {
			slidesPerView:  1.1,
			spaceBetween:   20,
			grabCursor:     true,
			loop:           false,
			breakpoints: {
				560:  { slidesPerView: 1.4, spaceBetween: 24 },
				768:  { slidesPerView: 1.8, spaceBetween: 24 },
				1024: { slidesPerView: 2.3, spaceBetween: 28 },
				1280: { slidesPerView: 2.6, spaceBetween: 28 },
			},
			navigation: {
				prevEl: prevBtn,
				nextEl: nextBtn,
			},
			on: {
				init:        function (s) { setProgress(s); },
				slideChange: function (s) { setProgress(s); },
				progress:    function (s) { setProgress(s); },
			},
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initTesti);
	} else {
		initTesti();
	}
})();
</script>
