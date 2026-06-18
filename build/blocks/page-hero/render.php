<?php
/**
 * Page Hero block — general-purpose editorial hero.
 * Used on: About, Work, Contact, Services pages.
 *
 * @package GrosharpCore
 */

$eyebrow        = $attributes['eyebrow']       ?? '';
$heading        = $attributes['heading']       ?? '';
$heading_accent = $attributes['headingAccent'] ?? '';
$text           = $attributes['text']          ?? '';
$image1_url     = $attributes['image1Url']     ?? '';
$image1_alt     = $attributes['image1Alt']     ?? '';
$image2_url     = $attributes['image2Url']     ?? '';
$image2_alt     = $attributes['image2Alt']     ?? '';

$image_count = ( $image1_url ? 1 : 0 ) + ( $image2_url ? 1 : 0 );
$no_media_class = $image_count === 0 ? ' has-no-media' : '';
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-page-hero' . $no_media_class ) ); ?>>
	<div class="gs-container">

		<!-- Text area -->
		<div class="ph-text-area">

			<?php if ( $eyebrow ) : ?>
				<p class="ph-eyebrow" data-ph-eyebrow>
					<span class="h-1.5 w-1.5 rounded-full bg-brand-violet flex-shrink-0" aria-hidden="true"></span>
					<?php echo esc_html( $eyebrow ); ?>
				</p>
			<?php endif; ?>

			<?php if ( $heading || $heading_accent ) : ?>
				<h1 class="ph-heading" data-ph-heading>
					<?php if ( $heading ) : ?>
						<span class="ph-heading-dark"><?php echo esc_html( $heading ); ?></span>
					<?php endif; ?>
					<?php if ( $heading_accent ) : ?>
						<span class="ph-heading-accent"><?php echo esc_html( $heading_accent ); ?></span>
					<?php endif; ?>
				</h1>
			<?php endif; ?>

			<?php if ( $text ) : ?>
				<p class="ph-sub" data-ph-sub>
					<?php echo esc_html( $text ); ?>
				</p>
			<?php endif; ?>

		</div>

		<?php if ( $image_count > 0 ) : ?>
			<div class="ph-media ph-media--<?php echo esc_attr( $image_count === 1 ? 'single' : 'double' ); ?>" data-ph-media>

				<?php if ( $image1_url ) : ?>
					<figure class="ph-media-item" data-ph-img>
						<img
							src="<?php echo esc_url( $image1_url ); ?>"
							alt="<?php echo esc_attr( $image1_alt ); ?>"
							loading="lazy"
							decoding="async"
						/>
					</figure>
				<?php endif; ?>

				<?php if ( $image2_url ) : ?>
					<figure class="ph-media-item" data-ph-img>
						<img
							src="<?php echo esc_url( $image2_url ); ?>"
							alt="<?php echo esc_attr( $image2_alt ); ?>"
							loading="lazy"
							decoding="async"
						/>
					</figure>
				<?php endif; ?>

			</div>
		<?php endif; ?>

	</div>
</section>
