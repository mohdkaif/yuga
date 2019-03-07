=== WP Custom Social Sharing ===
Contributors: alokstha1
Plugin URI: https://wordpress.org/plugins/wp-custom-social-sharing/
Tags: responsive social icons, responsive social sharing icons, responsive icon, social icons, social sharing, sharing icons, twitter share, whatsapp share, googleplus share, facebook share, linkedin share, pinterest share, share icon for custom post type, share icon for pages, share icon for posts
Requires at least: 3.6
Tested up to: 4.9.4
License: GPLv3 or later

== Description ==

<strong>WP Custom Social Sharing</strong> is a free WordPress plugin that makes any content on you website social-share-friendly by allowing anyone easily share their website content (page, posts, custom post types, media) on some major social medias: Facebook, Twitter, Google+, Pinterest, LinkedIn and Whatsapp from your website.

You can either enable/disable the social media profiles you want to activate and select the color for each individual icons.

This plugin provides the capability to select the position (above content, after content, floating left and inside image) all at once and 3 different sizes ( small, medium and large ).

Note: Whatsapp is enabled only for mobile or other small device browsers.

**Plugin Features**

- Supports social sharing for Facebook, Google+, Linkedin, Twitter, Whatsapp and Pinterest.
- Custom selection of Post, Page, Custom Post Types and Media to display the sharing icons.
- Size selection between Small, Medium and Large.
- 100% responsive.
- Reorder social icons by drag and drop in the suitable order.
- Provides multiple location to display icons on the same page such as: above content, below content, float left and over the post-thumbnail.
- Provides Shortcode.
- Compatible with any themes.
- Selection of custom colors for all the icons individually.
- Enable/Disable icons individually.

**Plugin Shortcodes**
`
[wcss_shortcode above_content=true] //Appears above the content
[wcss_shortcode below_content=true] //Appears below the content
[wcss_shortcode float_left=true] //Appears on the left side of the page
`

== Support ==

* Feel free to leave comments,ask question,suggest new feature or directly mail at alokstha1@gmail.com

== Screenshots ==
1. Social Sharing Dashboard.
2. Icons floating left
3. Icons above and below the contents.

== Installation ==

= Installation of the plugin =

1. In your WordPress dashboard, got to *Plugins->Add New*, Search for *WP Custom Social Sharing* and click "Install now" and activate.
2. Alternatively, download the plugin and upload the contents of `wp-custom-social-sharing.zip` to your plugins directory. Activate the plugin.
3. Can also be uploaded from *Plugins->Add New* page and clicking on the *Upload Plugin* button at the top of the page and selecte the downloaded zipped folder.

== Changelog ==

= 1.0 - July 8, 2017 =
- First Release.

= 1.1 - Septenber 6, 2017 =
- Sharing permalink is customizable with apply_filters( 'wcss_filter_permalink', get_permalink( $post->ID ) ).
