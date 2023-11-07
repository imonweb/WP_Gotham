<?php
$socials = $args['socials'] ?? false;
$title   = $args['title'] ?? false;

?>
<div class="cant-without">
	<div class="container">
		<div class="cant-without-inner">
			<div class="cant-without-left full">
				<?php if ( $title ) : ?>
					<h3><?php echo wp_kses_post( $title ); ?></h3>
				<?php else : ?>
					<h3><?php echo wp_kses_post( __( 'I need your <span class="highlighted">participation</span>!', 'our-mission' ) ); ?></h3>
					<?php endif; ?>
				<span><?php esc_html_e( 'It was popularised in the 1960s with the release of Letraset sheets containing. It wase of Letraset sheets containing  ', 'our-mission' ); ?></span>
			</div>

			<div class="cant-without-right">
				<?php if ( $socials ) : ?>
					<ul class="socials-list-rounded">
						<?php
						$socials = get_theme_mod( 'ourm_kirki_socials' );
						?>
							<?php foreach ( $socials as $social ) : ?>
							<li><a href="<?php echo esc_url( $social['link_url'] ); ?>" title="<?php echo esc_attr( $social['link_text'] ); ?>"><img src="<?php echo esc_url( $social['link_icon'] ); ?>" alt=""></a></li>
							
							<?php endforeach; ?>
						
					</ul>
					<?php else : ?>
				<a href="#" class="btn-light"><?php esc_html_e( 'Leave appeal', 'our-mission' ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
