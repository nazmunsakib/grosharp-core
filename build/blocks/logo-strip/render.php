<?php
/**
 * Logo strip block render template.
 *
 * @package GrosharpCore
 */

$items = isset( $attributes['items'] ) && is_array( $attributes['items'] )
	? array_values( array_filter( $attributes['items'] ) )
	: array();

$eyebrow = isset( $attributes['eyebrow'] ) ? (string) $attributes['eyebrow'] : '';
$speed   = isset( $attributes['speed'] ) ? absint( $attributes['speed'] ) : 42;

if ( empty( $items ) ) {
	$items = array(
		array( 'label' => 'Imprintify' ),
		array( 'label' => 'Berlin' ),
		array( 'label' => 'U-Turn' ),
		array( 'label' => 'Swiss' ),
		array( 'label' => 'KOBE' ),
		array( 'label' => 'On Event' ),
	);
}

$render_logo = static function ( $item ): void {
	$label     = is_array( $item ) ? (string) ( $item['label'] ?? '' ) : (string) $item;
	$image_url = is_array( $item ) ? (string) ( $item['imageUrl'] ?? '' ) : '';
	$image_alt = is_array( $item ) ? (string) ( $item['imageAlt'] ?? $label ) : $label;
	$url       = is_array( $item ) ? (string) ( $item['url'] ?? '' ) : '';
	$tag       = $url ? 'a' : 'div';
	$href      = $url ? ' href="' . esc_url( $url ) . '"' : '';
	?>
	<<?php echo esc_html( $tag ); ?><?php echo $href; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="inline-flex min-w-[150px] flex-none items-center justify-center px-8 py-4 no-underline md:min-w-[190px]">
		<?php if ( $image_url ) : ?>
			<img class="max-h-10 w-auto max-w-[170px] object-contain opacity-75 grayscale transition hover:opacity-100 hover:grayscale-0" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="lazy" decoding="async" />
		<?php else : ?>
			<span class="whitespace-nowrap font-heading text-2xl font-semibold leading-none text-[#111] opacity-80"><?php echo esc_html( $label ); ?></span>
		<?php endif; ?>
	</<?php echo esc_html( $tag ); ?>>
	<?php
};
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-logo-strip bg-[#fbfaff] py-8 md:py-10' ) ); ?>>
	<div class="gs-reveal">
		<?php if ( $eyebrow ) : ?>
			<p class="mx-auto mb-5 max-w-[760px] px-5 text-center font-body text-sm font-medium text-[#6a6877]"><?php echo esc_html( $eyebrow ); ?></p>
		<?php endif; ?>
		<div class="overflow-hidden [mask-image:linear-gradient(90deg,transparent,black_10%,black_90%,transparent)]" data-gs-logo-marquee data-speed="<?php echo esc_attr( (string) $speed ); ?>">
			<div class="flex w-max items-center" data-gs-logo-track>
				<?php foreach ( array( 0, 1 ) as $set_index ) : ?>
					<div class="flex flex-none items-center" aria-hidden="<?php echo 0 === $set_index ? 'false' : 'true'; ?>">
						<?php foreach ( $items as $item ) : ?>
							<?php $render_logo( $item ); ?>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
