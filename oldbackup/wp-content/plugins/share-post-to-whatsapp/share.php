<?php 
		/*
  Plugin Name: Share Post to Whatsapp
  Description: Location Click Map plugin is useful to display marker on clicking of location, use shortcode [location_map].
  Version: 1.0

 */
function spw_share_to_whatsapp_menu_item()
{
  add_submenu_page("options-general.php", "Share To Whatsapp", "Share To Whatsapp", "manage_options", "share-to-whatsapp", "spw_share_to_whatsapp_page"); 
}

add_action("admin_menu", "spw_share_to_whatsapp_menu_item");

function spw_share_to_whatsapp_page()
{
   ?>
      <div class="wrap">
         <h1>Share to Whatsapp Settings</h1>
 
         <form method="post" action="options.php">
            <?php
               settings_fields("share_to_whatsapp_config_section");
 
               do_settings_sections("share-to-whatsapp");
                
               submit_button(); 
            ?>
         </form>
      </div>
   <?php
}
function spw_share_to_whatsapp_settings()
{
    add_settings_section("share_to_whatsapp_config_section", "", null, "share-to-whatsapp");

    add_settings_field("share-to-whatsapp-whatsapp", "Display whatsapp share button?", "spw_share_to_whatsapp_whatsapp_checkbox", "share-to-whatsapp", "share_to_whatsapp_config_section");

    register_setting("share_to_whatsapp_config_section", "share-to-whatsapp-whatsapp");
}
 
function spw_share_to_whatsapp_whatsapp_checkbox()
{  
   ?>
        <input type="checkbox" name="share-to-whatsapp-whatsapp" value="1" <?php checked(1, get_option('share-to-whatsapp-whatsapp'), true); ?> /> Check for Yes
   <?php
}
 
add_action("admin_init", "spw_share_to_whatsapp_settings");

function spw_add_share_to_whatsapp_icons($content)
{
    $html = "<div class='share-to-whatsapp-wrapper'><div class='share-on-whsp'>Share on: </div>";

    global $post;

    $url = get_permalink($post->ID);
    $url = esc_url($url); 
    if(get_option("share-to-whatsapp-whatsapp") == 1)
    {
        $html = $html . "<a data-text='".$post->post_title."' data-link='" . $url . "' class='whatsapp whatsapp-share'>whatsapp</a>";
		
    }

    $html = $html . "<div class='clear '></div></div>";	

    return $content = $content . $html;
}

add_filter("the_content", "spw_add_share_to_whatsapp_icons");
function spw_share_to_whatsapp_style() 
{
	wp_enqueue_script('jquery');
    wp_register_style("share-to-whatsapp-style-file", plugin_dir_url(__FILE__) . "whatsshare.css");
    wp_enqueue_style("share-to-whatsapp-style-file");
	wp_register_script("share-to-whatsapp-script-file", plugin_dir_url(__FILE__) . "whatsshare.js");
    wp_enqueue_script("share-to-whatsapp-script-file");
}	

add_action("wp_enqueue_scripts", "spw_share_to_whatsapp_style");