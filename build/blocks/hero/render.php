<?php
/**
 * Hero block render template.
 *
 * @package GrosharpCore
 */

$attributes = wp_parse_args(
	$attributes,
	array(
		'badge'          => __( 'New', 'grosharp' ),
		'eyebrow'        => __( 'Digital growth systems for ambitious brands', 'grosharp' ),
		'heading'        => __( 'Design, build, and grow your digital presence.', 'grosharp' ),
		'text'           => __( 'Grosharp brings development, design, and marketing together to launch sharper websites, stronger brands, and smarter growth campaigns.', 'grosharp' ),
		'primaryLabel'   => __( 'Start your growth project', 'grosharp' ),
		'primaryUrl'     => '/contact/',
		'secondaryLabel' => __( 'See case studies', 'grosharp' ),
		'secondaryUrl'   => '/case-studies/',
		'imageId'        => 0,
		'imageUrl'       => '',
		'imageAlt'       => __( 'Grosharp growth dashboard preview', 'grosharp' ),
	)
);
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-hero relative overflow-hidden pt-[8rem] pb-[6rem]' ) ); ?>>

	<!-- ── Decorative background layer ──────────────────────────────────── -->
	<div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">

		<!-- Subtle dot grid -->
		<div class="absolute inset-0 opacity-[0.045]"
		     style="background-image:radial-gradient(circle,#9b72f5 1px,transparent 1px);background-size:28px 28px;"></div>

		<!-- Soft glow behind content (not a visible circle, just ambience) -->
		<div class="absolute left-1/2 top-[38%] h-[480px] w-[700px] -translate-x-1/2 -translate-y-1/2 blur-[140px] opacity-35"
		     style="background:rgba(172,137,242,0.7);"></div>

		<!-- Top-right corner: large outlined square, slightly rotated -->
		<div class="absolute -right-16 -top-16 h-[220px] w-[220px] border border-[#9b72f5]/18"
		     style="transform:rotate(12deg);"></div>
		<!-- Top-right corner: smaller square inside -->
		<div class="absolute right-4 top-4 h-[120px] w-[120px] border border-[#654cff]/12"
		     style="transform:rotate(12deg);"></div>

		<!-- Bottom-left corner: large square -->
		<div class="absolute -bottom-10 -left-10 h-[180px] w-[180px] border border-[#9b72f5]/15"
		     style="transform:rotate(-8deg);"></div>

		<!-- Top-left: small accent square -->
		<div class="absolute left-[6%] top-16 h-10 w-10 border-2 border-[#654cff]/20"
		     style="transform:rotate(20deg);"></div>

		<!-- Bottom-right: small accent square -->
		<div class="absolute bottom-16 right-[7%] h-7 w-7 border-2 border-[#9b72f5]/22"
		     style="transform:rotate(-15deg);"></div>

		<!-- Thin horizontal line accent — top area -->
		<div class="absolute left-[5%] top-[28%] h-px w-24 bg-[#654cff]/15"></div>
		<div class="absolute left-[5%] top-[28%] mt-2 h-px w-14 bg-[#654cff]/10" style="margin-top:8px;"></div>

		<!-- Thin horizontal line accent — bottom-right -->
		<div class="absolute bottom-[22%] right-[5%] h-px w-20 bg-[#9b72f5]/15"></div>
		<div class="absolute bottom-[22%] right-[5%] h-px w-12 bg-[#9b72f5]/10" style="margin-top:8px;"></div>

	</div>

	<div class="gs-container relative z-10">

		<!-- Hero copy -->
		<div class="gs-reveal mx-auto max-w-[1000px] text-center">
			<p class="mb-8 inline-flex items-center gap-3 rounded-full border border-black/[0.08] bg-white/90 py-1 pl-1 pr-5 text-[16px] font-semibold leading-none text-[#30313d] shadow-[0_8px_24px_rgba(101,76,255,0.10)]">
				<span class="rounded-full bg-[#0d0d12] px-3 py-2 text-[16px] font-bold uppercase tracking-wide text-white"><?php echo esc_html( $attributes['badge'] ); ?></span>
				<?php echo esc_html( $attributes['eyebrow'] ); ?>
			</p>
			<h1 class="mx-auto max-w-[980px] font-heading text-[clamp(2.25rem,7vw,4.6875rem)] font-extrabold leading-[1.06] tracking-[-0.02em] text-[#0d0d12]">
				<?php echo esc_html( $attributes['heading'] ); ?>
			</h1>
			<p class="mx-auto mt-8 max-w-[820px] font-body text-lg font-medium leading-[1.5] text-[#5c5d6d] md:text-[21px]">
				<?php echo esc_html( $attributes['text'] ); ?>
			</p>
			<div class="mt-10 flex flex-wrap justify-center gap-3">
				<a class="inline-flex min-h-[56px] flex-none items-center justify-center gap-3 whitespace-nowrap rounded-full bg-[#654cff] py-3 pl-7 pr-3 font-body text-[17px] font-semibold text-white no-underline shadow-[0_18px_48px_rgba(101,76,255,0.38),inset_0_-2px_0_rgba(0,0,0,0.14)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_24px_60px_rgba(101,76,255,0.45)]"
				   href="<?php echo esc_url( $attributes['primaryUrl'] ); ?>">
					<?php echo esc_html( $attributes['primaryLabel'] ); ?>
					<span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white text-[16px] text-[#0d0d12]" aria-hidden="true">→</span>
				</a>
				<a class="inline-flex min-h-[56px] flex-none items-center justify-center whitespace-nowrap rounded-full border border-black/[0.08] bg-white/80 px-7 font-body text-[17px] font-semibold text-[#111] no-underline shadow-[0_4px_20px_rgba(101,76,255,0.08)] backdrop-blur-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-white hover:shadow-[0_8px_32px_rgba(101,76,255,0.12)]"
				   href="<?php echo esc_url( $attributes['secondaryUrl'] ); ?>">
					<?php echo esc_html( $attributes['secondaryLabel'] ); ?>
				</a>
			</div>
		</div>

		<!-- Hero visual -->
		<?php
		$video_url  = $attributes['videoUrl'] ?? '';
		$image_url  = $attributes['imageUrl'] ?? '';
		$image_alt  = $attributes['imageAlt'] ?? '';
		$has_video  = ! empty( $video_url );
		$has_image  = ! empty( $image_url );

		// Extract YouTube ID
		$yt_id = '';
		if ( $has_video ) {
			if ( preg_match( '/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video_url, $m ) ) {
				$yt_id = $m[1];
			}
		}
		// If user uploaded an image, always use it as the thumbnail — no external YouTube tracking request.
		// Fall back to YouTube thumbnail only when no image is set.
		$thumb_url = $has_image ? $image_url : ( $yt_id ? "https://img.youtube.com/vi/{$yt_id}/maxresdefault.jpg" : '' );
		$modal_id  = 'gs-video-modal-' . substr( md5( $video_url . $image_url ), 0, 6 );
		?>
		<style>
		#<?php echo esc_attr( $modal_id ); ?> {
			display: none; position: fixed; inset: 0; z-index: 99990;
			background: rgba(9,9,15,0.88); backdrop-filter: blur(12px);
			align-items: center; justify-content: center; padding: 1.5rem;
			opacity: 0; transition: opacity 0.3s ease;
		}
		#<?php echo esc_attr( $modal_id ); ?>.gs-modal-open {
			display: flex; opacity: 1;
		}
		#<?php echo esc_attr( $modal_id ); ?> .gs-modal-inner {
			width: 100%; max-width: 960px; position: relative;
			transform: scale(0.94) translateY(16px);
			transition: transform 0.35s cubic-bezier(0.22,1,0.36,1);
		}
		#<?php echo esc_attr( $modal_id ); ?>.gs-modal-open .gs-modal-inner {
			transform: scale(1) translateY(0);
		}
		#<?php echo esc_attr( $modal_id ); ?> iframe {
			width: 100%; aspect-ratio: 16/9; border-radius: 20px; display: block;
			box-shadow: 0 48px 120px rgba(0,0,0,0.6);
		}
		.gs-play-btn { transform: translate(-50%,-50%) scale(1); transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.3s ease; }
		.gs-visual-thumb:hover .gs-play-btn {
			transform: translate(-50%,-50%) scale(1.18);
			box-shadow: 0 24px 60px rgba(101,76,255,0.55);
		}
		.gs-visual-thumb:hover .gs-play-ripple { animation: gs-ripple 1s ease-out forwards; }
		@keyframes gs-ripple {
			0%   { transform: translate(-50%,-50%) scale(1); opacity: 0.5; }
			100% { transform: translate(-50%,-50%) scale(2.8); opacity: 0; }
		}
		</style>

		<div class="mx-auto mt-16 max-w-[1060px] md:mt-20" data-gs-hero-visual>

			<?php if ( $has_video || $has_image ) : ?>

				<!-- ── Video / image — no bezel, flush rounded corners ─────── -->
				<?php if ( $has_video ) : ?>
				<button type="button"
				        id="<?php echo esc_attr( $modal_id ); ?>-play"
				        class="gs-visual-thumb group relative block w-full cursor-pointer overflow-hidden rounded-[24px] border-0 bg-transparent p-0 shadow-[0_32px_100px_rgba(101,76,255,0.18)]"
				        style="aspect-ratio:16/7;"
				        aria-label="<?php esc_attr_e( 'Watch showreel', 'grosharp' ); ?>">
				<?php else : ?>
				<div class="gs-visual-thumb relative overflow-hidden rounded-[24px] shadow-[0_32px_100px_rgba(101,76,255,0.14)]" style="aspect-ratio:16/7;">
				<?php endif; ?>

					<!-- Thumbnail / image -->
					<img class="h-full w-full object-cover object-center transition-transform duration-700 ease-out <?php echo $has_video ? 'group-hover:scale-[1.03]' : ''; ?>"
					     src="<?php echo esc_url( $thumb_url ); ?>"
					     alt="<?php echo esc_attr( $image_alt ?: 'GroSharp work preview' ); ?>"
					     loading="eager" decoding="async" />

					<?php if ( $has_video ) : ?>
					<!-- Dark veil -->
					<div class="absolute inset-0 bg-gradient-to-b from-black/10 via-black/25 to-black/50 transition-opacity duration-300 group-hover:opacity-70"></div>

					<!-- Ripple ring -->
					<span class="gs-play-ripple pointer-events-none absolute left-1/2 top-1/2 h-24 w-24 -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#654cff]/30 opacity-0"></span>

					<!-- Play button -->
					<span class="gs-play-btn pointer-events-none absolute left-1/2 top-1/2 flex h-20 w-20 items-center justify-center rounded-full bg-white shadow-[0_16px_48px_rgba(101,76,255,0.40)]">
						<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<path d="M8 5.5L22 14L8 22.5V5.5Z" fill="#654cff"/>
						</svg>
					</span>

					<!-- "Watch showreel" label -->
					<span class="pointer-events-none absolute bottom-5 left-1/2 -translate-x-1/2 inline-flex items-center gap-2 rounded-full bg-black/50 px-5 py-2 font-body text-[16px] font-semibold text-white backdrop-blur-sm opacity-0 transition-opacity duration-300 group-hover:opacity-100">
						<svg width="14" height="14" viewBox="0 0 14 14" fill="white" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M3 2L11 7L3 12V2Z"/></svg>
						<?php esc_html_e( 'Watch showreel', 'grosharp' ); ?>
					</span>
					<?php endif; ?>

				<?php echo $has_video ? '</button>' : '</div>'; ?>

			<?php else : ?>

				<!-- ── Mockup placeholder ─────────────────────────────────── -->
				<div class="relative aspect-[16/7] overflow-hidden rounded-[24px] shadow-[0_32px_100px_rgba(101,76,255,0.14)]" style="background:linear-gradient(135deg,#0d0d12 0%,#1a1330 50%,#0d0d12 100%);">
					<!-- Grid lines -->
					<div class="absolute inset-0 opacity-[0.07]" style="background-image:linear-gradient(#654cff 1px,transparent 1px),linear-gradient(90deg,#654cff 1px,transparent 1px);background-size:48px 48px;"></div>
					<!-- Ambient glow -->
					<div class="absolute left-1/2 top-1/2 h-[300px] w-[600px] -translate-x-1/2 -translate-y-1/2 blur-[80px] opacity-30" style="background:rgba(101,76,255,0.8);"></div>
					<!-- Browser mockup -->
					<div class="absolute left-1/2 top-1/2 w-[75%] max-w-[560px] -translate-x-1/2 -translate-y-1/2 overflow-hidden rounded-[12px] border border-white/10 shadow-[0_32px_80px_rgba(0,0,0,0.5)]">
						<!-- Browser chrome -->
						<div class="flex items-center gap-1.5 bg-[#1e1b2e] px-4 py-2.5">
							<span class="h-2.5 w-2.5 rounded-full bg-[#ff5f57]"></span>
							<span class="h-2.5 w-2.5 rounded-full bg-[#febc2e]"></span>
							<span class="h-2.5 w-2.5 rounded-full bg-[#28c840]"></span>
							<div class="ml-3 flex-1 rounded-full bg-white/10 px-3 py-1 text-center font-body text-[16px] text-white/40">grosharp.com</div>
						</div>
						<!-- Page content bars -->
						<div class="space-y-2 bg-[#13111f] p-4">
							<div class="h-3 w-3/5 rounded-full bg-white/15"></div>
							<div class="h-2 w-full rounded-full bg-white/[0.08]"></div>
							<div class="h-2 w-4/5 rounded-full bg-white/[0.08]"></div>
							<div class="mt-3 grid grid-cols-3 gap-2">
								<div class="h-16 rounded-lg bg-[#654cff]/25"></div>
								<div class="h-16 rounded-lg bg-white/[0.08]"></div>
								<div class="h-16 rounded-lg bg-white/[0.08]"></div>
							</div>
						</div>
					</div>
					<!-- Hint -->
					<div class="absolute bottom-4 left-1/2 -translate-x-1/2 whitespace-nowrap rounded-full border border-white/10 bg-white/5 px-4 py-1.5 font-body text-[16px] text-white/40 backdrop-blur-sm">
						<?php esc_html_e( 'Add an image or video URL in block settings', 'grosharp' ); ?>
					</div>
				</div>

			<?php endif; ?>

		</div><!-- /hero visual -->

		<?php if ( $has_video ) : ?>
		<!-- ── Video modal ──────────────────────────────────────────────────── -->
		<!-- iframe src is empty on load; set lazily by JS on play click. Uses youtube-nocookie.com — no visitor tracking until they choose to watch. -->
		<div id="<?php echo esc_attr( $modal_id ); ?>" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Video player', 'grosharp' ); ?>">
			<div class="gs-modal-inner">
				<!-- Close button -->
				<button type="button" id="<?php echo esc_attr( $modal_id ); ?>-close"
				        class="absolute -top-12 right-0 flex h-10 w-10 items-center justify-center rounded-full border border-white/20 bg-white/10 font-body text-[20px] text-white backdrop-blur-sm transition-all duration-200 hover:bg-white/20"
				        aria-label="<?php esc_attr_e( 'Close video', 'grosharp' ); ?>">✕</button>

				<?php if ( $yt_id ) : ?>
				<iframe id="<?php echo esc_attr( $modal_id ); ?>-frame"
				        data-yt-src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $yt_id ); ?>?autoplay=1&rel=0&modestbranding=1"
				        src=""
				        title="<?php esc_attr_e( 'GroSharp showreel', 'grosharp' ); ?>"
				        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
				        allowfullscreen></iframe>
				<?php else : ?>
				<video id="<?php echo esc_attr( $modal_id ); ?>-frame"
				       src="<?php echo esc_url( $video_url ); ?>"
				       controls
				       class="w-full rounded-[20px] shadow-[0_48px_120px_rgba(0,0,0,0.6)]"></video>
				<?php endif; ?>
			</div>
		</div>
		<script>
		(function(){
			var mid   = '<?php echo esc_js( $modal_id ); ?>';
			var modal = document.getElementById(mid);
			var frame = document.getElementById(mid + '-frame');
			var closeBtn = document.getElementById(mid + '-close');
			if (!modal) return;

			function openModal() {
				// Always (re-)set src — empty src="" resolves to current page URL in browsers,
				// so we can't use !frame.src as a "not loaded yet" check.
				if (frame && frame.dataset.ytSrc) {
					frame.src = frame.dataset.ytSrc;
				}
				modal.classList.add('gs-modal-open');
				document.body.style.overflow = 'hidden';
			}

			function closeModal() {
				modal.classList.remove('gs-modal-open');
				document.body.style.overflow = '';
				if (frame) {
					if (frame.dataset.ytSrc) {
						frame.src = ''; // unload iframe — stops playback, clears YouTube session
					} else if (frame.tagName === 'VIDEO') {
						frame.pause();
						frame.currentTime = 0;
					}
				}
			}

			// Wire play button by ID — reliable, no attribute-selector fragility
			var playBtn = document.getElementById(mid + '-play');
			if (playBtn) playBtn.addEventListener('click', openModal);

			// Close button
			if (closeBtn) closeBtn.addEventListener('click', closeModal);

			// Click backdrop
			modal.addEventListener('click', function(e) {
				if (e.target === modal) closeModal();
			});

			// Escape key
			document.addEventListener('keydown', function(e) {
				if (e.key === 'Escape' && modal.classList.contains('gs-modal-open')) closeModal();
			});
		})();
		</script>
		<?php endif; ?>

	</div><!-- /gs-container -->

</section>
