<?php
/**
 * 404 Not Found block — premium editorial design.
 *
 * @package GrosharpCore
 */
?>

<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-not-found' ) ); ?>
         style="padding-top:clamp(6rem,14vw,11rem);padding-bottom:clamp(5rem,12vw,9rem);overflow:hidden;position:relative;">

	<!-- Decorative large "404" behind content -->
	<div aria-hidden="true"
	     style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;pointer-events:none;user-select:none;overflow:hidden;">
		<span style="font-family:var(--grosharp-font-heading,sans-serif);font-size:clamp(14rem,35vw,28rem);font-weight:900;line-height:1;letter-spacing:-0.06em;color:transparent;-webkit-text-stroke:1px var(--grosharp-violet-07);white-space:nowrap;">
			404
		</span>
	</div>

	<div class="gs-container" style="position:relative;">
		<div style="max-width:600px;margin-inline:auto;text-align:center;">

			<!-- Eyebrow -->
			<p class="font-body text-[0.75rem] font-semibold uppercase tracking-[0.1em] text-brand-subtle mb-6">
				<?php esc_html_e( 'Error 404', 'grosharp' ); ?>
			</p>

			<!-- Heading -->
			<h1 class="font-heading text-[clamp(2.5rem,6vw,4.5rem)] font-extrabold leading-[1.05] tracking-[-0.04em] text-brand-dark m-0 mb-6">
				<?php esc_html_e( 'Page not', 'grosharp' ); ?><br>
				<span style="color:var(--grosharp-primary);"><?php esc_html_e( 'found.', 'grosharp' ); ?></span>
			</h1>

			<!-- Subtext -->
			<p class="font-body text-[1.125rem] leading-[1.75] text-brand-muted m-0 mb-10 max-w-[42ch] mx-auto">
				<?php esc_html_e( 'The page you\'re looking for may have moved, been removed, or never existed. Let\'s get you back on track.', 'grosharp' ); ?>
			</p>

			<!-- Actions -->
			<div class="flex flex-wrap items-center justify-center gap-4">

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				   class="inline-flex items-center gap-3 rounded-full bg-brand-violet px-8 py-3.5 font-body text-[0.9375rem] font-semibold text-white no-underline shadow-[0_8px_28px_var(--grosharp-violet-32)] transition-all duration-300 hover:shadow-[0_12px_36px_var(--grosharp-violet-50)] hover:scale-[1.03]">
					<?php esc_html_e( 'Back to Home', 'grosharp' ); ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
				</a>

				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
				   class="inline-flex items-center gap-3 rounded-full border border-black/15 px-8 py-3.5 font-body text-[0.9375rem] font-semibold text-brand-dark no-underline transition-all duration-300 hover:border-brand-violet hover:text-brand-violet">
					<?php esc_html_e( 'Get in touch', 'grosharp' ); ?>
				</a>

			</div>

		</div>
	</div>

</section>
