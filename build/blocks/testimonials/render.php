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
		'headline'    => __( '"The team delivered beyond what we imagined. Results came faster than expected."', 'grosharp' ),
		'name'        => 'Sarah Okeke',
		'role'        => 'CEO',
		'company'     => 'Elevance',
		'designation' => 'CEO · Elevance',
		'rating'      => '5.0',
		'avatar_url'  => '',
		'initials'    => 'SO',
		'color'       => '#e9e5ff',
		'text'        => '#4f39c7',
	),
	array(
		'headline'    => __( '"Six months later, organic traffic is up 148%. Couldn\'t be happier."', 'grosharp' ),
		'name'        => 'James Whitfield',
		'role'        => 'Head of Marketing',
		'company'     => 'Foliocraft',
		'designation' => 'Head of Marketing · Foliocraft',
		'rating'      => '5.0',
		'avatar_url'  => '',
		'initials'    => 'JW',
		'color'       => '#eef2ff',
		'text'        => '#3730a3',
	),
	array(
		'headline'    => __( '"Support tickets dropped 40% the week we launched. Fast, reliable, they listened."', 'grosharp' ),
		'name'        => 'Priya Nair',
		'role'        => 'Product Manager',
		'company'     => 'Meridian',
		'designation' => 'Product Manager · Meridian',
		'rating'      => '5.0',
		'avatar_url'  => '',
		'initials'    => 'PN',
		'color'       => '#ede9ff',
		'text'        => '#4f39c7',
	),
	array(
		'headline'    => __( '"Conversion rate jumped 60% after the redesign. The ROI was immediate."', 'grosharp' ),
		'name'        => 'Daniel Cross',
		'role'        => 'Founder',
		'company'     => 'Vizerto',
		'designation' => 'Founder · Vizerto',
		'rating'      => '5.0',
		'avatar_url'  => '',
		'initials'    => 'DC',
		'color'       => '#f5f3ff',
		'text'        => '#6d28d9',
	),
	array(
		'headline'    => __( '"Our new brand finally matches the quality of our product. Proud to show it off."', 'grosharp' ),
		'name'        => 'Anika Mensah',
		'role'        => 'CMO',
		'company'     => 'Aria Studio',
		'designation' => 'CMO · Aria Studio',
		'rating'      => '5.0',
		'avatar_url'  => '',
		'initials'    => 'AM',
		'color'       => '#e0e7ff',
		'text'        => '#4338ca',
	),
);

/* ── Avatar palette (cycles by index) ───────────────────────────────────────── */
$avatar_palette = array(
	array( 'color' => '#654cff', 'text' => '#ffffff' ),
	array( 'color' => '#0d0d12', 'text' => '#ffffff' ),
	array( 'color' => '#e8f0fe', 'text' => '#654cff' ),
	array( 'color' => '#fff4e6', 'text' => '#b45309' ),
	array( 'color' => '#e6fff4', 'text' => '#047857' ),
	array( 'color' => '#fce8ff', 'text' => '#9333ea' ),
);

/**
 * Derive up-to-two-letter initials from a name.
 *
 * @param string $name Full name.
 * @return string
 */
$get_initials = static function( string $name ): string {
	$parts = array_filter( explode( ' ', trim( $name ) ) );
	if ( count( $parts ) >= 2 ) {
		return mb_strtoupper( mb_substr( $parts[0], 0, 1 ) . mb_substr( end( $parts ), 0, 1 ) );
	}
	return mb_strtoupper( mb_substr( $name, 0, 2 ) );
};

/* ── Build slides array ─────────────────────────────────────────────────────── */
$slides = array();

if ( $query->have_posts() ) {
	$i = 0;
	while ( $query->have_posts() ) {
		$query->the_post();
		$pid     = get_the_ID();
		$fb      = $fallback[ $i % count( $fallback ) ];
		$palette = $avatar_palette[ $i % count( $avatar_palette ) ];

		/* ACF fields — with post title / content fallbacks */
		$name        = '';
		$designation = '';
		$review      = '';
		$avatar_url  = '';
		$rating      = '5.0';

		if ( function_exists( 'get_field' ) ) {
			$name        = (string) ( get_field( 'testimonial_client_name', $pid ) ?: get_the_title() );
			$designation = (string) ( get_field( 'testimonial_designation',  $pid ) ?: '' );
			$review      = (string) ( get_field( 'testimonial_review',       $pid ) ?: wp_strip_all_tags( get_the_content() ) );
			$rating      = (string) ( get_field( 'testimonial_rating',       $pid ) ?: '5.0' );
			$avatar_data = get_field( 'testimonial_avatar', $pid );
			if ( ! empty( $avatar_data['url'] ) ) {
				$avatar_url = $avatar_data['sizes']['thumbnail'] ?? $avatar_data['url'];
			}
		} else {
			$name   = get_the_title();
			$review = wp_strip_all_tags( get_the_content() );
		}

		if ( ! $name )   { $name   = $fb['name']; }
		if ( ! $review ) { $review = $fb['body']; }

		$slides[] = array(
			'headline'    => $review ? '"' . $review . '"' : $fb['headline'],
			'name'        => $name,
			'designation' => $designation ?: ( $fb['role'] . ' · ' . $fb['company'] ),
			'rating'      => $rating,
			'avatar_url'  => $avatar_url,
			'initials'    => $get_initials( $name ),
			'color'       => $palette['color'],
			'text'        => $palette['text'],
		);
		$i++;
	}
	wp_reset_postdata();
} else {
	$slides = $fallback;
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

			<h2 class="mt-6 font-heading text-[clamp(2rem,4vw,3.375rem)] font-extrabold leading-[1.1] tracking-[-0.035em] text-[#0d0d12]">
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

						<!-- Rating row -->
						<div class="mb-6 flex items-center gap-1">
							<?php
							$rating_val  = floatval( $slide['rating'] ?? 5 );
							$full_stars  = floor( $rating_val );
							$half_star   = ( $rating_val - $full_stars ) >= 0.5;
							for ( $s = 0; $s < 5; $s++ ) :
								if ( $s < $full_stars ) : ?>
									<span class="text-amber-400" style="font-size:1.125rem;">★</span>
								<?php elseif ( $s === $full_stars && $half_star ) : ?>
									<span class="text-amber-400" style="font-size:1.125rem;">½</span>
								<?php else : ?>
									<span class="text-black/15" style="font-size:1.125rem;">★</span>
								<?php endif;
							endfor; ?>
							<span class="ml-1 font-body text-[13px] font-semibold text-[#9a9ab0]">
								<?php echo esc_html( $slide['rating'] ); ?>
							</span>
						</div>

						<!-- Review quote -->
						<p class="grow font-heading text-[19px] font-bold leading-[1.35] tracking-[-0.015em] text-[#0d0d12] md:text-[21px]">
							<?php echo esc_html( $slide['headline'] ); ?>
						</p>

						<!-- Client info row -->
						<div class="mt-8 flex items-center gap-3 border-t border-black/[0.06] pt-6">

							<?php if ( ! empty( $slide['avatar_url'] ) ) : ?>
								<div class="h-11 w-11 flex-none overflow-hidden rounded-full border border-black/[0.07]">
									<img src="<?php echo esc_url( $slide['avatar_url'] ); ?>"
									     alt="<?php echo esc_attr( $slide['name'] ); ?>"
									     class="h-full w-full object-cover" loading="lazy" />
								</div>
							<?php else : ?>
								<div class="flex h-11 w-11 flex-none items-center justify-center rounded-full font-heading text-[14px] font-bold"
								     style="background:<?php echo esc_attr( $slide['color'] ); ?>;color:<?php echo esc_attr( $slide['text'] ); ?>;">
									<?php echo esc_html( $slide['initials'] ); ?>
								</div>
							<?php endif; ?>

							<div>
								<p class="font-body text-[15px] font-semibold leading-tight text-[#0d0d12]">
									<?php echo esc_html( $slide['name'] ); ?>
								</p>
								<?php if ( ! empty( $slide['designation'] ) ) : ?>
									<p class="font-body text-[13px] leading-tight text-[#9a9ab0]">
										<?php echo esc_html( $slide['designation'] ); ?>
									</p>
								<?php endif; ?>
							</div>

						</div>

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
