<?php
/**
 * Testimonials block render template.
 *
 * @package GrosharpCore
 */

$eyebrow = $attributes['eyebrow'] ?? __( 'Client stories', 'grosharp' );
$heading = $attributes['heading'] ?? __( 'What clients say about working with us', 'grosharp' );
$text    = $attributes['text'] ?? __( 'Proof from teams that trusted Grosharp to build, design, and grow their digital presence.', 'grosharp' );

$query = new WP_Query(
	array(
		'post_type'      => 'grosharp_testimonial',
		'posts_per_page' => absint( $attributes['count'] ?? 3 ),
		'post_status'    => 'publish',
	)
);

$fallback_testimonials = array(
	array(
		'quote'   => __( 'Grosharp completely transformed how we present ourselves online. Within two months of launch, our inbound lead volume doubled. The team brought ideas we never would have thought of.', 'grosharp' ),
		'name'    => 'Sarah Okeke',
		'role'    => 'CEO',
		'company' => 'Elevance',
		'initials' => 'SO',
		'color'   => 'bg-violet-100 text-violet-700',
	),
	array(
		'quote'   => __( "We hired Grosharp for SEO and ended up getting a full content strategy that changed how we think about our brand. Six months later, organic traffic is up 148%. Couldn't be happier.", 'grosharp' ),
		'name'    => 'James Whitfield',
		'role'    => 'Head of Marketing',
		'company' => 'Foliocraft',
		'initials' => 'JW',
		'color'   => 'bg-blue-100 text-blue-700',
	),
	array(
		'quote'   => __( "The new client portal Grosharp built replaced a tool we'd been struggling with for years. Launch week, support tickets dropped 40%. Fast, reliable, and they actually listened to what we needed.", 'grosharp' ),
		'name'    => 'Priya Nair',
		'role'    => 'Product Manager',
		'company' => 'Meridian',
		'initials' => 'PN',
		'color'   => 'bg-emerald-100 text-emerald-700',
	),
);

$star_svg = '<svg width="16" height="16" viewBox="0 0 24 24" fill="#f59e0b" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-testimonials bg-[#f8f9fc] py-24 md:py-32' ) ); ?>>
	<div class="gs-container">

		<!-- Section header -->
		<div class="gs-reveal mx-auto mb-16 max-w-3xl text-center">
			<p class="inline-flex items-center gap-2 rounded-full border border-[#654cff]/15 bg-[#654cff]/[0.06] px-4 py-1.5 text-xs font-semibold uppercase tracking-widest text-[#654cff]">
				<?php echo esc_html( $eyebrow ); ?>
			</p>
			<h2 class="mt-5 font-heading text-[38px] font-semibold leading-[1.06] tracking-[-0.02em] text-[#0d0d12] sm:text-[50px]">
				<?php echo esc_html( $heading ); ?>
			</h2>
			<p class="mx-auto mt-5 max-w-2xl text-lg leading-relaxed text-[#5c5d6d]">
				<?php echo esc_html( $text ); ?>
			</p>
		</div>

		<!-- Testimonial cards -->
		<div class="grid gap-6 md:grid-cols-3">
			<?php if ( $query->have_posts() ) : ?>
				<?php
				$i = 0;
				while ( $query->have_posts() ) :
					$query->the_post();
					$color = $fallback_testimonials[ $i % count( $fallback_testimonials ) ]['color'] ?? 'bg-violet-100 text-violet-700';
					$initials = strtoupper( substr( get_the_title(), 0, 2 ) );
					?>
					<article class="gs-reveal flex flex-col rounded-[28px] border border-black/[0.06] bg-white p-8 shadow-[0_2px_20px_rgba(0,0,0,0.04)]">
						<!-- Stars -->
						<div class="mb-5 flex gap-0.5">
							<?php for ( $s = 0; $s < 5; $s++ ) : ?>
								<?php echo $star_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php endfor; ?>
						</div>
						<!-- Quote mark -->
						<p class="grow text-base leading-relaxed text-[#3a3a4a]">
							"<?php echo wp_kses_post( get_the_content() ?: get_the_excerpt() ); ?>"
						</p>
						<!-- Attribution -->
						<div class="mt-7 flex items-center gap-4 border-t border-black/[0.06] pt-6">
							<div class="flex h-11 w-11 flex-none items-center justify-center rounded-full font-heading text-sm font-bold <?php echo esc_attr( $color ); ?>">
								<?php echo esc_html( $initials ); ?>
							</div>
							<div>
								<p class="font-heading text-sm font-semibold text-[#0d0d12]"><?php the_title(); ?></p>
							</div>
						</div>
					</article>
					<?php
					$i++;
				endwhile;
				wp_reset_postdata();
				?>

			<?php else : ?>
				<?php foreach ( $fallback_testimonials as $t ) : ?>
					<article class="gs-reveal flex flex-col rounded-[28px] border border-black/[0.06] bg-white p-8 shadow-[0_2px_20px_rgba(0,0,0,0.04)]">
						<!-- Stars -->
						<div class="mb-5 flex gap-0.5">
							<?php for ( $s = 0; $s < 5; $s++ ) : ?>
								<?php echo $star_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php endfor; ?>
						</div>
						<!-- Quote -->
						<p class="grow text-base leading-relaxed text-[#3a3a4a]">
							"<?php echo esc_html( $t['quote'] ); ?>"
						</p>
						<!-- Attribution -->
						<div class="mt-7 flex items-center gap-4 border-t border-black/[0.06] pt-6">
							<div class="flex h-11 w-11 flex-none items-center justify-center rounded-full font-heading text-sm font-bold <?php echo esc_attr( $t['color'] ); ?>">
								<?php echo esc_html( $t['initials'] ); ?>
							</div>
							<div>
								<p class="font-heading text-sm font-semibold text-[#0d0d12]"><?php echo esc_html( $t['name'] ); ?></p>
								<p class="text-xs text-[#9a9ab0]"><?php echo esc_html( $t['role'] . ' · ' . $t['company'] ); ?></p>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

	</div>
</section>
