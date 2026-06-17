<?php
/**
 * Contact Details block — premium editorial 3-col info + large social links.
 *
 * @package GrosharpCore
 */

$s       = get_option( 'grosharp_settings', array() );
$company = $s['company_name']  ?? 'GroSharp';
$address = $s['address']       ?? '';
$hours   = $s['working_hours'] ?? '';

$socials = array(
	'LinkedIn'  => $s['social_linkedin']  ?? '',
	'Instagram' => $s['social_instagram'] ?? '',
	'X'         => $s['social_x']         ?? '',
	'Dribbble'  => $s['social_dribbble']  ?? '',
	'WhatsApp'  => $s['social_whatsapp']  ?? '',
);
$socials = array_filter( $socials );

/* Fallbacks */
if ( ! $address ) $address = '123 Digital Avenue' . "\n" . 'Dhaka, Bangladesh';
if ( ! $hours )   $hours   = 'Mon – Fri, 9am – 6pm (GMT+6)';
if ( empty( $socials ) ) {
	$socials = array(
		'LinkedIn'  => '#',
		'Instagram' => '#',
		'X'         => '#',
		'Dribbble'  => '#',
	);
}

$address_lines = array_map( 'trim', explode( "\n", $address ) );
?>

<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-contact-details' ) ); ?>
         style="padding:0 0 6rem;">
	<div class="gs-container">

		<!-- Thin separator -->
		<div class="mb-16 h-px bg-black/[0.07]"></div>

		<!-- Info row: 3 columns -->
		<div class="grid grid-cols-2 gap-10 md:grid-cols-3 md:gap-0 mb-16" data-gs-cd-info>

			<!-- Office -->
			<div class="md:border-r md:border-black/[0.07] md:pr-10 lg:pr-16">
				<p class="mb-3 font-body text-[0.6875rem] font-semibold uppercase tracking-[0.1em] text-[#9a9ab0]">
					<?php esc_html_e( 'Our Office', 'grosharp' ); ?>
				</p>
				<?php foreach ( $address_lines as $line ) : ?>
					<p class="font-body text-[0.9375rem] leading-[1.65] text-[#3d3e4e] m-0">
						<?php echo esc_html( $line ); ?>
					</p>
				<?php endforeach; ?>
			</div>

			<!-- Hours -->
			<div class="md:border-r md:border-black/[0.07] md:px-10 lg:px-16">
				<p class="mb-3 font-body text-[0.6875rem] font-semibold uppercase tracking-[0.1em] text-[#9a9ab0]">
					<?php esc_html_e( 'Working Hours', 'grosharp' ); ?>
				</p>
				<p class="font-body text-[0.9375rem] leading-[1.65] text-[#3d3e4e] m-0">
					<?php echo esc_html( $hours ); ?>
				</p>
				<!-- Availability indicator -->
				<div class="mt-4 inline-flex items-center gap-2">
					<span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_5px_rgba(52,211,153,0.8)]"></span>
					<span class="font-body text-[0.75rem] font-medium text-[#5c5d6d]">
						<?php esc_html_e( 'Available for new projects', 'grosharp' ); ?>
					</span>
				</div>
			</div>

			<!-- Company identity (desktop only, keeps columns balanced) -->
			<div class="hidden md:flex md:flex-col md:justify-end md:pl-10 lg:pl-16">
				<p class="font-heading text-[clamp(1.5rem,2.5vw,2.25rem)] font-extrabold tracking-[-0.04em] text-[#0d0d12] leading-[1] m-0">
					<?php echo esc_html( $company ); ?>
				</p>
				<p class="font-body text-[0.8125rem] text-[#9a9ab0] m-0 mt-1.5">
					<?php esc_html_e( 'Digital Agency', 'grosharp' ); ?>
				</p>
			</div>

		</div>

		<!-- Social links: large editorial typography -->
		<?php if ( ! empty( $socials ) ) : ?>
			<div data-gs-cd-socials>

				<p class="mb-6 font-body text-[0.6875rem] font-semibold uppercase tracking-[0.1em] text-[#9a9ab0]">
					<?php esc_html_e( 'Find us online', 'grosharp' ); ?>
				</p>

				<div class="flex flex-wrap items-center gap-x-8 gap-y-3">
					<?php foreach ( $socials as $name => $url ) : ?>
						<a href="<?php echo esc_url( $url ); ?>"
						   target="_blank" rel="noopener noreferrer"
						   class="group inline-flex items-center gap-2 no-underline transition-all duration-200"
						   data-gs-cd-social>
							<span class="font-heading text-[1.75rem] font-extrabold tracking-[-0.03em] leading-none text-[#c9c9d8] transition-colors duration-200 group-hover:text-[#654cff] md:text-[2.25rem]">
								<?php echo esc_html( $name ); ?>
							</span>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="opacity-0 translate-y-1 transition-all duration-200 group-hover:opacity-100 group-hover:translate-y-0 text-[#654cff]"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
						</a>
					<?php endforeach; ?>
				</div>

			</div>
		<?php endif; ?>

	</div>
</section>
