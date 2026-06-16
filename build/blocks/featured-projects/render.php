<?php
/**
 * Featured projects block render template.
 *
 * @package GrosharpCore
 */

$eyebrow   = $attributes['eyebrow']   ?? __( '01 Work', 'grosharp' );
$heading   = $attributes['heading']   ?? __( 'Featured work.', 'grosharp' );
$text      = $attributes['text']      ?? __( 'A selection of projects where strategy, design, and engineering came together to deliver real results.', 'grosharp' );
$cta_label = $attributes['ctaLabel']  ?? __( 'All projects', 'grosharp' );
$cta_url   = $attributes['ctaUrl']    ?? '/case-studies/';
$count     = absint( $attributes['count'] ?? 4 );

$query = new WP_Query(
	array(
		'post_type'      => 'grosharp_project',
		'posts_per_page' => $count,
		'post_status'    => 'publish',
	)
);

$placeholder_projects = array(
	array(
		'title'    => __( 'Elevance — Brand & Website', 'grosharp' ),
		'type'     => __( 'Design', 'grosharp' ),
		'url'      => '/case-studies/',
		'gradient' => 'linear-gradient(145deg,#111111 0%,#2a2a2a 100%)',
	),
	array(
		'title'    => __( 'Foliocraft — SEO Growth', 'grosharp' ),
		'type'     => __( 'Marketing', 'grosharp' ),
		'url'      => '/case-studies/',
		'gradient' => 'linear-gradient(145deg,#052e16 0%,#065f46 100%)',
	),
	array(
		'title'    => __( 'Meridian — Web App', 'grosharp' ),
		'type'     => __( 'Development', 'grosharp' ),
		'url'      => '/case-studies/',
		'gradient' => 'linear-gradient(145deg,#0c1445 0%,#1e3a8a 100%)',
	),
	array(
		'title'    => __( 'Aria — Product Design', 'grosharp' ),
		'type'     => __( 'UX Design', 'grosharp' ),
		'url'      => '/case-studies/',
		'gradient' => 'linear-gradient(145deg,#1e0a3c 0%,#4c1d95 100%)',
	),
);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-projects bg-white py-[4rem]' ) ); ?>>
	<div class="gs-container">

		<!-- ── Section header ──────────────────────────────────────────────── -->
		<div class="mb-14 flex flex-col gap-10 md:mb-16 md:flex-row md:items-end md:justify-between">

			<!-- Left: eyebrow + heading -->
			<div class="max-w-[580px]">
				<p class="inline-flex items-center gap-2 rounded-full border border-[#654cff]/20 bg-[#654cff]/[0.07] px-4 py-1.5 font-body text-[16px] font-semibold uppercase tracking-widest text-[#654cff]" data-gs-project-eyebrow>
					<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
					<?php echo esc_html( $eyebrow ); ?>
				</p>
				<h2 class="mt-6 font-heading text-[clamp(2rem,4vw,3.375rem)] font-extrabold leading-[1.1] tracking-[-0.035em] text-[#0d0d12]" data-gs-project-heading>
					<?php echo esc_html( $heading ); ?>
				</h2>
			</div>

			<!-- Right: body text + CTA -->
			<div class="flex max-w-[360px] flex-col items-start md:shrink-0 md:items-end md:pb-2">
				<p class="font-body text-[20px] leading-[28px] text-[#5c5d6d]">
					<?php echo esc_html( $text ); ?>
				</p>
				<a href="<?php echo esc_url( $cta_url ); ?>"
				   class="mt-7 inline-flex min-h-[48px] items-center gap-3 rounded-full border border-black/15 px-7 font-body text-[0.9375rem] font-semibold text-[#0d0d12] no-underline transition-all duration-300 hover:border-[#654cff] hover:bg-[#654cff] hover:text-white hover:shadow-[0_8px_24px_rgba(101,76,255,0.28)]">
					<?php esc_html_e( 'See more projects', 'grosharp' ); ?>
					<span aria-hidden="true">→</span>
				</a>
			</div>

		</div>

		<!-- ── 2 × 2 project grid ──────────────────────────────────────────── -->
		<div class="grid grid-cols-1 gap-7 md:grid-cols-2">

			<?php if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : ?>
					<?php
					$query->the_post();
					$type_terms = get_the_terms( get_the_ID(), 'project_type' );
					$type_label = ( is_array( $type_terms ) && ! empty( $type_terms ) ) ? $type_terms[0]->name : '';
					$permalink  = get_permalink();
					?>
					<article class="group cursor-pointer" data-gs-project-card>

						<!-- ── Image with hover overlay ───────────────────── -->
						<a href="<?php echo esc_url( $permalink ); ?>"
						   class="relative block overflow-hidden rounded-[20px] no-underline"
						   style="aspect-ratio:16/10;" aria-label="<?php the_title_attribute(); ?>">

							<?php if ( has_post_thumbnail() ) : ?>
								<img
									class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.05]"
									src="<?php the_post_thumbnail_url( 'large' ); ?>"
									alt="<?php the_title_attribute(); ?>"
									loading="lazy"
									data-gs-project-img
								/>
							<?php else : ?>
								<div class="h-full w-full transition-transform duration-700 ease-out group-hover:scale-[1.05]"
								     style="background:linear-gradient(145deg,#1a1a2e 0%,#2d2d4e 100%);"
								     data-gs-project-img></div>
							<?php endif; ?>

							<!-- Dark tint -->
							<div class="absolute inset-0 bg-black/40 opacity-0 transition-opacity duration-[380ms] ease-out group-hover:opacity-100"></div>

							<!-- "View Project" button -->
							<div class="absolute inset-0 flex items-center justify-center">
								<span class="inline-flex translate-y-3 scale-90 items-center gap-3 rounded-full px-8 py-4 font-body text-[16px] font-semibold text-white opacity-0 shadow-[0_16px_40px_rgba(101,76,255,0.50)] transition-all duration-[400ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:translate-y-0 group-hover:scale-100 group-hover:opacity-100" style="background:linear-gradient(135deg,#654cff 0%,#7c3aed 100%);">
									<?php esc_html_e( 'View Project', 'grosharp' ); ?>
									<span class="flex h-8 w-8 flex-none items-center justify-center rounded-full bg-white/25 text-[16px]" aria-hidden="true">→</span>
								</span>
							</div>

						</a>

						<!-- ── Info row ───────────────────────────────────── -->
						<div class="mt-5 flex items-center justify-between gap-5">
							<h3 class="font-heading text-[20px] font-bold leading-snug tracking-[-0.02em] text-[#0d0d12] transition-colors duration-200 group-hover:text-[#654cff] md:text-[24px]">
								<?php the_title(); ?>
							</h3>
							<?php if ( $type_label ) : ?>
								<span class="flex-none rounded-full border border-[#654cff]/20 bg-[#654cff]/[0.07] px-4 py-1.5 font-body text-[16px] font-semibold text-[#654cff]">
									<?php echo esc_html( $type_label ); ?>
								</span>
							<?php endif; ?>
						</div>

					</article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<?php foreach ( $placeholder_projects as $project ) : ?>
					<article class="group cursor-pointer" data-gs-project-card>

						<!-- ── Image with hover overlay ───────────────────── -->
						<a href="<?php echo esc_url( $project['url'] ); ?>"
						   class="relative block overflow-hidden rounded-[20px] no-underline"
						   style="aspect-ratio:16/10;" aria-label="<?php echo esc_attr( $project['title'] ); ?>">

							<div class="h-full w-full transition-transform duration-700 ease-out group-hover:scale-[1.05]"
							     style="background:<?php echo esc_attr( $project['gradient'] ); ?>;"
							     data-gs-project-img></div>

							<!-- Dark tint -->
							<div class="absolute inset-0 bg-black/40 opacity-0 transition-opacity duration-[380ms] ease-out group-hover:opacity-100"></div>

							<!-- "View Project" button -->
							<div class="absolute inset-0 flex items-center justify-center">
								<span class="inline-flex translate-y-3 scale-90 items-center gap-3 rounded-full px-8 py-4 font-body text-[16px] font-semibold text-white opacity-0 shadow-[0_16px_40px_rgba(101,76,255,0.50)] transition-all duration-[400ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:translate-y-0 group-hover:scale-100 group-hover:opacity-100" style="background:linear-gradient(135deg,#654cff 0%,#7c3aed 100%);">
									<?php esc_html_e( 'View Project', 'grosharp' ); ?>
									<span class="flex h-8 w-8 flex-none items-center justify-center rounded-full bg-white/25 text-[16px]" aria-hidden="true">→</span>
								</span>
							</div>

						</a>

						<!-- ── Info row ───────────────────────────────────── -->
						<div class="mt-5 flex items-center justify-between gap-5">
							<h3 class="font-heading text-[20px] font-bold leading-snug tracking-[-0.02em] text-[#0d0d12] transition-colors duration-200 group-hover:text-[#654cff] md:text-[24px]">
								<?php echo esc_html( $project['title'] ); ?>
							</h3>
							<span class="flex-none rounded-full border border-[#654cff]/20 bg-[#654cff]/[0.07] px-4 py-1.5 font-body text-[16px] font-semibold text-[#654cff]">
								<?php echo esc_html( $project['type'] ); ?>
							</span>
						</div>

					</article>
				<?php endforeach; ?>
			<?php endif; ?>

		</div>

	</div>
</section>
