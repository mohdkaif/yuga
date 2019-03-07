<?php
/**
 * Plugin Name: Hs Whatsapp Share
 * Plugin URI: http://heliossolutions.in/
 * Description: Instantly share and promote your website posts, articles, woocommerce products using WhatsApp
 * Version: 1.0.1
 * Author: Helios Solutions
 * Author URI: http://heliossolutions.in/
 */

if ( ! defined( 'ABSPATH' ) ) {
    echo "Hi there! Nice try. Come again.";
    die();
}

$options = array();

/*
 * 	Add a link to our plugin in the admin menu
 * 	under 'Settings > HS Whatsapp Share'
 *
 */
function hswhatsapp_badges_menu() {
    /*
     * 	Use the add_options_page function
     * 	add_options_page( $page_title, $menu_title, $capability, $menu-slug, $function )
     *
     */
    add_options_page(
        'HS Whatsapp Share Settings', 'HS Whatsapp Share Settings', 'manage_options', 'hswhatsapp-badges', 'hswhatsapp_badges_options_page'
    );
}

add_action('admin_menu', 'hswhatsapp_badges_menu');

/*
 * Settings link on plugin activation page
 */

function plugin_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=hswhatsapp-badges">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );

add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );


function hswhatsapp_badges_options_page() {

    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }

    global $options;

    if (isset($_POST['hswhatsapp_form_submitted'])) {

        $hidden_field = esc_html($_POST['hswhatsapp_form_submitted']);

        if ($hidden_field == 'Y') {

            $hswhatsapp_text        = isset($_POST['hswhatsapp_text']);
            
            if ( isset($_POST['hswhatsappbutton_text']) ){
                $hswhatsappbutton_text  = esc_html($_POST['hswhatsappbutton_text']);
            }
            
            if ( isset($_POST['singlepage']) ){
                $singlepage = esc_html($_POST['singlepage']);
            }
            
            if ( isset($_POST['postpage']) ){
                $postpage   = esc_html($_POST['postpage']);
            }
			
            if ( isset($_POST['custompage']) ){
                $custompage = esc_html($_POST['custompage']);
            }
			
            if ( isset($_POST['woocommercepage']) ){
                $woocommercepage = esc_html($_POST['woocommercepage']);
            }
           
			$options['hswhatsapp_text']         = isset($hswhatsapp_text);
			$options['hswhatsappbutton_text']   = isset($hswhatsappbutton_text);
			$options['singlepage']              = isset($singlepage);
			$options['postpage']                = isset($postpage);
			$options['custompage']              = isset($custompage);
            $options['woocommercepage']         = isset($woocommercepage);
            $options['last_updated']            = time();

            update_option('hswhatsapp_badges', $options);
        }
    }

    $options = get_option('hswhatsapp_badges');

    if ($options != '') {
        $hswhatsapp_text        = $options['hswhatsapp_text'];
		$hswhatsappbutton_text  = $options['hswhatsappbutton_text'];
		$singlepage             = $options['singlepage'];
		$postpage               = $options['postpage'];
		$custompage             = $options['custompage'];
        $woocommercepage        = $options['woocommercepage'];
	}

    require( 'inc/options-page-wrapper.php' );
}

/* Load Front End */

function hswhatsapp_front_end_load() {
    require( 'inc/front-end.php' );
}

add_action('wp_head', 'hswhatsapp_front_end_load');