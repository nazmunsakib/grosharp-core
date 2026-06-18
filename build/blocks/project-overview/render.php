<?php
/**
 * Project Overview block render template.
 *
 * @package GrosharpCore
 */

$post_id  = get_the_ID();
$client   = get_post_meta( $post_id, 'project_client', true );
$year     = get_post_meta( $post_id, 'project_year', true );
$services = get_post_meta( $post_id, 'project_services', true );
$url      = get_post_meta( $post_id, 'project_url', true );

/* ── Build meta items — only show fields that have data ─────────────────── */
$meta = array();

if ( $client ) {
	$meta[] = array(
		'label' => __( 'Client', 'grosharp' ),
		'value' => $client,
		'link'  => '',
	);
}

if ( $year ) {
	$meta[] = array(
		'label' => __( 'Year', 'grosharp' ),
		'value' => $year,
		'link'  => '',
	);
}

if ( $services ) {
	$meta[] = array(
		'label' => __( 'Services', 'grosharp' ),
		'value' => $services,
		'link'  => '',
	);
}

if ( $url ) {
	$meta[] = array(
		'label' => __( 'Live Site', 'grosharp' ),
		'value' => __( 'Visit Project', 'grosharp' ),
		'link'  => $url,
	);
}

/* Don't render if no meta exists */
if ( empty( $meta ) ) {
	return;
}
?>

<div <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-project-overview' ) ); ?>>
	<div class="gs-container">

		<!-- Rule top -->
		<div class="border-t border-black/10"></div>

		<!-- Meta columns -->
		<div class="grid grid-cols-2 gap-8 py-10 md:grid-cols-4">

			<?php foreach ( $meta as $item ) : ?>
				<div data-gs-proj-meta>
					<p class="mb-1.5 font-body text-[11px] font-semibold uppercase tracking-[0.12em] text-brand-subtle">
						<?php echo esc_html( $item['label'] ); ?>
					</p>
					<?php if ( $item['link'] ) : ?>
						<a href="<?php echo esc_url( $item['link'] ); ?>"
						   target="_blank"
						   rel="noopener noreferrer"
						   class="inline-flex items-center gap-1.5 font-body text-[1rem] font-semibold text-brand-violet transition-colors duration-200 hover:text-brand-dark">
							<?php echo esc_html( $item['value'] ); ?>
							<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
						</a>
					<?php else : ?>
						<p class="font-body text-[1rem] font-semibold text-brand-dark">
							<?php echo esc_html( $item['value'] ); ?>
						</p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>

		</div>

		<!-- Rule bottom -->
		<div class="border-t border-black/10"></div>

	</div>
</div>
