<?php

/**
 * Class AlkaAdmin
 *
 * This class creates a very simple Options page
 */
class AlkaAdmin{

	/**
	 * The security nonce
	 *
	 * @var string
	 */
	private $_nonce = 'alka_facebook_admin';

	/**
	 * AlkaAdmin constructor.
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'addAdminMenu' ) );

		add_action( 'wp_ajax_alka_store_admin_creeds', array( $this, 'storeFacebookAdminCreeds' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'addAdminScripts' ) );

	}

	/**
	 * Callback for the Ajax request
	 *
	 * Updates the FaceBook App ID and App Secret options
	 */
	public function storeFacebookAdminCreeds() {

		if ( wp_verify_nonce( $_POST['security'], $this->_nonce ) === false ) {
			die( 'Invalid Request!' );
		}

		if (
		        (isset($_POST['app_id']) && !empty($_POST['app_id']))
                &&
                (isset($_POST['app_secret']) && !empty($_POST['app_secret']))
        ) {

			update_option( 'alka_facebook', array(
				'app_id'     => $_POST['app_id'],
				'app_secret' => $_POST['app_secret'],
			) );

		}

		echo __('Saved!', 'Alkaweb');
		die();

	}

	/**
	 * Adds Admin Scripts for the Ajax call
	 */
	public function addAdminScripts() {

		wp_enqueue_script( 'alka-facebook-admin', ALKA_FACEBOOK_URL. '/assets/js/admin.js', array(), 1.0 );

		$admin_options = array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'_nonce'   => wp_create_nonce( $this->_nonce ),
		);
		wp_localize_script( 'alka-facebook-admin', 'alka_facebook_admin', $admin_options );

	}

	/**
	 * Adds Alka to WordPress Admin Sidebar Menu
	 */
	public function addAdminMenu() {
		add_menu_page(
			__( 'Alka Facebook', 'alkaweb' ),
			__( 'Alka Facebook', 'alkaweb' ),
			'manage_options',
			'alka_facebook',
			array( $this, 'adminlayout' ),
			''
		);
	}

	/**
	 * Outputs the Admin Dashboard layout
	 */
	public function adminlayout() {

		$facebook_creeds = AlkaFacebook::getCredentials();
		$alka_app_id = (isset($facebook_creeds['app_id']) && !empty($facebook_creeds['app_id'])) ? $facebook_creeds['app_id'] : '';
		$alka_app_secret = (isset($facebook_creeds['app_secret']) && !empty($facebook_creeds['app_secret'])) ? $facebook_creeds['app_secret'] : '';
		?>

		<div class="wrap">
			<h3><?php _e( 'Facebook API Settings', 'alkaweb' ); ?></h3>

			<table class="form-table">
				<tbody>
                <tr>
                    <td>
                        <label><?php _e( 'Your callback url', 'alkaweb' ); ?></label>
                    </td>
                    <td>
                        <span class="highlight"><?php echo AlkaFacebook::getCallbackUrl(); ?></span>
                    </td>
                </tr>
				<tr>
					<td scope="row">
						<label><?php _e( 'Facebook App ID', 'alkaweb' ); ?></label>
					</td>
					<td>
						<input id="alka-fb-app-id" class="regular-text" value="<?php echo $alka_app_id; ?>"/>
					</td>
				</tr>
				<tr>
					<td>
                        <label><?php _e( 'Facebook App Secret', 'alkaweb' ); ?></label>
					</td>
					<td>
						<input id="alka-fb-app-secret" class="regular-text" value="<?php echo $alka_app_secret; ?>"/>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<button class="button button-primary" id="alkaweb-facebook-details"><?php _e( 'Submit', 'alkaweb' ); ?></button>
					</td>
				</tr>
				</tbody>
			</table>

		</div>

		<?php

	}



}

/*
 * Starts our admin class, easy!
 */
new AlkaAdmin();