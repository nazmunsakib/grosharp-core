<?php
/**
 * Featured projects block render template.
 *
 * @package GrosharpCore
 */

$eyebrow = $attributes['eyebrow'] ?? __( '01 Work', 'grosharp' );
$heading = $attributes['heading'] ?? __( 'Featured work.', 'grosharp' );
$count   = absint( $attributes['count'] ?? 4 );

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
		'type'     => __( 'Design · Development', 'grosharp' ),
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
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-projects bg-white py-24 md:py-32' ) ); ?>>
	<div class="gs-container">

		<!-- Section header -->
		<div class="mb-12 flex items-end justify-between gap-6 md:mb-16">
			<div>
				<p class="mb-3 font-body text-sm italic text-[#888]" data-gs-project-eyebrow>
					(<?php echo esc_html( $eyebrow ); ?>)
				</p>
				<h2 class="font-heading text-[52px] font-bold leading-[1.0] tracking-[-0.025em] text-[#0d0d12] sm:text-[68px] lg:text-[80px]" data-gs-project-heading>
					<?php echo esc_html( $heading ); ?>
				</h2>
			</div>
			<a href="/case-studies/"
			   class="flex-none rounded-full bg-[#0d0d12] px-6 py-3 font-body text-sm font-semibold text-white no-underline transition-all duration-300 hover:bg-[#654cff] hover:shadow-[0_8px_24px_rgba(101,76,255,0.35)]"
			   data-gs-project-cta>
				All projects
			</a>
		</div>

		<!-- 2 × 2 project grid -->
		<div class="grid grid-cols-1 gap-x-6 gap-y-10 md:grid-cols-2 md:gap-y-14">

			<?php if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : ?>
					<?php
					$query->the_post();
					$type_terms = get_the_terms( get_the_ID(), 'project_type' );
					$type_label = ( is_array( $type_terms ) && ! empty( $type_terms ) ) ? $type_terms[0]->name : '';
					$permalink  = get_permalink();
					?>
					<article class="group relative aspect-[4/3] cursor-pointer overflow-hidden rounded-[20px]" data-gs-project-card>

						<!-- Background image -->
						<?php if ( has_post_thumbnail() ) : ?>
							<img
								class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 ease-out"
								src="<?php the_post_thumbnail_url( 'large' ); ?>"
								alt="<?php the_title_attribute(); ?>"
								loading="lazy"
								data-gs-project-img
							/>
						<?php else : ?>
							<div class="absolute inset-0 bg-[#1a1a2e]" data-gs-project-img></div>
						<?php endif; ?>

						<!-- Permanent bottom title (fades on hover) -->
						<div class="pointer-events-none absolute inset-x-0 bottom-0 z-10 bg-gradient-to-t from-black/80 via-black/20 to-transparent px-6 pb-6 pt-24 transition-opacity duration-300 group-hover:opacity-0">
							<h3 class="font-heading text-[22px] font-bold leading-tight text-white md:text-[24px]">
								<?php the_title(); ?>
							</h3>
						</div>

						<!-- Glass overlay — slides up on hover -->
						<div class="pointer-events-none absolute inset-x-0 bottom-0 z-20 flex translate-y-full flex-col justify-between rounded-b-[20px] border-t border-white/10 p-6 pt-6 transition-transform duration-[420ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:translate-y-0 group-hover:pointer-events-auto"
						     style="height:65%;backdrop-filter:blur(20px) saturate(1.4);background:rgba(10,10,16,0.70);">

							<div>
								<?php if ( $type_label ) : ?>
									<span class="inline-block rounded-full border border-white/20 bg-white/10 px-3 py-1 font-body text-xs font-semibold text-white/80">
										<?php echo esc_html( $type_label ); ?>
									</span>
								<?php endif; ?>
								<h3 class="mt-3 font-heading text-[20px] font-bold leading-snug text-white md:text-[22px]">
									<?php the_title(); ?>
								</h3>
							</div>

							<a href="<?php echo esc_url( $permalink ); ?>"
							   class="inline-flex items-center gap-2 self-start rounded-full border border-white/25 px-5 py-2.5 font-body text-sm font-semibold text-white no-underline transition-all duration-300 hover:bg-white hover:text-[#0d0d12]">
								<?php esc_html_e( 'View Project', 'grosharp' ); ?>
								<span aria-hidden="true">→</span>
							</a>

						</div>
					</article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<?php foreach ( $placeholder_projects as $project ) : ?>
					<article class="group relative aspect-[4/3] cursor-pointer overflow-hidden rounded-[20px]" data-gs-project-card>

						<!-- Background gradient -->
						<div class="absolute inset-0 transition-transform duration-700 ease-out"
						     style="background:<?php echo esc_attr( $project['gradient'] ); ?>;"
						     data-gs-project-img></div>

						<!-- Permanent bottom title (fades on hover) -->
						<div class="pointer-events-none absolute inset-x-0 bottom-0 z-10 bg-gradient-to-t from-black/80 via-black/20 to-transparent px-6 pb-6 pt-24 transition-opacity duration-300 group-hover:opacity-0">
							<h3 class="font-heading text-[22px] font-bold leading-tight text-white md:text-[24px]">
								<?php echo esc_html( $project['title'] ); ?>
							</h3>
						</div>

						<!-- Glass overlay — slides up on hover -->
						<div class="pointer-events-none absolute inset-x-0 bottom-0 z-20 flex translate-y-full flex-col justify-between rounded-b-[20px] border-t border-white/10 p-6 pt-6 transition-transform duration-[420ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:translate-y-0 group-hover:pointer-events-auto"
						     style="height:65%;backdrop-filter:blur(20px) saturate(1.4);background:rgba(10,10,16,0.70);">

							<div>
								<span class="inline-block rounded-full border border-white/20 bg-white/10 px-3 py-1 font-body text-xs font-semibold text-white/80">
									<?php echo esc_html( $project['type'] ); ?>
								</span>
								<h3 class="mt-3 font-heading text-[20px] font-bold leading-snug text-white md:text-[22px]">
									<?php echo esc_html( $project['title'] ); ?>
								</h3>
							</div>

							<a href="<?php echo esc_url( $project['url'] ); ?>"
							   class="inline-flex items-center gap-2 self-start rounded-full border border-white/25 px-5 py-2.5 font-body text-sm font-semibold text-white no-underline transition-all duration-300 hover:bg-white hover:text-[#0d0d12]">
								<?php esc_html_e( 'View Project', 'grosharp' ); ?>
								<span aria-hidden="true">→</span>
							</a>

						</div>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>

		</div>
	</div>
</section>
