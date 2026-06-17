<?php
/**
 * Blog Grid block — full archive with category filters + pagination.
 *
 * @package GrosharpCore
 */

$posts_per_page = intval( $attributes['postsPerPage'] ?? 9 );
$show_filters   = (bool) ( $attributes['showFilters'] ?? true );

/* ── Current page + active category ─────────────────────────────────────── */
$paged      = max( 1, get_query_var( 'paged' ) ?: ( get_query_var( 'page' ) ?: 1 ) );
$active_cat = intval( $_GET['cat'] ?? 0 ); // phpcs:ignore WordPress.Security.NonceVerification

/* ── Query ───────────────────────────────────────────────────────────────── */
$args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => $posts_per_page,
	'paged'          => $paged,
	'orderby'        => 'date',
	'order'          => 'DESC',
);
if ( $active_cat > 0 ) {
	$args['cat'] = $active_cat;
}
$query = new WP_Query( $args );

/* ── All categories for filter pills ────────────────────────────────────── */
$categories = get_categories( array( 'hide_empty' => true ) );

/* ── Helpers ─────────────────────────────────────────────────────────────── */
$gradients = array(
	'linear-gradient(145deg,#ede9ff 0%,#c4b5fd 100%)',
	'linear-gradient(145deg,#f5f3ff 0%,#ddd6fe 100%)',
	'linear-gradient(145deg,#eef2ff 0%,#c7d2fe 100%)',
	'linear-gradient(145deg,#faf5ff 0%,#e9d5ff 100%)',
	'linear-gradient(145deg,#f0f9ff 0%,#bae6fd 100%)',
	'linear-gradient(145deg,#f8f7ff 0%,#e0e7ff 100%)',
);

/**
 * Estimated read time in minutes.
 */
if ( ! function_exists( 'grosharp_read_time' ) ) :
function grosharp_read_time( int $post_id ): int {
	$content = get_post_field( 'post_content', $post_id );
	$words   = str_word_count( wp_strip_all_tags( $content ) );
	return max( 1, (int) ceil( $words / 200 ) );
}
endif;

/* ── Base URL for filter links (strips existing ?cat + ?paged) ───────────── */
$base_url = strtok( get_pagenum_link( 1 ), '?' );

/* ── Fallback posts ──────────────────────────────────────────────────────── */
$fallback = array(
	array( 'title' => 'Why good typography makes websites convert better',         'excerpt' => 'Type choices affect readability, trust, and attention. Here is how we approach font pairing for every project.',     'category' => 'Design',      'date' => 'Jun 5, 2026',  'author' => 'Alex Morgan',  'read_time' => 5, 'gradient' => $gradients[0] ),
	array( 'title' => 'Building faster WordPress sites with modern tooling',        'excerpt' => 'A deep dive into our Tailwind + block theme stack and how we cut load times in half.',                              'category' => 'Development', 'date' => 'May 28, 2026', 'author' => 'Sam Lee',      'read_time' => 7, 'gradient' => $gradients[1] ),
	array( 'title' => 'SEO in 2026: what actually moves the needle',               'excerpt' => 'Search has changed. We break down the signals that drive rankings today.',                                           'category' => 'Marketing',   'date' => 'May 14, 2026', 'author' => 'Jordan Kim',   'read_time' => 6, 'gradient' => $gradients[2] ),
	array( 'title' => 'The UX principles behind high-converting landing pages',    'excerpt' => 'Every element on a landing page either earns its place or costs you a conversion. Here is our framework.',          'category' => 'Design',      'date' => 'Apr 30, 2026', 'author' => 'Alex Morgan',  'read_time' => 8, 'gradient' => $gradients[3] ),
	array( 'title' => 'WooCommerce vs custom ecommerce: how to choose',            'excerpt' => 'We have built both. Here is an honest breakdown of when each approach makes sense for your business.',              'category' => 'Development', 'date' => 'Apr 18, 2026', 'author' => 'Sam Lee',      'read_time' => 9, 'gradient' => $gradients[4] ),
	array( 'title' => 'How we approach brand identity for digital-first companies', 'excerpt' => 'Branding for the web is different from print. We explain the choices we make and why they matter at scale.',       'category' => 'Branding',    'date' => 'Apr 5, 2026',  'author' => 'Jordan Kim',   'read_time' => 6, 'gradient' => $gradients[5] ),
);

$cat_color_map = array(
	'Design'      => array( 'bg' => '#f0e9ff', 'text' => '#4f39c7' ),
	'Development' => array( 'bg' => '#e8f4ff', 'text' => '#1d4ed8' ),
	'Marketing'   => array( 'bg' => '#f0fdf4', 'text' => '#065f46' ),
	'Strategy'    => array( 'bg' => '#fff7ed', 'text' => '#9a3412' ),
	'Branding'    => array( 'bg' => '#fef3c7', 'text' => '#92400e' ),
	'News'        => array( 'bg' => '#f4f4f5', 'text' => '#3f3f46' ),
);

/**
 * Return inline style string for a category name.
 */
function grosharp_cat_style( string $name, array $map ): string {
	$c = $map[ $name ] ?? array( 'bg' => '#f4f4f5', 'text' => '#3f3f46' );
	return 'background:' . $c['bg'] . ';color:' . $c['text'] . ';';
}
?>

<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-blog-grid bg-white py-16 md:py-24' ) ); ?>>
<div class="gs-container">

	<?php if ( $show_filters && ! empty( $categories ) ) : ?>
	<!-- ── Category filter pills ──────────────────────────────────────────── -->
	<div class="mb-10 flex flex-wrap gap-2" data-gs-bg-filters>
		<a href="<?php echo esc_url( $base_url ); ?>"
		   class="inline-flex items-center rounded-full px-5 py-2 font-body text-[0.875rem] font-semibold no-underline transition-all duration-200"
		   style="<?php echo $active_cat === 0 ? 'background:#654cff;color:#fff;' : 'background:rgba(13,13,18,0.05);color:#5c5d6d;'; ?>">
			<?php esc_html_e( 'All', 'grosharp' ); ?>
		</a>
		<?php foreach ( $categories as $cat ) :
			$is_active = ( $active_cat === $cat->term_id );
		?>
			<a href="<?php echo esc_url( add_query_arg( 'cat', $cat->term_id, $base_url ) ); ?>"
			   class="inline-flex items-center rounded-full px-5 py-2 font-body text-[0.875rem] font-semibold no-underline transition-all duration-200"
			   style="<?php echo $is_active ? 'background:#654cff;color:#fff;' : 'background:rgba(13,13,18,0.05);color:#5c5d6d;'; ?>">
				<?php echo esc_html( $cat->name ); ?>
			</a>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<!-- ── Cards grid ─────────────────────────────────────────────────────── -->
	<div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">

	<?php if ( $query->have_posts() ) :
		$i = 0;
		while ( $query->have_posts() ) :
			$query->the_post();
			$pid       = get_the_ID();
			$cats      = get_the_category();
			$cat_name  = ! empty( $cats ) ? $cats[0]->name : '';
			$cat_url   = ! empty( $cats ) ? get_category_link( $cats[0]->term_id ) : '';
			$cat_style = grosharp_cat_style( $cat_name, $cat_color_map );
			$thumb     = get_the_post_thumbnail_url( $pid, 'grosharp-card-lg' );
			$gradient  = $gradients[ $i % count( $gradients ) ];
			$author    = get_the_author();
			$author_id = get_post_field( 'post_author', $pid );
			$avatar    = get_avatar_url( $author_id, array( 'size' => 40 ) );
			$read_time = grosharp_read_time( $pid );
	?>
		<article class="group flex flex-col overflow-hidden rounded-[20px] border border-black/[0.06] bg-white shadow-[0_4px_20px_rgba(101,76,255,0.05)] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_48px_rgba(101,76,255,0.12)]"
		         data-gs-bg-card>

			<!-- Thumbnail -->
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

			<!-- Body -->
			<div class="flex flex-1 flex-col p-6 md:p-7">

				<!-- Category + date -->
				<div class="mb-3.5 flex flex-wrap items-center gap-2.5">
					<?php if ( $cat_name ) : ?>
						<a href="<?php echo esc_url( $cat_url ); ?>"
						   class="inline-flex items-center rounded-full px-3 py-1 font-body text-[0.75rem] font-semibold no-underline"
						   style="<?php echo esc_attr( $cat_style ); ?>">
							<?php echo esc_html( $cat_name ); ?>
						</a>
					<?php endif; ?>
					<span class="font-body text-[0.8125rem] text-[#9a9ab0]">
						<?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
					</span>
				</div>

				<!-- Title -->
				<h3 class="font-heading text-[1.125rem] font-bold leading-snug tracking-[-0.015em] text-[#0d0d12] transition-colors duration-200 group-hover:text-[#654cff] md:text-[1.1875rem]">
					<a href="<?php the_permalink(); ?>" class="no-underline">
						<?php the_title(); ?>
					</a>
				</h3>

				<!-- Excerpt -->
				<p class="mt-2.5 line-clamp-2 flex-1 font-body text-[0.9rem] leading-relaxed text-[#5c5d6d]">
					<?php echo esc_html( wp_trim_words( get_the_excerpt() ?: wp_strip_all_tags( get_the_content() ), 20, '…' ) ); ?>
				</p>

				<!-- Author + read time -->
				<div class="mt-5 flex items-center gap-3 border-t border-black/[0.06] pt-4">
					<img src="<?php echo esc_url( $avatar ); ?>"
					     alt="<?php echo esc_attr( $author ); ?>"
					     class="h-8 w-8 flex-none rounded-full object-cover"
					     loading="lazy" />
					<div class="flex flex-1 items-center justify-between gap-2">
						<span class="font-body text-[0.8125rem] font-semibold text-[#0d0d12]">
							<?php echo esc_html( $author ); ?>
						</span>
						<span class="font-body text-[0.8125rem] text-[#9a9ab0]">
							<?php echo esc_html( $read_time ); ?> <?php esc_html_e( 'min read', 'grosharp' ); ?>
						</span>
					</div>
				</div>

			</div>
		</article>

	<?php $i++; endwhile; wp_reset_postdata();

	else : /* Fallback */ ?>
		<?php foreach ( $fallback as $idx => $post ) :
			$cat_style = grosharp_cat_style( $post['category'], $cat_color_map );
		?>
			<article class="group flex flex-col overflow-hidden rounded-[20px] border border-black/[0.06] bg-white shadow-[0_4px_20px_rgba(101,76,255,0.05)] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_48px_rgba(101,76,255,0.12)]"
			         data-gs-bg-card>
				<div class="relative aspect-[16/10] overflow-hidden">
					<div class="h-full w-full" style="background:<?php echo esc_attr( $post['gradient'] ); ?>;"></div>
				</div>
				<div class="flex flex-1 flex-col p-6 md:p-7">
					<div class="mb-3.5 flex flex-wrap items-center gap-2.5">
						<span class="inline-flex items-center rounded-full px-3 py-1 font-body text-[0.75rem] font-semibold"
						      style="<?php echo esc_attr( $cat_style ); ?>">
							<?php echo esc_html( $post['category'] ); ?>
						</span>
						<span class="font-body text-[0.8125rem] text-[#9a9ab0]"><?php echo esc_html( $post['date'] ); ?></span>
					</div>
					<h3 class="font-heading text-[1.125rem] font-bold leading-snug tracking-[-0.015em] text-[#0d0d12] md:text-[1.1875rem]">
						<?php echo esc_html( $post['title'] ); ?>
					</h3>
					<p class="mt-2.5 line-clamp-2 flex-1 font-body text-[0.9rem] leading-relaxed text-[#5c5d6d]">
						<?php echo esc_html( $post['excerpt'] ); ?>
					</p>
					<div class="mt-5 flex items-center gap-3 border-t border-black/[0.06] pt-4">
						<div class="flex h-8 w-8 flex-none items-center justify-center rounded-full bg-[rgba(101,76,255,0.1)] font-heading text-[0.6875rem] font-bold text-[#654cff]">
							<?php echo esc_html( mb_strtoupper( mb_substr( $post['author'], 0, 2 ) ) ); ?>
						</div>
						<div class="flex flex-1 items-center justify-between gap-2">
							<span class="font-body text-[0.8125rem] font-semibold text-[#0d0d12]"><?php echo esc_html( $post['author'] ); ?></span>
							<span class="font-body text-[0.8125rem] text-[#9a9ab0]"><?php echo esc_html( $post['read_time'] ); ?> <?php esc_html_e( 'min read', 'grosharp' ); ?></span>
						</div>
					</div>
				</div>
			</article>
		<?php endforeach; ?>
	<?php endif; ?>

	</div><!-- /.grid -->

	<?php
	/* ── Pagination ──────────────────────────────────────────────────────── */
	$total_pages = $query->max_num_pages;
	if ( $total_pages > 1 ) :
		$current = max( 1, $paged );
	?>
	<nav class="mt-14 flex items-center justify-center gap-2" aria-label="<?php esc_attr_e( 'Posts pagination', 'grosharp' ); ?>">
		<?php if ( $current > 1 ) : ?>
			<a href="<?php echo esc_url( add_query_arg( array( 'paged' => $current - 1, 'cat' => $active_cat ?: null ), $base_url ) ); ?>"
			   class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-black/10 font-body text-[0.875rem] text-[#0d0d12] no-underline transition-all duration-200 hover:border-[#654cff] hover:bg-[#654cff] hover:text-white">
				←
			</a>
		<?php endif; ?>

		<?php for ( $p = 1; $p <= $total_pages; $p++ ) :
			$is_cur = ( $p === $current );
		?>
			<a href="<?php echo esc_url( add_query_arg( array( 'paged' => $p, 'cat' => $active_cat ?: null ), $base_url ) ); ?>"
			   class="inline-flex h-10 min-w-[2.5rem] items-center justify-center rounded-full px-3 font-body text-[0.875rem] font-semibold no-underline transition-all duration-200"
			   style="<?php echo $is_cur ? 'background:#654cff;color:#fff;border:2px solid #654cff;' : 'border:1px solid rgba(13,13,18,0.1);color:#0d0d12;'; ?>"
			   <?php echo $is_cur ? 'aria-current="page"' : ''; ?>>
				<?php echo esc_html( $p ); ?>
			</a>
		<?php endfor; ?>

		<?php if ( $current < $total_pages ) : ?>
			<a href="<?php echo esc_url( add_query_arg( array( 'paged' => $current + 1, 'cat' => $active_cat ?: null ), $base_url ) ); ?>"
			   class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-black/10 font-body text-[0.875rem] text-[#0d0d12] no-underline transition-all duration-200 hover:border-[#654cff] hover:bg-[#654cff] hover:text-white">
				→
			</a>
		<?php endif; ?>
	</nav>
	<?php endif; ?>

</div>
</section>
