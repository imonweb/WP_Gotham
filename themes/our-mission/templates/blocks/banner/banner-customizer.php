<section class="banner-main">
	<div class="container">
		<div class="banner-inner">
			<div class="banner-left-side">
				<h1><?php echo wp_kses( get_theme_mod( 'ourm_banner_title' ), array( 'span' => array( 'class' => true ), 'br' => true ) ); ?></h1>
				<span><?php echo wp_kses_post( get_theme_mod( 'ourm_banner_subtitle' ) ); ?></span>
				<div class="banner-socials">
					<ul class="banner-socials-list">
						
							<li><a href="<?php echo esc_url( get_theme_mod( 'ourm_fb_link' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'ourm_fb_icon' ) ); ?>" alt=""></a></li>
							<li><a href=""><img src="" alt=""></a></li>
							<li><a href=""><img src="" alt=""></a></li>
						
					</ul>

				</div>
			</div>
			<div class="banner-right-side">
				<img src="<?php echo esc_url( get_theme_mod( 'ourm_banner_image' ) ); ?>" alt="">
			</div>
		</div>
	</div>
	<div class="circles-shapes-home" style="background-image: url('<?php echo esc_url( get_theme_mod( 'ourm_banner_circles' ) ); ?>')"></div>
</section>




