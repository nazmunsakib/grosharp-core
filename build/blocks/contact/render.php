<?php
/**
 * Contact block render template.
 *
 * @package GrosharpCore
 */

// Read global settings — social URLs and email come from grosharp_settings.
// Block attributes act as per-block overrides.
$gs = wp_parse_args(
	get_option( 'grosharp_settings', array() ),
	array(
		'email'            => '',
		'social_whatsapp'  => '',
		'social_linkedin'  => '',
		'social_instagram' => '',
		'social_x'         => '',
		'social_dribbble'  => '',
	)
);

$attributes = wp_parse_args(
	$attributes,
	array(
		'eyebrow'        => __( 'Get in touch', 'grosharp' ),
		'heading'        => __( 'Let\'s build something great together.', 'grosharp' ),
		'text'           => __( 'Have a project in mind or just want to say hello? Reach us on any channel — we reply within 24 hours.', 'grosharp' ),
		'badge'          => __( 'Typically replies within 24 h', 'grosharp' ),
		'whatsappLabel'  => '',
		'whatsappUrl'    => '',
		'emailLabel'     => '',
		'emailUrl'       => '',
		'linkedinLabel'  => '',
		'linkedinUrl'    => '',
		'instagramLabel' => '',
		'instagramUrl'   => '',
		'xLabel'         => '',
		'xUrl'           => '',
		'dribbbleLabel'  => '',
		'dribbbleUrl'    => '',
	)
);

// Resolve URLs: block attribute → settings → empty (hides the card).
$email_url   = $attributes['emailUrl']   ?: ( $gs['email'] ? 'mailto:' . $gs['email'] : '' );
$email_label = $attributes['emailLabel'] ?: $gs['email'];

$wa_url   = $attributes['whatsappUrl']   ?: $gs['social_whatsapp'];
$wa_label = $attributes['whatsappLabel'] ?: ( $gs['social_whatsapp'] ? preg_replace( '#^https?://wa\.me/#', '+', $gs['social_whatsapp'] ) : '' );

$li_url   = $attributes['linkedinUrl']   ?: $gs['social_linkedin'];
$li_label = $attributes['linkedinLabel'] ?: ( $gs['social_linkedin'] ? preg_replace( '#^https?://(www\.)?#', '', rtrim( $gs['social_linkedin'], '/' ) ) : '' );

$ig_url   = $attributes['instagramUrl']   ?: $gs['social_instagram'];
$ig_label = $attributes['instagramLabel'] ?: ( $gs['social_instagram'] ? '@' . basename( rtrim( $gs['social_instagram'], '/' ) ) : '' );

$x_url   = $attributes['xUrl']   ?: $gs['social_x'];
$x_label = $attributes['xLabel'] ?: ( $gs['social_x'] ? '@' . basename( rtrim( $gs['social_x'], '/' ) ) : '' );

$dr_url   = $attributes['dribbbleUrl']   ?: $gs['social_dribbble'];
$dr_label = $attributes['dribbbleLabel'] ?: ( $gs['social_dribbble'] ? preg_replace( '#^https?://(www\.)?#', '', rtrim( $gs['social_dribbble'], '/' ) ) : '' );

// Build channels array — skip any channel with no URL.
$channels_raw = array(
	array(
		'key'  => 'whatsapp',
		'name' => 'WhatsApp',
		'label' => $wa_label,
		'url'  => $wa_url,
		'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.116.554 4.1 1.523 5.824L.057 23.7a.5.5 0 0 0 .623.602l6.044-1.588A11.945 11.945 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.9a9.855 9.855 0 0 1-5.023-1.373l-.36-.214-3.733.98.998-3.642-.235-.374A9.857 9.857 0 0 1 2.1 12C2.1 6.533 6.533 2.1 12 2.1c5.468 0 9.9 4.432 9.9 9.9 0 5.467-4.432 9.9-9.9 9.9z"/></svg>',
	),
	array(
		'key'  => 'email',
		'name' => 'Email',
		'label' => $email_label,
		'url'  => $email_url,
		'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="3"/><path d="m2 7 10 7 10-7"/></svg>',
	),
	array(
		'key'  => 'linkedin',
		'name' => 'LinkedIn',
		'label' => $li_label,
		'url'  => $li_url,
		'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
	),
	array(
		'key'  => 'instagram',
		'name' => 'Instagram',
		'label' => $ig_label,
		'url'  => $ig_url,
		'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/></svg>',
	),
	array(
		'key'  => 'x',
		'name' => 'X (Twitter)',
		'label' => $x_label,
		'url'  => $x_url,
		'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.261 5.632L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>',
	),
	array(
		'key'  => 'dribbble',
		'name' => 'Dribbble',
		'label' => $dr_label,
		'url'  => $dr_url,
		'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 0C5.374 0 0 5.373 0 12c0 6.628 5.374 12 12 12 6.628 0 12-5.372 12-12 0-6.627-5.372-12-12-12zm7.92 5.292a10.12 10.12 0 0 1 2.314 5.948c-.338-.067-3.733-.757-7.15-.327-.079-.185-.154-.375-.236-.562-.221-.517-.46-1.033-.704-1.536 3.776-1.539 5.498-3.754 5.776-3.523zM12 1.889a10.11 10.11 0 0 1 6.854 2.657c-.236.238-1.784 2.307-5.435 3.671C11.557 5.783 9.773 3.645 9.474 3.28A10.16 10.16 0 0 1 12 1.889zM7.505 4.039c.289.35 2.038 2.5 3.916 5.81-4.935 1.313-9.294 1.285-9.762 1.279a10.157 10.157 0 0 1 5.846-7.089zM1.867 12.02v-.263c.455.01 5.576.074 10.835-1.504.302.591.59 1.19.855 1.794-4.662 1.311-7.102 4.895-7.288 5.176A10.116 10.116 0 0 1 1.867 12.02zm10.134 10.093a10.124 10.124 0 0 1-6.235-2.142c.154-.266 2.014-3.523 7.122-5.113l.031-.01a35.7 35.7 0 0 1 1.845 6.548 10.129 10.129 0 0 1-2.763.717zm4.7-1.246a37.44 37.44 0 0 0-1.713-6.18c3.201-.51 6.001.327 6.35.435a10.154 10.154 0 0 1-4.637 5.745z"/></svg>',
	),
);

$channels = array_values( array_filter( $channels_raw, function( $ch ) {
	return ! empty( $ch['url'] );
} ) );
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-contact bg-white py-[4rem]' ) ); ?>>
	<div class="gs-container">

		<div class="grid gap-16 md:grid-cols-[1fr_1.1fr] md:gap-20 md:items-center">

			<!-- ── Left: editorial copy ──────────────────────────────────── -->
			<div class="gs-reveal">

				<p class="inline-flex items-center gap-2 rounded-full border border-[#654cff]/20 bg-[#654cff]/[0.07] px-4 py-1.5 font-body text-[16px] font-semibold uppercase tracking-widest text-[#654cff]" data-gs-eyebrow>
					<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
					<?php echo esc_html( $attributes['eyebrow'] ); ?>
				</p>

				<h2 class="mt-7 font-heading text-[38px] font-bold leading-[1.08] tracking-[-0.025em] text-[#0d0d12] md:text-[48px] lg:text-[54px]">
					<?php echo esc_html( $attributes['heading'] ); ?>
				</h2>

				<p class="mt-6 font-body text-[18px] leading-relaxed text-[#5c5d6d]">
					<?php echo esc_html( $attributes['text'] ); ?>
				</p>

				<!-- Response-time badge -->
				<div class="mt-8 inline-flex items-center gap-3 rounded-2xl border border-black/[0.07] bg-[#fafaf9] px-5 py-3">
					<span class="relative flex h-2.5 w-2.5 flex-none">
						<span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-[#25D366] opacity-60"></span>
						<span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-[#25D366]"></span>
					</span>
					<p class="font-body text-[16px] font-semibold text-[#0d0d12]">
						<?php echo esc_html( $attributes['badge'] ); ?>
					</p>
				</div>

				<!-- Decorative large ampersand -->
				<div class="pointer-events-none mt-12 select-none font-heading text-[140px] font-bold leading-none tracking-tighter text-[#654cff]/[0.06] md:mt-14" aria-hidden="true">
					&amp;
				</div>

			</div>

			<!-- ── Right: contact channel cards ──────────────────────────── -->
			<?php if ( ! empty( $channels ) ) : ?>
			<div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

				<?php foreach ( $channels as $ch ) : ?>
				<a href="<?php echo esc_url( $ch['url'] ); ?>"
				   target="<?php echo strpos( $ch['url'], 'mailto:' ) === 0 ? '_self' : '_blank'; ?>"
				   rel="noopener noreferrer"
				   class="gs-contact-card group relative flex items-center gap-4 overflow-hidden rounded-[20px] border border-black/[0.07] bg-[#fafaf9] p-5 no-underline transition-all duration-300 hover:-translate-y-0.5 hover:border-black/[0.12] hover:bg-white hover:shadow-[0_12px_40px_rgba(0,0,0,0.08)]">

					<!-- Icon circle -->
					<div class="relative flex h-12 w-12 flex-none items-center justify-center rounded-[14px] bg-[#f0f0f0] text-[#0d0d12] transition-all duration-300 group-hover:bg-[#0d0d12] group-hover:text-white">
						<?php echo $ch['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>

					<!-- Text -->
					<div class="min-w-0 flex-1">
						<p class="font-body text-[13px] font-semibold uppercase tracking-[0.08em] text-[#9899a6]">
							<?php echo esc_html( $ch['name'] ); ?>
						</p>
						<p class="mt-0.5 truncate font-body text-[16px] font-semibold text-[#0d0d12] transition-colors duration-200 group-hover:text-[#654cff]">
							<?php echo esc_html( $ch['label'] ); ?>
						</p>
					</div>

					<!-- Arrow -->
					<svg class="flex-none text-black/20 transition-all duration-300 group-hover:translate-x-0.5 group-hover:text-[#654cff]" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
						<path d="M3 9h12M9.5 4.5 15 9l-5.5 4.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>

				</a>
				<?php endforeach; ?>

			</div>
			<?php endif; ?>

		</div>

	</div>
</section>
