<?php
global $ourm_settings;
?>
<header class="header-main">
		<div class="container">

			<div class="header-items">

			<div class="header-logo">
				<?php the_custom_logo();?>
			</div>
			<div class="header-lang">
				<a href="#" class="btn-outline-dark">Fr</a>
			</div>
			
			
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'container' => false,
						'menu_class' => 'header-menu',
						
					)
				);
				?>
					<div class="header-buttons">
					<div class="form-search-icon">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M9.16667 15.8333C12.8486 15.8333 15.8333 12.8486 15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							<path d="M17.5 17.5L13.875 13.875" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</div>
						<?php get_search_form() ;?>
						<a href="" class="btn-light"><?php _e('Leave appeal', 'our-mission'); ?></a>
					</div>
			</div>

		</div>
</header>
