<?php
$post = $args['post'];
?>
<div class="container">
<div class="propose-successfull-frame">
	<div class="propose-successfull-frame__left">
		<h1><?php esc_html_e( 'Thank you for your indifference!', 'our-mission' ); ?></h1>
		<p><?php esc_html_e( 'Your initiative has been successfully submitted and will be reviewed within 2-3 business days. You will receive an email to gothamoff@gmail.com when the initiative is published', 'our-mission' ); ?></p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'To home', 'our-mission' ); ?></a>
		<div>
			<span><?php esc_html_e( 'Join our team!', 'our-mission' ); ?></span>
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
	<div class="propose-successfull-frame__right">
	<div class="initiative-item">
					<div class="initiative-item-header">
						<div class="district-initiative">
							<?php
							$selected_district = get_post_meta( $post->ID, 'initiative_district', true);
							$all_disctricts    = ourm_get_disctricts();

							?>
							<?php if ( array_key_exists( $selected_district, $all_disctricts ) ) : ?>
								<?php echo esc_html( $all_disctricts[ $selected_district ] ); ?>
								<?php endif; ?>
						</div>

						<?php
						$selected_status = get_post_meta(  $post->ID, 'initiative_status', true);
						$all_statuses    = ourm_get_statuses();

						?>
						<?php if ( array_key_exists( $selected_status, $all_statuses ) ) : ?>
							<?php
							switch ( $selected_status ) {
								case 'on-keep':
									?>
									<div class="status-initiative keep">
										<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M11.6667 3L15 6.33333L6.33333 15H3V11.6667L11.6667 3Z" stroke="#8660F4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										</svg>

									<?php echo esc_html( $all_statuses[ $selected_status ] ); ?>
								</div>
									<?php
									break;
								case 'completed':
									?>
										<div class="status-initiative completed">
										<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M15 6L8.125 13L5 9.81818" stroke="#16B308" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										</svg>

									<?php echo esc_html( $all_statuses[ $selected_status ] ); ?>
								</div>
										<?php
									break;
								case 'on-consider':
									?>
													<div class="status-initiative consider">
													<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M8.99885 15.2999C12.5611 15.2999 15.4489 12.4122 15.4489 8.84992C15.4489 5.28767 12.5611 2.3999 8.99885 2.3999C5.4366 2.3999 2.54883 5.28767 2.54883 8.84992C2.54883 12.4122 5.4366 15.2999 8.99885 15.2999Z" stroke="#E7A600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M9 4.97998V8.84999L11.58 10.14" stroke="#E7A600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										</svg>
			
									<?php echo esc_html( $all_statuses[ $selected_status ] ); ?>
											</div>
													<?php
									break;
								case 'denied':
									?>
									<div class="status-initiative denied">
										<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12.6004 5.3999L5.40039 12.5999" stroke="#BC403A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M5.40039 5.3999L12.6004 12.5999" stroke="#BC403A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										</svg>
						
									<?php echo esc_html( $all_statuses[ $selected_status ] ); ?>
									</div>
									<?php
									break;
							}

								endif;
						?>
									
							  
					</div>
					<h5 class="initiative-item-title">
					<?php echo $post->post_title; ?>
					</h5>
					<div class="initiative-item-excerpt">
					<?php echo wp_trim_words( $post->content, 20 ); ?>
					</div>
					<div class="votes-initiative-block">
								<?php
								$required_votes = get_post_meta( $post->ID, 'required_votes', true );
								$accepted_votes = get_post_meta(  $post->ID, 'accepted_votes', true );
								$round_votes    = 0;
								
								if( $accepted_votes && $required_votes ) {
									$round_votes    = (int) $accepted_votes / (int) $required_votes * 100;
								}
								?>
						<div class="voted-header">
							<div class="votes-initiative"><?php printf( '<span>%d</span> signatures', $accepted_votes ); ?> </div>
							<div class="votes-initiative-percent"><?php echo esc_html( floor( $round_votes ) . '%' ); ?></div>
						</div>
						<span class="range-total">
							
								<span class="range-completed" style="width: <?php echo esc_html( $round_votes . '%' ); ?>"></span>
							
						</span>
						<?php
							$date_created = get_the_date( 'Y-m-d' );
							$date_now     = new DateTime( 'now' );

							$expiry_date_object = DateTime::createFromFormat( 'Y-m-d', $date_created );
							// expiry date is 100 days from $date_created;
							$expiry_date = $expiry_date_object->add( new DateInterval( 'P100D' ) );
							$interval    = $expiry_date->diff( $date_now )->format( '%a' );

						?>
						<?php if ( $date_now->format( 'Y-m-d' ) < $expiry_date->format( 'Y-m-d' ) ) : ?>
							<div class="dates-to-expire">
								<?php printf( _n( '%s day left', '%s days left', $interval, 'our-mission' ), $interval ); ?>
							
							</div>
					   <?php endif; ?>
					</div>


					<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more-blue"> <?php esc_html_e( 'Read more', 'our-mission' ); ?>
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4.16602 10H15.8327" stroke="#3454D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							<path d="M11.5 5L16.5 10L11.5 15" stroke="#3454D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</a>


				</div>	
	</div>
</div>
</div>
