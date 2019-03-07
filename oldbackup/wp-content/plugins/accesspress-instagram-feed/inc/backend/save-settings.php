<?php
defined('ABSPATH') or die( "No script kiddies please!" );
$_POST = array_map( 'stripslashes_deep', $_POST );
foreach( $_POST['instagram'] as $key=>$val ){
	$$key = sanitize_text_field($val);
}
$apif_settings = array();
$apif_settings['username'] = $username;
$apif_settings['access_token'] = $access_token;
$apif_settings['instagram_mosaic'] = isset($instagram_mosaic) ? $instagram_mosaic:'mosaic';
$apif_settings['followmetext'] = isset($followmetext) ? $followmetext:'';
$apif_settings['user_id'] = $user_id;
$apif_settings['active'] = isset($active) ? $active : ' ';
update_option( 'apif_settings', $apif_settings);
wp_redirect(admin_url('admin.php?page=if-instagram-feed&message=1'));
exit();