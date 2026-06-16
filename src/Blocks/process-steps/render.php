<?php
/**
 * Process Steps block render template.
 *
 * Horizontal timeline layout: number circle + connector line, then title + description.
 * 3 items = 3 columns, 4 items = 4 columns — all in one row.
 * Numbers auto-generated from index.
 *
 * @package GrosharpCore
 */

$eyebrow = $attributes['eyebrow'] ?? __( 'How We Work', 'grosharp' );
$heading = $attributes['heading'] ?? __( 'A focused workflow from brief to results', 'grosharp' );
$text    = $attributes['text']    ?? __( 'Every engagement follows a clear, repeatable process that keeps you informed and confident at every milestone.', 'grosharp' );

$default_steps = array(
	array(
		'title' => __( 'Discover', 'grosharp' ),
		'text'  => __( 'Deep-dive sessions to understand your business, audience, and goals. We eliminate assumptions and ground every decision in real insight.', 'grosharp' ),
	),
	array(
		'title' => __( 'Strategy', 'grosharp' ),
		'text'  => __( 'We craft a focused blueprint — architecture, design direction, content hierarchy, and a marketing foundation tailored to your goals.', 'grosharp' ),
	),
	array(
		'title' => __( 'Design & Build', 'grosharp' ),
		'text'  => __( 'Design and development in short feedback cycles, sharing progress early and often. Quality runs in parallel, not at the end.', 'grosharp' ),
	),
);

$steps = ( isset( $attributes['steps'] ) && is_array( $attributes['steps'] ) && ! empty( $attributes['steps'] ) )
	? array_slice( $attributes['steps'], 0, 4 )
	: $default_steps;

$count = count( $steps );
?>
<style>
.gs-process-timeline {
	display: grid;
	grid-template-columns: repeat(<?php echo (int) $count; ?>, 1fr);
	gap: 0;
}
@media (max-width: 767px) {
	.gs-process-timeline { grid-template-columns: 1fr; }
	.gs-process-connector { display: none; }
}
</style>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-process bg-white py-[clamp(3rem,6vw,5rem)]' ) ); ?>>
	<div class="gs-container">
		<div class="rounded-[28px] bg-[#f4f3ff] px-6 pt-16 pb-[72px] md:px-14">

			<!-- ── Section header ────────────────────────────────────────────── -->
			<div class="mx-auto mb-14 max-w-2xl text-center" data-gs-step-header>

				<p class="inline-flex items-center gap-2 rounded-full border border-[rgba(101,76,255,0.2)] bg-[rgba(101,76,255,0.07)] px-4 py-1.5 font-body text-[0.75rem] font-semibold uppercase tracking-[0.08em] text-[#654cff]" data-gs-eyebrow>
					<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
					<?php echo esc_html( $eyebrow ); ?>
				</p>

				<h2 class="mt-5 font-heading text-[clamp(1.75rem,3.5vw,2.75rem)] font-extrabold leading-[1.1] tracking-[-0.03em] text-[#0d0d12]">
					<?php echo esc_html( $heading ); ?>
				</h2>

				<p class="mt-4 font-body text-[1rem] leading-[1.75] text-[#5c5d6d] max-w-[52ch] mx-auto">
					<?php echo esc_html( $text ); ?>
				</p>

			</div>

			<!-- ── Horizontal timeline ─────────────────────────────────────── -->
			<div class="gs-process-timeline" data-gs-process-steps>

				<?php foreach ( $steps as $index => $step ) :
					$num     = str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT );
					$is_last = ( $index === $count - 1 );
				?>
				<div class="relative flex flex-col px-6 first:pl-0 last:pr-0 <?php echo ! $is_last ? 'border-r border-[rgba(13,13,18,0.08)]' : ''; ?>" data-gs-step>

					<!-- ── Timeline node: circle + connector ─────────────────── -->
					<div class="mb-8 flex items-center gap-4">
						<div class="flex h-12 w-12 flex-none items-center justify-center rounded-full border border-[rgba(101,76,255,0.25)] bg-[rgba(101,76,255,0.08)] font-heading text-[0.9375rem] font-bold text-[#654cff]">
							<?php echo esc_html( $num ); ?>
						</div>
						<?php if ( ! $is_last ) : ?>
						<div class="gs-process-connector h-px flex-1 bg-[rgba(13,13,18,0.08)]"></div>
						<?php else : ?>
						<div class="flex-1"></div>
						<?php endif; ?>
					</div>

					<!-- ── Step content ──────────────────────────────────────── -->
					<div class="flex-1">

						<h3 class="font-heading text-[1.125rem] font-bold leading-[1.2] tracking-[-0.02em] text-[#0d0d12]">
							<?php echo esc_html( $step['title'] ?? '' ); ?>
						</h3>

						<?php if ( ! empty( $step['text'] ) ) : ?>
						<p class="mt-3 font-body text-[0.9375rem] leading-[1.75] text-[#5c5d6d]">
							<?php echo esc_html( $step['text'] ); ?>
						</p>
						<?php endif; ?>

					</div>

				</div>
				<?php endforeach; ?>

			</div>

		</div>
	</div>
</section>
