<section class="banner-main">
	<div class="container">
		<div class="banner-inner">
			<div class="banner-left-side">
				<?php
				global $post;
				$banner_title = get_field( 'banner_title' , $post->ID, );
				$banner_subtitle = get_field( 'banner_subtitle', $post->ID,);
				$banner_image = get_field( 'banner_image', $post->ID );
				?>
				<?php if ( $banner_title ) : ?>
				<h1>
					<?php
					echo wp_kses(
						$banner_title,
						array(
							'span' => array( 'class' => true ),
							'br'   => true,
						)
					);
					?>
					</h1>
				<?php endif; ?>
				<?php if ( $banner_subtitle ) : ?>
				<span><?php echo wp_kses_post( $banner_subtitle ); ?></span>
				<?php endif; ?>
				<div class="banner-socials">
					<ul class="banner-socials-list">
						
							<li><a href="<?php echo esc_url( get_theme_mod( 'ourm_fb_link' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'ourm_fb_icon' ) ); ?>" alt=""></a></li>
							<li><a href=""><img src="" alt=""></a></li>
							<li><a href=""><img src="" alt=""></a></li>
						
					</ul>

				</div>
			</div>
			<div class="banner-right-side">
			<?php if ( $banner_image ) : ?>
				
				<img src="<?php echo esc_url( $banner_image ); ?>" alt="">
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="circles-shapes-home" style="background-image: url('<?php echo esc_url( get_theme_mod( 'ourm_banner_circles' ) ); ?>')"></div>
</section>
