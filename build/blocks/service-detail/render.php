<?php
/**
 * Service Detail block — single service content section.
 *
 * Renders on single grosharp_service posts:
 *   1. Post content (intro body text from editor)
 *   2. Two-column: key features checklist (left) + stats row + detail text (right)
 *   3. Full-width featured image
 *
 * ACF fields (free): service_key_features, service_detail_text
 * Falls back gracefully if ACF is not active.
 *
 * @package GrosharpCore
 */

// is_singular() reads the main WP_Query — safe in FSE context.
if ( ! is_singular( 'grosharp_service' ) ) {
	return;
}

// FSE-safe: get_queried_object_id() reads main WP_Query, not global $post
$post_id = get_queried_object_id() ?: get_the_ID();
$acf     = function_exists( 'get_field' );

// ── Key features (newline-separated textarea) ─────────────────────────────
$features_raw = $acf
	? (string) get_field( 'service_key_features', $post_id )
	: (string) get_post_meta( $post_id, 'service_key_features', true );
$features = array_values( array_filter( array_map( 'trim', explode( "\n", $features_raw ) ) ) );

// ── Detail text ───────────────────────────────────────────────────────────
$detail_text = $acf
	? (string) get_field( 'service_detail_text', $post_id )
	: (string) get_post_meta( $post_id, 'service_detail_text', true );

// ── Post content ─────────────────────────────────────────────────────────
$post_content = apply_filters( 'the_content', get_post_field( 'post_content', $post_id ) );

// ── Featured image ────────────────────────────────────────────────────────
$thumb_url = (string) get_the_post_thumbnail_url( $post_id, 'grosharp-hero' );
$thumb_alt = esc_attr( get_the_title() );

$has_content  = ! empty( trim( strip_tags( $post_content ) ) );
$has_features = ! empty( $features );
$has_right    = ! empty( $detail_text );
$has_image    = ! empty( $thumb_url );
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-service-detail bg-white' ) ); ?> data-gs-service-detail>

	<div class="gs-container">

		<?php if ( $has_content ) : ?>
			<!-- ── Post content intro ──────────────────────────────────────── -->
			<div class="max-w-[780px] mb-14 lg:mb-20" data-sd-intro>
				<div class="font-body text-[1.0625rem] leading-[1.85] text-[#4a4b5a] [&>p]:mb-5 [&>p:last-child]:mb-0 [&>h2]:font-heading [&>h2]:text-[1.5rem] [&>h2]:font-bold [&>h2]:text-brand-dark [&>h2]:mb-3 [&>ul]:mb-5 [&>ul]:pl-5">
					<?php echo wp_kses_post( $post_content ); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $has_features || $has_right ) : ?>
			<!-- ── Features + Stats two-column ────────────────────────────── -->
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 mb-14 lg:mb-20">

				<?php if ( $has_features ) : ?>
					<!-- Left: key features -->
					<div data-sd-features>
						<p class="font-body text-[0.75rem] font-semibold uppercase tracking-[0.08em] text-brand-violet mb-5">
							<?php esc_html_e( "What's Included", 'grosharp' ); ?>
						</p>
						<ul class="flex flex-col gap-3 m-0 p-0 list-none" role="list">
							<?php foreach ( $features as $feature ) : ?>
								<li class="flex items-start gap-3 font-body text-[0.9375rem] leading-[1.65] text-[#3d3e4e]">
									<span class="mt-[3px] flex-shrink-0 w-5 h-5 rounded-full bg-[var(--grosharp-violet-10)] flex items-center justify-center" aria-hidden="true">
										<svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M1 4.5L3.8 7.5L10 1" stroke="var(--grosharp-primary)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</span>
									<?php echo esc_html( $feature ); ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if ( $has_right ) : ?>
					<!-- Right: detail text -->
					<div class="flex flex-col gap-8" data-sd-right>

						<?php if ( $detail_text ) : ?>
							<div class="rounded-2xl bg-[var(--grosharp-violet-05)] border border-[var(--grosharp-violet-10)] p-6 lg:p-8">
								<p class="font-body text-[0.9375rem] leading-[1.75] text-brand-muted m-0">
									<?php echo esc_html( $detail_text ); ?>
								</p>
							</div>
						<?php endif; ?>

					</div>
				<?php endif; ?>

			</div>
		<?php endif; ?>

		<?php if ( $has_image ) : ?>
			<!-- ── Full-width featured image ───────────────────────────────── -->
			<figure class="m-0 overflow-hidden rounded-2xl lg:rounded-[1.75rem]" data-sd-image style="aspect-ratio: 16/7;">
				<img src="<?php echo esc_url( $thumb_url ); ?>"
				     alt="<?php echo esc_attr( $thumb_alt ); ?>"
				     class="w-full h-full object-cover"
				     loading="lazy"
				     decoding="async" />
			</figure>
		<?php endif; ?>

	</div>

</section>
