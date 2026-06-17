<?php
/**
 * Post Author Card block.
 * Pulls author data from WP user profile.
 *
 * @package GrosharpCore
 */

$post_id   = get_the_ID() ?: get_queried_object_id();
$post      = get_post( $post_id );
if ( ! $post ) { return; }

$author_id    = (int) $post->post_author;
$name         = get_the_author_meta( 'display_name', $author_id );
$bio          = get_the_author_meta( 'description',  $author_id );
$avatar_url   = get_avatar_url( $author_id, array( 'size' => 96 ) );
$author_url   = get_author_posts_url( $author_id );
$post_count   = count_user_posts( $author_id, 'post' );
?>

<div <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-post-author-card' ) ); ?>
     style="padding:3rem 0 0;">
	<div class="gs-container">
		<div class="flex flex-col gap-5 rounded-[1.5rem] border border-black/[0.08] bg-[#fafafa] p-6 sm:flex-row sm:items-start sm:gap-7 md:p-8"
		     data-gs-author-card>

			<!-- Avatar -->
			<a href="<?php echo esc_url( $author_url ); ?>" class="flex-none no-underline" tabindex="-1" aria-hidden="true">
				<img src="<?php echo esc_url( $avatar_url ); ?>"
				     alt="<?php echo esc_attr( $name ); ?>"
				     class="h-20 w-20 rounded-full object-cover ring-2 ring-white ring-offset-2"
				     style="box-shadow:0 4px 16px rgba(101,76,255,0.12);"
				     loading="lazy" />
			</a>

			<!-- Info -->
			<div class="flex-1 min-w-0">
				<h3 class="font-heading text-[1.25rem] font-bold tracking-[-0.02em] text-[#0d0d12] mt-0 mb-2">
					<a href="<?php echo esc_url( $author_url ); ?>" class="no-underline hover:text-[#654cff] transition-colors duration-200">
						<?php echo esc_html( $name ); ?>
					</a>
				</h3>

				<?php if ( $bio ) : ?>
					<p class="font-body text-[0.9375rem] leading-[1.7] text-[#5c5d6d] m-0">
						<?php echo esc_html( $bio ); ?>
					</p>
				<?php endif; ?>

				<!-- Author posts link -->
				<a href="<?php echo esc_url( $author_url ); ?>"
				   class="mt-4 inline-flex items-center gap-2 font-body text-[0.875rem] font-semibold text-[#654cff] no-underline hover:gap-3 transition-all duration-200">
					<?php
					/* translators: %d = number of articles */
					echo esc_html( sprintf( _n( 'View %d article', 'View all %d articles', $post_count, 'grosharp' ), $post_count ) );
					?>
					<span aria-hidden="true">→</span>
				</a>
			</div>

		</div>
	</div>
</div>
