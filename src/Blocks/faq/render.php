<?php
/**
 * FAQ block render template.
 *
 * @package GrosharpCore
 */

$eyebrow = $attributes['eyebrow'] ?? __( 'FAQs', 'grosharp' );
$heading = $attributes['heading'] ?? __( 'Questions we hear most.', 'grosharp' );
$text    = $attributes['text']    ?? __( "Can't find an answer? Drop us a line — we respond within one business day.", 'grosharp' );
$cta_label = $attributes['ctaLabel'] ?? __( 'Ask us anything', 'grosharp' );
$cta_url   = $attributes['ctaUrl']   ?? '/contact/';

$items = isset( $attributes['items'] ) && is_array( $attributes['items'] ) && ! empty( $attributes['items'] )
	? $attributes['items']
	: array(
		array(
			'question' => __( 'What services does GroSharp offer?', 'grosharp' ),
			'answer'   => __( 'We offer UI/UX design, web design, WordPress development, WooCommerce and ecommerce solutions, custom plugin development, brand identity, SEO, digital marketing, and automation. Most clients work with us across 2–3 of these areas at once.', 'grosharp' ),
		),
		array(
			'question' => __( 'How long does a typical project take?', 'grosharp' ),
			'answer'   => __( 'A focused website project (Discovery Sprint) runs 4–6 weeks from kickoff to launch. Larger brand and platform builds typically take 10–14 weeks. We share a clear milestone map before any work begins so you always know where things stand.', 'grosharp' ),
		),
		array(
			'question' => __( 'Do you work with clients internationally?', 'grosharp' ),
			'answer'   => __( 'Yes — our team is fully remote and we work with clients across North America, Europe, the Middle East, and Southeast Asia. All project communication runs asynchronously over Slack and video calls scheduled around your timezone.', 'grosharp' ),
		),
		array(
			'question' => __( 'Can you redesign our existing website?', 'grosharp' ),
			'answer'   => __( 'Absolutely. Redesigns make up a significant portion of our work. We start with a full audit of your current site — performance, UX, content, SEO — before touching design. That way every decision is grounded in data, not just aesthetics.', 'grosharp' ),
		),
		array(
			'question' => __( 'What platforms do you build on?', 'grosharp' ),
			'answer'   => __( 'WordPress is our primary platform — including custom block themes, Gutenberg blocks, WooCommerce, and bespoke plugins. For larger applications we also build on headless architectures using Next.js with a WordPress or Sanity CMS backend.', 'grosharp' ),
		),
		array(
			'question' => __( 'Do you provide ongoing support after launch?', 'grosharp' ),
			'answer'   => __( 'All projects include a 30-day post-launch support window. After that, many clients continue with our Growth Partner retainer, which gives them ongoing design, development, and marketing support on a monthly basis — no long-term contract required.', 'grosharp' ),
		),
		array(
			'question' => __( 'How does pricing work?', 'grosharp' ),
			'answer'   => __( 'Project work is scoped and priced per engagement — starting from $2,500 for a Discovery Sprint. Retainers start at $2,500/month. We will send you a clear proposal with line items before any agreement is signed. No hidden fees, no surprise invoices.', 'grosharp' ),
		),
		array(
			'question' => __( 'How do we get started?', 'grosharp' ),
			'answer'   => __( 'Hit "Start a Project" at the top of this page or visit our contact page. We will schedule a free 30-minute strategy call to learn about your goals, current situation, and timeline — then send a tailored proposal within 48 hours.', 'grosharp' ),
		),
	);

$block_id = 'gs-faq-' . substr( md5( $heading ), 0, 6 );
?>
<style>
	#<?php echo esc_attr( $block_id ); ?> .gs-faq-item summary { list-style: none; cursor: pointer; }
	#<?php echo esc_attr( $block_id ); ?> .gs-faq-item summary::-webkit-details-marker { display: none; }
	#<?php echo esc_attr( $block_id ); ?> .gs-faq-item[open] .gs-faq-icon { transform: rotate(45deg); }
	#<?php echo esc_attr( $block_id ); ?> .gs-faq-icon { transition: transform 0.25s cubic-bezier(0.4,0,0.2,1); }
	#<?php echo esc_attr( $block_id ); ?> .gs-faq-body { animation: gs-faq-open 0.25s ease; }
	@keyframes gs-faq-open {
		from { opacity: 0; transform: translateY(-6px); }
		to   { opacity: 1; transform: translateY(0);    }
	}
</style>

<section id="<?php echo esc_attr( $block_id ); ?>" <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-faq bg-[#fafaf9] py-24 md:py-32' ) ); ?>>
	<div class="gs-container">

		<div class="grid gap-16 lg:grid-cols-[1fr_1.8fr] lg:gap-24">

			<!-- ── Left: header col ──────────────────────────────────────────── -->
			<div class="gs-reveal lg:sticky lg:top-24 lg:self-start">

				<p class="inline-flex items-center gap-2 rounded-full border border-[#654cff]/20 bg-[#654cff]/[0.07] px-4 py-1.5 font-body text-xs font-semibold uppercase tracking-widest text-[#654cff]" data-gs-eyebrow>
					<span class="h-1.5 w-1.5 rounded-full bg-[#654cff]" aria-hidden="true"></span>
					<?php echo esc_html( $eyebrow ); ?>
				</p>

				<h2 class="mt-6 font-heading text-[36px] font-bold leading-[1.1] tracking-[-0.025em] text-[#0d0d12] md:text-[44px]">
					<?php echo esc_html( $heading ); ?>
				</h2>

				<p class="mt-5 font-body text-[16px] leading-relaxed text-[#5c5d6d]">
					<?php echo esc_html( $text ); ?>
				</p>

				<a href="<?php echo esc_url( $cta_url ); ?>"
				   class="mt-8 inline-flex min-h-[48px] items-center gap-2 rounded-full bg-[#654cff] px-7 font-body text-sm font-semibold text-white no-underline shadow-[0_8px_24px_rgba(101,76,255,0.28)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_12px_32px_rgba(101,76,255,0.38)]">
					<?php echo esc_html( $cta_label ); ?>
					<span aria-hidden="true">→</span>
				</a>

			</div>

			<!-- ── Right: accordion col ──────────────────────────────────────── -->
			<div class="gs-reveal divide-y divide-black/[0.07]">
				<?php foreach ( $items as $index => $item ) : ?>
					<details class="gs-faq-item group py-6 first:pt-0">
						<summary class="flex items-center justify-between gap-6">
							<span class="font-heading text-[17px] font-semibold leading-snug tracking-[-0.01em] text-[#0d0d12] transition-colors duration-200 group-open:text-[#654cff] md:text-[18px]">
								<?php echo esc_html( $item['question'] ?? '' ); ?>
							</span>
							<span class="gs-faq-icon flex h-8 w-8 flex-none items-center justify-center rounded-full border border-black/[0.08] bg-white font-body text-[18px] text-[#654cff] shadow-[0_2px_8px_rgba(101,76,255,0.08)] group-open:border-[#654cff]/20 group-open:bg-[#654cff]/[0.06]" aria-hidden="true">+</span>
						</summary>
						<div class="gs-faq-body mt-4 pr-14">
							<p class="font-body text-[15px] leading-relaxed text-[#5c5d6d]">
								<?php echo esc_html( $item['answer'] ?? '' ); ?>
							</p>
						</div>
					</details>
				<?php endforeach; ?>
			</div>

		</div>
	</div>
</section>
