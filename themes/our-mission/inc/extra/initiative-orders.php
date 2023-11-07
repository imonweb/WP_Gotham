<?php

class Ourm_Initiatives {
	private static $ourm_db_version;
	private static $ourm_installed_ver;

	public function __construct() {
		self::$ourm_db_version    = '1.4';
		self::$ourm_installed_ver = get_option('ourm_db_version');
		if (self::$ourm_db_version !== self::$ourm_installed_ver) {
			$this->create_table();
		}

		// admin post request.
		add_action('admin_post_sign_initiative', array($this, 'initiatives_with_post_type'));
		add_action('admin_post_nopriv_sign_initiative', array($this, 'initiatives_with_post_type'));

		add_action('admin_post_initiative_order', array($this, 'initiatives_with_db_table'));
		add_action('admin_post_nopriv_initiative_order', array($this, 'initiatives_with_db_table'));

		// ajax
		add_action('wp_ajax_initiative_order_ajax', array($this, 'initiatives_with_ajax'));
		add_action('wp_ajax_nopriv_initiative_order_ajax', array($this, 'initiatives_with_ajax'));

		add_action('wp_ajax_propose_initiative', array($this, 'propose_initiative'));
		add_action('wp_ajax_nopriv_propose_initiative', array($this, 'propose_initiative'));
	}

	/**
	 * Handle sign the initiatives with CPT.
	 */
	public function initiatives_with_post_type() {
		$post_id        = $_POST['initiative_id'];
		$accepted_votes = get_post_meta($post_id, 'accepted_votes', true); // get_field('accepted_votes', $post_id)
		$total_votes    = (int) $accepted_votes + 1;

		$already_signed_by_user = get_posts(
			array(
				'post_type'  => 'ourm_ini_signed',
				'meta_query' => array(
					array(
						'key'   => 'name',
						'value' => trim($_POST['name']),
					),
					array(
						'key'   => 'email',
						'value' => trim($_POST['email']),
					),
					array(
						'key'   => 'phone',
						'value' => trim($_POST['phone']),
					),
				),
			)
		);
		if (count($already_signed_by_user) > 0) {
			return wp_safe_redirect(
				add_query_arg(
					array(
						'status' => 'error',
						'signed' => 'already',
					),
					wp_get_referer()
				)
			);
		}

		$initiative_id = wp_insert_post( // 0
			array(

				'post_type'    => 'ourm_ini_signed',
				'post_status'  => 'publish',
				'post_author'  => 1,
				'post_title'   => $_POST['initiative_title'],
				'post_content' => '<p>Name:' . $_POST['name'] . '</p><p>Email:' . $_POST['email'] . '</p><p>Phone:' . $_POST['phone'] . '</p>',
				'meta_input'   => array(
					'name'  => $_POST['name'],
					'email' => $_POST['email'],
					'phone' => $_POST['phone'],
				),
			)
		);

		if (!$initiative_id || is_wp_error($initiative_id)) {
			return wp_safe_redirect(add_query_arg('status', 'error', wp_get_referer()));
		}

		// update_post_meta( $post_id, 'accepted_votes', $total_votes );

		return wp_safe_redirect(wp_get_referer());
		wp_die();
	}
	/**
	 * Handle sign the initiatives with custom DB Table.
	 */
	public function initiatives_with_db_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'initiative_orders';

		$post_id = $_POST['initiative_id'];

		$found_email = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}initiative_orders WHERE person_email = %s", $_POST['email']), ARRAY_A);
		if (!empty($found_email)) {
			return wp_safe_redirect(
				add_query_arg(
					array(
						'status' => 'error',
						'email'  => 'registered',
					),
					wp_get_referer()
				)
			);
		}
		$wpdb->insert(
			$table_name,
			array(
				'created_at'    => current_time('mysql'),
				'initiative_id' => $post_id,
				'person_name'   => $_POST['name'],
				'person_phone'  => $_POST['phone'],
				'person_email'  => $_POST['email'],
				'person_ip'     => $_SERVER['REMOTE_ADDR'],
			),
			array(
				'%s',
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
			)
		);
		$initiative_id = $wpdb->insert_id;
		if (!$initiative_id) {
			return wp_safe_redirect(add_query_arg('status', 'error', wp_get_referer()));
		}

		return wp_safe_redirect(wp_get_referer());
		wp_die();
	}

	public function initiatives_with_ajax() {

		if (!wp_verify_nonce($_POST['_wpnonce'])) {
			wp_send_json_error(
				array(
					'error' => __('Not allowed', 'our-mission'),
				)
			);
		}

		global $wpdb;
		$table_name = $wpdb->prefix . 'initiative_orders';

		$post_id = $_POST['initiative_id'];
		$errors  = array();

		if (trim($_POST['name']) === '') {
			$errors[] = array(
				'message' => __('This field is required', 'our-mission'),
				'field'   => 'name',
			);
		}

		if (!is_email($_POST['email'])) {
			$errors[] = array(
				'message' => __('Enter valid email', 'our-mission'),
				'field'   => 'email',
			);
		}
		if (!empty($errors)) {
			wp_send_json_error(
				array(
					'errors' => $errors,
				)
			);
		}
		$found_email = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}initiative_orders WHERE person_email = %s AND initiative_id = %d", $_POST['email'], $_POST['initiative_id']), ARRAY_A);
		if (!empty($found_email)) {
			wp_send_json_error(
				array(
					'errors' => array(
						array(
							'message' => __('You have already signed this initiative', 'our-mission'),
							'field'   => '.modal-header',
						),
					),
				)
			);
		}
		$wpdb->insert(
			$table_name,
			array(
				'created_at'    => current_time('mysql'),
				'initiative_id' => $post_id,
				'person_name'   => $_POST['name'],
				'person_phone'  => $_POST['phone'],
				'person_email'  => $_POST['email'],
				'person_ip'     => $_SERVER['REMOTE_ADDR'],
			),
			array(
				'%s',
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
			)
		);
		$initiative_id = $wpdb->insert_id;
		if (!$initiative_id) {
			wp_send_json_error(
				array(
					'error' => __('Failure on creation', 'our-mission'),
				)
			);
		}

		$total_votes = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}initiative_orders WHERE initiative_id = %s", absint($post_id)));

		$required_votes = get_post_meta($post_id, 'required_votes', true);

		if ((int) $total_votes === (int) $required_votes) {
			update_post_meta($post_id, 'initiative_status', 'completed');
		}
		update_post_meta($post_id, 'accepted_votes', $total_votes);

		$html   = $this->get_success_form_html($_POST['initiative_name']);
		$button = $this->get_success_button_html();
		wp_send_json_success(
			array(
				'html'   => $html,
				'button' => $button,
			)
		);
	}

	/**
	 * Load template form after successfull sign the initiative.
	 */
	public function get_success_form_html($title) {

		ob_start();
		locate_template('templates/blocks/success-form.php', true, true, array('title' => $title));
		return ob_get_clean();
	}

	/**
	 * Load template button after successfull sign the initiative.
	 */
	public function get_success_button_html() {

		ob_start();
		locate_template('templates/blocks/success-button.php', true, true);
		return ob_get_clean();
	}

	/**
	 * Load template form after successfull propose the initiative.
	 */
	public function get_success_propose_html($post) {

		ob_start();
		locate_template('templates/blocks/success-initiative.php', true, true, array('post' => $post));
		return ob_get_clean();
	}

	/**
	 * Ajax load success frame.
	 */
	public function propose_initiative() {
		if (!wp_verify_nonce($_POST['_wpnonce'])) {
			wp_send_json_error(
				array(
					'error' => __('Not allowed', 'our-mission'),
				)
			);
		}

		$initiative_id = wp_insert_post( // 0
			array(

				'post_type'    => 'ourm_initiatives',
				'post_status'  => 'draft',
				'post_author'  => 1,
				'post_title'   => $_POST['title'],
				'post_content' => $_POST['content'],
				'meta_input'   => array(
					'name'                => $_POST['name'],
					'email'               => $_POST['email'],
					'phone'               => $_POST['phone'],
					'initiative_district' => $_POST['district'],
					'initiative_status'   => 'on-consider',
					'required_votes'      => 1000,
					'accepted_votes'      => 0,
				),
			)
		);

		if (!$initiative_id || is_wp_error($initiative_id)) {
			wp_send_json_error(
				array(
					'error' => __('Creating propose initiative failed', 'our-mission'),
				)
			);
		}
		$post = get_post($initiative_id);
		$html = $this->get_success_propose_html($post);
		wp_send_json_success(
			array(
				'html' => $html,

			)
		);
	}

	/**
	 * Create table.
	 */
	public function create_table() {
		global $wpdb;
		$ourm_charset_collate = $wpdb->get_charset_collate();

		$table_name = $wpdb->prefix . 'initiative_orders';
		$sql        = "CREATE TABLE $table_name  (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				created_at datetime NOT NULL,
				initiative_id INT NOT NULL,
				person_name VARCHAR(150) NOT NULL,
				person_phone VARCHAR(150) DEFAULT NULL,
				person_email VARCHAR(150) NOT NULL,
				person_ip VARCHAR(50) NOT NULL,
				PRIMARY KEY (id)
			) $ourm_charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta($sql);
		update_option('ourm_db_version', self::$ourm_db_version);
	}
}
new Ourm_Initiatives();
