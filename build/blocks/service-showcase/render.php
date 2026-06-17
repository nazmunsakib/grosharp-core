<?php
/**
 * Service Showcase block — alternating two-column layout for the services archive.
 *
 * Pulls: title, excerpt, thumbnail, key_features, detail_text, cta_label from each service.
 *
 * @package GrosharpCore
 */

$count = isset( $attributes['count'] ) ? intval( $attributes['count'] ) : -1;
$acf   = function_exists( 'get_field' );

/* ── Fallback demo items ─────────────────────────────────────────────────── */
$fallback_services = array(
	array(
		'title'     => 'UI/UX Design',
		'excerpt'   => 'We craft intuitive, conversion-focused interfaces that users love from first interaction.',
		'permalink' => '#',
		'thumb_url' => '',
		'features'  => array( 'User research & wireframing', 'Interactive prototypes', 'Design system creation' ),
		'detail'    => '',
		'cta_label' => '',
	),
	array(
		'title'     => 'WordPress Development',
		'excerpt'   => 'Custom WordPress sites built from the ground up — fast, scalable, and easy to manage.',
		'permalink' => '#',
		'thumb_url' => '',
		'features'  => array( 'Custom theme & plugin development', 'Performance optimisation', 'Ongoing maintenance & support' ),
		'detail'    => '',
		'cta_label' => '',
	),
	array(
		'title'     => 'WooCommerce & Ecommerce',
		'excerpt'   => 'Full-featured online stores engineered to convert, retain, and scale.',
		'permalink' => '#',
		'thumb_url' => '',
		'features'  => array( 'Custom product & checkout flows', 'Payment gateway integration', 'Inventory & order management' ),
		'detail'    => '',
		'cta_label' => '',
	),
	array(
		'title'     => 'SEO & Digital Marketing',
		'excerpt'   => 'Organic strategies that compound over time. We build lasting search authority.',
		'permalink' => '#',
		'thumb_url' => '',
		'features'  => array( 'Technical SEO audit & fixes', 'Content strategy & creation', 'Data-driven campaign management' ),
		'detail'    => '',
		'cta_label' => '',
	),
);

/* ── Query published service posts ──────────────────────────────────────── */
$query = new WP_Query( array(
	'post_type'      => 'grosharp_service',
	'posts_per_page' => $count > 0 ? $count : -1,
	'orderby'        => 'menu_order title',
	'order'          => 'ASC',
	'post_status'    => 'publish',
) );

$items = array();

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$post_id = get_the_ID();

		/* Key features */
		$features_raw = $acf
			? (string) get_field( 'service_key_features', $post_id )
			: (string) get_post_meta( $post_id, 'service_key_features', true );
		$features = array_values( array_filter( array_map( 'trim', explode( "\n", $features_raw ) ) ) );

		/* Detail text */
		$detail = $acf
			? (string) get_field( 'service_detail_text', $post_id )
			: (string) get_post_meta( $post_id, 'service_detail_text', true );

		/* CTA label */
		$cta_label = $acf
			? (string) get_field( 'service_cta_label', $post_id )
			: (string) get_post_meta( $post_id, 'service_cta_label', true );

		$items[] = array(
			'title'     => get_the_title(),
			'excerpt'   => wp_strip_all_tags( get_the_excerpt() ),
			'permalink' => get_permalink(),
			'thumb_url' => (string) get_the_post_thumbnail_url( $post_id, 'grosharp-card-lg' ),
			'features'  => $features,
			'detail'    => $detail,
			'cta_label' => $cta_label,
		);
	}
	wp_reset_postdata();
} else {
	$items = $fallback_services;
}
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-service-showcase bg-white' ) ); ?> data-gs-service-showcase>

	<div class="gs-container">

		<?php foreach ( $items as $index => $item ) :
			$is_even   = ( $index % 2 === 1 );
			$btn_label = ! empty( $item['cta_label'] ) ? $item['cta_label'] : __( 'Learn More', 'grosharp' );
		?>

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 items-center py-14 lg:py-20 <?php echo $index > 0 ? 'border-t border-black/[0.06]' : ''; ?>" data-ss-row>

			<!-- ── Content ────────────────────────────────────────────────── -->
			<div class="<?php echo $is_even ? 'order-first lg:order-last' : ''; ?> flex flex-col gap-4" data-ss-content>

				<h2 class="font-heading text-[clamp(1.375rem,3vw,2rem)] font-extrabold leading-[1.1] tracking-[-0.03em] text-[#0d0d12] m-0">
					<?php echo esc_html( $item['title'] ); ?>
				</h2>

				<!-- Detail text — directly below title -->
				<?php if ( $item['detail'] ) : ?>
					<p class="font-body text-[1rem] leading-[1.8] text-[#5c5d6d] m-0">
						<?php echo esc_html( $item['detail'] ); ?>
					</p>
				<?php endif; ?>

				<?php if ( $item['excerpt'] ) : ?>
					<p class="font-body text-[1rem] leading-[1.8] text-[#5c5d6d] m-0">
						<?php echo esc_html( $item['excerpt'] ); ?>
					</p>
				<?php endif; ?>

				<!-- Key features checklist -->
				<?php if ( ! empty( $item['features'] ) ) : ?>
					<ul class="flex flex-col gap-1.5 m-0 p-0 list-none" role="list">
						<?php foreach ( $item['features'] as $feature ) : ?>
							<li class="flex items-start gap-2.5 font-body text-[0.9rem] leading-[1.55] text-[#3d3e4e]">
								<span class="mt-[3px] flex-shrink-0 w-5 h-5 rounded-full bg-[rgba(101,76,255,0.1)] flex items-center justify-center" aria-hidden="true">
									<svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1 4.5L3.8 7.5L10 1" stroke="#654cff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</span>
								<?php echo esc_html( $feature ); ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<div>
					<a href="<?php echo esc_url( $item['permalink'] ); ?>"
					   class="inline-flex items-center gap-2.5 rounded-full border border-[#0d0d12] bg-transparent px-7 py-3.5 font-body text-[0.9375rem] font-semibold text-[#0d0d12] no-underline transition-all duration-300 hover:border-[#654cff] hover:bg-[#654cff] hover:text-white hover:shadow-[0_8px_28px_rgba(101,76,255,0.28)]">
						<?php echo esc_html( $btn_label ); ?>
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
					</a>
				</div>

			</div>

			<!-- ── Image ──────────────────────────────────────────────────── -->
			<div class="<?php echo $is_even ? 'order-last lg:order-first' : 'order-last'; ?>" data-ss-image>
				<?php if ( $item['thumb_url'] ) : ?>
					<figure class="m-0 overflow-hidden rounded-2xl lg:rounded-[1.75rem]" style="aspect-ratio:4/3;">
						<img src="<?php echo esc_url( $item['thumb_url'] ); ?>"
						     alt="<?php echo esc_attr( $item['title'] ); ?>"
						     class="w-full h-full object-cover transition-transform duration-700 hover:scale-[1.03]"
						     loading="lazy" decoding="async" />
					</figure>
				<?php else : ?>
					<div class="rounded-2xl lg:rounded-[1.75rem] bg-[rgba(101,76,255,0.05)] border border-[rgba(101,76,255,0.1)] flex items-center justify-center" style="aspect-ratio:4/3;" aria-hidden="true">
						<svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="rgba(101,76,255,0.3)" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
							<rect x="6" y="10" width="36" height="28" rx="3"/>
							<circle cx="17" cy="20" r="4"/>
							<path d="M6 30l9-7 7 6 5-4 15 9"/>
						</svg>
					</div>
				<?php endif; ?>
			</div>

		</div>

		<?php endforeach; ?>

	</div>

</section>
