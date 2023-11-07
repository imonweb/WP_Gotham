<div class="related-posts">
	<div class="container">
		<div class="related-posts-header">
			<h3 class="title-default"><?php esc_html_e( 'Read also', 'our-mission' ); ?></h3>
		</div>
		<div class="news-items">
			<?php
			$kh_posts = get_posts(
				array(
					'post_type'   => 'post',
					'numberposts' => 4,
					'post__not_in' => array( $args['exclude'] ),
					'cat' => $args['cat']
				)
			);
			?>
			<?php
			foreach ( $kh_posts as $post ) :
				setup_postdata( $post );

				$cat = wp_get_post_categories( $post->ID, array( 'fields' => 'all' ) );

				?>

				<div class="news-item">
					<a href="<?php echo get_permalink(); ?>" class="news-image">
						<?php the_post_thumbnail( 'large' ); ?>

					</a>
					<div class="news-meta">
						<?php if ( ! empty( $cat ) ) : ?>
							<a href="<?php echo get_category_link( $cat[0] ); ?>" class="news-cat"><?php echo esc_html( $cat[0]->name ); ?></a>
						<?php endif; ?>
						<span><?php echo get_the_date( 'j F Y' ); ?></span>
					</div>
					<a href="<?php echo get_permalink(); ?>" class="news-title"><?php echo get_the_title(); ?></a>
				</div>
				<?php
			endforeach;
			wp_reset_postdata();
			?>

		</div>
	</div>
</div>
