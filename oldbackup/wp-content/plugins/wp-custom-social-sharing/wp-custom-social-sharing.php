<?php
/**
 * Plugin Name: WP Custom Social Sharing
 * Description: A plugin to display social sharing
 * Version: 1.1
 * Author: Alok Shrestha
 * Author URI: http://alokshrestha.com.np
 * Text Domain: wcss-social-share
 * License: GPLv3 or later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Wcss_Social_Share' ) ) {

/**
* Wcss_Social_share class manages all the backend attributes of plugin.
*/
	class Wcss_Social_Share {

		/**
		* Constructor Class
		*/
		public function __construct() {

			$this->wcss_define_constants();
			$this->wcss_default_options_settings();

			add_action( 'admin_menu', array( $this, 'wcss_add_menu_item' ) );
			add_action( 'admin_init', array( $this, 'wcss_register_settings' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'wcss_admin_enqueues' ) );
			add_action( 'plugins_loaded', array( $this, 'includes' ) );

		}

		/**
		* Define Plugin Constant
		*/
		public function wcss_define_constants() {

			if ( ! defined( 'WCSS_PLUGIN_DIR' ) ) {
				define( 'WCSS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			if ( ! defined( 'WCSS_PLUGIN_URL' ) ) {
				define( 'WCSS_PLUGIN_URL', plugins_url( '/', __FILE__ ) );
			}
		}

		/**
		* Add Option Page. Comes under Settings menu in backend.
		*/
		public function wcss_add_menu_item() {
			add_options_page( __( 'WP Custom Social Sharing', 'wcss-social-share' ), __( 'Social Sharing', 'wcss-social-share' ), 'manage_options', 'wcss-social-share', array( $this, 'wcss_settings_page' ) );
		}

		/**
		* Call Settings html content
		*/
		public function wcss_settings_page() {

			require WCSS_PLUGIN_DIR . 'templates/admin-settings-page.php';
		}

		/**
		* Admin enqueue scripts
		*/
		public function wcss_admin_enqueues() {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'wcss-admin-style', WCSS_PLUGIN_URL . 'assets/css/wcss-admin-style.css' );

			$wcss_front = new Wcss_front_manager();

			$wcss_front->wcss_dequeue_other_fontawesome();//dequeue font-awesome if exists.

			wp_enqueue_style( 'wcss-admin-fontawesome', WCSS_PLUGIN_URL . 'assets/css/font-awesome.min.css' );

			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'wcss-admin-script', WCSS_PLUGIN_URL . 'assets/js/wcss-admin-script.js', array( 'wp-color-picker' ), false, true );
		}


		/**
		* Load Classes
		*/
		public function includes() {

			if ( ! class_exists( 'Wcss_front_manager' ) ) {
				include_once( WCSS_PLUGIN_DIR . 'includes/class-wcss-front-manager.php' );
			}

		}

		/**
		* Sanitize and register a setting
		*/
		public function wcss_register_settings() {
			register_setting( 'wcss_settings_options', 'wcss_settings_options', array( $this, 'wcss_sanitize_settings_options' ) );
		}

		/**
		* Sanitize and return field/option  value
		*/
		public function wcss_sanitize_settings_options() {

			if ( ! isset( $_POST['validate_submit'] ) || ! wp_verify_nonce( $_POST['validate_submit'], 'wcss_nonce_field' ) ) {
				return false;
			}

			$variables_array = array();

			$input_options = array();

			$posts_variables = stripslashes_deep( $_POST['wcss_social_sharing'] );

			$social_options_array = array( 'facebook', 'twitter', 'gplus', 'pinterest', 'linkedin', 'whatsapp' );

			foreach ( $social_options_array as $option_value ) {

				if ( isset( $posts_variables[ $option_value ]['enable'] ) && ! empty( $posts_variables[ $option_value ]['enable'] ) && 'yes' === $posts_variables[ $option_value ]['enable'] ) {

					$input_options[ $option_value ]['enable'] = 'yes';
				} else {
					$input_options[ $option_value ]['enable'] = '';
				}
			}

			//Facebook color
			$input_options['facebook']['color'] = ( ! empty( $posts_variables['facebook']['color'] ) ) ? sanitize_hex_color( $posts_variables['facebook']['color'] ) : '#3b5998';

			// Twitter color
			$input_options['twitter']['color'] = ( ! empty( $posts_variables['twitter']['color'] ) ) ? sanitize_hex_color( $posts_variables['twitter']['color'] ) : '#00acee';

			//Whatsapp color
			$input_options['whatsapp']['color'] = ( ! empty( $posts_variables['whatsapp']['color'] ) ) ? sanitize_hex_color( $posts_variables['whatsapp']['color'] ) : '#43d854';

			//G+ color
			$input_options['gplus']['color'] = ( ! empty( $posts_variables['gplus']['color'] ) ) ? sanitize_hex_color( $posts_variables['gplus']['color'] ) : '#dd4b39';

			//Linkedin color
			$input_options['linkedin']['color'] = ( ! empty( $posts_variables['linkedin']['color'] ) ) ? sanitize_hex_color( $posts_variables['linkedin']['color'] ) : '#0077b5';

			//Pinterest cOlor
			$input_options['pinterest']['color'] = ( ! empty( $posts_variables['pinterest']['color'] ) ) ? sanitize_hex_color( $posts_variables['pinterest']['color'] ) : '#C92228';

			$variables_array['wcss_social_sharing']              = $input_options;
			$variables_array['wcss_social_sharing']['post_type'] = ( isset( $posts_variables['post_type'] ) && ! empty( $posts_variables['post_type'] ) ) ? $posts_variables['post_type'] : array();

			$variables_array['wcss_social_sharing']['button_order'] = ( isset( $posts_variables['button_order'] ) && ! empty( $posts_variables['button_order'] ) ) ? sanitize_text_field( $posts_variables['button_order'] ) : 'facebook,twitter,gplus,pinterest,linkedin,whatsapp';

			$variables_array['wcss_social_sharing']['icon_position'] = ( isset( $posts_variables['icon_position'] ) && ! empty( $posts_variables['icon_position'] ) ) ? $posts_variables['icon_position'] : array();

			$variables_array['wcss_social_sharing']['button_size'] = ( isset( $posts_variables['button_size'] ) && ! empty( $posts_variables['button_size'] ) ) ? sanitize_text_field( $posts_variables['button_size'] ) : 'small';

			$variables_array['wcss_social_sharing']['button_label'] = ( isset( $posts_variables['button_label'] ) && ! empty( $posts_variables['button_label'] ) ) ? sanitize_text_field( $posts_variables['button_label'] ) : '';

			return $variables_array;

		}

		/**
		* Return default admin form setting.
		*/
		public function wcss_default_options_settings() {
			$default_setting = array(
				'wcss_social_sharing' => array(
					'facebook'      => array(
						'enable' => 'yes',
						'color'  => '',
					),
					'twitter'       => array(
						'enable' => 'yes',
						'color'  => '',
					),
					'gplus'         => array(
						'enable' => 'yes',
						'color'  => '',
					),
					'pinterest'     => array(
						'enable' => 'yes',
						'color'  => '',
					),
					'linkedin'      => array(
						'enable' => 'yes',
						'color'  => '',
					),
					'whatsapp'      => array(
						'enable' => 'yes',
						'color'  => '',
					),
					'post_type'     => array(),
					'button_order'  => 'facebook,twitter,gplus,pinterest,linkedin,whatsapp',
					'icon_position' => array(),
					'button_size'   => 'medium',
					'button_label'  => 'Share This:',

				),
			);

			$settings = get_option( 'wcss_settings_options' );

			if ( empty( $settings ) ) {
				update_option( 'wcss_settings_options', $default_setting );
			}

			return $default_setting;
		}

	}

	$wcss = new Wcss_Social_Share();
}
