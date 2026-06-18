<?php
/**
 * Work Grid block — portfolio grid.
 *
 * @package GrosharpCore
 */

$eyebrow     = $attributes['eyebrow']    ?? __( 'Our Work', 'grosharp' );
$heading     = $attributes['heading']    ?? __( 'Every project, a story.', 'grosharp' );
$text        = $attributes['text']       ?? __( 'Browse our full portfolio — filtered by discipline.', 'grosharp' );
$count       = absint( $attributes['count'] ?? 0 );
$show_filter = $attributes['showFilter'] ?? true;

$terms = get_terms( array(
	'taxonomy'   => 'project_type',
	'hide_empty' => true,
	'orderby'    => 'count',
	'order'      => 'DESC',
) );
$terms = is_wp_error( $terms ) ? array() : $terms;

$query_args = array(
	'post_type'      => 'grosharp_project',
	'posts_per_page' => $count > 0 ? $count : -1,
	'post_status'    => 'publish',
	'orderby'        => 'menu_order date',
	'order'          => 'ASC',
);
$query = new WP_Query( $query_args );

$placeholders = array(
	array( 'client' => 'Booking Corp.',    'title' => 'Fintech Dello Banking App', 'slug' => 'web-design',  'url' => '#', 'bg' => '#1a1a2e' ),
	array( 'client' => 'Dazzle Inc.',      'title' => 'Dazzle © Branding',         'slug' => 'branding',    'url' => '#', 'bg' => '#0d0d0d' ),
	array( 'client' => 'CareSunset',       'title' => 'Healthcare Mobile App',      'slug' => 'development', 'url' => '#', 'bg' => '#e8e8f4' ),
	array( 'client' => 'Tech Bank Client', 'title' => 'Technical Infographic',      'slug' => 'branding',    'url' => '#', 'bg' => '#ececf5' ),
	array( 'client' => 'Lumio Store',      'title' => 'Ecommerce Redesign',         'slug' => 'ecommerce',   'url' => '#', 'bg' => '#f0f0f8' ),
	array( 'client' => 'Novu SaaS',        'title' => 'Landing Page & SEO',         'slug' => 'seo',         'url' => '#', 'bg' => '#1e1e3a' ),
);

$use_placeholders = ! $query->have_posts();

$arrow_svg = '<svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" class="w-4 h-4 block"><path d="M4.5 11.5 L11.5 4.5 M5 4.5 H11.5 V11" stroke="white" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>';
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'grosharp-block grosharp-work-grid bg-white py-14 md:py-[clamp(4rem,7vw,6rem)]' ) ); ?>>
	<div class="gs-container">

		<!-- Section header -->
		<div class="mb-8 md:mb-12">
			<!-- Top row: eyebrow + heading + sub -->
			<div class="mb-6 md:mb-8">
				<p class="wg-eyebrow inline-flex items-center gap-2 font-body text-[0.75rem] font-bold tracking-[0.09em] uppercase text-brand-violet mb-3" data-gs-eyebrow>
					<span class="wg-eyebrow-dot w-1.5 h-1.5 rounded-full bg-brand-violet flex-shrink-0" aria-hidden="true"></span>
					<?php echo esc_html( $eyebrow ); ?>
				</p>
				<h2 class="wg-heading font-heading text-[clamp(2rem,4vw,3.375rem)] font-extrabold leading-[1.1] tracking-[-0.035em] text-brand-dark m-0 mb-2">
					<?php echo esc_html( $heading ); ?>
				</h2>
				<?php if ( $text ) : ?>
					<p class="wg-sub font-body text-[1.25rem] text-brand-ink leading-[1.7] m-0 max-w-[480px]">
						<?php echo esc_html( $text ); ?>
					</p>
				<?php endif; ?>
			</div>

			<?php if ( $show_filter && ! empty( $terms ) ) : ?>
				<div class="flex flex-wrap gap-2" role="tablist" aria-label="<?php esc_attr_e( 'Filter projects by type', 'grosharp' ); ?>">
					<button class="wg-filter-btn is-active font-body text-[0.8125rem] font-semibold px-4 py-1.5 rounded-control border border-black/[0.12] bg-transparent text-brand-ink cursor-pointer transition-colors duration-200 whitespace-nowrap hover:border-brand-violet hover:text-brand-violet" data-filter="all" role="tab" aria-selected="true">
						<?php esc_html_e( 'All', 'grosharp' ); ?>
					</button>
					<?php foreach ( $terms as $term ) : ?>
						<button class="wg-filter-btn font-body text-[0.8125rem] font-semibold px-4 py-1.5 rounded-control border border-black/[0.12] bg-transparent text-brand-ink cursor-pointer transition-colors duration-200 whitespace-nowrap hover:border-brand-violet hover:text-brand-violet" data-filter="<?php echo esc_attr( $term->slug ); ?>" role="tab" aria-selected="false">
							<?php echo esc_html( $term->name ); ?>
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<!-- Projects grid -->
		<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8" data-wg-grid>

			<?php if ( $use_placeholders ) : ?>
				<?php foreach ( $placeholders as $p ) : ?>
					<article class="flex flex-col group" data-wg-card data-type="<?php echo esc_attr( $p['slug'] ); ?>">
						<a class="flex flex-col gap-3 md:gap-4 no-underline" href="<?php echo esc_url( $p['url'] ); ?>">
							<div class="relative overflow-hidden rounded-xl md:rounded-2xl aspect-[4/3]" style="background:<?php echo esc_attr( $p['bg'] ); ?>">
								<span class="absolute bottom-3 left-3 md:bottom-4 md:left-4 w-8 h-8 md:w-9 md:h-9 rounded-full bg-[rgba(13,14,20,0.75)] backdrop-blur-sm flex items-center justify-center transition-all duration-300 group-hover:bg-brand-violet group-hover:scale-110">
									<?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</span>
							</div>
							<div class="flex flex-col gap-0.5">
								<p class="font-body text-[0.75rem] md:text-[0.8125rem] font-medium text-brand-muted m-0 tracking-[0.01em]"><?php echo esc_html( $p['client'] ); ?></p>
								<h3 class="font-heading text-[1rem] md:text-[clamp(1rem,1.8vw,1.25rem)] font-bold tracking-[-0.02em] text-brand-dark leading-[1.25] m-0 transition-colors duration-200 group-hover:text-brand-violet"><?php echo esc_html( $p['title'] ); ?></h3>
							</div>
						</a>
					</article>
				<?php endforeach; ?>

			<?php else : ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php
					$type_terms = get_the_terms( get_the_ID(), 'project_type' );
					$type_slug  = ( is_array( $type_terms ) && ! empty( $type_terms ) ) ? implode( ' ', wp_list_pluck( $type_terms, 'slug' ) ) : '';
					$client     = get_post_meta( get_the_ID(), 'project_client', true );
					?>
					<article class="flex flex-col group" data-wg-card data-type="<?php echo esc_attr( $type_slug ); ?>">
						<a class="flex flex-col gap-3 md:gap-4 no-underline" href="<?php echo esc_url( get_permalink() ); ?>">
							<div class="relative overflow-hidden rounded-xl md:rounded-2xl aspect-[4/3] bg-[#e8e8f4]">
								<?php if ( has_post_thumbnail() ) : ?>
									<img class="w-full h-full object-cover block transition-transform duration-[650ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:scale-[1.04]"
									     src="<?php the_post_thumbnail_url( 'grosharp-card-lg' ); ?>"
									     alt="<?php the_title_attribute(); ?>"
									     loading="lazy" />
								<?php endif; ?>
								<span class="absolute bottom-3 left-3 md:bottom-4 md:left-4 w-8 h-8 md:w-9 md:h-9 rounded-full bg-[rgba(13,14,20,0.75)] backdrop-blur-sm flex items-center justify-center transition-all duration-300 group-hover:bg-brand-violet group-hover:scale-110">
									<?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</span>
							</div>
							<div class="flex flex-col gap-0.5">
								<?php if ( $client ) : ?>
									<p class="font-body text-[0.75rem] md:text-[0.8125rem] font-medium text-brand-muted m-0 tracking-[0.01em]"><?php echo esc_html( $client ); ?></p>
								<?php endif; ?>
								<h3 class="font-heading text-[1rem] md:text-[clamp(1rem,1.8vw,1.25rem)] font-bold tracking-[-0.02em] text-brand-dark leading-[1.25] m-0 transition-colors duration-200 group-hover:text-brand-violet"><?php the_title(); ?></h3>
							</div>
						</a>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			<?php endif; ?>

		</div>

	</div>
</section>
