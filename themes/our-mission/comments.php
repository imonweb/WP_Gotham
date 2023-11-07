<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package our-mission
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		
		<h2 class="comments-title">
			<?php
			$our_mission_comment_count = get_comments_number();
			printf( __( 'Comments <span>(%d)</span>', 'our-mission' ), $our_mission_comment_count );
			?>

		</h2><!-- .comments-title -->
		<?php
		$reviews_count  = get_comments(
			array(
				'post_id' => get_the_ID(),
				'type'    => 'review',
				'count'   => true,
				'parent'  => 0,
			)
		);
		$question_count = get_comments(
			array(
				'post_id' => get_the_ID(),
				'type'    => 'question',
				'count'   => true,
				'parent'  => 0,
			)
		);
		?>
		<div class="subtitle">
			<h3 class="reviews-subtitle">
				<?php

				$reviews_count_title = sprintf( __( 'Reviews <span>(%d)</span>' ), esc_html( $reviews_count ) );
				echo wp_kses_post( $reviews_count_title );

				?>
			</h3>
			<h3 class="questions-subtitle">
				<?php

				$question_count_title = sprintf( __( 'Questions <span>(%d)</span>' ), esc_html( $question_count ) );
				echo wp_kses_post( $question_count_title );

				?>
			</h3>
		</div>

		<div class="buttons-reviews-questions flex-all">
			<div class="rating-reviews-questions">
				<?php
				global $wpdb;

				$avg_rating = $wpdb->get_var( $wpdb->prepare( "SELECT AVG(meta_value) FROM {$wpdb->commentmeta} WHERE meta_key = '_ourm_rating' AND comment_id IN (SELECT comment_ID FROM {$wpdb->comments} WHERE comment_post_ID = %s AND comment_approved = 1)", get_the_ID() ) );
				
				?>
				<span><?php printf( __( 'Rating %s', 'our-mission' ), $avg_rating ); ?></span>
				<div class="rating">
					<?php foreach ( range( 1, 5 ) as $index ) : ?>
						<svg width="40" height="40" viewBox="0 0 40 40" fill="<?php echo floor( $avg_rating ) >= $index ? '#FFC107' : 'none'; ?>" xmlns="http://www.w3.org/2000/svg">
		<path d="M39.418 15.2635L39.4182 15.264C39.6254 15.9302 39.4301 16.6525 38.935 17.1044L38.9346 17.1048L30.2079 25.0894L29.9957 25.2836L30.0569 25.5646L32.6301 37.3928C32.6301 37.3928 32.6301 37.3928 32.6301 37.3929C32.7786 38.0771 32.5214 38.7767 31.9904 39.1783L31.9904 39.1783C31.4648 39.5759 30.7723 39.606 30.2211 39.26L30.2199 39.2592L20.2648 33.0484L20.0002 32.8833L19.7356 33.0483L9.77684 39.2592L9.77662 39.2593C9.51826 39.4207 9.23474 39.5 8.95162 39.5C8.6229 39.5 8.29343 39.3934 8.00747 39.1778C7.47758 38.7781 7.21976 38.0791 7.36841 37.3926L9.94161 25.5646L10.0027 25.2836L9.7906 25.0895L1.06389 17.1032L1.06295 17.1024C0.569177 16.6528 0.374683 15.9297 0.582033 15.2643C0.788603 14.6014 1.34284 14.1496 1.98046 14.0879C1.98065 14.0878 1.98084 14.0878 1.98103 14.0878L13.5271 12.994L13.8281 12.9655L13.9426 12.6857L18.5076 1.53809C18.7713 0.896551 19.3617 0.5 20.0002 0.5C20.6387 0.5 21.2291 0.896642 21.4927 1.53621C21.4928 1.53632 21.4928 1.53644 21.4929 1.53656L26.0577 12.6857L26.1722 12.9655L26.4732 12.994L38.0183 14.0879L38.0187 14.0879C38.6572 14.148 39.2128 14.6011 39.418 15.2635Z" stroke="#FFC107"/>
		</svg>
						<?php endforeach; ?>
					
				</div>
			</div>
			<div class="reviews-open">
				<a href="#" class="button" id="leave_review"><?php esc_html_e( 'Leave review' ); ?></a>
			</div>
			<div class="questions-open">
				<a href="#" class="button" id="leave_question"><?php esc_html_e( 'Ask question' ); ?></a>
			</div>
		</div>
		<!-- Tabs comments -->
		<div class="tabs-reviews-questions">
			<nav class="nav-reviews-questions">
				<a href="#tab-1" class="active"><?php echo esc_html( 'All' ); ?></a>
				<a href="#tab-2"><?php echo esc_html( 'Reviews' ); ?></a>
				<a href="#tab-3"><?php echo esc_html( 'Questions' ); ?></a>
			</nav>
			<div class="content-reviews-questions active" id="tab-1">
				<?php
				$total_cpage = get_comment_pages_count();
				$cpage       = get_query_var( 'cpage' ) ? get_query_var( 'cpage' ) : 1;

				?>
				<?php if ( have_comments() ) : ?>

					<ul>
						<?php
						wp_list_comments(
							array(
								'callback' => 'ourm_comments_display',
								'type'     => 'all',
							)
						);
						?>

					</ul>
					<script>
						var ourm_cpage = <?php echo $total_cpage; ?>;
					</script>
					<?php if ( $total_cpage > $cpage ) : ?>
						<div class="readmore-reviews-questions">

							<a class="button readmore-reviews-btn">Load more</a>
						</div>
					<?php endif; ?>
				<?php else : ?>
					<p class="noreviews"><?php esc_html_e( 'There are no reviews yet.', 'our-mission' ); ?></p>
				<?php endif; ?>


			</div>

			<div class="content-reviews-questions" id="tab-2">
				<ul>
					<?php
					wp_list_comments(
						array(
							'callback' => 'ourm_comments_display',
							'type'     => 'review',
						)
					);
					?>
				</ul>
			</div>

			<div class="content-reviews-questions" id="tab-3">
				<ul>
					<ul>
						<?php
						wp_list_comments(
							array(
								'callback' => 'ourm_comments_display',
								'type'     => 'question',
								'per_page' => 10,
							)
						);
						?>
					</ul>
				</ul>
			</div>
		</div>
<!-- Tabs comments -->
		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'our-mission' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().


	?>

</div><!-- #comments -->

<!-- Review modal form -->
<div class="ourm_modal_wrapper">
	<div class="ourm_modal_inner">

		<div class="ourm-modal-close"></div>
		<div id="review_form_wrapper">
			<div id="review_form">
	<?php
		$rating_field         = '<div class="ourm-rating"><p>' . esc_html__( 'Rate it', 'our-mission' ) . '</p><div><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M39.418 15.2635L39.4182 15.264C39.6254 15.9302 39.4301 16.6525 38.935 17.1044L38.9346 17.1048L30.2079 25.0894L29.9957 25.2836L30.0569 25.5646L32.6301 37.3928C32.6301 37.3928 32.6301 37.3928 32.6301 37.3929C32.7786 38.0771 32.5214 38.7767 31.9904 39.1783L31.9904 39.1783C31.4648 39.5759 30.7723 39.606 30.2211 39.26L30.2199 39.2592L20.2648 33.0484L20.0002 32.8833L19.7356 33.0483L9.77684 39.2592L9.77662 39.2593C9.51826 39.4207 9.23474 39.5 8.95162 39.5C8.6229 39.5 8.29343 39.3934 8.00747 39.1778C7.47758 38.7781 7.21976 38.0791 7.36841 37.3926L9.94161 25.5646L10.0027 25.2836L9.7906 25.0895L1.06389 17.1032L1.06295 17.1024C0.569177 16.6528 0.374683 15.9297 0.582033 15.2643C0.788603 14.6014 1.34284 14.1496 1.98046 14.0879C1.98065 14.0878 1.98084 14.0878 1.98103 14.0878L13.5271 12.994L13.8281 12.9655L13.9426 12.6857L18.5076 1.53809C18.7713 0.896551 19.3617 0.5 20.0002 0.5C20.6387 0.5 21.2291 0.896642 21.4927 1.53621C21.4928 1.53632 21.4928 1.53644 21.4929 1.53656L26.0577 12.6857L26.1722 12.9655L26.4732 12.994L38.0183 14.0879L38.0187 14.0879C38.6572 14.148 39.2128 14.6011 39.418 15.2635Z" stroke="#FFC107"/>
		</svg><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M39.418 15.2635L39.4182 15.264C39.6254 15.9302 39.4301 16.6525 38.935 17.1044L38.9346 17.1048L30.2079 25.0894L29.9957 25.2836L30.0569 25.5646L32.6301 37.3928C32.6301 37.3928 32.6301 37.3928 32.6301 37.3929C32.7786 38.0771 32.5214 38.7767 31.9904 39.1783L31.9904 39.1783C31.4648 39.5759 30.7723 39.606 30.2211 39.26L30.2199 39.2592L20.2648 33.0484L20.0002 32.8833L19.7356 33.0483L9.77684 39.2592L9.77662 39.2593C9.51826 39.4207 9.23474 39.5 8.95162 39.5C8.6229 39.5 8.29343 39.3934 8.00747 39.1778C7.47758 38.7781 7.21976 38.0791 7.36841 37.3926L9.94161 25.5646L10.0027 25.2836L9.7906 25.0895L1.06389 17.1032L1.06295 17.1024C0.569177 16.6528 0.374683 15.9297 0.582033 15.2643C0.788603 14.6014 1.34284 14.1496 1.98046 14.0879C1.98065 14.0878 1.98084 14.0878 1.98103 14.0878L13.5271 12.994L13.8281 12.9655L13.9426 12.6857L18.5076 1.53809C18.7713 0.896551 19.3617 0.5 20.0002 0.5C20.6387 0.5 21.2291 0.896642 21.4927 1.53621C21.4928 1.53632 21.4928 1.53644 21.4929 1.53656L26.0577 12.6857L26.1722 12.9655L26.4732 12.994L38.0183 14.0879L38.0187 14.0879C38.6572 14.148 39.2128 14.6011 39.418 15.2635Z" stroke="#FFC107"/>
		</svg><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M39.418 15.2635L39.4182 15.264C39.6254 15.9302 39.4301 16.6525 38.935 17.1044L38.9346 17.1048L30.2079 25.0894L29.9957 25.2836L30.0569 25.5646L32.6301 37.3928C32.6301 37.3928 32.6301 37.3928 32.6301 37.3929C32.7786 38.0771 32.5214 38.7767 31.9904 39.1783L31.9904 39.1783C31.4648 39.5759 30.7723 39.606 30.2211 39.26L30.2199 39.2592L20.2648 33.0484L20.0002 32.8833L19.7356 33.0483L9.77684 39.2592L9.77662 39.2593C9.51826 39.4207 9.23474 39.5 8.95162 39.5C8.6229 39.5 8.29343 39.3934 8.00747 39.1778C7.47758 38.7781 7.21976 38.0791 7.36841 37.3926L9.94161 25.5646L10.0027 25.2836L9.7906 25.0895L1.06389 17.1032L1.06295 17.1024C0.569177 16.6528 0.374683 15.9297 0.582033 15.2643C0.788603 14.6014 1.34284 14.1496 1.98046 14.0879C1.98065 14.0878 1.98084 14.0878 1.98103 14.0878L13.5271 12.994L13.8281 12.9655L13.9426 12.6857L18.5076 1.53809C18.7713 0.896551 19.3617 0.5 20.0002 0.5C20.6387 0.5 21.2291 0.896642 21.4927 1.53621C21.4928 1.53632 21.4928 1.53644 21.4929 1.53656L26.0577 12.6857L26.1722 12.9655L26.4732 12.994L38.0183 14.0879L38.0187 14.0879C38.6572 14.148 39.2128 14.6011 39.418 15.2635Z" stroke="#FFC107"/>
		</svg><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M39.418 15.2635L39.4182 15.264C39.6254 15.9302 39.4301 16.6525 38.935 17.1044L38.9346 17.1048L30.2079 25.0894L29.9957 25.2836L30.0569 25.5646L32.6301 37.3928C32.6301 37.3928 32.6301 37.3928 32.6301 37.3929C32.7786 38.0771 32.5214 38.7767 31.9904 39.1783L31.9904 39.1783C31.4648 39.5759 30.7723 39.606 30.2211 39.26L30.2199 39.2592L20.2648 33.0484L20.0002 32.8833L19.7356 33.0483L9.77684 39.2592L9.77662 39.2593C9.51826 39.4207 9.23474 39.5 8.95162 39.5C8.6229 39.5 8.29343 39.3934 8.00747 39.1778C7.47758 38.7781 7.21976 38.0791 7.36841 37.3926L9.94161 25.5646L10.0027 25.2836L9.7906 25.0895L1.06389 17.1032L1.06295 17.1024C0.569177 16.6528 0.374683 15.9297 0.582033 15.2643C0.788603 14.6014 1.34284 14.1496 1.98046 14.0879C1.98065 14.0878 1.98084 14.0878 1.98103 14.0878L13.5271 12.994L13.8281 12.9655L13.9426 12.6857L18.5076 1.53809C18.7713 0.896551 19.3617 0.5 20.0002 0.5C20.6387 0.5 21.2291 0.896642 21.4927 1.53621C21.4928 1.53632 21.4928 1.53644 21.4929 1.53656L26.0577 12.6857L26.1722 12.9655L26.4732 12.994L38.0183 14.0879L38.0187 14.0879C38.6572 14.148 39.2128 14.6011 39.418 15.2635Z" stroke="#FFC107"/>
		</svg><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M39.418 15.2635L39.4182 15.264C39.6254 15.9302 39.4301 16.6525 38.935 17.1044L38.9346 17.1048L30.2079 25.0894L29.9957 25.2836L30.0569 25.5646L32.6301 37.3928C32.6301 37.3928 32.6301 37.3928 32.6301 37.3929C32.7786 38.0771 32.5214 38.7767 31.9904 39.1783L31.9904 39.1783C31.4648 39.5759 30.7723 39.606 30.2211 39.26L30.2199 39.2592L20.2648 33.0484L20.0002 32.8833L19.7356 33.0483L9.77684 39.2592L9.77662 39.2593C9.51826 39.4207 9.23474 39.5 8.95162 39.5C8.6229 39.5 8.29343 39.3934 8.00747 39.1778C7.47758 38.7781 7.21976 38.0791 7.36841 37.3926L9.94161 25.5646L10.0027 25.2836L9.7906 25.0895L1.06389 17.1032L1.06295 17.1024C0.569177 16.6528 0.374683 15.9297 0.582033 15.2643C0.788603 14.6014 1.34284 14.1496 1.98046 14.0879C1.98065 14.0878 1.98084 14.0878 1.98103 14.0878L13.5271 12.994L13.8281 12.9655L13.9426 12.6857L18.5076 1.53809C18.7713 0.896551 19.3617 0.5 20.0002 0.5C20.6387 0.5 21.2291 0.896642 21.4927 1.53621C21.4928 1.53632 21.4928 1.53644 21.4929 1.53656L26.0577 12.6857L26.1722 12.9655L26.4732 12.994L38.0183 14.0879L38.0187 14.0879C38.6572 14.148 39.2128 14.6011 39.418 15.2635Z" stroke="#FFC107"/>
		</svg></div><input type="hidden" name="rating" value="" /></div>';
		$comments_args_review = array(
			'id_form'        => 'form_review',
			'title_reply'    => 'Leave review',
			'title_reply_to' => 'Reply to review',
			'label_submit'   => 'Submit review',
			'comment_field'  => $rating_field . '<p class="comment-form-comment"><label for="comment">Comment <span class="required" aria-hidden="true">*</span></label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required></textarea></p><input type="hidden" name="review_type" />',
		);
		comment_form( $comments_args_review );
		?>
			</div>
		</div>
	</div>
</div>
<!-- Review modal form -->
<!-- Question modal form -->
<div class="ourm_modal_wrapper">
	<div class="ourm_modal_inner">

		<div class="ourm-modal-close"></div>
		<div id="question_form_wrapper">
			<div id="question_form">
				<?php

					$comments_args_question = array(
						'id_form'        => 'form_question',

						'title_reply'    => 'Ask question',
						'title_reply_to' => 'Reply to question',
						'label_submit'   => 'Submit question',
						'comment_field'  => '<p class="comment-form-comment"><label for="comment">Comment <span class="required" aria-hidden="true">*</span></label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required></textarea></p><input type="hidden" name="question_type" />',

					);

					comment_form( $comments_args_question );

					?>
			</div>
		</div>
	</div>
</div>
<!-- Question modal form -->
