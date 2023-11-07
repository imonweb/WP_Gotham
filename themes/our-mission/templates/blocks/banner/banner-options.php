<section class="banner-main">
	<div class="container">
		<div class="banner-inner">
			<div class="banner-left-side">
				<?php

				$ourm_banner = get_option( 'ourm_banner' );
				?>
				<?php if ( isset( $ourm_banner['banner_title'] ) && ! empty( $ourm_banner['banner_title'] ) ) : ?>
				<h1>
					<?php
					echo wp_kses(
						$ourm_banner['banner_title'],
						array(
							'span' => array( 'class' => true ),
							'br'   => true,
						)
					);
					?>
					</h1>
				<?php endif; ?>
				<?php if ( isset( $ourm_banner['banner_subtitle'] ) && ! empty( $ourm_banner['banner_subtitle'] ) ) : ?>
				<span><?php echo wp_kses_post( $ourm_banner['banner_subtitle'] ); ?></span>
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
			<?php if ( isset( $ourm_banner['banner_subtitle'] ) && ! empty( $ourm_banner['banner_subtitle'] ) ) : ?>
				<?php $image_url = wp_get_attachment_image_url( $ourm_banner['banner_image'], 'full' ); ?>
				<img src="<?php echo esc_url( $image_url ); ?>" alt="">
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="circles-shapes-home" style="background-image: url('<?php echo esc_url( get_theme_mod( 'ourm_banner_circles' ) ); ?>')"></div>
</section>
