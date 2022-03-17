<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Show in WP Dashboard notice about the plugin is not activated.
 *
 * @return void
 */
function configurator_elementor_fail_load_admin_notice() {
	// Leave to Elementor Pro to manage this.
	if ( function_exists( 'elementor_pro_load_plugin' ) ) {
		return;
	}

	$screen = get_current_screen();
	if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
		return;
	}

	if ( 'true' === get_user_meta( get_current_user_id(), '_configurator_elementor_install_notice', true ) ) {
		return;
	}

	$plugin = 'elementor/elementor.php';

	$installed_plugins = get_plugins();

	$is_elementor_installed = isset( $installed_plugins[ $plugin ] );
	

	if ( $is_elementor_installed ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		$message = __( 'Configurator Theme is a lightweight starter theme. We recommend you to use it together with Elementor Page Builder plugin, they work perfectly together!', 'configurator-elementor' );

		$button_text = __( 'Activate Elementor', 'configurator-elementor' );
		$button_link = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		$message = __( 'Configurator Theme is a lightweight starter theme. We recommend you to use it together with Elementor Page Builder plugin, they work perfectly together!', 'configurator-elementor' );

		$button_text = __( 'Install Elementor', 'configurator-elementor' );
		$button_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
	}




	?>
	<style>
		.notice.configurator-elementor-notice {
			border: 1px solid #ccd0d4;
			border-left: 4px solid #9b0a46 !important;
			box-shadow: 0 1px 4px rgba(0,0,0,0.15);
			display: flex;
			padding: 0px;
		}
		.rtl .notice.configurator-elementor-notice {
			border-right-color: #9b0a46 !important;
		}
		.notice.configurator-elementor-notice .configurator-elementor-notice-aside {
			width: 50px;
			display: flex;
			align-items: start;
			justify-content: center;
			padding-top: 15px;
			background: rgba(215,43,63,0.04);
		}
		.notice.configurator-elementor-notice .configurator-elementor-notice-aside img{
			width: 1.5rem;
		}
		.notice.configurator-elementor-notice .configurator-elementor-notice-inner {
			display: table;
			padding: 20px 0px;
			width: 100%;
		}
		.notice.configurator-elementor-notice .configurator-elementor-notice-content {
			padding: 0 20px;
		}
		.notice.configurator-elementor-notice p {
			padding: 0;
			margin: 0;
		}
		.notice.configurator-elementor-notice h3 {
			margin: 0 0 5px;
		}
		.notice.configurator-elementor-notice .configurator-elementor-install-now {
			display: block;
			margin-top: 15px;
		}
		.notice.configurator-elementor-notice .configurator-elementor-install-now .configurator-elementor-install-button {
			background: #127DB8;
			border-radius: 3px;
			color: #fff;
			text-decoration: none;
			height: auto;
			line-height: 20px;
			padding: 0.4375rem 0.75rem;
			text-transform: capitalize;
		}
		.notice.configurator-elementor-notice .configurator-elementor-install-now .configurator-elementor-install-button:active {
			transform: translateY(1px);
		}
		@media (max-width: 767px) {
			.notice.configurator-elementor-notice.configurator-elementor-install-elementor {
				padding: 0px;
			}
			.notice.configurator-elementor-notice .configurator-elementor-notice-inner {
				display: block;
				padding: 10px;
			}
			.notice.configurator-elementor-notice .configurator-elementor-notice-inner .configurator-elementor-notice-content {
				display: block;
				padding: 0;
			}
			.notice.configurator-elementor-notice .configurator-elementor-notice-inner .configurator-elementor-install-now {
				display: none;
			}
		}
	</style>
	<script>jQuery( function( $ ) {
			$( 'div.notice.configurator-elementor-install-elementor' ).on( 'click', 'button.notice-dismiss', function( event ) {
				event.preventDefault();

				$.post( ajaxurl, {
					action: 'configurator_elementor_set_admin_notice_viewed'
				} );
			} );
		} );</script>
	<div class="notice updated  configurator-elementor-notice configurator-elementor-install-elementor">
		<div class="configurator-elementor-notice-inner">
			<div class="configurator-elementor-notice-content">
				<h3><?php esc_html_e( 'Thanks for installing Configurator Theme!', 'configurator-elementor' ); ?></h3>
				<p><?php echo esc_html( $message ); ?></p>
				<div class="configurator-elementor-install-now">
					<a class="configurator-elementor-install-button" href="<?php echo esc_attr( $button_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
				</div>
			</div>
		</div>
	</div>
	<?php
}




// woocommerce
function woocommerce_elements_fail_load_admin_notice() {
	// Leave to Elementor Pro to manage this.
	if ( function_exists( 'elementor_pro_load_plugin' ) ) {
		return;
	}

	$screen = get_current_screen();
	if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
		return;
	}

	if ( 'true' === get_user_meta( get_current_user_id(), '_configurator_woocommerce_install_notice', true ) ) {
		return;
	}

	$woocommerce_plugin = 'woocommerce/woocommerce.php';

	$installed_woocommerce_plugins = get_plugins();

	$is_woocommerce_installed = isset( $installed_woocommerce_plugins[ $woocommerce_plugin ] );
	

	if ( $is_woocommerce_installed ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$woocommerce_message = __( 'Configurator Theme is a lightweight starter theme. We recommend you to use it together with WooCommerce plugin, they work perfectly together!', 'configurator-woocommerce' );

		$woocommerce_button_text = __( 'Activate Woocommerce', 'configurator-woocommerce' );
		$woocommerce_button_link = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $woocommerce_plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $woocommerce_plugin );
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		$woocommerce_message = __( 'Configurator Theme is a lightweight starter theme. We recommend you to use it together with WooCommerce plugin, they work perfectly together!', 'configurator-woocommerce' );

		$woocommerce_button_text = __( 'Install Woocommerce', 'configurator-woocommerce' );
		$woocommerce_button_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' );
	}



	?>
	<style>
		.notice.configurator-elementor-notice {
			border: 1px solid #ccd0d4;
			border-left: 4px solid #9b0a46 !important;
			box-shadow: 0 1px 4px rgba(0,0,0,0.15);
			display: flex;
			padding: 0px;
		}
		.rtl .notice.configurator-elementor-notice {
			border-right-color: #9b0a46 !important;
		}
		.notice.configurator-elementor-notice .configurator-elementor-notice-aside {
			width: 50px;
			display: flex;
			align-items: start;
			justify-content: center;
			padding-top: 15px;
			background: rgba(215,43,63,0.04);
		}
		.notice.configurator-elementor-notice .configurator-elementor-notice-aside img{
			width: 1.5rem;
		}
		.notice.configurator-elementor-notice .configurator-elementor-notice-inner {
			display: table;
			padding: 20px 0px;
			width: 100%;
		}
		.notice.configurator-elementor-notice .configurator-elementor-notice-content {
			padding: 0 20px;
		}
		.notice.configurator-elementor-notice p {
			padding: 0;
			margin: 0;
		}
		.notice.configurator-elementor-notice h3 {
			margin: 0 0 5px;
		}
		.notice.configurator-elementor-notice .configurator-elementor-install-now {
			display: block;
			margin-top: 15px;
		}
		.notice.configurator-elementor-notice .configurator-elementor-install-now .configurator-elementor-install-button {
			background: #127DB8;
			border-radius: 3px;
			color: #fff;
			text-decoration: none;
			height: auto;
			line-height: 20px;
			padding: 0.4375rem 0.75rem;
			text-transform: capitalize;
		}
		.notice.configurator-elementor-notice .configurator-elementor-install-now .configurator-elementor-install-button:active {
			transform: translateY(1px);
		}
		@media (max-width: 767px) {
			.notice.configurator-elementor-notice.configurator-elementor-install-woocommerce {
				padding: 0px;
			}
			.notice.configurator-elementor-notice .configurator-elementor-notice-inner {
				display: block;
				padding: 10px;
			}
			.notice.configurator-elementor-notice .configurator-elementor-notice-inner .configurator-elementor-notice-content {
				display: block;
				padding: 0;
			}
			.notice.configurator-elementor-notice .configurator-elementor-notice-inner .configurator-elementor-install-now {
				display: none;
			}
		}
	</style>
	<script>jQuery( function( $ ) {
			$( 'div.notice.configurator-elementor-install-woocommerce' ).on( 'click', 'button.notice-dismiss', function( event ) {
				event.preventDefault();

				$.post( ajaxurl, {
					action: 'configurator_woocommerce_set_admin_notice_viewed'
				} );
			} );
		} );</script>
	
	<div class="notice updated  configurator-elementor-notice configurator-elementor-install-woocommerce" style="<?php if ( class_exists( 'woocommerce' ) ) { echo 'display:none';} ?>">
		<div class="configurator-elementor-notice-inner">
			<div class="configurator-elementor-notice-content">
				<h3><?php esc_html_e( 'Thanks for installing Configurator Theme!', 'configurator-elementor' ); ?></h3>
				<p><?php echo esc_html( $woocommerce_message ); ?></p>
				<div class="configurator-elementor-install-now">
					<a class="configurator-elementor-install-button" href="<?php echo esc_attr( $woocommerce_button_link ); ?>"><?php echo esc_html( $woocommerce_button_text ); ?></a>
				</div>
			</div>
		</div>
	</div>
	<?php
}


/**
 * Set Admin Notice Viewed.
 *
 * @return void
 */
function ajax_configurator_elementor_set_admin_notice_viewed() {
	update_user_meta( get_current_user_id(), '_configurator_elementor_install_notice', 'true' );
	die;
}

add_action( 'wp_ajax_configurator_elementor_set_admin_notice_viewed', 'ajax_configurator_elementor_set_admin_notice_viewed' );
if ( ! did_action( 'elementor/loaded' ) ) {
	add_action( 'admin_notices', 'configurator_elementor_fail_load_admin_notice' );
}

// woocommerce
function ajax_configurator_woocommerce_set_admin_notice_viewed() {
	update_user_meta( get_current_user_id(), '_configurator_woocommerce_install_notice', 'true' );
	die;
}
add_action( 'wp_ajax_configurator_woocommerce_set_admin_notice_viewed', 'ajax_configurator_woocommerce_set_admin_notice_viewed' );
if ( ! did_action( 'woocommerce/loaded' ) ) {
	add_action( 'admin_notices', 'woocommerce_elements_fail_load_admin_notice' );
}

// add_action( 'wp_ajax_configurator_elements_set_admin_notice_viewed', 'ajax_configurator_elements_set_admin_notice_viewed' );
// if ( ! did_action( 'configurator/loaded' ) ) {
// 	add_action( 'admin_notices', 'configurator_elements_fail_load_admin_notice' );
// }
