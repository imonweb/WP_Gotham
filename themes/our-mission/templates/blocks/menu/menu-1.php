<?php
global $ourm_settings;
wp_enqueue_style( 'ourm-menu' );
?>
<header class="header-main">
		<div class="container">

			<div class="header-items">

				<div class="header-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $ourm_settings['ourm_dark_logo']['url'] ); ?>" /></a>	
					
				</div>
				<div class="header-lang">

						
				<span href="">

					<?php _e( 'FR', 'our-mission' ); ?>
				</span>

				<ul>
				<li>
					<a href="" ><?php _e( 'JAP', 'our-mission' ); ?></a>
				</li>
				<li>
					<a href=""><?php _e( 'EN', 'our-mission' ); ?></a>
				</li>
				</ul>

				</div>
				
				<nav id="site-navigation" class="main-navigation">
				<!--	<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'have' ); ?></button> -->
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'container'      => false,
							'menu_class'     => 'header-menu',

						)
					);
					?>
				</nav>
						<div class="header-buttons">
							<div class="form-search-icon">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M9.16667 15.8333C12.8486 15.8333 15.8333 12.8486 15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									<path d="M17.5 17.5L13.875 13.875" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
								</svg>
							</div>
							<?php get_search_form(); ?>
							<a href="" class="btn-dark"><?php _e( 'Leave appeal', 'our-mission' ); ?></a>
						</div>

				<div class="mobile-menu-bars">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</div>
			</div>

			<!-- Mobile menu -->
			<div class="mobile-menu-items">
				<div class="mobile-menu-inner">
					<div class="mobile-lang">
		

							<span href="" class="btn-outline-dark">

								<?php _e( 'FR', 'our-mission' ); ?>
							</span>
							<ul>
						<li>
							<a href="" ><?php _e( 'JAP', 'our-mission' ); ?></a>
						</li>
						<li>
							<a href=""><?php _e( 'EN', 'our-mission' ); ?></a>
						</li>
						</ul>
						
					</div>
					<div class="mobile-header">
						<div class="mobile-search">
							<?php get_search_form(); ?>
						</div>


					</div>
					<div class="mobile-menu">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'container'      => false,
								'menu_class'     => 'header-menu',
								'menu_id'        => 'menu-mobile-primary',
							)
						);
						?>
					</div>
					<a href="" class="btn-light"><?php _e( 'Leave appeal', 'our-mission' ); ?></a>
				</div>
			</div>

		</div>
</header>
