<?php
/**
 * Service Showcase block — alternating two-column layout for the services archive.
 *
 * Reads directly from grosharp_service posts (title, excerpt, thumbnail, permalink).
 * No ACF or custom meta required — content is managed via the block editor (Option B).
 *
 * Odd  rows (1st, 3rd…): content LEFT — image RIGHT
 * Even rows (2nd, 4th…): image  LEFT — content RIGHT
 *
 * @package GrosharpCore
 */

// Use intval so -1 (show all) is preserved — absint would convert -1 → 1.
$count = isset( $attributes['count'] ) ? intval( $attributes['count'] ) : -1;

/* ── Fallback demo items (shown when no service posts are published) ────── */
$fallback_services = array(
	array(
		'title'     => 'UI/UX Design',
		'excerpt'   => 'We craft intuitive, conversion-focused interfaces that users love from first interaction. Every screen is designed with purpose — balancing aesthetics with functionality.',
		'permalink' => '#',
		'thumb_url' => '',
	),
	array(
		'title'     => 'WordPress Development',
		'excerpt'   => 'Custom WordPress sites built from the ground up — fast, scalable, and easy to manage. No bloated page builders, no shortcuts. Just clean, maintainable code.',
		'permalink' => '#',
		'thumb_url' => '',
	),
	array(
		'title'     => 'WooCommerce & Ecommerce',
		'excerpt'   => 'Full-featured online stores engineered to convert, retain, and scale. From product catalogues to checkout flows, we eliminate every point of friction.',
		'permalink' => '#',
		'thumb_url' => '',
	),
	array(
		'title'     => 'Branding & Identity',
		'excerpt'   => 'Identities that mean something. We build brand systems that work across every surface — from logo to language — so your business looks intentional at every touchpoint.',
		'permalink' => '#',
		'thumb_url' => '',
	),
	array(
		'title'     => 'SEO & Digital Marketing',
		'excerpt'   => 'Organic strategies that compound over time. We build lasting search authority through technical SEO, content strategy, and data-driven campaigns that generate qualified revenue.',
		'permalink' => '#',
		'thumb_url' => '',
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
		$items[] = array(
			'title'     => get_the_title(),
			'excerpt'   => wp_strip_all_tags( get_the_excerpt() ),
			'permalink' => get_permalink(),
			'thumb_url' => (string) get_the_post_thumbnail_url( $post_id, 'large' ),
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
			$is_even = ( $index % 2 === 1 );
		?>

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 items-center py-14 lg:py-20" data-ss-row>

			<!-- ── Content ──────────────────────────────────────────────── -->
			<div class="<?php echo $is_even ? 'order-first lg:order-last' : ''; ?> flex flex-col gap-6" data-ss-content>

				<p class="inline-flex w-fit items-center gap-2 rounded-full border border-[rgba(101,76,255,0.2)] bg-[rgba(101,76,255,0.07)] px-4 py-1.5 font-body text-[0.75rem] font-semibold uppercase tracking-[0.08em] text-[#654cff]">
					<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
					<?php esc_html_e( 'Service', 'grosharp' ); ?>
				</p>

				<h2 class="font-heading text-[clamp(1.75rem,4vw,2.75rem)] font-extrabold leading-[1.08] tracking-[-0.035em] text-[#0d0d12] m-0">
					<?php echo esc_html( $item['title'] ); ?>
				</h2>

				<?php if ( $item['excerpt'] ) : ?>
					<p class="font-body text-[1rem] leading-[1.8] text-[#5c5d6d] m-0">
						<?php echo esc_html( $item['excerpt'] ); ?>
					</p>
				<?php endif; ?>

				<div>
					<a href="<?php echo esc_url( $item['permalink'] ); ?>"
					   class="inline-flex items-center gap-2.5 rounded-full border border-[#0d0d12] bg-transparent px-7 py-3.5 font-body text-[0.9375rem] font-semibold text-[#0d0d12] no-underline transition-all duration-300 hover:border-[#654cff] hover:bg-[#654cff] hover:text-white hover:shadow-[0_8px_28px_rgba(101,76,255,0.28)]">
						<?php esc_html_e( 'Learn More', 'grosharp' ); ?>
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</a>
				</div>

			</div>

			<!-- ── Image ────────────────────────────────────────────────── -->
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
