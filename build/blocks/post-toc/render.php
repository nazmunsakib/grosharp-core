<?php
/**
 * Post Table of Contents block.
 * Parses h2/h3 from the current post and renders a sticky sidebar TOC.
 * Always renders the wrapper div so the CSS grid layout is never broken.
 *
 * @package GrosharpCore
 */

$post_id = get_the_ID() ?: get_queried_object_id();
$post    = get_post( $post_id );

/* Always output wrapper — keeps grid column 1 in place */
if ( ! $post || $post->post_type !== 'post' ) {
	echo '<div ' . get_block_wrapper_attributes( array( 'class' => 'grosharp-post-toc grosharp-post-toc--empty' ) ) . '></div>';
	return;
}

$toc_title = $attributes['title'] ?? __( 'Contents', 'grosharp' );

/* ── Parse headings from raw content ───────────────────────────────────── */
preg_match_all( '/<h([23])[^>]*>(.*?)<\/h\1>/is', $post->post_content, $matches, PREG_SET_ORDER );

$items = array();
$used  = array();

foreach ( $matches as $m ) {
	$level = (int) $m[1];
	$text  = wp_strip_all_tags( $m[2] );
	$base  = sanitize_title( $text );

	$id    = $base;
	$count = 1;
	while ( in_array( $id, $used, true ) ) {
		$id = $base . '-' . $count++;
	}
	$used[]  = $id;
	$items[] = array( 'level' => $level, 'text' => $text, 'id' => $id );
}

/* Render empty wrapper if not enough headings — grid stays intact */
if ( count( $items ) < 2 ) {
	echo '<div ' . get_block_wrapper_attributes( array( 'class' => 'grosharp-post-toc grosharp-post-toc--empty' ) ) . '></div>';
	return;
}
?>

<div <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-post-toc' ) ); ?>>

	<nav aria-label="<?php echo esc_attr( $toc_title ); ?>" class="gs-toc-inner">

		<p class="gs-toc-title"><?php echo esc_html( $toc_title ); ?></p>

		<ol class="gs-toc-list" id="gs-toc-list">
			<?php foreach ( $items as $i => $item ) : ?>
				<li class="gs-toc-item<?php echo $item['level'] === 3 ? ' gs-toc-item--sub' : ''; ?>"
				    data-toc-item="<?php echo esc_attr( $item['id'] ); ?>">
					<a href="#<?php echo esc_attr( $item['id'] ); ?>" class="gs-toc-link">
						<span class="gs-toc-num"><?php echo sprintf( '%02d', $i + 1 ); ?></span>
						<span class="gs-toc-text"><?php echo esc_html( $item['text'] ); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ol>

	</nav>

</div>
