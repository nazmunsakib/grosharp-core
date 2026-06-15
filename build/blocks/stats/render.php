<?php
/**
 * Stats block render template.
 *
 * @package GrosharpCore
 */

$items = isset( $attributes['items'] ) && is_array( $attributes['items'] )
	? $attributes['items']
	: array(
		array( 'value' => '4.9/5', 'label' => __( 'Client rating',   'grosharp' ) ),
		array( 'value' => '100%',  'label' => __( 'On-time delivery', 'grosharp' ) ),
	);

/**
 * Parse a stat value string into (prefix, number, suffix) for count-up JS.
 * Examples: "32+"  → ('', '32', '+')   "4.9/5" → ('', '4.9', '/5')
 *           "100%" → ('', '100', '%')  "3×"    → ('', '3', '×')
 */
if ( ! function_exists( 'grosharp_parse_stat' ) ) :
function grosharp_parse_stat( string $raw ): array {
	if ( preg_match( '/^([^\d]*)(\d+\.?\d*)(.*)$/', $raw, $m ) ) {
		return array( $m[1], $m[2], $m[3] );
	}
	return array( '', '', $raw );
}
endif;
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-stats bg-[#0d0d12] py-[4rem]' ) ); ?>>
	<div class="gs-container">
		<!--
			gap-px + bg-white/[0.08] on the grid creates 1px white-tinted gaps between cells.
			Each cell uses bg-[#0d0d12] to fill its area, making the gaps the only visible dividers.
		-->
		<dl class="grid grid-cols-2 gap-px overflow-hidden rounded-3xl bg-white/[0.08]">
			<?php foreach ( $items as $item ) :
				$raw              = $item['value'] ?? '';
				[ $pfx, $num, $sfx ] = grosharp_parse_stat( $raw );
			?>
				<div class="flex flex-col items-center bg-[#0d0d12] px-8 py-14 text-center" data-gs-stat>
					<dt class="font-heading text-[56px] font-semibold leading-none tracking-[-0.02em] text-white md:text-[64px]">
						<?php if ( '' !== $num ) : ?>
							<span
								data-stat-number="<?php echo esc_attr( $num ); ?>"
								data-stat-prefix="<?php echo esc_attr( $pfx ); ?>"
								data-stat-suffix="<?php echo esc_attr( $sfx ); ?>"
							><?php echo esc_html( $raw ); ?></span>
						<?php else : ?>
							<?php echo esc_html( $raw ); ?>
						<?php endif; ?>
					</dt>
					<dd class="mt-3 font-body text-[16px] font-medium uppercase tracking-widest text-[#9a9ab0]">
						<?php echo esc_html( $item['label'] ?? '' ); ?>
					</dd>
				</div>
			<?php endforeach; ?>
		</dl>
	</div>
</section>
