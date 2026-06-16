<?php
/**
 * Page Hero block — general-purpose editorial hero.
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
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-page-hero bg-white pt-24 pb-12 md:pt-[clamp(5rem,10vw,8rem)] md:pb-[clamp(3rem,6vw,5rem)]' ) ); ?>>
	<div class="gs-container">

		<div class="max-w-[860px]">

			<?php if ( $eyebrow ) : ?>
				<p class="font-body text-[0.75rem] font-medium tracking-[0.06em] uppercase text-brand-muted mb-4 opacity-0" data-ph-eyebrow>
					<?php echo esc_html( $eyebrow ); ?>
				</p>
			<?php endif; ?>

			<?php if ( $heading || $heading_accent ) : ?>
				<h1 class="font-heading text-[clamp(2rem,5.5vw,4.6875rem)] font-extrabold tracking-[-0.04em] leading-[1.05] mb-5 md:mb-7 block" data-ph-heading>
					<?php if ( $heading ) : ?>
						<span class="ph-heading-dark inline text-brand-dark"><?php echo esc_html( $heading ); ?> </span>
					<?php endif; ?>
					<?php if ( $heading_accent ) : ?>
						<span class="ph-heading-accent inline text-[#b0b5c3]"><?php echo esc_html( $heading_accent ); ?></span>
					<?php endif; ?>
				</h1>
			<?php endif; ?>

			<?php if ( $text ) : ?>
				<p class="font-body text-[0.9375rem] md:text-[clamp(1rem,1.6vw,1.125rem)] leading-[1.7] text-brand-ink max-w-[52ch] opacity-0" data-ph-sub>
					<?php echo esc_html( $text ); ?>
				</p>
			<?php endif; ?>

		</div>

		<?php if ( $image_count > 0 ) : ?>
			<div class="mt-8 md:mt-[clamp(2.5rem,5vw,4rem)]">

				<?php if ( $image_count === 1 ) : ?>
					<figure class="rounded-xl md:rounded-2xl overflow-hidden m-0" data-ph-img>
						<img src="<?php echo esc_url( $image1_url ); ?>" alt="<?php echo esc_attr( $image1_alt ); ?>"
						     class="w-full object-cover block" style="height: clamp(200px, 45vw, 560px);"
						     loading="lazy" decoding="async" />
					</figure>

				<?php else : ?>
					<div class="grid gap-3 md:gap-4 grid-cols-1 sm:grid-cols-[3fr_2fr]">
						<figure class="rounded-xl md:rounded-2xl overflow-hidden m-0" data-ph-img>
							<img src="<?php echo esc_url( $image1_url ); ?>" alt="<?php echo esc_attr( $image1_alt ); ?>"
							     class="w-full object-cover block" style="height: clamp(180px, 32vw, 460px);"
							     loading="lazy" decoding="async" />
						</figure>
						<figure class="rounded-xl md:rounded-2xl overflow-hidden m-0" data-ph-img>
							<img src="<?php echo esc_url( $image2_url ); ?>" alt="<?php echo esc_attr( $image2_alt ); ?>"
							     class="w-full object-cover block" style="height: clamp(180px, 32vw, 460px);"
							     loading="lazy" decoding="async" />
						</figure>
					</div>
				<?php endif; ?>

			</div>
		<?php endif; ?>

	</div>
</section>
