<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package our-mission
 */

get_header();
?>
<div class="news-archive-block">
	<div class="container">
		<div class="news-title">
			<span><?php esc_html_e( 'News', 'our-mission' ); ?></span>
			<h1><?php echo wp_kses_post( __( 'What <span class="highlighted">media</span> says about us', 'our-mission' ) ); ?></h1>
		</div>
	</div>
</div>
<div class="news">
	<div class="container">
		<div class="news-posts-inner">
			<div class="news-posts-filter">
				<div class="kh-category-filter">
				<!-- Filters -->
					<?php ourm_get_categories_html(); ?>
				</div>

			</div>

			<div class="news-items">
				<?php
				global $wp_query;
				// var_dump($wp_query);
				$index = 0;
				while ( have_posts() ) :
					the_post();
					$index++;
					?>

					<div class="news-item">
						<a href="" class="news-image">
							<?php the_post_thumbnail( 'full' ); ?>

						</a>
						<div class="news-meta">
						<?php $cats = wp_get_post_categories( get_the_ID(), array( 'fields' => 'all' ) ); ?>
								<a href="<?php echo esc_url( get_term_link( $cats[0]->term_id ) ); ?>" class="news-cat"><?php echo esc_html( $cats[0]->name ); ?></a>
						
							<span><?php echo get_the_date( 'j F Y' ); ?></span>
						</div>
						<a href="<?php echo get_permalink(); ?>" class="news-title"><?php echo get_the_title(); ?></a>
					</div>


					<?php
					if ( $index > 6 ) {
						get_template_part( 'templates/appeal-banner', '', array( 'socials' => true ) );
					}

					?>

			
				
				<?php endwhile; ?>


			</div>
		</div>

		<?php
		$args = array(
			'show_all'  => false,
			'end_size'  => 1,
			'mid_size'  => 0,
			'prev_next' => true,
			'prev_text' => __(
				'<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.25 4.5L5.75 9L10.25 13.5" stroke="#8DA3C6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>'
			),
			'next_text' => __(
				'<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.5 15L13.5 10L8.5 5" stroke="#8C96A3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            '
			),

		);
		the_posts_pagination( $args );
		?>

	</div>
</div>
<?php
get_footer();
