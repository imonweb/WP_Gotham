<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package our-mission
 */

get_header();
?>

<div class="initiative-archive-block">
	<div class="container">
		<div class="initiative-title">
			<h1><?php echo wp_kses_post( __( 'Search results ', 'our-mission' ) ); ?></h1>
			<form role="search" method="get" class="main-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

				<div class="form-search-wrapper">
				
					<input type="text" class="search-field" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php _e( 'Search', 'our-mission' ); ?>" />

					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M9.16667 15.8333C12.8486 15.8333 15.8333 12.8486 15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333Z" stroke="#090C1A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						<path d="M17.5 17.5L13.875 13.875" stroke="#090C1A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" " />
					</svg>
					<button type="submit" class="btn-full-blue"><?php echo esc_html( 'Search', 'our-mission' ); ?></button>
				</div>
				
			</form>
			<span class="subtitle">
			<?php
			global $wp_query;
			printf( __( 'Found materials on your request: <span>%d</span>', 'our-mission' ), $wp_query->found_posts );
			?>
			</span>
		</div>
	</div>
</div>
<div class="ourm-search">
	<div class="container">
		<div class="search-filter">
			<ul>
				<li><a href="#" class="active" data-container="all">All</a></li>
				<li><a href="#" data-container="projects">Projects</a></li>
				<li><a href="#" data-container="events">Events</a></li>
				<li><a href="#" data-container="news" >News</a></li>
				<li><a href="#" data-container="initiatives">Initiatives</a></li>
			</ul>
		</div>

		<!-- Projects -->
		<?php
			$projects_query = new WP_Query(
				array(
					'post_type'      => 'ourm_projects',
					'posts_per_page' => -1,
					's'              => get_search_query(),

				)
			);
			if ( $projects_query->have_posts() ) :
				?>
				<div class="projects">
					<h3>
						<?php printf(__('Projects <span>%d</span>', 'our-mission'), $projects_query->found_posts);?>
					</h3>
					<div class="project-items">
				<?php
				while ( $projects_query->have_posts() ) :
					$projects_query->the_post();
					?>
					<div class="project-item" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>')">

						<h5 class="project-item-title">
							<?php echo wp_kses_post( get_the_title() ); ?>
						</h5>
						<div class="project-item-excerpt">
						<?php echo wp_kses_post( get_the_excerpt() ); ?>
						</div>

						<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more"> <?php esc_html_e( 'Read more', 'ourm-mission' ); ?>
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.16602 10H15.8327" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M11.5 5L16.5 10L11.5 15" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</a>


					</div>
					<?php
			endwhile;
				?>
				</div>
			</div>
				<?php
			endif;

			?>
			<!-- Projects -->
			<!-- Events -->
			<?php
			$events_query = new WP_Query(
				array(
					'post_type'      => 'ourm_events',
					'posts_per_page' => -1,
					's'              => get_search_query(),

				)
			);
			if ( $events_query->have_posts() ) :
				?>
				<div class="events">
					<h3>
						<?php printf(__('Events <span>%d</span>', 'our-mission'), $events_query->found_posts);?>
					</h3>
					<div class="events-items">
				<?php
				while ( $events_query->have_posts() ) :
					$events_query->the_post();
					?>
					  <div class="events-item">
					<div class="events-item__header">
						<h4><?php echo get_the_title(); ?></h4>
						<div class="events-date">
							<span class="event-icon">
								<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M20.5347 6.88037H7.4682C6.43729 6.88037 5.60156 7.63251 5.60156 8.56031V20.3199C5.60156 21.2477 6.43729 21.9999 7.4682 21.9999H20.5347C21.5656 21.9999 22.4013 21.2477 22.4013 20.3199V8.56031C22.4013 7.63251 21.5656 6.88037 20.5347 6.88037Z" stroke="#8C96A3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M5.60156 11.9199H22.4013" stroke="#8C96A3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M17.7344 5.2002V8.56008" stroke="#8C96A3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M10.2695 5.2002V8.56008" stroke="#8C96A3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</span>
							<span>
							<?php
							$date_event = get_field( 'date_event' );
							 echo wp_date( 'j F Y', strtotime( $date_event ) );
							?>
							  </span>
						</div>
						<div class="events-format">
							<span  class="event-icon"><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M23.7755 8.91015C23.6654 8.47014 23.4411 8.067 23.1253 7.74142C22.8095 7.41585 22.4133 7.17938 21.9769 7.0559C20.3822 6.6665 14.0036 6.6665 14.0036 6.6665C14.0036 6.6665 7.62498 6.6665 6.03032 7.09298C5.59387 7.21646 5.19774 7.45293 4.88193 7.77851C4.56613 8.10408 4.34183 8.50723 4.2317 8.94724C3.93985 10.5656 3.79709 12.2073 3.80522 13.8517C3.79481 15.5086 3.93758 17.1628 4.2317 18.7933C4.35311 19.2197 4.58243 19.6075 4.89751 19.9193C5.21258 20.2311 5.60275 20.4564 6.03032 20.5734C7.62498 20.9999 14.0036 20.9999 14.0036 20.9999C14.0036 20.9999 20.3822 20.9999 21.9769 20.5734C22.4133 20.4499 22.8095 20.2135 23.1253 19.8879C23.4411 19.5623 23.6654 19.1592 23.7755 18.7191C24.0651 17.113 24.2079 15.4838 24.202 13.8517C24.2124 12.1949 24.0696 10.5407 23.7755 8.91015V8.91015Z" stroke="#8C96A3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M11.9141 16.8837L17.245 13.852L11.9141 10.8203V16.8837Z" stroke="#8C96A3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg></span>
							<span>Online</span>
						</div>
						<div class="event-expand">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19 14L12 7L5 14" stroke="#3454D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

						</div>
					</div>
					<div class="events-item__content">
						<div class="events-content">
							<div class="events-content__left">
							<?php echo get_the_content(); ?>
							<a href="#" class="btn-full-blue"><?php echo esc_html( 'Sign in', 'our-mission' ); ?></a>
							</div>
							<div class="events-content__right">
							<div class="events-image">
							<?php the_post_thumbnail( 'full' ); ?>
							</div>
							</div>
						</div>
						<div class="events-share">
						<span><?php echo esc_html( 'Share', 'our-mission' ); ?></span>
						<ul class="footer-socials">
							
					<?php $socials = get_theme_mod( 'ourm_kirki_socials' ); ?>

					<?php foreach ( $socials as $social ) : ?>
				<li><a href="<?php echo esc_url( $social['link_url'] ); ?>"><img src="<?php echo esc_url( $social['link_icon'] ); ?>" alt=""></a></li>
			
				<?php endforeach; ?>
		
		</ul>
						</div>
					
					</div>
				  </div>
					<?php
			endwhile;
				?>
				</div>
			</div>
				<?php
			endif;

			?>
			<!-- Events -->
			<!-- News -->
			<!-- News -->
			<!-- Initiatives -->
			<!-- Initiatives -->
	</div>
</div>

<?php

get_footer();
