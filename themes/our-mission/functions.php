<?php
/**
 * our-mission functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package our-mission
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.1' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function our_mission_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on our-mission, use a find and replace
		* to change 'our-mission' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'our-mission', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Menu-1', 'our-mission' ),
			'menu-2' => esc_html__( 'Menu-2', 'our-mission' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'our_mission_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'our_mission_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function our_mission_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'our_mission_content_width', 640 );
}
add_action( 'after_setup_theme', 'our_mission_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function our_mission_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'our-mission' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'our-mission' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer #1', 'our-mission' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'our-mission' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer #2', 'our-mission' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'our-mission' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Google maps', 'our-mission' ),
			'id'            => 'google-maps',
			'description'   => esc_html__( 'Add widgets here.', 'our-mission' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'our_mission_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function our_mission_scripts() {
	wp_enqueue_style( 'our-mission-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'our-mission-style', 'rtl', 'replace' );

	// slick.
	wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
	wp_enqueue_script( 'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js' );

	if ( is_author() ) {
		wp_enqueue_script( 'ourm-vue', 'https://unpkg.com/vue@3' );
	}

	wp_enqueue_script( 'our-mission-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'our-mission-menu', get_template_directory_uri() . '/assets/js/menu.js', array( 'jquery' ), time(), true );

	wp_enqueue_script( 'ourm-countdown', get_template_directory_uri() . '/assets/js/countdown.js', array(), time(), true );
	wp_enqueue_script( 'our-mission-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), time(), true );
	wp_localize_script(
		'our-mission-main',
		'MISSION_DATA',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),

		)
	);
	if ( is_author() ) {
		$user      = get_queried_object();
		$equipment = get_user_meta( $user->ID, 'user_equipment', true );
		wp_localize_script(
			'ourm-vue',
			'USER_DATA',
			array(
				'equipment' => $equipment,

			)
		);

	}

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// wp_enqueue_script( 'comment-reply' );
	// }

	wp_enqueue_style( 'ourm-style', get_template_directory_uri() . '/assets/css/front/main.css', array(), time(), 'all' );

	wp_register_style( 'ourm-menu', get_template_directory_uri() . '/assets/css/front/menu.css', array(), time(), 'all' );
	wp_enqueue_style( 'ourm-comments', get_template_directory_uri() . '/assets/css/front/comments.css', array(), time(), 'all' );
}
add_action( 'wp_enqueue_scripts', 'our_mission_scripts' );

/**
 * Admin stcripts.
 */
add_action( 'admin_enqueue_scripts', 'our_mission_admin_scripts' );

function our_mission_admin_scripts() {
	wp_enqueue_style( 'ourm-admin', get_template_directory_uri() . '/assets/css/admin/admin.css', array(), time(), 'all' );

	wp_enqueue_script( 'our-mission-admin', get_template_directory_uri() . '/assets/js/admin.js', array( 'jquery' ), time(), true );
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Kirki customizer.
 */
require_once get_template_directory() . '/inc/ext/kirki.php';

/**
 * Load Redux customizer.
 */
require_once get_template_directory() . '/inc/ext/redux.php';

/**
 * Register a custom menu page.
 */
add_action( 'admin_menu', 'ourm_add_options_page' );

function ourm_add_options_page() {
	/**
	 * add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $callback = '', string $icon_url = '', int|float $position = null )
	 */
	add_menu_page( __( 'Theme options', 'our-mission' ), __( 'Theme options', 'our-mission' ), 'manage_options', 'ourm-settings', 'admin_page_template', 'dashicons-admin-generic', 10 );
	add_submenu_page( 'users.php', 'Signed initiatives', 'Signed initiatives', 'manage_options', 'edit.php?post_type=ourm_ini_signed' );
}

function admin_page_template() {
	wp_enqueue_media();
	?>
	<div class="wrap">
			<form action="options.php" method="POST">
				<?php
				settings_fields( 'ourm_settings' );
				do_settings_sections( 'ourm-settings' );
				submit_button();
				?>
			</form>
		</div>
	<?php
}

/**
 * Register settings.
 */
add_action( 'admin_init', 'ourm_add_settings' );

function ourm_add_settings() {

	$banner_title_args = array(
		'type'     => 'text',
		'id'       => 'banner_title',
		'group_id' => 'ourm_banner',
	);

	$banner_subtitle_args = array(
		'type'     => 'textarea',
		'id'       => 'banner_subtitle',
		'group_id' => 'ourm_banner',
	);

	$banner_image_args     = array(
		'type'     => 'image',
		'id'       => 'banner_image',
		'group_id' => 'ourm_banner',
	);
	$user_initiatives_args = array(
		'type'     => 'checkbox',
		'id'       => 'user_initiative',
		'group_id' => 'ourm_initiative',
	);

	/**
	 * register_setting(string $option_group, string $option_name);
	 */
	register_setting( 'ourm_settings', 'ourm_banner' );
	/**
	 * add_settings_section( string $id, string $title, callable $callback, string $page )
	 */
	add_settings_section( 'ourm_banner', 'Banner', '', 'ourm-settings' );

	/**
	 * add_settings_field( string $id, string $title, callable $callback, string $page, string $section = 'default', array $args = array() )
	 */
	add_settings_field( 'banner_title', __( 'Banner title', 'our-mission' ), 'display_settings_field', 'ourm-settings', 'ourm_banner', $banner_title_args );
	add_settings_field( 'banner_subtitle', __( 'Banner subtitle', 'our-mission' ), 'display_settings_field', 'ourm-settings', 'ourm_banner', $banner_subtitle_args );
	add_settings_field( 'banner_image', __( 'Banner image', 'our-mission' ), 'display_settings_field', 'ourm-settings', 'ourm_banner', $banner_image_args );

	register_setting( 'ourm_settings', 'ourm_initiative' );
	add_settings_section( 'ourm_initiative', 'Initiatives', '', 'ourm-settings' );
	add_settings_field( 'user_initiative', __( 'User should be logged in to sign initiative', 'our-mission' ), 'display_settings_field', 'ourm-settings', 'ourm_initiative', $user_initiatives_args );

}

function display_settings_field( $args ) {

	$options = get_option( $args['group_id'] );

	switch ( $args['type'] ) {
		// name attr for title: ourm_banner[banner_title];
		// name attr for subtitle: ourm_banner[banner_subtitle];
		// name attr for image: ourm_banner[banner_image];
		// and then we can get value for example for image from database with $options['banner_image']
		case 'text':
			echo '<input type="text" class="regular-text" id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['group_id'] ) . '[' . esc_attr( $args['id'] ) . ']" value="' . esc_attr( $options[ $args['id'] ] ?? '' ) . '" />';
			break;
		case 'textarea':
			echo '<textarea class="regular-text" rows="8" id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['group_id'] ) . '[' . esc_attr( $args['id'] ) . ']" >' . esc_attr( $options[ $args['id'] ] ?? '' ) . '</textarea>';
			break;
		case 'checkbox':
			echo '<input type="checkbox" id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['group_id'] ) . '[' . esc_attr( $args['id'] ) . ']" ' . checked( $options[ $args['id'] ] ?? 'off', 'on', false ) . '/>';
			break;
		case 'image':
			?>
			<div class="kh-nav-icon">
				<div class="kh-nav-icon-inner">
				<?php if ( isset( $options[ $args['id'] ] ) ) : ?>
					<?php $image_url = wp_get_attachment_image_url( $options[ $args['id'] ], 'thumbnail' ); ?>
					<div class="kh-nav-image">
						<img src="<?php echo esc_url( $image_url ); ?>" />
					</div>
					<span class="kh-nav-close">		
						<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M6.46967 6.46967C6.76256 6.17678 7.23744 6.17678 7.53033 6.46967L14 12.9393L20.4697 6.46967C20.7626 6.17678 21.2374 6.17678 21.5303 6.46967C21.8232 6.76256 21.8232 7.23744 21.5303 7.53033L15.0607 14L21.5303 20.4697C21.8232 20.7626 21.8232 21.2374 21.5303 21.5303C21.2374 21.8232 20.7626 21.8232 20.4697 21.5303L14 15.0607L7.53033 21.5303C7.23744 21.8232 6.76256 21.8232 6.46967 21.5303C6.17678 21.2374 6.17678 20.7626 6.46967 20.4697L12.9393 14L6.46967 7.53033C6.17678 7.23744 6.17678 6.76256 6.46967 6.46967Z" fill="white"/>
						</svg>
					</span>
					<?php else : ?>
					<div class="kh-nav-image">
						<span>+</span>
					</div>
					<?php endif; ?>
				</div>
				<input type="hidden" name="<?php echo esc_attr( $args['group_id'] ) . '[' . esc_attr( $args['id'] ) . ']'; ?>" value="<?php echo esc_attr( $options[ $args['id'] ] ?? '' ); ?>" />
			</div>
				<?php
	}
}

add_action( 'add_meta_boxes', 'ourm_add_metaboxes', 10, 2 );

/**
 * Add metabox.
 *
 * @param string  $post_type Post type.
 * @param WP_Post $post Post object.
 */
function ourm_add_metaboxes( $post_type, $post ) {

	if ( 155 !== $post->ID ) {

		return;
	}
	add_meta_box( 'ourm-setting', __( 'Settings for front page', 'our-mission' ), 'ourm_render_metabox', 'page', 'normal' );
}
/**
 * Render metabox.
 *
 * @param WP_Post $post Post object.
 */
function ourm_render_metabox( $post ) {
	$banner_title    = get_post_meta( $post->ID, 'ourm_banner_title', true );
	$banner_subtitle = get_post_meta( $post->ID, 'ourm_banner_subtitle', true );
	?>
	
		<input name="ourm_banner_title" value="<?php echo esc_attr( $banner_title ); ?>" placeholder="Banner title" />
		<textarea name="ourm_banner_subtitle" placeholder="Banner subtitle"><?php echo esc_attr( $banner_subtitle ); ?></textarea>
	
	<?php
}

/**
 * Saving meta data.
 *
 * @param string  $post_id Post id.
 * @param WP_Post $post Post object.
 */
add_action( 'save_post', 'ourm_save_metadata', 10, 2 );
function ourm_save_metadata( $post_id, $post ) {
	if ( isset( $_POST['ourm_banner_title'] ) ) {
		update_post_meta( $post_id, 'ourm_banner_title', wp_unslash( $_POST['ourm_banner_title'] ) );
	}
	if ( isset( $_POST['ourm_banner_subtitle'] ) ) {
		update_post_meta( $post_id, 'ourm_banner_subtitle', sanitize_text_field( wp_unslash( $_POST['ourm_banner_subtitle'] ) ) );
	}
}

require_once get_template_directory() . '/inc/extra/post-types.php';
add_filter(
	'excerpt_more',
	function() {
		return '&hellip;';
	}
);
add_filter(
	'excerpt_length',
	function( $length ) {
		if ( is_front_page() || is_search() ) {
			return 15;
		}
		return $length;
	}
);

/** Menus */

require_once get_template_directory() . '/inc/menu/menu.php';
require_once get_template_directory() . '/inc/menu/ourm-mega-menu-walker.php';
require_once get_template_directory() . '/inc/utils.php';
require_once get_template_directory() . '/inc/extra/initiative-orders.php';

function myplugin_query_vars( $public_query_vars ) {

	// $public_query_vars[] = 'custom_query_var';
	// var_dump($public_query_vars);
	return $public_query_vars;
}
add_filter( 'query_vars', 'myplugin_query_vars' );

function hwl_home_pagesize( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_home() ) {
		// Display 50 posts for a custom post type called 'movie'
		// if(isset($_GET['mission_cat'])) {
		// $query->set( 'cat', $_GET['mission_cat'] );
		// }
		// $query->set( 'posts_per_page', 12 );
		// return;
	}
	if ( ! is_admin() && ! $query->is_main_query() && is_home() ) {
		// $category = $query->get('custom_query_var');
		// if($category) {
		// $query->set( 'cat', $category );
		// }
	}
}
add_action( 'pre_get_posts', 'hwl_home_pagesize', 1 );

add_action( 'pre_get_posts', 'ourm_filter_initiatives' );
function ourm_filter_initiatives( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( isset( $_GET['orderby'] ) ) {
		switch ( $_GET['orderby'] ) {
			case 'date-asc':
				$query->set( 'orderby', array( 'date' => 'ASC' ) );
				break;
			case 'date-desc':
				$query->set( 'orderby', array( 'date' => 'DESC' ) );
				break;
			case 'soon-expired':
				$meta_query   = $query->get( 'meta_query' );
				$meta_query   = is_array( $meta_query ) ? $meta_query : array();
				$meta_query[] = array(
					array(
						'key'     => 'initiative_status',
						'value'   => 'on-keep',
						'compare' => 'IN',
					),
				);
				$query->set( 'meta_query', $meta_query );

				// get initiatives only with 30days to expire;
				// 100 days to expire by default. 100 - 30 = 70;
				$date_query   = $query->get( 'date_query' );
				$date_query   = is_array( $date_query ) ? $date_query : array();
				$date_query[] = array(
					array(
						'column' => 'post_date_gmt',
						'before' => '70 days ago',
					),
				);
				$query->set( 'date_query', $date_query );
				break;
			case 'votes':
				$meta_query   = $query->get( 'meta_query' );
				$meta_query   = is_array( $meta_query ) ? $meta_query : array();
				$meta_query[] = array(
					array(
						'key'  => 'accepted_votes',
						'type' => 'numeric',
					),
				);
				$query->set( 'meta_query', $meta_query );
				$query->set( 'orderby', 'meta_value_num' );

				break;

		}
	}
	if ( isset( $_GET['district'] ) ) {
		$meta_query           = $query->get( 'meta_query' );
				$meta_query   = is_array( $meta_query ) ? $meta_query : array();
				$meta_query[] = array(
					array(
						'key'     => 'initiative_district',
						'value'   => $_GET['district'],
						'compare' => 'IN', // default
					),
				);
				$query->set( 'meta_query', $meta_query );
	}

	if ( isset( $_GET['status_ini'] ) ) {
		$meta_query           = $query->get( 'meta_query' );
				$meta_query   = is_array( $meta_query ) ? $meta_query : array();
				$meta_query[] = array(
					array(
						'key'     => 'initiative_status',
						'value'   => $_GET['status_ini'],
						'compare' => 'IN', // default
					),
				);
				$query->set( 'meta_query', $meta_query );
	}

}


function wpdocs_remove_website_field( $fields ) {
	unset( $fields['url'] );
	$fields['eat'] = '<p class="comment-form-eat"><label for="eat">Did you eat today ? </label> <input id="eat" name="eat" type="text" value="" size="30" maxlength="245"></p>';

	return $fields;
}

add_filter( 'comment_form_default_fields', 'wpdocs_remove_website_field' );

add_action( 'comment_post', 'ourm_save_eat_comment', 10, 3 );
function ourm_save_eat_comment( $comment_ID, $comment_approved, $commentdata ) {
	if ( isset( $_POST['eat'] ) ) {
		update_comment_meta( $comment_ID, '_ourm_eat', sanitize_text_field( wp_unslash( $_POST['eat'] ) ) );
	}

	if ( isset( $_POST['rating'] ) ) {
		update_comment_meta( $comment_ID, '_ourm_rating', intval( wp_unslash( $_POST['rating'] ) ) );
	}
}

// add_filter(
// 'comment_reply_link',
// function( $link, $args, $comment, $post ) {
// $link = str_replace( 'Reply', 'Reply >', $link );
// return $link;
// },
// 10,
// 4
// );

function ourm_comments_display( $comment, $args, $depth ) {
	$commenter              = wp_get_current_commenter();
		$show_pending_links = ! empty( $commenter['comment_author'] );

	if ( $commenter['comment_author_email'] ) {
		$moderation_note = __( 'Your comment is awaiting moderation.' );
	} else {
		$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.' );
	}

	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( ! empty( $args['has_children'] ) ? 'parent' : '', $comment ); ?>>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				
				<div class="desc">
					
						<strong>
					<?php
					$text_before = '';
					if ( 'question' === get_comment_type( $comment ) ) {
						$text_before = __( 'Question:' );
					} elseif ( 'review' === get_comment_type( $comment ) ) {
						$text_before = __( 'Review:' );
					}
					echo $text_before;
					?>
					</strong>
					 
					<?php comment_text(); ?>
				</div>
				<?php
				$rating = get_comment_meta( get_comment_ID(), '_ourm_rating', true );

				if ( $rating ) :
					?>
				<div class="rating">
					<?php foreach ( range( 1, 5 ) as $index ) : ?>
						<svg width="40" height="40" viewBox="0 0 40 40" fill="<?php echo (int) $rating >= $index ? '#FFC107' : 'none'; ?>" xmlns="http://www.w3.org/2000/svg">
		<path d="M39.418 15.2635L39.4182 15.264C39.6254 15.9302 39.4301 16.6525 38.935 17.1044L38.9346 17.1048L30.2079 25.0894L29.9957 25.2836L30.0569 25.5646L32.6301 37.3928C32.6301 37.3928 32.6301 37.3928 32.6301 37.3929C32.7786 38.0771 32.5214 38.7767 31.9904 39.1783L31.9904 39.1783C31.4648 39.5759 30.7723 39.606 30.2211 39.26L30.2199 39.2592L20.2648 33.0484L20.0002 32.8833L19.7356 33.0483L9.77684 39.2592L9.77662 39.2593C9.51826 39.4207 9.23474 39.5 8.95162 39.5C8.6229 39.5 8.29343 39.3934 8.00747 39.1778C7.47758 38.7781 7.21976 38.0791 7.36841 37.3926L9.94161 25.5646L10.0027 25.2836L9.7906 25.0895L1.06389 17.1032L1.06295 17.1024C0.569177 16.6528 0.374683 15.9297 0.582033 15.2643C0.788603 14.6014 1.34284 14.1496 1.98046 14.0879C1.98065 14.0878 1.98084 14.0878 1.98103 14.0878L13.5271 12.994L13.8281 12.9655L13.9426 12.6857L18.5076 1.53809C18.7713 0.896551 19.3617 0.5 20.0002 0.5C20.6387 0.5 21.2291 0.896642 21.4927 1.53621C21.4928 1.53632 21.4928 1.53644 21.4929 1.53656L26.0577 12.6857L26.1722 12.9655L26.4732 12.994L38.0183 14.0879L38.0187 14.0879C38.6572 14.148 39.2128 14.6011 39.418 15.2635Z" stroke="#FFC107"/>
		</svg>
						<?php endforeach; ?>
					
				</div>
				<?php endif; ?>
					<div class="comment-author vcard meta">
					
						<?php
						$comment_author = get_comment_author_link( $comment );

						if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
							$comment_author = get_comment_author( $comment );
						}

						?>
						<strong><?php echo $comment_author; ?></strong>
						<span><time datetime="<?php echo get_comment_time( 'c' ); ?>"><?php echo get_comment_date( 'j F Y', $comment ); ?></time></span>
					</div><!-- .comment-author -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<em class="comment-awaiting-moderation"><?php echo wp_kses_post( $moderation_note ); ?></em>
					<?php endif; ?>
			

				<?php
				if ( '1' == $comment->comment_approved || $show_pending_links ) {
					$link_classes = array( 'reply' );
					if ( 'question' === get_comment_type( $comment ) ) {
						$link_classes[] = 'reply-question';
					} elseif ( 'review' === get_comment_type( $comment ) ) {
						$link_classes[] = 'reply-review';
					}

						comment_reply_link(
							array_merge(
								$args,
								array(
									'add_below'  => 'div-comment',
									'depth'      => $depth,
									'max_depth'  => $args['max_depth'],
									'respond_id' => ( 'question' === get_comment_type( $comment ) ? 'form_question' : 'review' === get_comment_type( $comment ) ) ? 'form_review' : 'respond',
									'before'     => '<div class="' . esc_attr( implode( ' ', $link_classes ) ) . '">',
									'after'      => '<svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 11.5L6 6.5L1 1.5" stroke="#00A552" stroke-width="1.5" stroke-linecap="round"/>
									</svg>
									</div>',
								)
							)
						);

				}
				?>
			</div><!-- .comment-body -->
			
			<?php

}

// add_action(
// 'comment_form',
// function( $post_id ) {
// if ( 'post' === get_post_type( $post_id ) ) {

// echo '<input type="hidden" name="review_type" />';
// }
// }
// );

add_filter(
	'preprocess_comment',
	function( $commentdata ) {
		if ( isset( $_POST['review_type'] ) ) {
			$commentdata['comment_type'] = 'review';
		}
		if ( isset( $_POST['question_type'] ) ) {
			$commentdata['comment_type'] = 'question';
		}
		return $commentdata;
	}
);

/**********LOGIN */

add_action(
	'login_enqueue_scripts',
	function() {
		// wp_enqueue_style('some_style');
	}
);


add_action(
	'login_head',
	function() {

	}
);

add_filter(
	'login_headerurl',
	function() {
		return home_url();
	}
);

add_filter(
	'login_headertext',
	function() {
		return __( 'Gotham City', 'our-mission' );
	}
);

add_action(
	'login_header',
	function() {
		?>
	<div>
Display something before '< div id="login"></ div>
</div>
		<?php
	}
);

add_filter( 'login_display_language_dropdown', '__return_false' );
add_action(
	'login_footer',
	function() {
		?>
	<div>
Display something before closing body
</div>
		<?php
	}
);

add_action(
	'register_form',
	function() {
		?>
	<p>
				<label for="user_phone"><?php _e( 'Phone', 'our-mission' ); ?></label>
				<input type="email" name="user_phone" id="user_phone" class="input" value="" size="25" autocomplete="phone" />
			</p>
		<?php
	}
);

add_action( 'user_register', 'myplugin_registration_save', 10, 1 );

function myplugin_registration_save( $user_id ) {

	if ( isset( $_POST['user_phone'] ) ) {
		update_user_meta( $user_id, 'user_phone', sanitize_text_field( wp_unslash( $_POST['user_phone'] ) ) );
	}

}

function myplugin_check_fields( $errors, $sanitized_user_login, $user_email ) {

	if ( empty( $_POST['user_phone'] ) ) {
		$errors->add( 'phone_error', __( '<strong>ERROR</strong>: Phone is required.', 'our-mission' ) );
	}

	return $errors;
}

add_filter( 'registration_errors', 'myplugin_check_fields', 10, 3 );


/**
 * Show custom user profile fields
 *
 * @param  object $profileuser A WP_User object
 * @return void
 */

function wpdocs_custom_user_profile_fields( $profileuser ) {
	?>
		<table class="form-table">
			<tr>
				<th>
					<label for="user_phone"><?php _e( 'Phone' ); ?></label>
				</th>
				<td>
					<input type="text" name="user_phone" id="user_phone" value="<?php echo esc_attr( get_user_meta( $profileuser->ID, 'user_phone', true ) ); ?>" class="regular-text" />
					
				</td>
			</tr>
		</table>
	<?php
}
	add_action( 'show_user_profile', 'wpdocs_custom_user_profile_fields' );
	add_action( 'edit_user_profile', 'wpdocs_custom_user_profile_fields' );

function update_extra_profile_fields( $user_id ) {
	if ( current_user_can( 'edit_user', $user_id ) ) {
		update_user_meta( $user_id, 'user_phone', sanitize_text_field( wp_unslash( $_POST['user_phone'] ) ) );
	}
}

   add_action( 'edit_user_profile_update', 'update_extra_profile_fields' );
   add_action( 'personal_options_update', 'update_extra_profile_fields' );

   add_action( 'wp_ajax_update_author_form', 'ourm_update_author_form' );

function ourm_update_author_form() {
	if ( ! wp_verify_nonce( $_POST['_wpnonce'] ) ) {
		wp_send_json_error();
	}
	$user    = wp_get_current_user();
	$user_id = absint( $_POST['user_ID'] );
	if ( $user_id < 1 ) {
		wp_send_json_error();
	}
	wp_update_user(
		array(
			'ID'           => $user_id,
			'display_name' => sanitize_text_field( $_POST['user_name'] ),
			'user_email'   => sanitize_text_field( $_POST['user_email'] ),
		)
	);
	update_user_meta( $user_id, 'user_phone', sanitize_text_field( $_POST['user_phone'] ) );
	update_user_meta( $user_id, 'user_equipment', $_POST['equipment'] );

	wp_send_json_success();
}

add_filter( 'ourm_sign_initiative_by_user', 'ourm_check_for_user_rights' );
function ourm_check_for_user_rights() {
	$ourm_initiative = get_option( 'ourm_initiative' );
	if ( isset( $ourm_initiative['user_initiative'] ) && $ourm_initiative['user_initiative'] === 'on' ) {
		if ( ! is_user_logged_in() ) {
			return false;
		}
	}
	return true;
}
