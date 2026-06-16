<?php
/**
 * FAQ block render template.
 *
 * @package GrosharpCore
 */

$eyebrow   = $attributes['eyebrow']   ?? __( 'FAQs', 'grosharp' );
$heading   = $attributes['heading']   ?? __( 'Your Questions, Answered', 'grosharp' );
$text      = $attributes['text']      ?? __( "Helping you understand our process and offerings at GroSharp.", 'grosharp' );
$cta_label = $attributes['ctaLabel']  ?? __( 'Ask us anything', 'grosharp' );
$cta_url   = $attributes['ctaUrl']    ?? '/contact/';

$items = isset( $attributes['items'] ) && is_array( $attributes['items'] ) && ! empty( $attributes['items'] )
	? $attributes['items']
	: array(
		array(
			'question' => __( 'What services does GroSharp offer?', 'grosharp' ),
			'answer'   => __( 'We offer UI/UX design, web design, WordPress development, WooCommerce and ecommerce solutions, custom plugin development, brand identity, SEO, digital marketing, and automation. Most clients work with us across 2–3 of these areas at once.', 'grosharp' ),
		),
		array(
			'question' => __( 'How long does a typical project take?', 'grosharp' ),
			'answer'   => __( 'A focused website project runs 4–6 weeks from kickoff to launch. Larger brand and platform builds typically take 10–14 weeks. We share a clear milestone map before any work begins so you always know where things stand.', 'grosharp' ),
		),
		array(
			'question' => __( 'Do you work with clients internationally?', 'grosharp' ),
			'answer'   => __( 'Yes — our team is fully remote and we work with clients across North America, Europe, the Middle East, and Southeast Asia. All project communication runs asynchronously over Slack and video calls scheduled around your timezone.', 'grosharp' ),
		),
		array(
			'question' => __( 'Can you redesign our existing website?', 'grosharp' ),
			'answer'   => __( 'Absolutely. Redesigns make up a significant portion of our work. We start with a full audit of your current site — performance, UX, content, SEO — before touching design. Every decision is grounded in data, not just aesthetics.', 'grosharp' ),
		),
		array(
			'question' => __( 'What platforms do you build on?', 'grosharp' ),
			'answer'   => __( 'WordPress is our primary platform — including custom block themes, Gutenberg blocks, WooCommerce, and bespoke plugins. For larger applications we also build on headless architectures using Next.js with a WordPress or Sanity CMS backend.', 'grosharp' ),
		),
		array(
			'question' => __( 'Do you provide ongoing support after launch?', 'grosharp' ),
			'answer'   => __( 'All projects include a 30-day post-launch support window. After that, many clients continue with our Growth Partner retainer for ongoing design, development, and marketing support — no long-term contract required.', 'grosharp' ),
		),
		array(
			'question' => __( 'How does pricing work?', 'grosharp' ),
			'answer'   => __( 'Project work is scoped and priced per engagement. We send you a clear proposal with line items before any agreement is signed. No hidden fees, no surprise invoices.', 'grosharp' ),
		),
		array(
			'question' => __( 'How do we get started?', 'grosharp' ),
			'answer'   => __( 'Hit "Start a Project" at the top of this page or visit our contact page. We will schedule a free 30-minute strategy call, then send a tailored proposal within 48 hours.', 'grosharp' ),
		),
	);

$block_id = 'gs-faq-' . substr( md5( $heading ), 0, 6 );
?>
<style>
	#<?php echo esc_attr( $block_id ); ?> .gs-faq-item summary { list-style: none; cursor: pointer; }
	#<?php echo esc_attr( $block_id ); ?> .gs-faq-item summary::-webkit-details-marker { display: none; }
	#<?php echo esc_attr( $block_id ); ?> .gs-faq-item[open] .gs-faq-icon { transform: rotate(45deg); background: #654cff; border-color: #654cff; color: #fff; }
	#<?php echo esc_attr( $block_id ); ?> .gs-faq-icon { transition: transform 0.3s cubic-bezier(0.4,0,0.2,1), background 0.25s, color 0.25s; }
	/* Smooth height animation via overflow + grid trick */
	#<?php echo esc_attr( $block_id ); ?> .gs-faq-inner { display: grid; grid-template-rows: 0fr; transition: grid-template-rows 0.38s cubic-bezier(0.4,0,0.2,1); }
	#<?php echo esc_attr( $block_id ); ?> .gs-faq-item[open] .gs-faq-inner { grid-template-rows: 1fr; }
	#<?php echo esc_attr( $block_id ); ?> .gs-faq-inner > div { overflow: hidden; }
</style>

<section id="<?php echo esc_attr( $block_id ); ?>" <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-faq bg-white py-[4rem]' ) ); ?>>
	<div class="gs-container">

		<!-- ── Centered section header ──────────────────────────────────────── -->
		<div class="mx-auto mb-14 max-w-2xl text-center gs-reveal">

			<p class="inline-flex items-center gap-2 rounded-full border border-[#654cff]/20 bg-[#654cff]/[0.07] px-4 py-1.5 font-body text-[16px] font-semibold uppercase tracking-widest text-[#654cff]" data-gs-eyebrow>
				<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
				<?php echo esc_html( $eyebrow ); ?>
			</p>

			<h2 class="mt-6 font-heading text-[clamp(2rem,4vw,3.375rem)] font-extrabold leading-[1.1] tracking-[-0.035em] text-[#0d0d12]">
				<?php echo esc_html( $heading ); ?>
			</h2>

			<p class="mt-5 font-body text-[1.25rem] leading-[1.7] text-[#5c5d6d]">
				<?php echo esc_html( $text ); ?>
			</p>

		</div>

		<!-- ── 2-column FAQ grid ────────────────────────────────────────────── -->
		<div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:items-start">

			<?php foreach ( $items as $index => $item ) : ?>
				<details class="gs-faq-item group rounded-[18px] border border-black/[0.07] bg-[#fafaf9] px-7 py-6 transition-colors duration-300 open:border-[#654cff]/20 open:bg-white open:shadow-[0_8px_32px_rgba(101,76,255,0.08)]">
					<summary class="flex items-center justify-between gap-6 select-none">
						<span class="font-heading text-[17px] font-semibold leading-snug tracking-[-0.01em] text-[#0d0d12] transition-colors duration-200 group-open:text-[#654cff] md:text-[18px]">
							<?php echo esc_html( $item['question'] ?? '' ); ?>
						</span>
						<span class="gs-faq-icon flex h-9 w-9 flex-none items-center justify-center rounded-full border border-black/[0.10] bg-white font-body text-[20px] font-light leading-none text-[#0d0d12] shadow-[0_2px_8px_rgba(0,0,0,0.06)]" aria-hidden="true">+</span>
					</summary>
					<div class="gs-faq-inner">
						<div>
							<div class="pt-4 pr-12 pb-1">
								<p class="font-body text-[16px] leading-relaxed text-[#5c5d6d]">
									<?php echo esc_html( $item['answer'] ?? '' ); ?>
								</p>
							</div>
						</div>
					</div>
				</details>
			<?php endforeach; ?>

		</div>

		<!-- ── Bottom CTA ───────────────────────────────────────────────────── -->
		<div class="mt-12 text-center">
			<p class="font-body text-[16px] text-[#5c5d6d]">
				<?php esc_html_e( "Can't find an answer?", 'grosharp' ); ?>
				<a href="<?php echo esc_url( $cta_url ); ?>"
				   class="ml-1 font-semibold text-[#654cff] no-underline hover:underline">
					<?php echo esc_html( $cta_label ); ?> →
				</a>
			</p>
		</div>

	</div>
</section>
<script>
(function(){
	var section = document.getElementById('<?php echo esc_js( $block_id ); ?>');
	if (!section) return;

	section.querySelectorAll('.gs-faq-item').forEach(function(details){
		var inner = details.querySelector('.gs-faq-inner');
		if (!inner) return;

		details.addEventListener('click', function(e){
			// Only act on summary clicks
			if (!e.target.closest('summary')) return;

			if (details.open) {
				// ── CLOSING ──────────────────────────────────────────────────
				e.preventDefault();
				inner.style.gridTemplateRows = '0fr';

				function onClose(ev) {
					// Guard: only fire for the grid-template-rows transition on this element.
					// transitionend bubbles, so child transitions (icon colour etc.) would
					// otherwise trigger this handler prematurely.
					if (ev.target !== inner || ev.propertyName !== 'grid-template-rows') return;
					inner.removeEventListener('transitionend', onClose);
					details.removeAttribute('open');
					// CRITICAL: clear inline style so the CSS [open] rule can win next time
					inner.style.gridTemplateRows = '';
				}
				inner.addEventListener('transitionend', onClose);

			} else {
				// ── OPENING ───────────────────────────────────────────────────
				// Clear any leftover inline style BEFORE the browser adds [open],
				// otherwise the CSS transition from 0fr → 1fr never fires.
				inner.style.gridTemplateRows = '';
			}
		});
	});
})();
</script>
