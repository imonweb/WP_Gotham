<section class="banner-main">
	<div class="container">
		<div class="banner-inner">
			<div class="banner-left-side">
				<h1><?php echo wp_kses(
					get_theme_mod( 'ourm_kirki_banner_title' ),
					array(
						'span' => array( 'class' => true ),
						'br'   => true,
					)
				); ?></h1>
				<span><?php echo wp_kses_post( get_theme_mod( 'ourm_kirki_banner_subtitle' ) ); ?></span>
				<div class="banner-socials">
					<ul class="banner-socials-list">
						<?php
						$socials = get_theme_mod( 'ourm_kirki_socials' );
						?>
							<?php foreach ( $socials as $social ) : ?>
							<li><a href="<?php echo esc_url( $social['link_url'] ); ?>" title="<?php echo esc_attr( $social['link_text'] ); ?>"><img src="<?php echo esc_url( $social['link_icon'] ); ?>" alt=""></a></li>
							
							<?php endforeach; ?>
						
					</ul>

				</div>
			</div>
			<div class="banner-right-side">
				<img src="<?php echo esc_url( get_theme_mod( 'ourm_kirki_banner_image' ) ); ?>" alt="">
			</div>
		</div>
	</div>
	<div class="circles-shapes-home"></div>
</section>
