<?php
/**
 * About Hero block render template.
 *
 * @package GrosharpCore
 */

$eyebrow        = $attributes['eyebrow']        ?? __( 'About GroSharp', 'grosharp' );
$heading        = $attributes['heading']        ?? __( 'We build digital products that define brands.', 'grosharp' );
$text           = $attributes['text']           ?? __( 'GroSharp is a premium digital agency specialising in UI/UX design, WordPress development, and digital growth — built for ambitious brands that refuse to settle for ordinary.', 'grosharp' );
$primary_label  = $attributes['primaryLabel']   ?? __( 'Start a Project', 'grosharp' );
$primary_url    = $attributes['primaryUrl']     ?? '/contact/';
$secondary_label = $attributes['secondaryLabel'] ?? __( 'See Our Work', 'grosharp' );
$secondary_url  = $attributes['secondaryUrl']   ?? '/case-studies/';
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-about-hero' ) ); ?>>

	<div class="gs-container relative z-10 flex flex-col justify-end min-h-[90vh] pb-16 pt-36">

		<!-- Eyebrow -->
		<p class="about-hero-eyebrow" data-gs-eyebrow>
			<span class="about-hero-eyebrow-dot" aria-hidden="true"></span>
			<?php echo esc_html( $eyebrow ); ?>
		</p>

		<!-- Heading -->
		<h1 class="about-hero-heading mt-6">
			<?php echo esc_html( $heading ); ?>
		</h1>

		<!-- Sub text + CTAs -->
		<div class="mt-8 flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">

			<p class="about-hero-sub max-w-[520px]">
				<?php echo esc_html( $text ); ?>
			</p>

			<div class="flex flex-wrap items-center gap-3 lg:shrink-0">
				<a href="<?php echo esc_url( $primary_url ); ?>"
				   class="about-hero-cta-primary">
					<?php echo esc_html( $primary_label ); ?>
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</a>
				<a href="<?php echo esc_url( $secondary_url ); ?>"
				   class="about-hero-cta-secondary">
					<?php echo esc_html( $secondary_label ); ?>
				</a>
			</div>

		</div>

		<!-- Stat strip -->
		<div class="about-hero-stats mt-14 pt-8 border-t border-white/[0.1]">
			<div class="about-hero-stat">
				<span class="about-hero-stat-value">2022</span>
				<span class="about-hero-stat-label"><?php esc_html_e( 'Founded', 'grosharp' ); ?></span>
			</div>
			<div class="about-hero-stat-divider" aria-hidden="true"></div>
			<div class="about-hero-stat">
				<span class="about-hero-stat-value">50+</span>
				<span class="about-hero-stat-label"><?php esc_html_e( 'Projects Delivered', 'grosharp' ); ?></span>
			</div>
			<div class="about-hero-stat-divider" aria-hidden="true"></div>
			<div class="about-hero-stat">
				<span class="about-hero-stat-value">98%</span>
				<span class="about-hero-stat-label"><?php esc_html_e( 'Client Satisfaction', 'grosharp' ); ?></span>
			</div>
			<div class="about-hero-stat-divider" aria-hidden="true"></div>
			<div class="about-hero-stat">
				<span class="about-hero-stat-value">12+</span>
				<span class="about-hero-stat-label"><?php esc_html_e( 'Countries Served', 'grosharp' ); ?></span>
			</div>
		</div>

	</div>

</section>
