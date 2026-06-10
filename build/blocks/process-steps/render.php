<?php
/**
 * Process steps block render template.
 *
 * @package GrosharpCore
 */

$eyebrow = $attributes['eyebrow'] ?? __( 'How we work', 'grosharp' );
$heading = $attributes['heading'] ?? __( 'A focused workflow from brief to results', 'grosharp' );
$text    = $attributes['text'] ?? __( 'Every Grosharp engagement follows a clear process — strategic, intentional, and accountable at every step.', 'grosharp' );

$steps = isset( $attributes['steps'] ) && is_array( $attributes['steps'] ) && ! empty( $attributes['steps'] )
	? $attributes['steps']
	: array(
		array(
			'title' => __( 'Discover', 'grosharp' ),
			'text'  => __( 'We map your goals, audience, competitive landscape, and growth opportunities before writing a line of code or crafting a pixel.', 'grosharp' ),
		),
		array(
			'title' => __( 'Strategy', 'grosharp' ),
			'text'  => __( 'We shape a focused plan — site architecture, design direction, and marketing foundations aligned to your specific business goals.', 'grosharp' ),
		),
		array(
			'title' => __( 'Build', 'grosharp' ),
			'text'  => __( 'We design and develop in short cycles, keeping you involved at every stage and adjusting in real time as the project evolves.', 'grosharp' ),
		),
		array(
			'title' => __( 'Launch & Grow', 'grosharp' ),
			'text'  => __( 'We launch with confidence, then track performance and iterate — pushing results further and further over time.', 'grosharp' ),
		),
	);

$count     = count( $steps );
$grid_cols = 4 === $count ? 'lg:grid-cols-4' : ( 3 === $count ? 'lg:grid-cols-3' : 'lg:grid-cols-2' );
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-process bg-[#f8f9fc] py-24 md:py-32' ) ); ?>>
	<div class="gs-container">

		<!-- Section header -->
		<div class="gs-reveal mx-auto mb-20 max-w-3xl text-center">
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

		<!-- Steps -->
		<div class="relative grid gap-10 sm:grid-cols-2 <?php echo esc_attr( $grid_cols ); ?>">

			<!-- Connecting line (desktop, sits behind step circles) -->
			<div class="absolute left-0 right-0 top-[26px] hidden h-px bg-gradient-to-r from-transparent via-[#654cff]/20 to-transparent lg:block" aria-hidden="true"></div>

			<?php foreach ( $steps as $index => $step ) : ?>
				<div class="gs-reveal flex flex-col items-center text-center">

					<!-- Number circle — sits above the connecting line via bg matching section -->
					<div class="relative z-10 mb-7 flex h-[52px] w-[52px] items-center justify-center rounded-full border-2 border-[#654cff]/25 bg-[#f8f9fc] font-heading text-base font-bold text-[#654cff] shadow-[0_0_0_8px_#f8f9fc]">
						<?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>
					</div>

					<h3 class="font-heading text-[20px] font-semibold text-[#0d0d12]">
						<?php echo esc_html( $step['title'] ?? '' ); ?>
					</h3>
					<p class="mt-3 text-base leading-relaxed text-[#5c5d6d]">
						<?php echo esc_html( $step['text'] ?? '' ); ?>
					</p>
				</div>
			<?php endforeach; ?>

		</div>

	</div>
</section>
