<?php
/**
 * Project Results block — editorial metric cards.
 *
 * Card layout matches "What We Stand For" (about-values):
 * white card · violet border · hover lift · ghost value in corner · title + desc.
 *
 * ACF repeater fields per row:
 *   result_value       — e.g. "24", "65", "3.2×"
 *   result_label       — e.g. "Unique Screens Designed"
 *   result_description — e.g. "Covering onboarding, card setup, payments…"
 *
 * @package GrosharpCore
 */

$post_id = get_the_ID();
if ( ! $post_id ) {
	$post_id = get_queried_object_id();
}

/* ── Parse textarea — one card per line, fields separated by " : " ─────── */
$items = array();

if ( function_exists( 'get_field' ) ) {
	$raw_text = (string) get_field( 'project_results', $post_id );
	if ( $raw_text ) {
		$lines = array_filter( array_map( 'trim', explode( "\n", $raw_text ) ) );
		foreach ( $lines as $line ) {
			/* Allow both " : " and " | " as in-line separators */
			$parts = array_map( 'trim', explode( ' : ', $line, 3 ) );
			if ( count( $parts ) >= 2 && $parts[0] ) {
				$items[] = array(
					'result_value'       => $parts[0],
					'result_label'       => $parts[1] ?? '',
					'result_description' => $parts[2] ?? '',
				);
			}
		}
	}
}

/* ── Fallback copy ───────────────────────────────────────────────────────── */
if ( empty( $items ) ) {
	$items = array(
		array(
			'result_value'       => '24',
			'result_label'       => 'Unique Screens Designed',
			'result_description' => 'Covering onboarding, card setup, payments, and smart investment flows.',
		),
		array(
			'result_value'       => '65',
			'result_label'       => 'Custom UI Components',
			'result_description' => 'Built to increase speed, clarity, and confidence across every interaction.',
		),
		array(
			'result_value'       => '100%',
			'result_label'       => 'Mobile-First Experience',
			'result_description' => 'Designed for users who handle money decisions from their pocket, not a desktop.',
		),
	);
}
$count = count( $items );

/* ── Grid columns ────────────────────────────────────────────────────────── */
$col_class = match ( true ) {
	$count <= 2 => 'grid-cols-1 md:grid-cols-2',
	$count === 4 => 'grid-cols-1 md:grid-cols-2',
	default     => 'grid-cols-1 md:grid-cols-3',
};
?>

<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-project-results bg-[#f4f3ff] py-14 lg:py-20' ) ); ?>>
	<div class="gs-container">

		<!-- Section header -->
		<div class="mb-10 lg:mb-14 max-w-[520px]">
			<p class="inline-flex items-center gap-2 rounded-full border border-[rgba(101,76,255,0.2)] bg-[rgba(101,76,255,0.07)] px-4 py-1.5 font-body text-[0.75rem] font-semibold uppercase tracking-[0.09em] text-[#654cff] mb-4"
			   data-gs-pr-eyebrow>
				<span class="inline-block h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
				<?php esc_html_e( 'Results & Metrics', 'grosharp' ); ?>
			</p>
			<h2 class="font-heading text-[clamp(1.75rem,3.5vw,2.5rem)] font-extrabold leading-[1.1] tracking-[-0.035em] text-[#0d0d12] m-0"
			    data-gs-pr-heading>
				<?php esc_html_e( 'Impact measured.', 'grosharp' ); ?>
			</h2>
		</div>

		<!-- Cards grid -->
		<div class="grid <?php echo esc_attr( $col_class ); ?> gap-4 md:gap-5">

			<?php foreach ( $items as $idx => $item ) :
				$value = trim( $item['result_value']       ?? '' );
				$label = trim( $item['result_label']       ?? '' );
				$desc  = trim( $item['result_description'] ?? '' );
				if ( ! $value ) { continue; }

				$ordinal = sprintf( '%02d', $idx + 1 );
			?>
				<div class="relative overflow-hidden rounded-2xl md:rounded-[1.5rem] border border-[rgba(101,76,255,0.12)] bg-white p-6 md:p-10 transition-all duration-300 hover:border-[rgba(101,76,255,0.35)] hover:shadow-[0_12px_40px_rgba(101,76,255,0.1)] hover:-translate-y-[3px]"
				     data-gs-value-card>

					<!-- Ghost value — large, top-right -->
					<span class="pointer-events-none select-none absolute -top-2 right-3 font-heading font-black leading-none tracking-[-0.05em]"
					      style="font-size:clamp(4.5rem,9vw,7rem);color:rgba(101,76,255,0.05);"
					      aria-hidden="true">
						<?php echo esc_html( $value ); ?>
					</span>

					<!-- Ordinal pill -->
					<div class="inline-flex items-center justify-center w-[48px] h-[48px] md:w-[52px] md:h-[52px] rounded-[12px] md:rounded-[14px] bg-[rgba(101,76,255,0.08)] border border-[rgba(101,76,255,0.15)] text-[#654cff] font-heading font-bold text-[0.875rem] about-value-icon">
						<?php echo esc_html( $ordinal ); ?>
					</div>

					<!-- Metric title -->
					<h3 class="font-heading text-[1.125rem] md:text-[1.25rem] font-bold tracking-[-0.02em] text-[#0d0d12] leading-[1.25] mt-4 md:mt-5 mb-0">
						<?php echo esc_html( $label ); ?>
					</h3>

					<!-- Description -->
					<?php if ( $desc ) : ?>
						<p class="font-body text-[0.875rem] md:text-[0.9375rem] leading-[1.75] text-[#5c5d6d] mt-2 md:mt-3 mb-0">
							<?php echo esc_html( $desc ); ?>
						</p>
					<?php endif; ?>

				</div>

			<?php endforeach; ?>

		</div>

	</div>
</section>
