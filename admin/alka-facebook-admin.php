<?php
/**
 * Created by PhpStorm.
 * User: Ovidiu
 * Date: 9/18/2017
 * Time: 12:43 PM
 */

/**
 * Class AlkaFacebookAdmin
 */
class AlkaFacebookAdmin {
	private $_nonce = 'alka-facebook-admin';

	/**
	 * AlkaFacebookAdmin constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'alka_add_admin_menu' ) );

		add_action( 'wp_ajax_alka_store_admin_creeds', array( $this, 'alka_store_facebook_admin_creeds' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'alka_add_admin_scripts' ) );
	}

	/**
	 * Called from an ajax request
	 *
	 * Updates the FaceBook App ID and App Secret options
	 */
	public function alka_store_facebook_admin_creeds() {
		if ( wp_verify_nonce( $_POST['security'], $this->_nonce ) === false ) {
			die( 'Invalid Request!' );
		}

		if ( ! empty( $_POST['app_id'] ) && ! empty( $_POST['app_secret'] ) ) {
			update_option( 'alka_facebook', array(
				'app_id'     => $_POST['app_id'],
				'app_secret' => $_POST['app_secret'],
			) );

		}
	}

	/**
	 * Adds Admin Scripts
	 */
	public function alka_add_admin_scripts() {
		wp_enqueue_script( 'alka-facebook-admin', plugin_dir_url( __FILE__ ) . ltrim( '/alka-admin.js', '\\/' ), array(), 1.0 );

		$admin_options = array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'_nonce'   => wp_create_nonce( $this->_nonce ),
		);
		wp_localize_script( 'alka-facebook-admin', 'alka_facebook_admin', $admin_options );
	}

	/**
	 * Adds Alka to WordPress Admin Sidebar Menu
	 */
	public function alka_add_admin_menu() {
		add_menu_page(
			__( 'Alka Facebook', 'alkaweb' ),
			__( 'Alka Facebook', 'alkaweb' ),
			'manage_options',
			'alka_facebook',
			array( $this, 'alka_admin_layout' ),
			''
		);
	}

	/**
	 * Outputs the Admin Dashboard layout
	 */
	public function alka_admin_layout() {
		$alka_app_id     = '';
		$alka_app_secret = '';
		$facebook_creeds = get_option( 'alka_facebook', array() );
		if ( ! empty( $facebook_creeds['app_id'] ) ) {
			$alka_app_id = $facebook_creeds['app_id'];
		}
		if ( ! empty( $facebook_creeds['app_secret'] ) ) {
			$alka_app_secret = $facebook_creeds['app_secret'];
		}

		require_once 'dashboard.phtml';
	}
}

/**
 * Instantiate the admin class
 */
new AlkaFacebookAdmin();