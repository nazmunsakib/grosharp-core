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
					?>
					<article class="group cursor-pointer" data-gs-project-card>
						<!-- Image -->
						<a href="<?php the_permalink(); ?>" class="block overflow-hidden rounded-[20px]" tabindex="-1" aria-hidden="true">
							<div class="relative aspect-[4/3] overflow-hidden" data-gs-project-img-wrap>
								<?php if ( has_post_thumbnail() ) : ?>
									<img
										class="h-full w-full object-cover"
										src="<?php the_post_thumbnail_url( 'large' ); ?>"
										alt="<?php the_title_attribute(); ?>"
										loading="lazy"
										data-gs-project-img
									/>
								<?php else : ?>
									<div class="h-full w-full" data-gs-project-img></div>
								<?php endif; ?>
								<!-- Hover overlay -->
								<div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent" data-gs-project-overlay>
									<div class="absolute bottom-5 right-5 flex h-11 w-11 items-center justify-center rounded-full bg-white font-bold text-[#0d0d12] shadow-lg" aria-hidden="true" data-gs-project-arrow>
										↗
									</div>
								</div>
							</div>
						</a>
						<!-- Card info -->
						<div class="mt-4 flex items-center justify-between gap-4">
							<h3 class="font-heading text-[20px] font-bold leading-tight text-[#0d0d12] md:text-[22px]">
								<a href="<?php the_permalink(); ?>" class="no-underline transition-colors duration-200 hover:text-[#654cff]">
									<?php the_title(); ?>
								</a>
							</h3>
							<?php if ( $type_label ) : ?>
								<span class="flex-none rounded-full border border-black/15 px-4 py-1.5 font-body text-xs font-semibold text-[#555]">
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
						<!-- Image -->
						<a href="<?php echo esc_url( $project['url'] ); ?>" class="block overflow-hidden rounded-[20px]" tabindex="-1" aria-hidden="true">
							<div class="relative aspect-[4/3] overflow-hidden" data-gs-project-img-wrap>
								<div
									class="h-full w-full"
									style="background:<?php echo esc_attr( $project['gradient'] ); ?>;"
									data-gs-project-img
								></div>
								<!-- Hover overlay -->
								<div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent" data-gs-project-overlay>
									<div class="absolute bottom-5 right-5 flex h-11 w-11 items-center justify-center rounded-full bg-white font-bold text-[#0d0d12] shadow-lg" aria-hidden="true" data-gs-project-arrow>
										↗
									</div>
								</div>
							</div>
						</a>
						<!-- Card info -->
						<div class="mt-4 flex items-center justify-between gap-4">
							<h3 class="font-heading text-[20px] font-bold leading-tight text-[#0d0d12] md:text-[22px]">
								<a href="<?php echo esc_url( $project['url'] ); ?>" class="no-underline transition-colors duration-200 hover:text-[#654cff]">
									<?php echo esc_html( $project['title'] ); ?>
								</a>
							</h3>
							<span class="flex-none rounded-full border border-black/15 px-4 py-1.5 font-body text-xs font-semibold text-[#555]">
								<?php echo esc_html( $project['type'] ); ?>
							</span>
						</div>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>

		</div>
	</div>
</section>
