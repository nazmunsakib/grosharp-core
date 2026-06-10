<?php
/**
 * Services grid block render template.
 *
 * @package GrosharpCore
 */

$eyebrow = $attributes['eyebrow'] ?? __( 'What we do', 'grosharp' );
$heading = $attributes['heading'] ?? __( 'Services built for digital growth', 'grosharp' );
$text    = $attributes['text'] ?? __( 'From first impression to full-scale growth, Grosharp covers every layer of your digital presence.', 'grosharp' );

$query = new WP_Query(
	array(
		'post_type'      => 'grosharp_service',
		'posts_per_page' => absint( $attributes['count'] ?? 6 ),
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	)
);

$icons = array(
	'code'   => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
	'layers' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>',
	'pen'    => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>',
	'layout' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>',
	'chart'  => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/></svg>',
	'rocket' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"/><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"/></svg>',
);

$fallback = array(
	array(
		'title'  => __( 'WordPress Development', 'grosharp' ),
		'text'   => __( 'Custom WordPress sites engineered for speed, scalability, and clean content editing.', 'grosharp' ),
		'pillar' => 'Development',
		'url'    => '/services/development/',
		'icon'   => 'code',
	),
	array(
		'title'  => __( 'Custom Web Apps', 'grosharp' ),
		'text'   => __( 'React and full-stack applications that solve real business problems beautifully.', 'grosharp' ),
		'pillar' => 'Development',
		'url'    => '/services/development/',
		'icon'   => 'layers',
	),
	array(
		'title'  => __( 'Brand & UI Design', 'grosharp' ),
		'text'   => __( 'Identities and interfaces that turn visitors into believers from first glance.', 'grosharp' ),
		'pillar' => 'Design',
		'url'    => '/services/design/',
		'icon'   => 'pen',
	),
	array(
		'title'  => __( 'UX & Product Design', 'grosharp' ),
		'text'   => __( 'User flows, wireframes, and prototypes that remove friction and drive conversions.', 'grosharp' ),
		'pillar' => 'Design',
		'url'    => '/services/design/',
		'icon'   => 'layout',
	),
	array(
		'title'  => __( 'SEO & Content Strategy', 'grosharp' ),
		'text'   => __( 'Organic strategies that build lasting authority, qualified traffic, and revenue.', 'grosharp' ),
		'pillar' => 'Marketing',
		'url'    => '/services/marketing/',
		'icon'   => 'chart',
	),
	array(
		'title'  => __( 'Growth Campaigns', 'grosharp' ),
		'text'   => __( 'Paid media, conversion funnels, and retention systems that compound results.', 'grosharp' ),
		'pillar' => 'Marketing',
		'url'    => '/services/marketing/',
		'icon'   => 'rocket',
	),
);

$pillar_styles = array(
	'Development' => array( 'badge' => 'bg-blue-50 text-blue-600 border-blue-100', 'icon' => 'bg-blue-50 text-blue-600' ),
	'Design'      => array( 'badge' => 'bg-violet-50 text-violet-600 border-violet-100', 'icon' => 'bg-violet-50 text-violet-600' ),
	'Marketing'   => array( 'badge' => 'bg-emerald-50 text-emerald-600 border-emerald-100', 'icon' => 'bg-emerald-50 text-emerald-600' ),
);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-services bg-white py-24 md:py-32' ) ); ?>>
	<div class="gs-container">

		<!-- Section header -->
		<div class="gs-reveal mx-auto mb-16 max-w-3xl text-center">
			<p class="inline-flex items-center gap-2 rounded-full border border-[#654cff]/15 bg-[#654cff]/[0.06] px-4 py-1.5 text-xs font-semibold uppercase tracking-widest text-[#654cff]">
				<?php echo esc_html( $eyebrow ); ?>
			</p>
			<h2 class="mt-5 font-heading text-[38px] font-semibold leading-[1.06] tracking-[-0.02em] text-[#0d0d12] sm:text-[50px]">
				<?php echo esc_html( $heading ); ?>
			</h2>
			<p class="mx-auto mt-5 max-w-2xl text-lg leading-relaxed text-[#5c5d6d]">
				<?php echo esc_html( $text ); ?>
			</p>
		</div>

		<!-- Service cards grid -->
		<div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
			<?php if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : ?>
					<?php
					$query->the_post();
					$pillar_terms = get_the_terms( get_the_ID(), 'service_pillar' );
					$pillar       = ( is_array( $pillar_terms ) && ! empty( $pillar_terms ) ) ? $pillar_terms[0]->name : '';
					$styles       = $pillar_styles[ $pillar ] ?? array( 'badge' => 'bg-gray-100 text-gray-600 border-gray-200', 'icon' => 'bg-gray-100 text-gray-600' );
					?>
					<article class="gs-reveal group flex flex-col rounded-[28px] border border-black/[0.06] bg-white p-8 shadow-[0_2px_20px_rgba(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-1.5 hover:border-[#654cff]/25 hover:shadow-[0_20px_52px_rgba(101,76,255,0.10)]">
						<div class="mb-5 flex items-start justify-between gap-3">
							<div class="flex h-12 w-12 flex-none items-center justify-center rounded-2xl <?php echo esc_attr( $styles['icon'] ); ?>">
								<?php echo $icons['code']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
							<?php if ( $pillar ) : ?>
								<span class="inline-block rounded-full border px-3 py-1 text-xs font-semibold <?php echo esc_attr( $styles['badge'] ); ?>">
									<?php echo esc_html( $pillar ); ?>
								</span>
							<?php endif; ?>
						</div>
						<h3 class="font-heading text-[20px] font-semibold text-[#0d0d12]">
							<a href="<?php the_permalink(); ?>" class="no-underline hover:text-[#654cff]"><?php the_title(); ?></a>
						</h3>
						<div class="mt-3 grow text-base leading-relaxed text-[#5c5d6d] [&_p]:m-0">
							<?php the_excerpt(); ?>
						</div>
						<a href="<?php the_permalink(); ?>" class="mt-7 inline-flex items-center gap-2 text-sm font-semibold text-[#654cff] no-underline transition-all duration-200 hover:gap-3">
							<?php esc_html_e( 'Learn more', 'grosharp' ); ?> <span aria-hidden="true">→</span>
						</a>
					</article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<?php foreach ( $fallback as $service ) : ?>
					<?php
					$styles = $pillar_styles[ $service['pillar'] ] ?? array( 'badge' => 'bg-gray-100 text-gray-600 border-gray-200', 'icon' => 'bg-gray-100 text-gray-600' );
					$icon   = $icons[ $service['icon'] ] ?? $icons['code'];
					?>
					<article class="gs-reveal group flex flex-col rounded-[28px] border border-black/[0.06] bg-white p-8 shadow-[0_2px_20px_rgba(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-1.5 hover:border-[#654cff]/25 hover:shadow-[0_20px_52px_rgba(101,76,255,0.10)]">
						<div class="mb-5 flex items-start justify-between gap-3">
							<div class="flex h-12 w-12 flex-none items-center justify-center rounded-2xl <?php echo esc_attr( $styles['icon'] ); ?>">
								<?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
							<span class="inline-block rounded-full border px-3 py-1 text-xs font-semibold <?php echo esc_attr( $styles['badge'] ); ?>">
								<?php echo esc_html( $service['pillar'] ); ?>
							</span>
						</div>
						<h3 class="font-heading text-[20px] font-semibold text-[#0d0d12]">
							<a href="<?php echo esc_url( $service['url'] ); ?>" class="no-underline hover:text-[#654cff]">
								<?php echo esc_html( $service['title'] ); ?>
							</a>
						</h3>
						<p class="mt-3 grow text-base leading-relaxed text-[#5c5d6d]">
							<?php echo esc_html( $service['text'] ); ?>
						</p>
						<a href="<?php echo esc_url( $service['url'] ); ?>" class="mt-7 inline-flex items-center gap-2 text-sm font-semibold text-[#654cff] no-underline transition-all duration-200 hover:gap-3">
							<?php esc_html_e( 'Learn more', 'grosharp' ); ?> <span aria-hidden="true">→</span>
						</a>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

	</div>
</section>
