<?php
/**
 * Contact Methods block — editorial horizontal rows, not generic cards.
 *
 * @package GrosharpCore
 */

$s        = get_option( 'grosharp_settings', array() );
$email    = $s['email']           ?? '';
$phone    = $s['phone']           ?? '';
$whatsapp = $s['social_whatsapp'] ?? '';
$calendly = $s['calendly_url']    ?? '';

/* Fallbacks */
if ( ! $email )    $email    = 'hello@grosharp.com';
if ( ! $phone )    $phone    = '+1 (555) 000-0000';
if ( ! $calendly ) $calendly = '#';

$methods = array();

if ( $email ) {
	$methods[] = array(
		'num'    => '01',
		'label'  => __( 'Email', 'grosharp' ),
		'value'  => $email,
		'note'   => __( 'We reply within 24 hours', 'grosharp' ),
		'href'   => 'mailto:' . $email,
	);
}

if ( $whatsapp || $phone ) {
	$href = $whatsapp ?: 'tel:' . preg_replace( '/[^+\d]/', '', $phone );
	$methods[] = array(
		'num'    => '02',
		'label'  => __( 'WhatsApp', 'grosharp' ),
		'value'  => $phone ?: __( 'Message us', 'grosharp' ),
		'note'   => __( 'Quick response guaranteed', 'grosharp' ),
		'href'   => $href,
	);
}

if ( $calendly ) {
	$methods[] = array(
		'num'      => '03',
		'label'    => __( 'Book a Call', 'grosharp' ),
		'value'    => __( 'Schedule 30 min', 'grosharp' ),
		'note'     => __( 'Free discovery call', 'grosharp' ),
		'href'     => $calendly,
		'external' => true,
	);
}

if ( empty( $methods ) ) return;
?>

<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-contact-methods' ) ); ?>
         style="padding:0 0 5rem;">
	<div class="gs-container">

		<div class="grid gap-12 md:grid-cols-[1fr_1.6fr] md:gap-20 lg:gap-32">

			<!-- Left: statement -->
			<div class="flex flex-col justify-between gap-8" data-gs-cm-left>
				<div>
					<p class="mb-4 font-body text-[0.75rem] font-semibold uppercase tracking-[0.1em] text-brand-subtle">
						<?php esc_html_e( 'Get in touch', 'grosharp' ); ?>
					</p>
					<h2 class="font-heading text-[clamp(2rem,4vw,3rem)] font-extrabold leading-[1.1] tracking-[-0.035em] text-brand-dark m-0">
						<?php esc_html_e( 'Let\'s start a', 'grosharp' ); ?><br>
						<span style="color:var(--grosharp-primary);"><?php esc_html_e( 'conversation.', 'grosharp' ); ?></span>
					</h2>
				</div>
				<p class="font-body text-[0.9375rem] leading-[1.75] text-brand-muted max-w-[32ch] m-0">
					<?php esc_html_e( 'We work with ambitious brands worldwide. Tell us about your project and we\'ll be in touch.', 'grosharp' ); ?>
				</p>
			</div>

			<!-- Right: contact rows -->
			<div class="flex flex-col divide-y divide-black/[0.07]" data-gs-cm-rows>
				<?php foreach ( $methods as $m ) : ?>
					<a href="<?php echo esc_url( $m['href'] ); ?>"
					   <?php echo ! empty( $m['external'] ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
					   class="group flex items-center justify-between gap-6 py-6 no-underline transition-all duration-300 hover:pl-2"
					   data-gs-cm-row>

						<div class="flex items-start gap-5 min-w-0">
							<span class="font-body text-[0.6875rem] font-semibold text-[#c4c4d4] tabular-nums flex-none mt-1">
								<?php echo esc_html( $m['num'] ); ?>
							</span>
							<div class="min-w-0">
								<p class="font-body text-[0.75rem] font-semibold uppercase tracking-[0.08em] text-brand-subtle m-0 mb-1">
									<?php echo esc_html( $m['label'] ); ?>
								</p>
								<p class="font-heading text-[1.25rem] font-bold tracking-[-0.02em] text-brand-dark m-0 truncate transition-colors duration-200 group-hover:text-brand-violet md:text-[1.5rem]">
									<?php echo esc_html( $m['value'] ); ?>
								</p>
								<p class="font-body text-[0.8125rem] text-brand-subtle m-0 mt-0.5">
									<?php echo esc_html( $m['note'] ); ?>
								</p>
							</div>
						</div>

						<div class="flex-none flex h-10 w-10 items-center justify-center rounded-full border border-black/[0.1] text-brand-subtle transition-all duration-300 group-hover:border-brand-violet group-hover:bg-brand-violet group-hover:text-white group-hover:scale-110">
							<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
						</div>

					</a>
				<?php endforeach; ?>
			</div>

		</div>

	</div>
</section>
