<?php get_header(); ?>
<?php
while ( have_posts() ) :
	the_post();
	?>
	<div class="initiative-title-block">
		<div class="container">
			<div class="back-button-wrapper">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'ourm_initiatives' ) ); ?>" class="back-button">
					<span>
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.25 4.5L5.75 9L10.25 13.5" stroke="#8DA3C6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</span>
					<?php esc_html_e( 'Back to initiatives', 'our-mission' ); ?>
				</a>
			</div>
			<div class="initiative-title">
				<span><?php esc_html_e( 'Initiative', 'our-mission' ); ?></span>
				<h1><?php echo wp_kses_post( get_the_title() ); ?></h1>
			</div>
		</div>
	</div>
	<div class="initiative-single">
		<div class="container">
			<div class="initiative-single-content">
				<div class="initiative-single-content__left">
					<div class="initiative-item">
						<div class="initiative-item-header">
							<div class="district-initiative">
								<?php
								$dist_ini      = get_field( 'initiative_district' );
								$all_districts = ourm_get_disctricts();

								if ( array_key_exists( $dist_ini, $all_districts ) ) {
									echo $all_districts[ $dist_ini ];
								}
								?>
							</div>
							<?php

							$status_ini   = get_field( 'initiative_status' );
							$all_statuses = ourm_get_statuses();
							?>
							<?php if ( array_key_exists( $status_ini, $all_statuses ) ) : ?>
								<?php
								switch ( $status_ini ) {

									case 'on-keep':
										?>
										<div class="status-initiative keep">
											<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M11.6667 3L15 6.33333L6.33333 15H3V11.6667L11.6667 3Z" stroke="#8660F4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
											</svg>

											<?php echo $all_statuses[ $status_ini ]; ?>
										</div>
										<?php
										break;
									case 'completed':
										?>
										<div class="status-initiative completed">
											<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M15 6L8.125 13L5 9.81818" stroke="#16B308" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
											</svg>

											<?php echo $all_statuses[ $status_ini ]; ?>
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


											<?php echo $all_statuses[ $status_ini ]; ?>
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


											<?php echo $all_statuses[ $status_ini ]; ?>
										</div>
										<?php break; ?>
								<?php } ?>
							<?php endif; ?>
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

					</div>
					<div class="initiative-desc">
						<p class="desc"><?php esc_html_e( 'Description', 'our-mission' ); ?></p>
						<?php echo get_the_content(); ?>
					</div>
				</div>
				<div class="initiative-single-content__right">
					<div class="initiative_info">
						<div class="initiative_author">
							<div class="person">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M20 21V19C20 16.7909 18.2091 15 16 15H8C5.79086 15 4 16.7909 4 19V21" stroke="#090C1A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									<path fill-rule="evenodd" clip-rule="evenodd" d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#090C1A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
								</svg>

							</div>
							<div class="person-info">
								<span><?php esc_html_e( 'Author(initiator):', 'our-mission' ); ?></span>
								<span><?php echo get_the_author(); ?></span>
							</div>
						</div>
						<div class="initiative_date">
							<div class="date">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M3 6C3 4.89543 3.89543 4 5 4H19C20.1046 4 21 4.89543 21 6V20C21 21.1046 20.1046 22 19 22H5C3.89543 22 3 21.1046 3 20V6Z" stroke="#090C1A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									<path d="M16 2V6" stroke="#090C1A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									<path d="M8 2V6" stroke="#090C1A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									<path d="M3 10H21" stroke="#090C1A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
								</svg>

							</div>
							<div class="date-info">
								<span><?php esc_html_e( 'Date of publication:', 'our-mission' ); ?></span>
								<span><?php echo wp_date( 'j F Y', strtotime( get_the_date( 'Y-m-d' ) ) ); ?></span>
							</div>
						</div>
							<?php if('on-keep' === $status_ini && apply_filters('ourm_sign_initiative_by_user', true) ) : ?>
								<button class="btn-full-blue"><?php esc_html_e( 'Sign the initiative', 'our-mission' ); ?></button>
								<?php endif;?>
						
						
					</div>
					<div class="share-initiative">
						<div class="share-title">
							<?php esc_html_e( 'Share initiative', 'our-mission' ); ?>
						</div>
						<ul>
							<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() . $_SERVER['REQUEST_URI']; ?>">
									<svg width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M10.2792 11.165L10.8493 7.57282H7.2831V5.24272C7.2831 4.25971 7.78037 3.30097 9.37763 3.30097H11V0.242718C11 0.242718 9.52831 0 8.12192 0C5.18356 0 3.26484 1.72087 3.26484 4.83495V7.57282H0V11.165H3.26484V19.8495C3.92032 19.949 4.59087 20 5.27397 20C5.95708 20 6.62763 19.949 7.2831 19.8495V11.165H10.2792Z" fill="#8C96A3" />
									</svg>
								</a></li>
							<li><a href="https://telegram.me/share/url?url=<?php echo get_permalink() . $_SERVER['REQUEST_URI']; ?>">
									<svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0.301966 7.44246C2.34803 6.35383 4.63198 5.4452 6.76599 4.53196C10.4373 3.03613 14.1232 1.56623 17.8463 0.197773C18.5707 -0.0353846 19.8723 -0.263372 19.9999 0.773533C19.93 2.24132 19.6425 3.70051 19.4453 5.15971C18.9449 8.36861 18.3664 11.5665 17.8023 14.7649C17.6079 15.8302 16.2263 16.3817 15.3423 15.6999C13.2177 14.3138 11.0769 12.941 8.97948 11.5227C8.29243 10.8483 8.92954 9.87992 9.54314 9.39835C11.293 7.73262 13.1487 6.31738 14.8071 4.56556C15.2544 3.52212 13.9326 4.40149 13.4967 4.67097C11.1011 6.26555 8.76424 7.9575 6.23861 9.35893C4.94851 10.0449 3.44489 9.45869 2.15538 9.07592C0.999199 8.61351 -0.694956 8.14749 0.301966 7.44246Z" fill="#8C96A3" />
									</svg>

								</a></li>
							<li><a href="https://www.instagram.com/sharer.php?u=<?php echo get_permalink() . $_SERVER['REQUEST_URI']; ?>">
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M17.1538 0H2.84615C1.23077 0 0 1.23077 0 2.84615V17.1538C0 18.7692 1.23077 20 2.84615 20H17.1538C18.7692 20 20 18.7692 20 17.1538V2.84615C20 1.23077 18.7692 0 17.1538 0ZM10 16C13.3077 16 16 13.3846 16 10.2308C16 9.69231 15.9231 9.07692 15.7692 8.61539H17.4615V16.7692C17.4615 17.1538 17.1538 17.5385 16.6923 17.5385H3.30769C2.92308 17.5385 2.53846 17.2308 2.53846 16.7692V8.53846H4.3077C4.15385 9.07692 4.07693 9.61539 4.07693 10.1538C4 13.3846 6.69231 16 10 16ZM10 13.6923C7.84615 13.6923 6.15385 12 6.15385 9.92308C6.15385 7.84616 7.84615 6.15385 10 6.15385C12.1538 6.15385 13.8462 7.84616 13.8462 9.92308C13.8462 12.0769 12.1538 13.6923 10 13.6923ZM17.3846 5.46154C17.3846 5.92308 17 6.30769 16.5385 6.30769H14.3846C13.9231 6.30769 13.5385 5.92308 13.5385 5.46154V3.38462C13.5385 2.92308 13.9231 2.53846 14.3846 2.53846H16.5385C17 2.53846 17.3846 2.92308 17.3846 3.38462V5.46154Z" fill="#8C96A3" />
									</svg>

								</a></li>
							<li><a href="#" id="copy_link" data-link="<?php echo get_permalink(); ?>">
									<input type="hidden" id="copy_input" value="<?php echo get_permalink(); ?>">
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 9.5C7.5 8.39543 8.39543 7.5 9.5 7.5H16.3333C17.4379 7.5 18.3333 8.39543 18.3333 9.5V16.3333C18.3333 17.4379 17.4379 18.3333 16.3333 18.3333H9.5C8.39543 18.3333 7.5 17.4379 7.5 16.3333V9.5Z" stroke="#8C96A3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M4.16602 12.5H3.33268C2.41221 12.5 1.66602 11.7538 1.66602 10.8333V3.33329C1.66602 2.41282 2.41221 1.66663 3.33268 1.66663H10.8327C11.7532 1.66663 12.4993 2.41282 12.4993 3.33329V4.16663" stroke="#8C96A3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>


								</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php get_template_part( 'templates/initiative-banner' ); ?>

	<section class="initiatives related">
		<div class="container">
			<div class="initiatives-related-header">
				<h3 class="title-default"><?php esc_html_e( 'See also', 'our-mission' ); ?></h3>
			</div>
			<?php get_template_part( 'templates/related-initiatives' ); ?>
		</div>
	</section>

<!-- Sign the initiative form -->
	<div class="initiatives-modal">
		<div class="initiatives-modal-inner">
			<div class="modal-header">
				<h6><?php esc_html_e( 'Sign the initiative', ' our-mission' ); ?></h6>
				<span class="modal-close">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M5 5L19 19" stroke="#101010" stroke-width="2" />
						<path d="M19 5L5 19" stroke="#101010" stroke-width="2" />
					</svg>

				</span>
			</div>
			<div class="modal-body">
			<form action="" id="initiave-form">
					<div class="form-group">
						<label for="name"><?php esc_html_e( 'Your name', 'our-mission' ); ?></label>
						<input type="text" name="name" placeholder="<?php esc_html_e( 'Your name', 'our-mission' ); ?>">
					</div>
					<div class="form-group">
						<label for="name"><?php esc_html_e( 'Phone', 'our-mission' ); ?></label>
						<input type="tel" name="phone" placeholder="<?php esc_html_e( '+415(__)__-__-___', 'our-mission' ); ?>">
					</div>
					<div class="form-group">
						<label for="name"><?php esc_html_e( 'Email', 'our-mission' ); ?></label>
						<input type="email" name="email" placeholder="<?php esc_html_e( 'Email', 'our-mission' ); ?>">
					</div>
					<input type="hidden" name="action" value="initiative_order_ajax">
					<input type="hidden" name="initiative_id" value="<?php echo get_the_ID(); ?>">
					<input type="hidden" name="initiative_name" value="<?php echo get_the_title(); ?>">
					<?php 
					wp_nonce_field();
					 ?>
					<button class="modal-button" id="send_ini_data"><?php esc_html_e( 'Please fill in all data', 'our-mission' ); ?></button>
				</form>
			</div>

		</div>
	</div>
<!-- Sign the initiative form -->
<?php endwhile; ?>
<?php get_footer(); ?>
