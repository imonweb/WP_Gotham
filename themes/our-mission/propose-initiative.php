<?php
/**
 * Template Name: Propose initiative
 */
 get_header('blank');
?>
 <div class="propose-header-nav">
	
	<div class="back-button-wrapper">
					<a href="<?php echo esc_url( wp_get_referer() ); ?>" class="back-button">
						<span>
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10.25 4.5L5.75 9L10.25 13.5" stroke="#8DA3C6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</span>
						<?php esc_html_e( 'Back', 'our-mission' ); ?>
					</a>
	</div>
	<a href="#"><?php esc_html_e( 'Rules for submitting initiatives', 'our-mission' ); ?></a>
	
	<div class="propose-progress-bar"></div>
</div>

<div class="propose-initiate-block">
	<p><?php echo wp_kses_post( __( 'Propose Initiative. <span class="propose-step"><span>Step 1</span>/3</span>', 'our-mission' ) ); ?></p>
	<form id="propose_initiative">
	<div class="propose-initiate-steps">
		<!-- Step 1 -->
		<div class="propose-initiate-step active">

			<h1><?php esc_html_e( 'Please fill in your data', 'our-mission' ); ?></h1>

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
		</div>
		<!-- Step 1 -->
		<!-- Step 2 -->
		<div class="propose-initiate-step">
				
				<h1><?php esc_html_e( 'Create a headline for your initiative', 'our-mission' ); ?></h1>

				<div class="form-group">
					<label for="name"><?php esc_html_e( 'District', 'our-mission' ); ?></label>
					<select name="district">
						<?php foreach ( ourm_get_disctricts() as $key => $value ) : ?>
							<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
							<?php endforeach; ?>
					</select>
					<span class="propose-tip">
							<span>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M3.91797 15H8.99859V22.8508L20.0792 9H14.9986V1.14922L3.91797 15ZM10.9975 13H8.07812L12.9975 6.85078V11H15.9169L10.9975 17.1492V13Z" fill="#F9C63B"/>
								</svg>
							</span>
							<span><?php echo esc_html( 'Tip: choose your area correctly, it will help to collect more signatures from your neighbors', 'our-mission' ); ?></span>
					</span>
				</div>
				<div class="form-group">
					<label for="title"><?php esc_html_e( 'The essence of the appeal', 'our-mission' ); ?></label>
					<textarea name="title" placeholder="<?php esc_html_e( 'This will be your title', 'our-mission' ); ?>"></textarea>
					<span class="title-characters"><?php echo wp_kses_post( __( '<span>0</span>/100 characters', 'our-mission' ) ); ?></span>
					<span class="propose-tip">
							<span>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M3.91797 15H8.99859V22.8508L20.0792 9H14.9986V1.14922L3.91797 15ZM10.9975 13H8.07812L12.9975 6.85078V11H15.9169L10.9975 17.1492V13Z" fill="#F9C63B"/>
								</svg>
							</span>
							<span><?php echo esc_html( 'Tip: Write your title as easily as possible, because this is the first thing people will see', 'our-mission' ); ?></span>
					</span>
				</div>
			
		</div>
		<!-- Step 2 -->
		<!-- Step 3 -->
		<div class="propose-initiate-step">
				<h1><?php esc_html_e( 'Describe initiative', 'our-mission' ); ?></h1>
			
					<div class="form-group">
						<label for="content"><?php esc_html_e( 'Initiative text', 'our-mission' ); ?></label>
						<textarea id="content" name="content" placeholder="<?php esc_html_e( 'Add a description', 'our-mission' ); ?>">
						
						</textarea>
						
					</div>
					<div class="form-group form-group-accept">
						<input type="checkbox" name="accept" id="accept" />
						<label for="accept"><?php esc_html_e( 'I am agree with privacy policy', 'our-mission' ); ?></label>
						
					</div>
			</div>
			<!-- Step 3 -->
	</div>
	<input type="hidden" name="action" value="propose_initiative" />
	<?php wp_nonce_field();?>
	</form>
	
</div>

<div class="propose-footer-nav">
	<a href="#" id="prev-step">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M12.3889 3L16 6.61111L6.61111 16H3V12.3889L12.3889 3Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>	
		<?php esc_html_e( 'Previous step', 'our-mission' ); ?>

	</a>
	<a href="#" id="next-step"><?php esc_html_e( 'Next step', 'our-mission' ); ?>
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
			<path d="M4.16797 10H15.8346" stroke="#3454D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M11.5 5L16.5 10L11.5 15" stroke="#3454D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
	</a>
</div>


 <?php get_footer('blank');