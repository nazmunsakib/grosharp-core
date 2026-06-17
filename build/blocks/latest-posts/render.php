<?php
/**
 * Latest posts block render template.
 *
 * @package GrosharpCore
 */

$eyebrow   = $attributes['eyebrow']  ?? __( 'Latest Articles', 'grosharp' );
$heading   = $attributes['heading']  ?? __( 'Insights from the team.', 'grosharp' );
$subtext   = $attributes['subtext']  ?? __( 'Tips, case studies, and thinking on design, development, and digital growth.', 'grosharp' );
$cta_label = $attributes['ctaLabel'] ?? __( 'More Articles', 'grosharp' );
$cta_url   = $attributes['ctaUrl']   ?? '/blog/';
$count     = absint( $attributes['count'] ?? 3 );

$query = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => $count,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);

/* ── Pastel gradient fallbacks (rotated by post index) ─────────────────────── */
$gradients = array(
	'linear-gradient(145deg,#ede9ff 0%,#c4b5fd 100%)',
	'linear-gradient(145deg,#f5f3ff 0%,#ddd6fe 100%)',
	'linear-gradient(145deg,#eef2ff 0%,#c7d2fe 100%)',
	'linear-gradient(145deg,#faf5ff 0%,#e9d5ff 100%)',
	'linear-gradient(145deg,#f0f9ff 0%,#bae6fd 100%)',
	'linear-gradient(145deg,#f8f7ff 0%,#e0e7ff 100%)',
);

/* ── Fallback post data ─────────────────────────────────────────────────────── */
$fallback_posts = array(
	array(
		'title'    => __( 'Why good typography makes websites convert better', 'grosharp' ),
		'excerpt'  => __( 'Type choices affect readability, trust, and attention. Here is how we approach font pairing for every project we take on.', 'grosharp' ),
		'category' => __( 'Design', 'grosharp' ),
		'date'     => 'Jun 5, 2026',
		'url'      => '/blog/',
		'gradient' => $gradients[0],
	),
	array(
		'title'    => __( 'Building faster WordPress sites with modern tooling', 'grosharp' ),
		'excerpt'  => __( 'A deep dive into our Tailwind + block theme stack, how we cut load times in half, and the tools that made it possible.', 'grosharp' ),
		'category' => __( 'Development', 'grosharp' ),
		'date'     => 'May 28, 2026',
		'url'      => '/blog/',
		'gradient' => $gradients[1],
	),
	array(
		'title'    => __( 'SEO in 2026: what actually moves the needle', 'grosharp' ),
		'excerpt'  => __( 'Search has changed. We break down the signals that drive rankings today and how we build them into every site we launch.', 'grosharp' ),
		'category' => __( 'Marketing', 'grosharp' ),
		'date'     => 'May 14, 2026',
		'url'      => '/blog/',
		'gradient' => $gradients[2],
	),
);

/* ── Category pill colours ──────────────────────────────────────────────────── */
$cat_colors = array(
	'Design'      => 'bg-[#f0e9ff] text-[#4f39c7]',
	'Development' => 'bg-[#e8f4ff] text-[#1d4ed8]',
	'Marketing'   => 'bg-[#f0fdf4] text-[#065f46]',
	'Strategy'    => 'bg-[#fff7ed] text-[#9a3412]',
	'News'        => 'bg-[#fafafa] text-[#3f3f46]',
);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-latest-posts bg-white py-[4rem]' ) ); ?>>
	<div class="gs-container">

		<!-- ── Section header ──────────────────────────────────────────────── -->
		<div class="mb-14 flex flex-col gap-10 md:mb-16 md:flex-row md:items-end md:justify-between">

			<!-- Left: eyebrow + heading -->
			<div class="max-w-[560px]">
				<p class="inline-flex items-center gap-2 rounded-full border border-[#654cff]/20 bg-[#654cff]/[0.07] px-4 py-1.5 font-body text-[16px] font-semibold uppercase tracking-widest text-[#654cff]" data-gs-eyebrow>
					<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
					<?php echo esc_html( $eyebrow ); ?>
				</p>
				<h2 class="mt-6 font-heading text-[clamp(2rem,4vw,3.375rem)] font-extrabold leading-[1.1] tracking-[-0.035em] text-[#0d0d12]">
					<?php echo esc_html( $heading ); ?>
				</h2>
			</div>

			<!-- Right: subtext + CTA -->
			<div class="max-w-[360px] md:shrink-0 md:pb-2 md:text-right">
				<p class="font-body text-[20px] leading-[28px] text-[#5c5d6d]">
					<?php echo esc_html( $subtext ); ?>
				</p>
				<a href="<?php echo esc_url( $cta_url ); ?>"
				   class="mt-7 inline-flex min-h-[48px] items-center gap-3 rounded-full border border-black/15 px-7 font-body text-[0.9375rem] font-semibold text-[#0d0d12] no-underline transition-all duration-300 hover:border-[#654cff] hover:bg-[#654cff] hover:text-white hover:shadow-[0_8px_24px_rgba(101,76,255,0.28)]">
					<?php echo esc_html( $cta_label ); ?>
					<span aria-hidden="true">→</span>
				</a>
			</div>

		</div>

		<!-- ── Article cards grid ──────────────────────────────────────────── -->
		<div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">

			<?php if ( $query->have_posts() ) : ?>
				<?php $i = 0; while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php
					$cats     = get_the_category();
					$cat_name = ( $cats && ! empty( $cats ) ) ? $cats[0]->name : '';
					$cat_cls  = $cat_colors[ $cat_name ] ?? 'bg-[#f5f5f5] text-[#3f3f46]';
					$gradient = $gradients[ $i % count( $gradients ) ];
					$thumb    = get_the_post_thumbnail_url( get_the_ID(), 'grosharp-card-sm' );
					$date     = get_the_date( 'M j, Y' );
					?>
					<article class="group flex flex-col overflow-hidden rounded-[20px] border border-black/[0.06] bg-white shadow-[0_4px_20px_rgba(101,76,255,0.06)] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_48px_rgba(101,76,255,0.13)]" data-gs-post-card>

						<!-- Image / gradient top -->
						<a href="<?php the_permalink(); ?>" class="relative block aspect-[16/10] overflow-hidden no-underline" tabindex="-1" aria-hidden="true">
							<?php if ( $thumb ) : ?>
								<img src="<?php echo esc_url( $thumb ); ?>"
								     alt="<?php the_title_attribute(); ?>"
								     class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
								     loading="lazy" />
							<?php else : ?>
								<div class="h-full w-full transition-transform duration-700 ease-out group-hover:scale-105"
								     style="background:<?php echo esc_attr( $gradient ); ?>;"></div>
							<?php endif; ?>
						</a>

						<!-- Card body -->
						<div class="flex flex-1 flex-col p-6 md:p-7">

							<!-- Category + date -->
							<div class="mb-3.5 flex items-center gap-3">
								<?php if ( $cat_name ) : ?>
									<span class="rounded-full px-3 py-1 font-body text-[16px] font-semibold <?php echo esc_attr( $cat_cls ); ?>">
										<?php echo esc_html( $cat_name ); ?>
									</span>
								<?php endif; ?>
								<span class="font-body text-[16px] text-[#9a9ab0]"><?php echo esc_html( $date ); ?></span>
							</div>

							<!-- Title -->
							<h3 class="font-heading text-[18px] font-bold leading-snug tracking-[-0.015em] text-[#0d0d12] transition-colors duration-200 group-hover:text-[#654cff] md:text-[20px]">
								<a href="<?php the_permalink(); ?>" class="no-underline">
									<?php the_title(); ?>
								</a>
							</h3>

							<!-- Excerpt -->
							<p class="mt-3 line-clamp-2 flex-1 font-body text-[16px] leading-relaxed text-[#5c5d6d]">
								<?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 20, '…' ) ); ?>
							</p>

							<!-- Read more link -->
							<a href="<?php the_permalink(); ?>"
							   class="mt-5 inline-flex items-center gap-1.5 self-start font-body text-[16px] font-semibold text-[#654cff] no-underline transition-all duration-200 hover:gap-3">
								<?php esc_html_e( 'Read article', 'grosharp' ); ?>
								<span aria-hidden="true">→</span>
							</a>

						</div>
					</article>
				<?php $i++; endwhile; wp_reset_postdata(); ?>

			<?php else : ?>
				<?php foreach ( array_slice( $fallback_posts, 0, $count ) as $idx => $post ) :
					$cat_cls = $cat_colors[ $post['category'] ] ?? 'bg-[#f5f5f5] text-[#3f3f46]';
				?>
					<article class="group flex flex-col overflow-hidden rounded-[20px] border border-black/[0.06] bg-white shadow-[0_4px_20px_rgba(101,76,255,0.06)] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_48px_rgba(101,76,255,0.13)]" data-gs-post-card>

						<!-- Gradient top -->
						<div class="relative aspect-[16/10] overflow-hidden">
							<div class="h-full w-full transition-transform duration-700 ease-out group-hover:scale-105"
							     style="background:<?php echo esc_attr( $post['gradient'] ); ?>;"></div>
						</div>

						<!-- Card body -->
						<div class="flex flex-1 flex-col p-6 md:p-7">
							<div class="mb-3.5 flex items-center gap-3">
								<span class="rounded-full px-3 py-1 font-body text-[16px] font-semibold <?php echo esc_attr( $cat_cls ); ?>">
									<?php echo esc_html( $post['category'] ); ?>
								</span>
								<span class="font-body text-[16px] text-[#9a9ab0]"><?php echo esc_html( $post['date'] ); ?></span>
							</div>
							<h3 class="font-heading text-[18px] font-bold leading-snug tracking-[-0.015em] text-[#0d0d12] transition-colors duration-200 group-hover:text-[#654cff] md:text-[20px]">
								<a href="<?php echo esc_url( $post['url'] ); ?>" class="no-underline">
									<?php echo esc_html( $post['title'] ); ?>
								</a>
							</h3>
							<p class="mt-3 line-clamp-2 flex-1 font-body text-[16px] leading-relaxed text-[#5c5d6d]">
								<?php echo esc_html( $post['excerpt'] ); ?>
							</p>
							<a href="<?php echo esc_url( $post['url'] ); ?>"
							   class="mt-5 inline-flex items-center gap-1.5 self-start font-body text-[16px] font-semibold text-[#654cff] no-underline transition-all duration-200 hover:gap-3">
								<?php esc_html_e( 'Read article', 'grosharp' ); ?>
								<span aria-hidden="true">→</span>
							</a>
						</div>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>

		</div>
	</div>
</section>
