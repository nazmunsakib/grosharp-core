<?php
/**
 * Project Detail block render template.
 * Challenge + Solution editorial rows.
 *
 * @package GrosharpCore
 */

$post_id   = get_the_ID();
$challenge = get_post_meta( $post_id, 'project_challenge', true );
$solution  = get_post_meta( $post_id, 'project_solution', true );

/* Fallback copy shown before real content is entered */
$fallback_challenge = __( 'The client needed a digital presence that matched the ambition of their product — fast, modern, and built to convert. Their existing site was slow, generic, and failing to communicate what made them different.', 'grosharp' );
$fallback_solution  = __( 'We started with a full discovery sprint to understand their audience and competitive landscape. From there, we built a design system from scratch — clean, typographically led, with purposeful motion. Development was done in WordPress with a fully custom theme.', 'grosharp' );

$rows = array(
	array(
		'label' => __( 'The Challenge', 'grosharp' ),
		'text'  => $challenge ?: $fallback_challenge,
		'attr'  => 'data-gs-pd-challenge',
	),
	array(
		'label' => __( 'Our Approach', 'grosharp' ),
		'text'  => $solution ?: $fallback_solution,
		'attr'  => 'data-gs-pd-solution',
	),
);
?>

<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-project-detail py-20 md:py-28' ) ); ?>>
	<div class="gs-container">

		<?php foreach ( $rows as $i => $row ) : ?>

			<div class="flex flex-col gap-8 <?php echo $i > 0 ? 'mt-16 border-t border-black/10 pt-16 md:mt-20 md:pt-20' : ''; ?> md:flex-row md:gap-16 lg:gap-24"
			     <?php echo esc_attr( $row['attr'] ); ?>>

				<!-- Label column -->
				<div class="flex-none md:w-[220px] lg:w-[260px]">
					<h3 class="font-heading text-[1.25rem] font-bold leading-[1.2] tracking-[-0.02em] text-brand-dark m-0 md:text-[1.5rem]">
						<?php echo esc_html( $row['label'] ); ?>
					</h3>
				</div>

				<!-- Text column -->
				<div class="flex-1">
					<p class="font-body text-[1.1875rem] leading-[1.75] text-brand-ink md:text-[1.25rem]">
						<?php echo wp_kses_post( wpautop( $row['text'] ) ); ?>
					</p>
				</div>

			</div>

		<?php endforeach; ?>

	</div>
</section>
