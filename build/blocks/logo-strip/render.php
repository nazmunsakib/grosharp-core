<?php
/**
 * Logo strip block render template.
 *
 * @package GrosharpCore
 */

$logos = isset( $attributes['logos'] ) && is_array( $attributes['logos'] )
	? array_values( array_filter( $attributes['logos'], static fn( $l ) => ! empty( $l['imageUrl'] ) ) )
	: array();

$speed = isset( $attributes['speed'] ) ? absint( $attributes['speed'] ) : 42;

/* Nothing to render until logos are added. */
if ( empty( $logos ) ) {
	return;
}

$render_logo = static function ( array $logo ): void {
	$url = esc_url( $logo['imageUrl'] );
	$alt = esc_attr( $logo['imageAlt'] ?? '' );
	?>
	<div class="inline-flex min-w-[120px] flex-none items-center justify-center px-8 py-3 md:min-w-[160px]">
		<img
			class="max-h-9 w-auto max-w-[160px] object-contain opacity-70 grayscale transition duration-300 hover:opacity-100 hover:grayscale-0"
			src="<?php echo $url; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"
			alt="<?php echo $alt; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"
			loading="lazy"
			decoding="async"
		/>
	</div>
	<?php
};
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-logo-strip py-10 md:py-14' ) ); ?>>
	<div class="gs-container">
		<div
			class="gs-reveal overflow-hidden [mask-image:linear-gradient(90deg,transparent,black_8%,black_92%,transparent)]"
			data-gs-logo-marquee
			data-speed="<?php echo esc_attr( (string) $speed ); ?>"
		>
			<div class="flex w-max items-center" data-gs-logo-track>
				<?php foreach ( array( 0, 1 ) as $set_index ) : ?>
					<div class="flex flex-none items-center" aria-hidden="<?php echo 0 === $set_index ? 'false' : 'true'; ?>">
						<?php foreach ( $logos as $logo ) : ?>
							<?php $render_logo( $logo ); ?>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
