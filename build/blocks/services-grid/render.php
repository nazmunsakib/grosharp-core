<?php
/**
 * Services grid block render template.
 *
 * @package GrosharpCore
 */

$eyebrow   = $attributes['eyebrow']   ?? __( 'Services', 'grosharp' );
$heading   = $attributes['heading']   ?? __( 'We help you design and build better digital products.', 'grosharp' );
$text      = $attributes['text']      ?? __( 'You need a partner who gets your business and covers everything. From branding to UI/UX design and web development, you can rely on us.', 'grosharp' );
$cta_url   = $attributes['ctaUrl']    ?? '/services/';
$cta_label = $attributes['ctaLabel']  ?? __( 'See All Services', 'grosharp' );

// Hide section header when explicitly set, or when on the services archive (page-hero already provides it).
$hide_header = ! empty( $attributes['hideHeader'] ) || is_post_type_archive( 'grosharp_service' );

/* ─── Inline SVG icon library (fallback) ──────────────────────────────────── */
if ( ! function_exists( 'grosharp_service_icon' ) ) :
function grosharp_service_icon( string $key ): string {
	$icons = array(
		'branding' => '<svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="17" cy="24" r="11"/><circle cx="31" cy="24" r="11"/></svg>',
		'design'   => '<svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="6" y="7" width="36" height="27" rx="3"/><line x1="6" y1="17" x2="42" y2="17"/><line x1="15" y1="7" x2="15" y2="17"/><rect x="16" y="38" width="16" height="4" rx="2"/><line x1="24" y1="34" x2="24" y2="38"/></svg>',
		'code'     => '<svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="17,16 7,24 17,32"/><polyline points="31,16 41,24 31,32"/><line x1="28" y1="12" x2="20" y2="36"/></svg>',
		'seo'      => '<svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true"><line x1="24" y1="6" x2="24" y2="42"/><line x1="6" y1="24" x2="42" y2="24"/><line x1="10.3" y1="10.3" x2="37.7" y2="37.7"/><line x1="37.7" y1="10.3" x2="10.3" y2="37.7"/></svg>',
		'ecomm'    => '<svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 13h4l3 16h18l3-12H16"/><circle cx="20" cy="34" r="2"/><circle cx="33" cy="34" r="2"/><path d="M9 13l-2-6H4"/></svg>',
		'auto'     => '<svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M37 26a13 13 0 01-13 13 13 13 0 01-13-13"/><path d="M11 22a13 13 0 0113-13 13 13 0 0113 13"/><polyline points="37,20 37,26 31,26"/><polyline points="11,28 11,22 17,22"/></svg>',
	);
	return $icons[ $key ] ?? $icons['code'];
}
endif;

/* Default icon keys to cycle through */
$icon_keys = array( 'branding', 'design', 'code', 'seo', 'ecomm', 'auto' );

/* ─── Hardcoded fallback service data ────────────────────────────────────── */
$fallback = array(
	array(
		'title'       => __( 'Branding & Identity', 'grosharp' ),
		'description' => __( 'Identities and interfaces that turn visitors into believers from first glance.', 'grosharp' ),
		'number'      => '01',
		'icon_key'    => 'branding',
		'url'         => '/services/',
	),
	array(
		'title'       => __( 'UI/UX Design', 'grosharp' ),
		'description' => __( 'User flows, wireframes, and prototypes that remove friction and drive conversions.', 'grosharp' ),
		'number'      => '02',
		'icon_key'    => 'design',
		'url'         => '/services/',
	),
	array(
		'title'       => __( 'WordPress Development', 'grosharp' ),
		'description' => __( 'Custom WordPress sites engineered for speed, scalability, and clean content editing.', 'grosharp' ),
		'number'      => '03',
		'icon_key'    => 'code',
		'url'         => '/services/',
	),
	array(
		'title'       => __( 'SEO & Digital Marketing', 'grosharp' ),
		'description' => __( 'Organic strategies that build lasting authority, qualified traffic, and revenue.', 'grosharp' ),
		'number'      => '04',
		'icon_key'    => 'seo',
		'url'         => '/services/',
	),
	array(
		'title'       => __( 'WooCommerce & Ecommerce', 'grosharp' ),
		'description' => __( 'Full-featured online stores built to convert, scale, and retain customers.', 'grosharp' ),
		'number'      => '05',
		'icon_key'    => 'ecomm',
		'url'         => '/services/',
	),
);

/* ─── Build card list: editor attrs → WP_Query → hardcoded fallback ─────── */
$cards = array();

/* 1. Manual items from block editor */
$manual = isset( $attributes['services'] ) && is_array( $attributes['services'] ) && ! empty( $attributes['services'] )
	? $attributes['services']
	: array();

if ( ! empty( $manual ) ) {
	foreach ( $manual as $i => $item ) {
		$cards[] = array(
			'title'       => $item['title']       ?? '',
			'description' => $item['description'] ?? '',
			'number'      => $item['number']      ?? str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ),
			'icon_key'    => $icon_keys[ $i % count( $icon_keys ) ],
			'icon_url'    => $item['iconUrl']     ?? '',
			'url'         => $item['url']         ?? '/services/',
		);
	}
} else {
	/* 2. WP_Query from grosharp_service post type */
	$query = new WP_Query(
		array(
			'post_type'      => 'grosharp_service',
			'posts_per_page' => absint( $attributes['count'] ?? 6 ),
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
			'post_status'    => 'publish',
		)
	);

	if ( $query->have_posts() ) {
		$i = 0;
		while ( $query->have_posts() ) {
			$query->the_post();
			$icon_url = get_post_meta( get_the_ID(), '_service_icon_url', true );
			$cards[]  = array(
				'title'       => get_the_title(),
				'description' => wp_strip_all_tags( get_the_excerpt() ),
				'number'      => str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ),
				'icon_key'    => $icon_keys[ $i % count( $icon_keys ) ],
				'icon_url'    => $icon_url ?: '',
				'url'         => get_permalink(),
			);
			$i++;
		}
		wp_reset_postdata();
	} else {
		/* 3. Hardcoded fallback */
		$cards = $fallback;
	}
}
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-services overflow-hidden bg-white py-[4rem]' ) ); ?>>

	<!-- ── Section header (hidden on services archive — page-hero already handles it) ── -->
	<?php if ( ! $hide_header ) : ?>
	<div class="gs-container pb-10">
		<div class="flex flex-col gap-10 md:flex-row md:items-end md:justify-between">

			<!-- Left: eyebrow + heading -->
			<div class="max-w-[580px]">
				<p class="inline-flex items-center gap-2 rounded-full border border-[rgba(101,76,255,0.2)] bg-[rgba(101,76,255,0.07)] px-4 py-1.5 font-body text-[0.875rem] font-semibold uppercase tracking-widest text-[#654cff]" data-gs-eyebrow>
					<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
					<?php echo esc_html( $eyebrow ); ?>
				</p>
				<h2 class="mt-6 font-heading text-[clamp(2rem,4vw,3.375rem)] font-extrabold leading-[1.1] tracking-[-0.035em] text-[#0d0d12]">
					<?php echo esc_html( $heading ); ?>
				</h2>
			</div>

			<!-- Right: body text + CTA -->
			<div class="max-w-[360px] md:shrink-0 md:pb-2 md:text-right">
				<p class="font-body text-[1.25rem] leading-[1.7] text-[#5c5d6d]">
					<?php echo esc_html( $text ); ?>
				</p>
				<a href="<?php echo esc_url( $cta_url ); ?>"
				   class="mt-6 inline-flex min-h-[48px] items-center gap-3 rounded-full border border-black/15 px-7 font-body text-[0.9375rem] font-semibold text-[#0d0d12] no-underline transition-all duration-300 hover:border-[#654cff] hover:bg-[#654cff] hover:text-white hover:shadow-[0_8px_24px_rgba(101,76,255,0.28)]">
					<?php echo esc_html( $cta_label ); ?>
					<span aria-hidden="true">→</span>
				</a>
			</div>

		</div>
	</div>
	<?php endif; ?>

	<!-- ── 2-row service grid ────────────────────────────────────────────── -->
	<div class="gs-container">
		<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

			<!-- ── Stat card (col 1, row 1) ───────────────────────────────── -->
			<div class="relative overflow-hidden rounded-[24px] bg-white" style="min-height:320px;" data-gs-service-card>
				<div class="flex h-full flex-col justify-center p-8">
					<p class="font-heading text-[88px] font-bold leading-none tracking-[-0.04em] text-[#0d0d12]">
						98<span class="text-[48px] align-top mt-3 inline-block text-[#654cff]">%</span>
					</p>
					<p class="mt-4 font-heading text-[22px] font-bold leading-tight tracking-[-0.02em] text-[#0d0d12]">
						<?php esc_html_e( 'Client Satisfaction Rate', 'grosharp' ); ?>
					</p>
					<p class="mt-3 font-body text-[16px] leading-relaxed text-[#5c5d6d]">
						<?php esc_html_e( 'Based on post-project surveys across all engagements since 2021.', 'grosharp' ); ?>
					</p>
				</div>
			</div>

			<?php foreach ( $cards as $card ) : ?>

				<article class="group relative overflow-hidden rounded-[24px] bg-[#0d0d12]" style="min-height:320px;" data-gs-service-card>

					<!-- Full-card link -->
					<a href="<?php echo esc_url( $card['url'] ?? '/services/' ); ?>"
					   class="absolute inset-0 z-10 rounded-[24px]"
					   tabindex="0"
					   aria-label="<?php echo esc_attr( $card['title'] ?? '' ); ?>"></a>

					<!-- Card content -->
					<div class="relative z-20 flex h-full flex-col items-start justify-center p-8 pointer-events-none">

						<!-- Icon -->
						<div class="gs-service-icon mb-6 inline-block text-white transition-colors duration-300 group-hover:text-[#654cff]">
							<?php if ( ! empty( $card['icon_url'] ) ) : ?>
								<img src="<?php echo esc_url( $card['icon_url'] ); ?>"
								     alt=""
								     class="h-16 w-16 object-contain"
								     loading="lazy"
								     aria-hidden="true" />
							<?php else : ?>
								<?php echo grosharp_service_icon( $card['icon_key'] ?? 'code' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php endif; ?>
						</div>

						<!-- Title + description -->
						<div>
							<h3 class="font-heading text-[22px] font-bold leading-tight tracking-[-0.02em] text-white">
								<?php echo esc_html( $card['title'] ?? '' ); ?>
							</h3>
							<?php if ( ! empty( $card['description'] ) ) : ?>
								<p class="mt-3 font-body text-[16px] leading-relaxed text-white/75">
									<?php echo esc_html( $card['description'] ); ?>
								</p>
							<?php endif; ?>
						</div>

					</div>

					<!-- Number watermark (absolute, bottom-right) -->
					<div class="gs-service-number absolute bottom-2 right-4 select-none font-heading text-[100px] font-bold leading-none text-white/20 transition-colors duration-500 group-hover:text-[rgba(101,76,255,0.5)]"
					     aria-hidden="true">
						<?php echo esc_html( $card['number'] ?? '01' ); ?>
					</div>

					<!-- Hover: violet border ring -->
					<div class="pointer-events-none absolute inset-0 rounded-[24px] border border-transparent transition-colors duration-300 group-hover:border-[rgba(101,76,255,0.4)]" aria-hidden="true"></div>

					<!-- Hover: subtle violet glow at bottom -->
					<div class="pointer-events-none absolute inset-x-0 bottom-0 h-1/2 rounded-b-[24px] opacity-0 transition-opacity duration-500 group-hover:opacity-100"
					     style="background:radial-gradient(ellipse 80% 60% at 50% 100%, rgba(101,76,255,0.14), transparent);"
					     aria-hidden="true"></div>

				</article>

			<?php endforeach; ?>

		</div>
	</div>

</section>
