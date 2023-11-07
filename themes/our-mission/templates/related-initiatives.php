<?php

$related_ini = get_posts(
	array(
		'post_type'      => 'ourm_initiatives',
		'orderby'        => 'rand',
		'exclude'        => get_the_ID(),
		'posts_per_page' => 3,
	)
);

?>


<div class="initiatives-posts-inner related">

	<div class="initiative-items">
		<?php

		foreach ( $related_ini as $post ) :
			setup_postdata( $post );
			?>
			<div class="initiative-item">
					<div class="initiative-item-header">
						<div class="district-initiative">
							<?php
							$selected_district = get_field( 'initiative_district', $post->ID );
							$all_disctricts    = ourm_get_disctricts();

							?>
							<?php if ( array_key_exists( $selected_district, $all_disctricts ) ) : ?>
								<?php echo esc_html( $all_disctricts[ $selected_district ] ); ?>
								<?php endif; ?>
						</div>

						<?php
						$selected_status = get_field( 'initiative_status', $post->ID );
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
					<?php echo get_the_title(); ?>
					</h5>
					<div class="initiative-item-excerpt">
					<?php echo wp_trim_words( get_the_content(), 20 ); ?>
					</div>
					<div class="votes-initiative-block">
								<?php
								$required_votes = get_field( 'required_votes', $post->ID );
								$accepted_votes = get_field( 'accepted_votes', $post->ID );
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

	   

<?php endforeach; ?>

<?php wp_reset_postdata(); ?>
</div>
</div>
