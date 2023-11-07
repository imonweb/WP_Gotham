<?php
/**
 * The template for displaying author page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package our-mission
 */

get_header();
$author_name = get_the_author();
$author_id   = get_the_author_meta( 'ID' );
$user        = get_user_by( 'id', $author_id );
$user_phone  = get_user_meta( $author_id, 'user_phone', true );


?>
<div id="ourm-author">
	<div class="container">
<form action="" id="ourm-author-form">

<!-- Personal information -->
	<div>
		<h3>Personal information</h3>

		<div class="form-group">
			<input type="text" name="user_name" value="<?php echo $user->display_name; ?>" placeholder="<?php esc_attr_e( 'Name', 'our-mission' ); ?>" :readonly="readonly.name">
		
			<span @click="toggleRead('name')">
				<svg width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M19.7451 4.21191L24.6814 9.16956L7.80147 26.1224L3.62321 26.4349C3.01494 26.4804 2.50872 25.972 2.55401 25.3611L2.86514 21.1648L19.7451 4.21191Z" fill="#4D5DAE"/>
					<path d="M28.2981 4.24564L24.7701 0.708066C24.3801 0.317012 23.7478 0.317012 23.3578 0.708066L20.5352 3.53836L25.4755 8.49207L28.2981 5.66177C28.6881 5.27072 28.6881 4.6367 28.2981 4.24564Z" fill="#4D5DAE"/>
				</svg>
			</span>
		</div>
		<div class="form-group">
			<input type="email" name="user_email" value="<?php echo $user->user_email; ?>" placeholder="<?php esc_attr_e( 'Email', 'our-mission' ); ?>" :readonly="readonly.email">
		
			<span @click="toggleRead('email')">
				<svg width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M19.7451 4.21191L24.6814 9.16956L7.80147 26.1224L3.62321 26.4349C3.01494 26.4804 2.50872 25.972 2.55401 25.3611L2.86514 21.1648L19.7451 4.21191Z" fill="#4D5DAE"/>
					<path d="M28.2981 4.24564L24.7701 0.708066C24.3801 0.317012 23.7478 0.317012 23.3578 0.708066L20.5352 3.53836L25.4755 8.49207L28.2981 5.66177C28.6881 5.27072 28.6881 4.6367 28.2981 4.24564Z" fill="#4D5DAE"/>
				</svg>
			</span>
		</div>
		<div class="form-group">
			<input type="text" name="user_phone" value="<?php echo $user_phone; ?>" placeholder="<?php esc_attr_e( 'Phone', 'our-mission' ); ?>" :readonly="readonly.phone">
		
			<span @click="toggleRead('phone')">
				<svg width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M19.7451 4.21191L24.6814 9.16956L7.80147 26.1224L3.62321 26.4349C3.01494 26.4804 2.50872 25.972 2.55401 25.3611L2.86514 21.1648L19.7451 4.21191Z" fill="#4D5DAE"/>
					<path d="M28.2981 4.24564L24.7701 0.708066C24.3801 0.317012 23.7478 0.317012 23.3578 0.708066L20.5352 3.53836L25.4755 8.49207L28.2981 5.66177C28.6881 5.27072 28.6881 4.6367 28.2981 4.24564Z" fill="#4D5DAE"/>
				</svg>
			</span>
		</div>
	</div>
<!-- Personal information -->
<!-- Equipment -->
<div>
		<h3>My Equipment</h3>
		<div class="equipment-container">
		<div class="equipment-block-left">
		<div class="equipment-row" v-for="(equipment, index ) in allEquipments" :class="addClass(index)">
			<div class="equipment-block">
				<img src="<?php echo wp_get_attachment_image_url( 350 ); ?>" />
				<div>
					<span>{{equipment.name}}</span>
					<span>{{equipment.efficiency}}</span>
				</div>
			</div>
		
			<span @click="editEquipment(index)">
				<svg width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M19.7451 4.21191L24.6814 9.16956L7.80147 26.1224L3.62321 26.4349C3.01494 26.4804 2.50872 25.972 2.55401 25.3611L2.86514 21.1648L19.7451 4.21191Z" fill="#4D5DAE"/>
					<path d="M28.2981 4.24564L24.7701 0.708066C24.3801 0.317012 23.7478 0.317012 23.3578 0.708066L20.5352 3.53836L25.4755 8.49207L28.2981 5.66177C28.6881 5.27072 28.6881 4.6367 28.2981 4.24564Z" fill="#4D5DAE"/>
				</svg>
			</span>

			<input type="hidden" :name="`equipment[${index}][name]`" :value="equipment.name">
			<input type="hidden" :name="`equipment[${index}][efficiency]`" :value="equipment.efficiency">
		</div>

		<div class="equipment-row">
			<div class="equipment-block">
				<img src="<?php echo wp_get_attachment_image_url( 350 ); ?>" />
				<div>
					<span>Add equipment</span>
					
				</div>
			</div>
		
			<span @click="addEquipment">
				<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15 2V28" stroke="#DEE1EA" stroke-width="4" stroke-linecap="round"/>
					<path d="M28 15H2" stroke="#DEE1EA" stroke-width="4" stroke-linecap="round"/>
				</svg>

			</span>
		</div>
		</div>
		<div class="equipment-block-right" v-if="selectedEquipment">
			<p>{{selectedEquipment.name === "" ? 'New Equipment' : selectedEquipment.name}}</p>
		<div class="form-group">
			<input type="text" @input="event => updateName(event,selectedEquipment.index)" :value="selectedEquipment.name" placeholder="<?php esc_attr_e( 'Name', 'our-mission' ); ?>">
		
		</div>
		
		<div class="form-group">
			<input type="text" @input="event => updateEffiency(event,selectedEquipment.index)" :value="selectedEquipment.efficiency" placeholder="<?php esc_attr_e( 'Efficiency', 'our-mission' ); ?>">
		
		</div>
		</div>
		</div>
</div>
<!-- Equipment -->



	<input type="hidden" name='action' value="update_author_form">
	<input type="hidden" name='user_ID' value="<?php echo $author_id; ?>">
	<?php wp_nonce_field(); ?>
	<button @click.prevent="submit" class="ourm-author-submit"><?php esc_html_e( 'Save changes', 'our-mission' ); ?></button>
</form>
</div>
</div>

<!-- My initiatives -->

<div class="initiatives related">
	<div class="container">
	<h3>My initiatives</h3>
<div class="initiatives-posts-inner related">

<div class="initiative-items">
	<?php
	$initiatives = get_posts(
		array(
			'post_type'      => 'ourm_initiatives',
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => 'email',
					'value'   => $user->user_email,
					'compare' => 'IN',
				),
			),
		)
	);
	if ( ! empty( $initiatives ) ) :
		foreach ( $initiatives as $post ) :
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
<?php endif; ?>
<?php wp_reset_postdata(); ?>
</div>
</div>
</div>
</div>

<script>
	const {createApp} = Vue;
	createApp({
		data() {
			return {
				
				readonly: {
					name: true,
					email: true,
					phone: true
				},
				newEquipment: {
					name: '',
					efficiency: ''
				},
				allEquipments: USER_DATA.equipment || [],
				selectedEquipment: null
			}
		},
		methods: {
		
			toggleRead(id) {
				this.readonly[id] = ! this.readonly[id]
			},
			addEquipment() {
				this.allEquipments = [...this.allEquipments, this.newEquipment]
			},
			editEquipment(i) {

				if(this.selectedEquipment && this.selectedEquipment.index === i) {
					this.selectedEquipment = null;
					return;
				}
				this.selectedEquipment = {...this.allEquipments.find((el, index) => index === i), index: i}
				
				
			},
			updateName(e,i) {
				this.selectedEquipment.name = e.target.value;
				const newValue = this.allEquipments.map((el,index) => index === i ? {...el ,name: e.target.value} : el)
				this.allEquipments = newValue;
			},
			updateEffiency(e,i) {
				this.selectedEquipment.efficiency =  e.target.value;
				const newValue = this.allEquipments.map((el,index) => index === i ? {...el ,efficiency: e.target.value} : el)
				this.allEquipments = newValue;
			},
			addClass(i) {
				if(this.selectedEquipment && this.selectedEquipment.index === i) {
					return 'active';
				}
				return '';
			},
			submit() {
				jQuery.ajax({
					url: MISSION_DATA.ajax_url,
					type: 'POST',
					data: jQuery('#ourm-author-form').serialize()
				})
				.then(res => {
					console.log(res)
				})
				.fail(err => {
					console.log(err)
				})
			}
		}
	}).mount('#ourm-author')
</script>
<?php

get_footer();
