<?php
/**
 * Pricing block render template.
 *
 * @package GrosharpCore
 */

$eyebrow = $attributes['eyebrow'] ?? __( 'Engagement Models', 'grosharp' );
$heading = $attributes['heading'] ?? __( 'The right model for your growth stage.', 'grosharp' );
$text    = $attributes['text']    ?? __( 'Whether you need a one-time launch or a long-term growth partner, we have a model that fits. All engagements include direct access to our senior team.', 'grosharp' );

$items = isset( $attributes['items'] ) && is_array( $attributes['items'] ) && ! empty( $attributes['items'] )
	? $attributes['items']
	: array(
		array(
			'title'    => __( 'Discovery Sprint', 'grosharp' ),
			'price'    => __( 'From $2,500', 'grosharp' ),
			'period'   => __( 'one-time', 'grosharp' ),
			'desc'     => __( 'A focused project to launch or refresh your digital presence fast. Ideal for new brands and funded startups ready to ship.', 'grosharp' ),
			'features' => array(
				__( 'Brand audit & positioning', 'grosharp' ),
				__( 'Up to 7-page website', 'grosharp' ),
				__( 'Mobile-first responsive build', 'grosharp' ),
				__( 'On-page SEO setup', 'grosharp' ),
				__( '30-day post-launch support', 'grosharp' ),
			),
			'cta_label' => __( 'Get started', 'grosharp' ),
			'cta_url'   => '/contact/',
			'featured'  => false,
		),
		array(
			'title'    => __( 'Growth Partner', 'grosharp' ),
			'price'    => __( 'From $2,500', 'grosharp' ),
			'period'   => __( 'per month', 'grosharp' ),
			'desc'     => __( 'An ongoing design, development, and marketing retainer. We become your in-house digital team without the overhead.', 'grosharp' ),
			'features' => array(
				__( 'Unlimited design requests', 'grosharp' ),
				__( '20 hrs dev per month', 'grosharp' ),
				__( 'Monthly SEO & content', 'grosharp' ),
				__( 'Analytics & reporting dashboard', 'grosharp' ),
				__( 'Priority Slack access', 'grosharp' ),
				__( 'Quarterly strategy session', 'grosharp' ),
			),
			'cta_label' => __( 'Start growing', 'grosharp' ),
			'cta_url'   => '/contact/',
			'featured'  => true,
		),
		array(
			'title'    => __( 'Scale Package', 'grosharp' ),
			'price'    => __( 'Custom', 'grosharp' ),
			'period'   => __( 'scoped per project', 'grosharp' ),
			'desc'     => __( 'A fully scoped engagement for established brands undergoing a complete digital transformation or platform rebuild.', 'grosharp' ),
			'features' => array(
				__( 'Full brand identity system', 'grosharp' ),
				__( 'Custom web platform', 'grosharp' ),
				__( 'Full-funnel marketing build', 'grosharp' ),
				__( 'Dedicated team pod', 'grosharp' ),
				__( 'Ongoing growth retainer option', 'grosharp' ),
			),
			'cta_label' => __( 'Talk to us', 'grosharp' ),
			'cta_url'   => '/contact/',
			'featured'  => false,
		),
	);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-pricing bg-white py-[4rem]' ) ); ?>>
	<div class="gs-container">

		<!-- ── Section header ──────────────────────────────────────────────────── -->
		<div class="gs-reveal mx-auto mb-16 max-w-2xl text-center md:mb-20">

			<p class="inline-flex items-center gap-2 rounded-full border border-[#654cff]/20 bg-[#654cff]/[0.07] px-4 py-1.5 font-body text-[16px] font-semibold uppercase tracking-widest text-[#654cff]" data-gs-eyebrow>
				<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
				<?php echo esc_html( $eyebrow ); ?>
			</p>

			<h2 class="mt-6 font-heading text-[clamp(2rem,4vw,3.375rem)] font-extrabold leading-[1.1] tracking-[-0.035em] text-[#0d0d12]">
				<?php echo esc_html( $heading ); ?>
			</h2>

			<p class="mt-5 font-body text-[1.25rem] leading-[1.7] text-[#5c5d6d]">
				<?php echo esc_html( $text ); ?>
			</p>

		</div>

		<!-- ── Pricing cards ───────────────────────────────────────────────────── -->
		<div class="grid gap-6 lg:grid-cols-3">
			<?php foreach ( $items as $item ) :
				$featured = ! empty( $item['featured'] );
			?>

				<?php if ( $featured ) : ?>
				<!-- Featured card — violet background -->
				<article class="gs-reveal relative flex flex-col rounded-[24px] bg-[#654cff] p-8 md:p-10">
					<!-- "Most popular" badge -->
					<div class="mb-6 inline-flex self-start items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1 font-body text-[16px] font-bold uppercase tracking-widest text-white/90">
						<span class="h-1.5 w-1.5 rounded-full bg-[#C9A96E]" aria-hidden="true"></span>
						<?php esc_html_e( 'Most Popular', 'grosharp' ); ?>
					</div>

					<h3 class="font-heading text-[22px] font-bold tracking-[-0.02em] text-white">
						<?php echo esc_html( $item['title'] ?? '' ); ?>
					</h3>

					<div class="mt-4 flex items-end gap-2">
						<span class="font-heading text-[40px] font-bold leading-none tracking-[-0.03em] text-white">
							<?php echo esc_html( $item['price'] ?? '' ); ?>
						</span>
						<?php if ( ! empty( $item['period'] ) ) : ?>
							<span class="mb-1 font-body text-[16px] text-white/60">
								/ <?php echo esc_html( $item['period'] ); ?>
							</span>
						<?php endif; ?>
					</div>

					<p class="mt-4 font-body text-[16px] leading-relaxed text-white/75">
						<?php echo esc_html( $item['desc'] ?? '' ); ?>
					</p>

					<!-- Features list -->
					<?php if ( ! empty( $item['features'] ) ) : ?>
					<ul class="mt-8 space-y-3">
						<?php foreach ( $item['features'] as $feature ) : ?>
						<li class="flex items-start gap-3 font-body text-[16px] text-white/85">
							<span class="mt-0.5 flex h-5 w-5 flex-none items-center justify-center rounded-full bg-white/20 text-white text-[16px] font-bold" aria-hidden="true">✓</span>
							<?php echo esc_html( $feature ); ?>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>

					<!-- CTA -->
					<a href="<?php echo esc_url( $item['cta_url'] ?? '/contact/' ); ?>"
					   class="mt-auto pt-10 inline-flex min-h-[52px] w-full items-center justify-center gap-2.5 rounded-full bg-white py-3 pl-7 pr-3 font-body text-[16px] font-semibold text-[#654cff] no-underline shadow-[0_8px_24px_rgba(0,0,0,0.15)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_12px_32px_rgba(0,0,0,0.20)]">
						<?php echo esc_html( $item['cta_label'] ?? __( 'Get started', 'grosharp' ) ); ?>
						<span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-[#654cff] text-[16px] text-white" aria-hidden="true">→</span>
					</a>

				</article>

				<?php else : ?>
				<!-- Standard card — white background -->
				<article class="gs-reveal flex flex-col rounded-[24px] border border-black/[0.08] bg-white p-8 shadow-[0_4px_20px_rgba(101,76,255,0.05)] md:p-10">

					<h3 class="font-heading text-[22px] font-bold tracking-[-0.02em] text-[#0d0d12]">
						<?php echo esc_html( $item['title'] ?? '' ); ?>
					</h3>

					<div class="mt-4 flex items-end gap-2">
						<span class="font-heading text-[36px] font-bold leading-none tracking-[-0.03em] text-[#0d0d12]">
							<?php echo esc_html( $item['price'] ?? '' ); ?>
						</span>
						<?php if ( ! empty( $item['period'] ) ) : ?>
							<span class="mb-1 font-body text-[16px] text-[#9a9ab0]">
								/ <?php echo esc_html( $item['period'] ); ?>
							</span>
						<?php endif; ?>
					</div>

					<p class="mt-4 font-body text-[16px] leading-relaxed text-[#5c5d6d]">
						<?php echo esc_html( $item['desc'] ?? '' ); ?>
					</p>

					<!-- Divider -->
					<div class="my-8 h-px bg-black/[0.06]"></div>

					<!-- Features list -->
					<?php if ( ! empty( $item['features'] ) ) : ?>
					<ul class="space-y-3">
						<?php foreach ( $item['features'] as $feature ) : ?>
						<li class="flex items-start gap-3 font-body text-[16px] text-[#5c5d6d]">
							<span class="mt-0.5 flex h-5 w-5 flex-none items-center justify-center rounded-full bg-[#654cff]/10 text-[#654cff] text-[16px] font-bold" aria-hidden="true">✓</span>
							<?php echo esc_html( $feature ); ?>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>

					<!-- CTA -->
					<a href="<?php echo esc_url( $item['cta_url'] ?? '/contact/' ); ?>"
					   class="mt-auto pt-10 inline-flex min-h-[52px] w-full items-center justify-center gap-2.5 rounded-full border border-black/15 bg-transparent py-3 px-7 font-body text-[16px] font-semibold text-[#0d0d12] no-underline transition-all duration-200 hover:border-[#654cff] hover:bg-[#654cff] hover:text-white hover:shadow-[0_8px_24px_rgba(101,76,255,0.28)]">
						<?php echo esc_html( $item['cta_label'] ?? __( 'Get started', 'grosharp' ) ); ?>
					</a>

				</article>
				<?php endif; ?>

			<?php endforeach; ?>
		</div>

		<!-- ── Trust note ──────────────────────────────────────────────────────── -->
		<p class="gs-reveal mt-12 text-center font-body text-[16px] text-[#9a9ab0]">
			<?php esc_html_e( 'All plans include a free 30-minute strategy call. No lock-in contracts. Cancel or pause any time.', 'grosharp' ); ?>
		</p>

	</div>
</section>
