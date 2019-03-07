<?php
$wcss_settings_options = get_option('wcss_settings_options');
$wcss_options = $wcss_settings_options['wcss_social_sharing'];
?>

<div class="wrap">
	<h1><?php _e('WP Custom Social Sharing', 'wcss-social-share'); ?></h1>

	<form action="options.php" method="POST">
		<?php settings_fields( 'wcss_settings_options' ); ?>

		<table class="form-table">
			<?php wp_nonce_field('wcss_nonce_field', 'validate_submit' ); ?>
			<tbody>
			<!-- tr for button setting -->
				<tr scope="row">
					<th>
						<label for="sharebutton"><?php _e( 'Customize Button Settings', 'wcss-social-share'); ?></label>
						<p class="description" >
							<?php _e( 'Drag the icon to change the order.', 'wcss-social-sharing'); ?>
						</p>
					</th>
					<td>
						<div id="sharebutton" class="wcss-button-container">

							<div class="wcss-order-icon" id="wcss-order-icon">
								<?php
								$wcss_order = esc_attr( $wcss_options['button_order'] );

								$exploded_order = explode( ',', rtrim( $wcss_order,',' ) );
								foreach ($exploded_order  as $i){
									switch($i){
										case 'facebook':
										echo sprintf( __('<a href="#" id="facebook" class="button icon-button facebook-icon" data-show="facebook-slide" ><i class="fa fa-facebook"></i>%s</a>'), __('Facebook', 'wcss-social-share') );
										break;
										case 'twitter':
										echo sprintf( __('<a href="#" id="twitter" class="button icon-button twitter-icon" data-show="twitter-slide" ><i class="fa fa-twitter"></i>%s</a>'), __('Twitter', 'wcss-social-share') );
										break;
										case 'gplus':
										echo sprintf( __('<a href="#" id="gplus" class="button icon-button gplus-icon" data-show="gplus-slide" ><i class="fa fa-google-plus"></i>%s</a>'), __('Google+', 'wcss-social-share') );
										break;
										case 'pinterest':
										echo sprintf( __('<a href="#" id="pinterest" class="button icon-button pinterest-icon" data-show="pinterest-slide" ><i class="fa fa-pinterest"></i>%s</a>'), __('Pinterest', 'wcss-social-share') );
										break;
										case 'linkedin':
										echo sprintf( __('<a href="#" id="linkedin" class="button icon-button linkedin-icon" data-show="linkedin-slide" ><i class="fa fa-linkedin"></i>%s</a>'), __('LinkedIn', 'wcss-social-share') );
										break;
										case 'whatsapp':
										echo sprintf( __('<a href="#" id="whatsapp" class="button icon-button whatsapp-icon" data-show="whatsapp-slide" ><i class="fa fa-whatsapp"></i>%s</a>'), __('Whatsapp', 'wcss-social-share') );
										break;
									}
								}
								?>
								<input type="hidden" id="wcss-button-order-field" name="wcss_social_sharing[button_order]" value="<?php echo ( isset( $wcss_options['button_order'] ) && !empty( $wcss_options['button_order'] ) ) ? esc_attr( $wcss_options['button_order'] ) : 'facebook,twitter,gplus,pinterest,linkedin,whatsapp'; ?>" />
							</div>

							<!-- Facebook button setting -->
							<div class="wcss-share-item item facebook">

								<div class="slide-section closed" id="facebook-slide">
									<label for="enablefacebook">
										<input type="checkbox" name="wcss_social_sharing[facebook][enable]" value="yes" id="enablefacebook" <?php checked( ( 'yes' === $wcss_options['facebook']['enable'] ), true ); ?> />
										<?php _e( 'Enable Facebook', 'wcss-social-share' ); ?>
									</label>
									<div class="color-select">
										<label for="facebookcolor">
											<input type="text" name="wcss_social_sharing[facebook][color]" id="facebookcolor" class="color-field" value="<?php echo ( isset( $wcss_options['facebook']['color'] ) && !empty( $wcss_options['facebook']['color'] ) ) ? esc_attr( $wcss_options['facebook']['color'] ) : '#3b5998'; ?>" />
											<p class="description" ><?php _e( 'Select button color.', 'wcss-social-share' ); ?></p>
										</label>
									</div>
								</div>
							</div>
							<!--End of Facebook button setting -->

							<!-- Twitter button setting -->
							<div class="wcss-share-item item twitter">

								<div class="slide-section closed" id="twitter-slide">
									<label for="enabletwitter">
										<input type="checkbox" name="wcss_social_sharing[twitter][enable]" value="yes" id="enabletwitter" <?php checked( ( 'yes' === $wcss_options['twitter']['enable'] ), true ); ?> />
										<?php _e( 'Enable Twitter', 'wcss-social-share' ); ?>
									</label>
									<div class="color-select">
										<label for="twittercolor">
											<input type="text" name="wcss_social_sharing[twitter][color]" id="twittercolor" class="color-field" value="<?php echo ( isset( $wcss_options['twitter']['color'] ) && !empty( $wcss_options['twitter']['color'] ) ) ? esc_attr( $wcss_options['twitter']['color'] ) : '#00acee'; ?>" />
											<p class="description" ><?php _e( 'Select button color.', 'wcss-social-share' ); ?></p>
										</label>
									</div>
								</div>
							</div>
							<!--End of Twitter button setting -->

							<!-- Google+ button setting -->
							<div class="wcss-share-item item gplus">

								<div class="slide-section closed" id="gplus-slide">
									<label for="enablegplus">
										<input type="checkbox" name="wcss_social_sharing[gplus][enable]" value="yes" id="enablegplus" <?php checked( ( 'yes' === $wcss_options['gplus']['enable'] ), true ); ?> />
										<?php _e( 'Enable Google+', 'wcss-social-share' ); ?>
									</label>
									<div class="color-select">
										<label for="gpluscolor">
											<input type="text" name="wcss_social_sharing[gplus][color]" id="gpluscolor" class="color-field" value="<?php echo ( isset( $wcss_options['gplus']['color'] ) && !empty( $wcss_options['gplus']['color'] ) ) ? esc_attr( $wcss_options['gplus']['color'] ) : '#dd4b39'; ?>" />
											<p class="description" ><?php _e( 'Select button color.', 'wcss-social-share' ); ?></p>
										</label>
									</div>
								</div>
							</div>
							<!--End of Google+ button setting -->

							<!-- Pinterest button setting -->
							<div class="wcss-share-item item pinterest">

								<div class="slide-section closed" id="pinterest-slide">
									<label for="enablepinterest">
										<input type="checkbox" name="wcss_social_sharing[pinterest][enable]" value="yes" id="enablepinterest" <?php checked( ( 'yes' === $wcss_options['pinterest']['enable'] ), true ); ?> />
										<?php _e( 'Enable Pinterest', 'wcss-social-share' ); ?>
									</label>
									<div class="color-select">
										<label for="pinterestcolor">
											<input type="text" name="wcss_social_sharing[pinterest][color]" id="pinterestcolor" class="color-field" value="<?php echo ( isset( $wcss_options['pinterest']['color'] ) && !empty( $wcss_options['pinterest']['color'] ) ) ? esc_attr( $wcss_options['pinterest']['color'] ) : '#C92228'; ?>" />
											<p class="description" ><?php _e( 'Select button color.', 'wcss-social-share' ); ?></p>
										</label>
									</div>
								</div>
							</div>
							<!--End of Pinterest button setting -->

							<!-- Linkedin button setting -->
							<div class="wcss-share-item item linkedin">

								<div class="slide-section closed" id="linkedin-slide">
									<label for="enablelinkedin">
										<input type="checkbox" name="wcss_social_sharing[linkedin][enable]" value="yes" id="enablelinkedin" <?php checked( ( 'yes' === $wcss_options['linkedin']['enable'] ), true ); ?> />
										<?php _e( 'Enable LinkdeIn', 'wcss-social-share' ); ?>
									</label>
									<div class="color-select">
										<label for="linkedincolor">
											<input type="text" name="wcss_social_sharing[linkedin][color]" id="linkedincolor" class="color-field" value="<?php echo ( isset( $wcss_options['linkedin']['color'] ) && !empty( $wcss_options['linkedin']['color'] ) ) ? esc_attr( $wcss_options['linkedin']['color'] ) : '#0077b5'; ?>" />
											<p class="description" ><?php _e( 'Select button color.', 'wcss-social-share' ); ?></p>
										</label>
									</div>
								</div>
							</div>
							<!--End of Linkedin button setting -->

							<!-- Whatsapp button setting -->
							<div class="wcss-share-item item whatsapp">

								<div class="slide-section closed" id="whatsapp-slide">
									<label for="enablewhatsapp">
										<input type="checkbox" name="wcss_social_sharing[whatsapp][enable]" value="yes" id="enablewhatsapp" <?php checked( ( 'yes' === $wcss_options['whatsapp']['enable'] ), true ); ?> />
										<?php _e( 'Enable Whatsapp', 'wcss-social-share' ); ?>
									</label>
									<div class="color-select">
										<label for="whatsappcolor">
											<input type="text" name="wcss_social_sharing[whatsapp][color]" id="whatsappcolor" class="color-field" value="<?php echo ( isset( $wcss_options['whatsapp']['color'] ) && !empty( $wcss_options['whatsapp']['color'] ) ) ? esc_attr( $wcss_options['whatsapp']['color'] ) : '#43d854'; ?>" />
											<p class="description" ><?php _e( 'Select button color.', 'wcss-social-share' ); ?></p>
										</label>
									</div>
								</div>
							</div>
							<!--End of Whatsapp button setting -->

						</div>
					</td>
				</tr>
				<!-- End of tr for button setting -->

				<!-- Sectin to select button for post types and custom post types-->
				<tr>
					<th>
						<label for="displayon">
							<?php _e( 'Show buttons on', 'wcss-social-share'); ?>
						</label>
					</th>
					<td>
						<?php

						$post_types = get_post_types(array(
							'show_ui' => true,
							'show_in_menu' => true,
							), 'objects');

						foreach ($post_types as $post_type) {
							?>
							<input type="checkbox" name="wcss_social_sharing[post_type][]" value="<?php echo $post_type->name; ?>" id="select-<?php echo $post_type->name; ?>" <?php checked( in_array( $post_type->name, $wcss_options['post_type'] ), true ); ?> />
							<label class="mr10" for="select-<?php echo $post_type->name; ?>">
								<?php echo $post_type->label; ?>
							</label>

							<?php
						}
						?>
					</td>
				</tr>
				<!--End of Sectin to select button for post types and custom post types-->

				<!-- Sectin to select button position to display in front-->
				<tr>
					<th>
						<label for="iconposition">
							<?php _e( 'Icon Position', 'wcss-social-share'); ?>
						</label>
					</th>
					<td>
						<input type="checkbox" name="wcss_social_sharing[icon_position][]" value="after_content" id="select-after_content" <?php checked( in_array( 'after_content', $wcss_options['icon_position'] ), true ); ?> />
						<label class="mr10" for="select-after_content">
							<?php _e( 'After Content', 'wcss-social-share'); ?>
						</label>
						<input type="checkbox" name="wcss_social_sharing[icon_position][]" value="above_content" id="select-above_content" <?php checked( in_array( 'above_content', $wcss_options['icon_position'] ), true ); ?> />
						<label class="mr10" for="select-above_content">
							<?php _e( 'Above Content', 'wcss-social-share'); ?>
						</label>
						<input type="checkbox" name="wcss_social_sharing[icon_position][]" value="float_left" id="select-float_left" <?php checked( in_array( 'float_left', $wcss_options['icon_position'] ), true ); ?> />
						<label class="mr10" for="select-float_left">
							<?php _e( 'Float Left', 'wcss-social-share'); ?>
						</label>
						<input type="checkbox" name="wcss_social_sharing[icon_position][]" value="inside_image" id="select-inside_image" <?php checked( in_array( 'inside_image', $wcss_options['icon_position'] ), true ); ?> />
						<label class="mr10" for="select-inside_image">
							<?php _e( 'Inside Image', 'wcss-social-share'); ?>
						</label>

					</td>
				</tr>
				<!--End of Sectin to select button position to display in front-->

				<!-- Sectin to select button sizes to display in front-->
				<tr>
					<th>
						<label for="buttonsizes">
							<?php _e( 'Button Sizes', 'wcss-social-share' ); ?>
						</label>
					</th>
					<td>
						<input id="small-button" type="radio" name="wcss_social_sharing[button_size]" value="small" <?php checked($wcss_options['button_size'] == 'small'); ?> />
						<label class="mr10" for="small-button">
							<?php _e( 'Small', 'wcss-social-share' ); ?>
						</label>
						<input id="medium-button" type="radio" name="wcss_social_sharing[button_size]" value="medium" <?php checked($wcss_options['button_size'] == 'medium'); ?> />
						<label class="mr10" for="medium-button">
							<?php _e( 'Medium', 'wcss-social-share' ); ?>
						</label>
						<input id="large-button" type="radio" name="wcss_social_sharing[button_size]" value="large" <?php checked($wcss_options['button_size'] == 'large'); ?> />
						<label class="mr10" for="large-button">
							<?php _e( 'Large', 'wcss-social-share' ); ?>
						</label>
					</td>
				</tr>
				<!--End of Sectin to select button sizes to display in front-->

				<!-- Sectin to change the button label to display in front-->
				<tr>
					<th>
						<label for="buttonlabel">
							<?php _e( 'Button Label', 'wcss-social-share' ); ?>
						</label>
					</th>
					<td>
						<input type="text" name="wcss_social_sharing[button_label]" value="<?php echo ( isset( $wcss_options['button_label'] ) && !empty( $wcss_options['button_label'] ) ) ? esc_attr( $wcss_options['button_label'] ) : ''; ?>" id="icon-label" />
					</td>
				</tr>
				<!--End of Sectin to change the button label to display in front-->
			</tbody>
		</table>
		<!-- submit button -->
		<?php submit_button( 'Save Changes', 'primary', 'submit_settings', false ); ?>
	</form>
</div>