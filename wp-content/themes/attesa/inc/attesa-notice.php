<?php
/**
 * Attesa Notice Class.
 *
 * @author  AttesaWP
 * @package Attesa
 * @since   1.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Attesa_Notice' ) ) :

/**
 * Attesa_Notice Class.
 */
class Attesa_Notice {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}
	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $pagenow;

		wp_enqueue_style( 'attesa-theme-message', get_template_directory_uri() . '/inc/css/message.css', array(), wp_get_theme()->get('Version') );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'attesa_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'attesa_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['attesa-hide-notice'] ) && isset( $_GET['_attesa_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( sanitize_key($_GET['_attesa_notice_nonce'] ), 'attesa_hide_notices_nonce' ) ) {
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'attesa' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'Cheatin&#8217; huh?', 'attesa' ) );
			}

			$hide_notice = sanitize_text_field( wp_unslash($_GET['attesa-hide-notice'] ));
			update_option( 'attesa_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated attesa-message">
			<a class="attesa-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'attesa-hide-notice', 'welcome' ) ), 'attesa_hide_notices_nonce', '_attesa_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'attesa' ); ?></a>
			<p>
			<?php esc_html_e('Welcome! Thank you for choosing Attesa theme! To fully take advantage of the best our theme can offer please make sure you have installed the "Attesa Extra" plugin', 'attesa'); ?>
			</p>
			<p class="submit">
				<a class="button-primary" href="<?php echo esc_url_raw( admin_url( 'plugin-install.php?s=attesa+extra&tab=search&type=term' ) ); ?>"><?php esc_html_e( 'Install Attesa Extra Plugin', 'attesa' ); ?></a>
			</p>
		</div>
		<?php
	}
}

endif;

return new Attesa_Notice();