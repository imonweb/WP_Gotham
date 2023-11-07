<div class="initiatives-modal-inner">
	<div class="modal-header">
		<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
			<circle cx="40" cy="40" r="39.25" fill="white" stroke="#3454D2" stroke-width="1.5" />
			<path d="M46.9993 36L37.8327 45.3333L33.666 41.0909" stroke="#3454D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
		</svg>
		<span class="modal-close">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M5 5L19 19" stroke="#101010" stroke-width="2" />
				<path d="M19 5L5 19" stroke="#101010" stroke-width="2" />
			</svg>

		</span>
	</div>
	<div class="modal-body success">
		<h6><?php esc_html_e( 'Thank you for your vote', 'our-mission' ); ?></h6>
		<span><?php printf( __( 'You have successfully signed "%s', 'our-mission' ), $args['title'] ); ?></span>
		<a href="<?php echo esc_url( get_post_type_archive_link( 'ourm_initiatives' ) ); ?>" class="modal-button valid"><?php esc_html_e( 'See other initiatives', 'our-mission' ); ?></a>
	</div>
</div>
