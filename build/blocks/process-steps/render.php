<?php
/**
 * Process steps block render template.
 *
 * @package GrosharpCore
 */

$eyebrow = $attributes['eyebrow'] ?? __( 'How We Work', 'grosharp' );
$heading = $attributes['heading'] ?? __( 'A focused workflow from brief to results', 'grosharp' );
$text    = $attributes['text'] ?? __( 'We don\'t believe in guesswork. Every Grosharp engagement follows a clear, repeatable process that keeps you informed, in control, and confident at every milestone — from the first call to post-launch growth.', 'grosharp' );

$steps = isset( $attributes['steps'] ) && is_array( $attributes['steps'] ) && ! empty( $attributes['steps'] )
	? $attributes['steps']
	: array(
		array(
			'title'       => __( 'Discover', 'grosharp' ),
			'label'       => __( 'Understanding your world', 'grosharp' ),
			'text'        => __( 'We run deep-dive sessions to understand your business model, target audience, competitive landscape, and the outcomes you want to achieve. This phase eliminates assumptions and grounds every decision in real insight.', 'grosharp' ),
			'duration'    => __( 'Week 1 – 2', 'grosharp' ),
			'deliverable' => __( 'Brand audit · Competitor analysis · Audience personas · Project brief', 'grosharp' ),
		),
		array(
			'title'       => __( 'Strategy', 'grosharp' ),
			'label'       => __( 'Building the blueprint', 'grosharp' ),
			'text'        => __( 'With research in hand, we craft a focused strategy — information architecture, design direction, content hierarchy, and a marketing foundation tailored to your goals.', 'grosharp' ),
			'duration'    => __( 'Week 3 – 4', 'grosharp' ),
			'deliverable' => __( 'Sitemap · Wireframes · Design system · Content plan', 'grosharp' ),
		),
		array(
			'title'       => __( 'Design & Build', 'grosharp' ),
			'label'       => __( 'Bringing it to life', 'grosharp' ),
			'text'        => __( 'We design and develop in short feedback cycles, sharing progress early and often. Quality assurance runs in parallel, not at the end.', 'grosharp' ),
			'duration'    => __( 'Week 5 – 10', 'grosharp' ),
			'deliverable' => __( 'High-fidelity UI · Responsive build · QA testing · Staging review', 'grosharp' ),
		),
		array(
			'title'       => __( 'Launch & Grow', 'grosharp' ),
			'label'       => __( 'Shipping and scaling', 'grosharp' ),
			'text'        => __( 'Launch day is a milestone, not the finish line. We handle deployment, performance checks, and analytics instrumentation — then stay close to push growth forward.', 'grosharp' ),
			'duration'    => __( 'Week 11+', 'grosharp' ),
			'deliverable' => __( 'Live deployment · Analytics setup · SEO baseline · Growth roadmap', 'grosharp' ),
		),
	);

$count = count( $steps );
?>
<style>
.gs-process-timeline {
	display: grid;
	grid-template-columns: repeat(<?php echo $count; ?>, 1fr);
	gap: 0;
}
@media (max-width: 767px) {
	.gs-process-timeline {
		grid-template-columns: 1fr;
	}
	.gs-process-connector {
		display: none;
	}
}
</style>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-process py-8 px-[100px]' ) ); ?>>
	<div class="rounded-[24px] bg-[#0d0d12] pt-[64px] pb-[80px]">
	<div class="gs-container">

		<!-- ── Centered section header ─────────────────────────────────────── -->
		<div class="mx-auto mb-16 max-w-2xl text-center" data-gs-step-header>

			<p class="inline-flex items-center gap-2 rounded-full border border-[#654cff]/30 bg-[#654cff]/[0.12] px-4 py-1.5 font-body text-xs font-semibold uppercase tracking-widest text-[#a78bfa]" data-gs-eyebrow>
				<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
				<?php echo esc_html( $eyebrow ); ?>
			</p>

			<h2 class="mt-6 font-heading text-[48px] font-bold leading-[53px] tracking-[-0.025em] text-white">
				<?php echo esc_html( $heading ); ?>
			</h2>

			<p class="mt-5 mb-[48px] font-body text-[20px] leading-[28px] text-white/50">
				<?php echo esc_html( $text ); ?>
			</p>

		</div>

		<!-- ── Horizontal timeline ─────────────────────────────────────────── -->
		<div class="gs-process-timeline" data-gs-process-steps>

			<?php foreach ( $steps as $index => $step ) :
				$num          = str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT );
				$is_last      = ( $index === $count - 1 );
				$deliverables = ! empty( $step['deliverable'] ) ? explode( '·', $step['deliverable'] ) : array();
			?>

			<div class="relative flex flex-col px-6 <?php echo $is_last ? '' : 'border-r border-white/[0.08]'; ?>" data-gs-step>

				<!-- ── Timeline node ──────────────────────────────────────── -->
				<div class="mb-8 flex items-center gap-4">
					<!-- Number circle -->
					<div class="flex h-12 w-12 flex-none items-center justify-center rounded-full border border-white/10 bg-white/[0.06] font-heading text-[13px] font-bold text-white">
						<?php echo esc_html( $num ); ?>
					</div>
					<!-- Connector line to next -->
					<?php if ( ! $is_last ) : ?>
					<div class="gs-process-connector h-px flex-1 bg-white/[0.08]"></div>
					<?php else : ?>
					<div class="flex-1"></div>
					<?php endif; ?>
				</div>

				<!-- ── Step content ───────────────────────────────────────── -->
				<div class="flex-1">

					<p class="mb-2 font-body text-[11px] font-semibold uppercase tracking-widest text-white/30">
						<?php echo esc_html( $step['duration'] ?? '' ); ?>
					</p>

					<h3 class="font-heading text-[20px] font-bold leading-tight tracking-[-0.02em] text-white">
						<?php echo esc_html( $step['title'] ?? '' ); ?>
					</h3>

					<?php if ( ! empty( $step['label'] ) ) : ?>
					<p class="mt-1 font-body text-[13px] italic text-[#654cff]">
						<?php echo esc_html( $step['label'] ); ?>
					</p>
					<?php endif; ?>

					<p class="mt-4 font-body text-[14px] leading-[1.75] text-white/50">
						<?php echo esc_html( $step['text'] ?? '' ); ?>
					</p>

					<?php if ( $deliverables ) : ?>
					<div class="mt-5 border-t border-white/[0.07] pt-5">
						<p class="mb-3 font-body text-[10px] font-semibold uppercase tracking-widest text-white/25">
							<?php esc_html_e( 'Deliverables', 'grosharp' ); ?>
						</p>
						<div class="flex flex-wrap gap-2">
							<?php foreach ( $deliverables as $item ) : ?>
							<span class="rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 font-body text-[11px] text-white/40">
								<?php echo esc_html( trim( $item ) ); ?>
							</span>
							<?php endforeach; ?>
						</div>
					</div>
					<?php endif; ?>

				</div>

			</div>

			<?php endforeach; ?>

		</div>

	</div>
	</div>
</section>
