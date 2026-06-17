<?php
/**
 * Post Meta Bar block — author, date, read time, category.
 * Sits directly below the post-hero on single posts.
 *
 * @package GrosharpCore
 */

$post_id   = get_the_ID() ?: get_queried_object_id();
$post      = get_post( $post_id );
if ( ! $post ) { return; }

/* ── Author ──────────────────────────────────────────────────────────────── */
$author_id   = (int) $post->post_author;
$author_name = get_the_author_meta( 'display_name', $author_id );
$avatar_url  = get_avatar_url( $author_id, array( 'size' => 48 ) );

/* ── Date ────────────────────────────────────────────────────────────────── */
$date         = get_the_date( 'M j, Y', $post_id );
$date_iso     = get_the_date( 'c',      $post_id );

/* ── Read time ───────────────────────────────────────────────────────────── */
$words     = str_word_count( wp_strip_all_tags( $post->post_content ) );
$read_time = max( 1, (int) ceil( $words / 200 ) );

/* ── Category ────────────────────────────────────────────────────────────── */
$cats     = get_the_category( $post_id );
$cat      = ! empty( $cats ) ? $cats[0] : null;
$cat_name = $cat ? $cat->name : '';
$cat_url  = $cat ? get_category_link( $cat->term_id ) : '';

$cat_color_map = array(
	'Design'      => array( 'bg' => '#f0e9ff', 'text' => '#4f39c7' ),
	'Development' => array( 'bg' => '#e8f4ff', 'text' => '#1d4ed8' ),
	'Marketing'   => array( 'bg' => '#f0fdf4', 'text' => '#065f46' ),
	'Strategy'    => array( 'bg' => '#fff7ed', 'text' => '#9a3412' ),
	'Branding'    => array( 'bg' => '#fef3c7', 'text' => '#92400e' ),
	'News'        => array( 'bg' => '#f4f4f5', 'text' => '#3f3f46' ),
);
$cat_c = $cat_color_map[ $cat_name ] ?? array( 'bg' => '#f4f4f5', 'text' => '#3f3f46' );
?>

<div <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-post-meta-bar' ) ); ?>
     style="background:#ffffff;border-bottom:1px solid rgba(13,13,18,0.07);padding:1.25rem 0;">
	<div class="gs-container">
		<div class="flex flex-wrap items-center gap-x-6 gap-y-3" data-gs-pmb>

			<!-- Date -->
			<time datetime="<?php echo esc_attr( $date_iso ); ?>"
			      class="font-body text-[0.875rem] text-[#9a9ab0]">
				<?php echo esc_html( $date ); ?>
			</time>

			<!-- Divider -->
			<span class="hidden h-4 w-px bg-black/10 sm:block" aria-hidden="true"></span>

			<!-- Read time -->
			<span class="font-body text-[0.875rem] text-[#9a9ab0]">
				<?php echo esc_html( $read_time ); ?> <?php esc_html_e( 'min read', 'grosharp' ); ?>
			</span>

			<!-- Category -->
			<?php if ( $cat_name ) : ?>
				<span class="hidden h-4 w-px bg-black/10 sm:block" aria-hidden="true"></span>
				<a href="<?php echo esc_url( $cat_url ); ?>"
				   class="inline-flex items-center rounded-full px-3.5 py-1 font-body text-[0.75rem] font-semibold no-underline"
				   style="background:<?php echo esc_attr( $cat_c['bg'] ); ?>;color:<?php echo esc_attr( $cat_c['text'] ); ?>;">
					<?php echo esc_html( $cat_name ); ?>
				</a>
			<?php endif; ?>

		</div>
	</div>
</div>
