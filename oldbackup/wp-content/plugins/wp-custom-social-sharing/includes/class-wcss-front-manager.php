<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Wcss_front_manager class. manage the contents related to front-end
*/
class Wcss_front_manager {

	/**
	* constructor class
	*/
	public function __construct() {

		$wcss_settings_options = get_option('wcss_settings_options');
		$wcss_options = $wcss_settings_options['wcss_social_sharing'];

		if ( is_array( $wcss_options['icon_position'] ) && !empty( $wcss_options['icon_position'] ) ) {

			foreach ( $wcss_options['icon_position'] as $icon_position ) {

				if ( in_array( 'inside_image', $wcss_options['icon_position'] ) ) {

					add_filter('post_thumbnail_html', array( $this, 'wcss_inside_image' ), 99, 5 );

				}

				if ( in_array( 'after_content', $wcss_options['icon_position'] ) ) {

					add_filter( 'the_content', array( $this, 'wcss_buttons_after_content' ) );
				}

				if (in_array( 'above_content', $wcss_options['icon_position'] ) ) {

					add_filter( 'the_content', array( $this, 'wcss_buttons_above_content' ) );
				}

				if ( in_array( 'float_left', $wcss_options['icon_position'] ) ) {

					add_filter( 'the_content', array( $this, 'wcss_buttons_float_left' ) );
				}
			}
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'wcss_enqueue_scripts' ) );//enqueue scripts and styles
		add_shortcode( 'wcss_shortcode', array( $this, 'wcss_button_html_shortcode') );//add shortcode
		add_action( 'wp_head', array( $this, 'wcss_display_custom_color') );//add action to wp_head

	}

	/**
	* Enqueue Front End scripts and styles
	*/
	public function wcss_enqueue_scripts() {

		$this->wcss_dequeue_other_fontawesome();//dequeue font-awesome if exists.
		wp_enqueue_style( 'wcss-font-awesome', WCSS_PLUGIN_URL.'assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'wcss-front-end-style', WCSS_PLUGIN_URL.'assets/css/wcss-front-end-style.css' );
		wp_enqueue_script( 'wcss-front-script', WCSS_PLUGIN_URL.'assets/js/wcss-front-end.js', array(), false, true );
	}

	/**
	* Check for any other font-awesome enqueued
	*/
	public function wcss_dequeue_other_fontawesome() {

		global $wp_styles;

		if ( !empty( $wp_styles->registered ) ) {
			foreach ($wp_styles->registered as $index => $styles) {
				if ( ( strpos( $styles->src, 'font-awesome.min.css' ) !== false ) || ( strpos( $styles->src, 'font-awesome.css' ) !== false ) ) {
					wp_dequeue_style( $styles->handle );
					wp_deregister_style( $styles->handle );
				}
			}
		}
	}

	/**
	* Posts content filter returned with buttons html
	*/
	public function wcss_buttons_after_content( $content ) {

		global $post;
		$wcss_settings_options = get_option('wcss_settings_options');
		$wcss_options = $wcss_settings_options['wcss_social_sharing'];
		$return_content = $content;

		if (is_single() || is_page() ) {

			if ( in_array( $post->post_type, $wcss_options['post_type'] ) ) {

				$return_content = $content.$this->wcss_button_html( '', 'wcss-after-content');
			}
			return $return_content;
		} else {
			return $content;
		}
	}

	/**
	* Share buttons below title filter
	*/
	public function wcss_buttons_above_content( $content ) {

		global $post;

		$wcss_settings_options = get_option('wcss_settings_options');
		$wcss_options = $wcss_settings_options['wcss_social_sharing'];

		$return_content = $content;

		if (is_single() || is_page() ) {

			if ( in_array( $post->post_type, $wcss_options['post_type'] ) ) {

				$return_content = $this->wcss_button_html( '', 'wcss-below-title').$content;

			}
			return $return_content;

		} else {
			return $content;
		}
	}

	/**
	* Float left sharing button html
	*/
	public function wcss_buttons_float_left( $content ) {

		global $post;

		$wcss_settings_options = get_option('wcss_settings_options');
		$wcss_options = $wcss_settings_options['wcss_social_sharing'];

		$return_content = $content;

		if (is_single() || is_page() ) {

			if ( in_array( $post->post_type, $wcss_options['post_type'] ) ) {
				$return_content = $content.$this->wcss_button_html( '', 'wcss-fixed-content');
			}
			return $return_content;
		} else {
			return $content;
		}
	}

	/**
	* Social sharing with images
	*/
	public function wcss_inside_image( $html, $post_id, $post_thumbnail_id, $size, $attr ) {

		$return_content = '';

		$return_content .= $this->wcss_button_html( '', 'wcss-featured-image');

		$return = '<div class="wcss-featured-image-wrap">'.$html.$return_content.'</div>';

		return $return;
	}

	/**
	* Social sharing shortcode
	*/
	public function wcss_button_html_shortcode( $atts ) {
		$value = shortcode_atts(array(
			'above_content'	=> false,
			'below_content' => false,
			'float_left' => false,

			),$atts);
		if ( $value['above_content'] ) {

			$icon_position = 'wcss-below-title';

		} elseif ( $value['below_content'] ) {

			$icon_position = 'wcss-after-content';

		} elseif ( $value['float_left'] ) {

			$icon_position = 'wcss-fixed-content';
		}

		ob_start();

		echo $this->wcss_button_html('', $icon_position );

		$return_content = ob_get_clean();

		return $return_content;
	}

	/**
	* Returns Buttons html
	*/
	public function wcss_button_html( $title = '', $icon_position = '') 	{
		global $post;

		$wcss_settings_options = get_option('wcss_settings_options');

		$wcss_options = $wcss_settings_options['wcss_social_sharing'];

		if ( is_archive() || is_home() ||( is_front_page() && is_home() ) ) {
			return '';
		}

		$button_size = esc_attr( $wcss_options['button_size'] );
		$return_content = '';

		$return_content .= '<div class="social-sharing wcss-social-sharing '.esc_attr( $icon_position ).' wcss-icon-enabled">';

		$before_button_text = esc_attr( $wcss_options['button_label'] );
		$return_content .= sprintf(  __( '<h3 class="wcss-title share-button-title">%s</h3>', 'wcss-social-share' ), $before_button_text );
		$return_content .= '<div class="wcss-content"><ul>';

		$button_order = esc_attr( $wcss_options['button_order'] );
		$exploded_order = explode( ',', rtrim( $button_order,',' ) );

		$title = ( !empty( $title ) ) ? esc_att( $title ) : esc_attr( get_the_title( $post->ID ) );
		$post_title = urlencode( html_entity_decode( $title ) );
		$get_permalink = urlencode( apply_filters( 'wcss_filter_permalink', get_permalink( $post->ID ) ) );

		$escaped_js = esc_js('return wcss_load_popup(this)');

		foreach ($exploded_order as $value) {
			switch ( $value ) {
				case 'facebook':

				if ( 'yes' == $wcss_options['facebook']['enable'] ) {

					$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$get_permalink;
					$return_content .=  sprintf(
						__( '<li class="wcss-facebook" ><a href="%s" onclick="%s" class="%s" target="_blank" title="%s"><i class="wcss-icon fa fa-facebook"></i> </a></li>', 'wcss-social-share' ),
						$facebookURL,
						$escaped_js,
						'wcss-share-btn wcss-'.$button_size,
						__( 'Share on Facebook', 'wcss-social-share')
						);

				}
				break;

				case 'pinterest':

				if ( 'yes' == $wcss_options['pinterest']['enable'] ) {
					$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					$thumbnail_url = $post_thumbnail[0];
					$pinterestURL =  'https://pinterest.com/pin/create/button/?url='.$get_permalink.'&media='.$thumbnail_url.'&description='.$post_title;
					$return_content .=  sprintf(
						__( '<li class="wcss-pinterest"><a href="%s" onclick="%s" class="%s" target="_blank" title="%s"><i class="wcss-icon fa fa-pinterest"></i> </a></li>', 'wcss-social-share' ),
						$pinterestURL,
						$escaped_js,
						'wcss-share-btn wcss-'.$button_size,
						__( 'Share on Pinterest', 'wcss-social-share')
						);
				}
				break;

				case 'twitter':
				if ( 'yes' == $wcss_options['twitter']['enable'] ) {
					$twitterURL = 'https://twitter.com/intent/tweet?text='.$post_title.'&url='.$get_permalink;
					$return_content .=  sprintf(
						__( '<li class="wcss-twitter"><a href="%s" onclick="%s" class="%s" target="_blank" title="%s"><i class="wcss-icon fa fa-twitter"></i> </a></li>', 'wcss-social-share' ),
						$twitterURL,
						$escaped_js,
						'wcss-share-btn wcss-'.$button_size,
						__( 'Share on Twitter', 'wcss-social-share')
						);
				}
				break;

				case 'whatsapp':
				if ( 'yes' == $wcss_options['whatsapp']['enable'] ) {
					$whatsappURL = 'whatsapp://send?text='.$post_title . ' ' . $get_permalink;
					$return_content .=  sprintf(
						__( '<li class="wcss-whatsapp"><a href="%s" onclick="%s" class="%s" target="_blank" title="%s"><i class="wcss-icon fa fa-whatsapp"></i> </a></li>', 'wcss-social-share' ),
						$whatsappURL,
						$escaped_js,
						'wcss-share-btn wcss-'.$button_size,
						__( 'Share on Whatsapp', 'wcss-social-share')
						);
				}
				break;

				case 'gplus':
				if ( 'yes' == $wcss_options['gplus']['enable'] ) {
					$googleURL = 'https://plus.google.com/share?url='.$get_permalink;
					$return_content .=  sprintf(
						__( '<li  class="wcss-google"><a href="%s" onclick="%s" class="%s" target="_blank" title="%s"><i class="wcss-icon fa fa-google-plus"></i> </a></li>', 'wcss-social-share' ),
						$googleURL,
						$escaped_js,
						'wcss-share-btn wcss-'.$button_size,
						__( 'Share on Google Plus', 'wcss-social-share')
						);
				}
				break;

				case 'linkedin':
				if ( 'yes' == $wcss_options['linkedin']['enable'] ) {
					$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$get_permalink.'&title='.$post_title;
					$return_content .= sprintf(
						__( '<li class="wcss-linkedin"><a href="%s" onclick="%s" class="%s" target="_blank" title="%s"><i class="wcss-icon fa fa-linkedin"></i> </a></li>', 'wcss-social-share' ),
						$linkedInURL,
						$escaped_js,
						'wcss-share-btn wcss-'.$button_size,
						__( 'Share on LinkedIn', 'wcss-social-share')
						);
				}
				break;
			}
		}
		$return_content .= '</ul></div></div>';
		?>
		<?php

		return $return_content;
	}


	/**
	* Print style to wp-head
	*/
	public  function wcss_display_custom_color() {
		$wcss_settings_options = get_option('wcss_settings_options');
		$wcss_options = $wcss_settings_options['wcss_social_sharing'];
		?>
		<style type="text/css">
			.wcss-content .wcss-whatsapp a.wcss-share-btn {
				background: <?php echo esc_attr( $wcss_options['whatsapp']['color'] ); ?>;
			}
			.wcss-content .wcss-twitter a.wcss-share-btn {
				background: <?php echo esc_attr( $wcss_options['twitter']['color'] ); ?>;
			}
			.wcss-content .wcss-google a.wcss-share-btn {
				background: <?php echo esc_attr( $wcss_options['gplus']['color'] ); ?>;
			}
			.wcss-content .wcss-facebook a.wcss-share-btn {
				background: <?php echo esc_attr( $wcss_options['facebook']['color'] ); ?>;
			}
			.wcss-content .wcss-linkedin a.wcss-share-btn {
				background: <?php echo esc_attr( $wcss_options['linkedin']['color'] ); ?>;
			}
			.wcss-content .wcss-pinterest a.wcss-share-btn {
				background: <?php echo esc_attr( $wcss_options['pinterest']['color'] ); ?>;
			}
		</style>
		<?php
	}

}

$wcss_front = new Wcss_front_manager();