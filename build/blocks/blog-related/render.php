<?php
/**
 * Blog Related Posts block.
 * Shows 3 posts from the same category, excluding the current post.
 *
 * @package GrosharpCore
 */

$post_id  = get_the_ID() ?: get_queried_object_id();
$heading  = $attributes['heading'] ?? __( 'More Articles', 'grosharp' );
$cats     = get_the_category( $post_id );
$cat_ids  = ! empty( $cats ) ? wp_list_pluck( $cats, 'term_id' ) : array();

$args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 3,
	'post__not_in'   => array( $post_id ),
	'orderby'        => 'date',
	'order'          => 'DESC',
);
if ( ! empty( $cat_ids ) ) {
	$args['category__in'] = $cat_ids;
}
$query = new WP_Query( $args );

/* Fallback: any 3 posts if same-category has none */
if ( ! $query->have_posts() && ! empty( $cat_ids ) ) {
	unset( $args['category__in'] );
	$query = new WP_Query( $args );
}

if ( ! $query->have_posts() ) { return; }

$gradients = array(
	'linear-gradient(145deg,#ede9ff 0%,#c4b5fd 100%)',
	'linear-gradient(145deg,#eef2ff 0%,#c7d2fe 100%)',
	'linear-gradient(145deg,#faf5ff 0%,#e9d5ff 100%)',
);

$cat_color_map = array(
	'Design'      => array( 'bg' => '#f0e9ff', 'text' => '#4f39c7' ),
	'Development' => array( 'bg' => '#e8f4ff', 'text' => '#1d4ed8' ),
	'Marketing'   => array( 'bg' => '#f0fdf4', 'text' => '#065f46' ),
	'Strategy'    => array( 'bg' => '#fff7ed', 'text' => '#9a3412' ),
	'Branding'    => array( 'bg' => '#fef3c7', 'text' => '#92400e' ),
	'News'        => array( 'bg' => '#f4f4f5', 'text' => '#3f3f46' ),
);
?>

<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-blog-related bg-[#f9f9fb]' ) ); ?>
         style="padding:4rem 0 5rem;">
	<div class="gs-container">

		<!-- Heading -->
		<div class="mb-10 flex items-center justify-between gap-6" data-gs-related-header>
			<h2 class="font-heading text-[clamp(1.5rem,3vw,2rem)] font-extrabold tracking-[-0.03em] text-[#0d0d12] m-0">
				<?php echo esc_html( $heading ); ?>
			</h2>
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>"
			   class="hidden shrink-0 items-center gap-2 font-body text-[0.875rem] font-semibold text-[#654cff] no-underline hover:gap-3 transition-all duration-200 sm:inline-flex">
				<?php esc_html_e( 'All articles', 'grosharp' ); ?>
				<span aria-hidden="true">→</span>
			</a>
		</div>

		<!-- Cards -->
		<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
			<?php $i = 0; while ( $query->have_posts() ) : $query->the_post();
				$pid       = get_the_ID();
				$rcats     = get_the_category();
				$cat_name  = ! empty( $rcats ) ? $rcats[0]->name : '';
				$cat_url   = ! empty( $rcats ) ? get_category_link( $rcats[0]->term_id ) : '';
				$cat_c     = $cat_color_map[ $cat_name ] ?? array( 'bg' => '#f4f4f5', 'text' => '#3f3f46' );
				$thumb     = get_the_post_thumbnail_url( $pid, 'grosharp-card-sm' );
				$gradient  = $gradients[ $i % count( $gradients ) ];
				$author    = get_the_author();
				$words     = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $pid ) ) );
				$read_time = max( 1, (int) ceil( $words / 200 ) );
			?>
				<article class="group flex flex-col overflow-hidden rounded-[20px] border border-black/[0.06] bg-white shadow-[0_4px_16px_rgba(101,76,255,0.05)] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_16px_40px_rgba(101,76,255,0.11)]"
				         data-gs-related-card>

					<a href="<?php the_permalink(); ?>" class="relative block aspect-[16/10] overflow-hidden no-underline" tabindex="-1" aria-hidden="true">
						<?php if ( $thumb ) : ?>
							<img src="<?php echo esc_url( $thumb ); ?>"
							     alt="<?php the_title_attribute(); ?>"
							     class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
							     loading="lazy" />
						<?php else : ?>
							<div class="h-full w-full transition-transform duration-700 group-hover:scale-105"
							     style="background:<?php echo esc_attr( $gradient ); ?>;"></div>
						<?php endif; ?>
					</a>

					<div class="flex flex-1 flex-col p-5 md:p-6">
						<div class="mb-3 flex flex-wrap items-center gap-2">
							<?php if ( $cat_name ) : ?>
								<a href="<?php echo esc_url( $cat_url ); ?>"
								   class="inline-flex items-center rounded-full px-3 py-1 font-body text-[0.75rem] font-semibold no-underline"
								   style="background:<?php echo esc_attr( $cat_c['bg'] ); ?>;color:<?php echo esc_attr( $cat_c['text'] ); ?>;">
									<?php echo esc_html( $cat_name ); ?>
								</a>
							<?php endif; ?>
							<span class="font-body text-[0.8rem] text-[#9a9ab0]"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
						</div>

						<h3 class="font-heading text-[1rem] font-bold leading-snug tracking-[-0.01em] text-[#0d0d12] transition-colors duration-200 group-hover:text-[#654cff] md:text-[1.0625rem]">
							<a href="<?php the_permalink(); ?>" class="no-underline"><?php the_title(); ?></a>
						</h3>

						<p class="mt-2 line-clamp-2 flex-1 font-body text-[0.875rem] leading-relaxed text-[#5c5d6d]">
							<?php echo esc_html( wp_trim_words( get_the_excerpt() ?: wp_strip_all_tags( get_the_content() ), 16, '…' ) ); ?>
						</p>

						<div class="mt-4 flex items-center justify-between border-t border-black/[0.06] pt-3.5">
							<span class="font-body text-[0.8125rem] font-semibold text-[#0d0d12]"><?php echo esc_html( $author ); ?></span>
							<span class="font-body text-[0.8rem] text-[#9a9ab0]"><?php echo esc_html( $read_time ); ?> <?php esc_html_e( 'min read', 'grosharp' ); ?></span>
						</div>
					</div>

				</article>
			<?php $i++; endwhile; wp_reset_postdata(); ?>
		</div>

	</div>
</section>
