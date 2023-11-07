<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package our-mission
 */

get_header();
?>
<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
<div class="team-single-block fornews">
	<div class="container">
		<div class="back-button-wrapper">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="back-button">
				<span>
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10.25 4.5L5.75 9L10.25 13.5" stroke="#8DA3C6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</span>
				<?php esc_html_e( 'Back to news', 'our-mission' ); ?>
			</a>
		</div>
		<div class="team-title">
			<?php
			$cat = wp_get_post_categories( get_the_ID(), array( 'fields' => 'all' ) );
			?>
			<?php if ( ! empty( $cat ) ) : ?>
				<span><?php echo esc_html( $cat[0]->name ); ?></span>
			<?php endif; ?>
			<h1><?php echo wp_kses_post( get_the_title() ); ?></h1>
			<span class="member-staff"><?php echo wp_date( 'j F Y', strtotime( get_the_date( 'Y-m-d' ) ) ); ?></span>
		</div>
	</div>
</div>
<div class="team-single-content ">
	<div class="container">
		<div class="kh-single-content">
			<?php the_content(); ?>
		</div>

		<div class="team-single-share">
			<span><?php esc_html_e( 'Share', 'our-mission' ); ?></span>
			<ul class="socials-team">
				<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() . $_SERVER['REQUEST_URI']; ?>">
						<svg width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.2792 11.165L10.8493 7.57282H7.2831V5.24272C7.2831 4.25971 7.78037 3.30097 9.37763 3.30097H11V0.242718C11 0.242718 9.52831 0 8.12192 0C5.18356 0 3.26484 1.72087 3.26484 4.83495V7.57282H0V11.165H3.26484V19.8495C3.92032 19.949 4.59087 20 5.27397 20C5.95708 20 6.62763 19.949 7.2831 19.8495V11.165H10.2792Z" fill="#3454D2" />
						</svg>

					</a></li>
				<li><a href="https://telegram.me/share/url?url=<?php echo get_permalink() . $_SERVER['REQUEST_URI']; ?>">
						<svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.301966 7.44246C2.34803 6.35383 4.63198 5.4452 6.76599 4.53196C10.4373 3.03613 14.1232 1.56623 17.8463 0.197773C18.5707 -0.0353846 19.8723 -0.263372 19.9999 0.773533C19.93 2.24132 19.6425 3.70051 19.4453 5.15971C18.9449 8.36861 18.3664 11.5665 17.8023 14.7649C17.6079 15.8302 16.2263 16.3817 15.3423 15.6999C13.2177 14.3138 11.0769 12.941 8.97948 11.5227C8.29243 10.8483 8.92954 9.87992 9.54314 9.39835C11.293 7.73262 13.1487 6.31738 14.8071 4.56556C15.2544 3.52212 13.9326 4.40149 13.4967 4.67097C11.1011 6.26555 8.76424 7.9575 6.23861 9.35893C4.94851 10.0449 3.44489 9.45869 2.15538 9.07592C0.999199 8.61351 -0.694956 8.14749 0.301966 7.44246Z" fill="#3454D2" />
						</svg>

					</a></li>

			</ul>
		</div>

	</div>

</div>

	<?php
	get_template_part(
		'templates/appeal-banner',
		'',
		array(
			'title'   => __( 'Join our team!', 'our-mission' ),
			'socials' => true,
		)
	);
	?>
	<?php get_template_part( 'templates/related-news', '', array( 'exclude' => get_the_ID(), 'cat' => $cat[0]->term_id ) ); ?>
<?php	
// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				?>
				<div class="container">
				<?php comments_template(); ?>
				</div>
				<?php
				
			endif; ?>
	<?php endwhile; ?>
<?php
get_footer();
