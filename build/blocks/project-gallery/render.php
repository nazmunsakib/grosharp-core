<?php
/**
 * Project Gallery block render template.
 *
 * 2-column × up-to-2-row grid. Click any image to open lightbox.
 * Reads from the project_images ACF group:
 *   project_image_1–4 (only filled slots render).
 *
 * @package GrosharpCore
 */

$post_id = get_the_ID();
if ( ! $post_id ) {
	$post_id = get_queried_object_id();
}

/* ── Fetch from ACF group ───────────────────────────────────────────────── */
$group = array();
if ( function_exists( 'get_field' ) ) {
	$result = get_field( 'project_images', $post_id );
	$group  = is_array( $result ) ? $result : array();
}

$slots = array(
	$group['project_image_1'] ?? null,
	$group['project_image_2'] ?? null,
	$group['project_image_3'] ?? null,
	$group['project_image_4'] ?? null,
);

$images = array_values( array_filter( $slots ) );

if ( empty( $images ) ) {
	return;
}

$block_id  = 'gs-gallery-' . substr( md5( (string) $post_id ), 0, 6 );
$count     = count( $images );
$style_id  = $block_id . '-style';
?>

<style id="<?php echo esc_attr( $style_id ); ?>">
/* Gallery card hover overlay */
#<?php echo esc_attr( $block_id ); ?> .gs-gal-item { position:relative; }
#<?php echo esc_attr( $block_id ); ?> .gs-gal-item img { display:block; width:100%; height:100%; object-fit:cover; border-radius:1.25rem; }
#<?php echo esc_attr( $block_id ); ?> .gs-gal-overlay {
	position:absolute; inset:0; border-radius:1.25rem;
	background:rgba(13,13,18,0); display:flex; align-items:center; justify-content:center;
	transition:background 0.25s ease;
}
#<?php echo esc_attr( $block_id ); ?> .gs-gal-icon {
	display:flex; align-items:center; justify-content:center;
	width:2.75rem; height:2.75rem; border-radius:9999px;
	border:1.5px solid rgba(255,255,255,0.9); background:rgba(255,255,255,0.1);
	backdrop-filter:blur(4px); -webkit-backdrop-filter:blur(4px);
	opacity:0; transform:scale(0.8); transition:opacity 0.22s ease, transform 0.22s ease;
}
#<?php echo esc_attr( $block_id ); ?> .gs-gal-item:hover .gs-gal-overlay { background:rgba(13,13,18,0.35); }
#<?php echo esc_attr( $block_id ); ?> .gs-gal-item:hover .gs-gal-icon   { opacity:1; transform:scale(1); }
</style>

<!-- Lightbox -->
<div id="<?php echo esc_attr( $block_id ); ?>-lb"
     role="dialog" aria-modal="true"
     aria-label="<?php esc_attr_e( 'Image viewer', 'grosharp' ); ?>"
     style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(13,13,18,0.93);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);align-items:center;justify-content:center;cursor:zoom-out;">

	<button aria-label="<?php esc_attr_e( 'Close', 'grosharp' ); ?>"
	        style="position:absolute;top:1.25rem;right:1.25rem;display:flex;align-items:center;justify-content:center;width:2.5rem;height:2.5rem;border-radius:9999px;border:1.5px solid rgba(255,255,255,0.25);background:transparent;color:#fff;font-size:1rem;cursor:pointer;line-height:1;transition:background .2s;"
	        onmouseenter="this.style.background='rgba(255,255,255,0.1)'"
	        onmouseleave="this.style.background='transparent'"
	        class="gs-lb-close">✕</button>

	<div style="max-width:min(92vw,1280px);max-height:90vh;display:flex;align-items:center;justify-content:center;" onclick="event.stopPropagation()">
		<img class="gs-lb-img" src="" alt=""
		     style="max-width:100%;max-height:90vh;object-fit:contain;border-radius:1rem;display:block;" />
	</div>
</div>

<!-- Gallery -->
<section id="<?php echo esc_attr( $block_id ); ?>"
         <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-project-gallery py-4' ) ); ?>>
	<div class="gs-container">
		<div style="display:grid;grid-template-columns:1fr 1fr;gap:0.5rem;">

			<?php foreach ( $images as $i => $img ) :
				$src      = $img['sizes']['large'] ?? $img['url'] ?? '';
				$src_full = $img['url'] ?? $src;
				$alt      = $img['alt'] ?? '';
				if ( ! $src ) { continue; }

				/* Last image spans full width if total count is odd */
				$span = ( $count % 2 !== 0 && $i === $count - 1 )
					? 'grid-column:1 / -1;aspect-ratio:16/7;'
					: 'aspect-ratio:4/3;';
			?>
				<div class="gs-gal-item cursor-pointer overflow-hidden"
				     style="border-radius:1.25rem;<?php echo esc_attr( $span ); ?>"
				     data-gs-pg-grid-item
				     data-lb-src="<?php echo esc_attr( $src_full ); ?>"
				     data-lb-alt="<?php echo esc_attr( $alt ); ?>"
				     data-lb-target="<?php echo esc_attr( $block_id ); ?>-lb"
				     role="button" tabindex="0"
				     aria-label="<?php echo esc_attr( sprintf( __( 'View image %d', 'grosharp' ), $i + 1 ) ); ?>">

					<img src="<?php echo esc_url( $src ); ?>"
					     alt="<?php echo esc_attr( $alt ); ?>"
					     loading="lazy" />

					<!-- Hover overlay -->
					<div class="gs-gal-overlay" aria-hidden="true">
						<div class="gs-gal-icon">
							<!-- Expand / view icon -->
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
								<path d="M1 5V2a1 1 0 0 1 1-1h3M10 1h3a1 1 0 0 1 1 1v3M15 11v3a1 1 0 0 1-1 1h-3M6 15H3a1 1 0 0 1-1-1v-3" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>
					</div>

				</div>
			<?php endforeach; ?>

		</div>
	</div>
</section>

<script>
(function () {
	function initGallery() {
		var lb       = document.getElementById('<?php echo esc_js( $block_id ); ?>-lb');
		var lbImg    = lb ? lb.querySelector('.gs-lb-img') : null;
		var closeBtn = lb ? lb.querySelector('.gs-lb-close') : null;
		if (!lb || !lbImg) return;

		function open(src, alt) {
			lbImg.src = src;
			lbImg.alt = alt || '';
			lb.style.display = 'flex';
			document.body.style.overflow = 'hidden';
		}
		function close() {
			lb.style.display = 'none';
			lbImg.src = '';
			document.body.style.overflow = '';
		}

		document.querySelectorAll('[data-lb-target="<?php echo esc_js( $block_id ); ?>-lb"]').forEach(function (el) {
			el.addEventListener('click', function () { open(el.dataset.lbSrc, el.dataset.lbAlt); });
			el.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); open(el.dataset.lbSrc, el.dataset.lbAlt); }
			});
		});

		lb.addEventListener('click', close);
		if (closeBtn) closeBtn.addEventListener('click', function (e) { e.stopPropagation(); close(); });
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && lb.style.display === 'flex') close();
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initGallery);
	} else {
		initGallery();
	}
})();
</script>
