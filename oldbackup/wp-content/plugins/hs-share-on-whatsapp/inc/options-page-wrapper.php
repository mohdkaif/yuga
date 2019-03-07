<?php 
    if ( ! defined( 'ABSPATH' ) ) {
        echo "Hi there! Nice try. Come again.";
        die();
    }
    $singlepage; $postpage; $custompage; $woocommercepage;    
?>
<div class="wrap">

    <div id="icon-options-general" class="icon32"></div>
    <h2>HS Whatsapp Share Setting</h2>

    <div id="poststuff">

        <div id="post-body" class="metabox-holder columns-2">

            <!-- main content -->
            <div id="post-body-content">

                <div class="meta-box-sortables ui-sortable">

                        <div class="postbox">
                            <h3><span>Whatsapp Share Details</span></h3>
                            <div class="inside">

                                <form name="hswhatsapp_form" method="post" action="">

                                    <input type="hidden" name="hswhatsapp_form_submitted" value="Y">

                                    <table class="form-table" cellpadding="5" cellspacing="5">
										<tr>
                                            <td>
                                                <label for="hswhatsappwhere_text"><strong>Display Settings (Show At) </strong></label>
                                            </td>
                                        </tr>
										<tr>
                                            <td>
                                                <label for="hswhatsappwhere_text">On Page</label>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="singlepage" value="yes" <?php if($singlepage == '1') { ?> checked="checked" <?php } ?> >
											</td>
                                        </tr>
										<tr>
                                            <td>
                                                <label for="hswhatsappwhere_text">On Post</label>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="postpage" value="yes" <?php if($postpage == '1') { ?> checked="checked" <?php } ?>>
											</td>
                                        </tr>
										<tr>
                                            <td>
                                                <label for="hswhatsappwhere_text">Custom Post Type</label>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="custompage" value="yes" <?php if($custompage == '1') { ?> checked="checked" <?php } ?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color:red">
                                                <label for="hswhatsappwhere_text">WooCommerce Product Page</label>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="woocommercepage" value="yes" <?php if($woocommercepage == '1') { ?> checked="checked" <?php } ?> disabled>
                                                <span>Available in <a target="_blank" href="http://www.heliossolutions.in/product/hs-whatsapp-share-pro/">PRO Version!</a></span>
                                            </td>
                                        </tr>
										<tr>
                                            <td>
                                                <input type ="submit" name="submit" class="button button-primary" value="Save!">
                                            </td>
                                        </tr>
                                    </table>
                                </form>

                            </div> <!-- .inside -->

                        </div> <!-- .postbox -->
                </div> <!-- .meta-box-sortables .ui-sortable -->

            </div> <!-- post-body-content -->

            <!-- sidebar -->
            <div id="postbox-container-1" class="postbox-container">

                <div class="meta-box-sortables">

                    <div class="postbox">

                        <h3><span>About Company</span></h3>
                        <div class="inside">
                            <a target="_blank" href="http://www.heliossolutions.in/product/hs-whatsapp-share-pro/"><img src="<?php echo plugins_url( 'images/cmp_logo.png', __FILE__ ) ?>"></a>
                            <p >Helios Solution is an Indian IT outsourcing company who works on many IT technologies such as wordpress, magento, joomla, drupal, opencart, cakephp, .NET etc </p>
                        </div> <!-- .inside -->

                    </div> <!-- .postbox -->

                    <div class="postbox">

                        <h3><span>Pro Version! (WooCommerce Compatible)</span></h3>
                        <div class="inside">
                            <a target="_blank" href="http://www.heliossolutions.in/product/hs-whatsapp-share-pro/"><img src="<?php echo plugins_url( 'images/pro_screenshot.png', __FILE__ ) ?>"></a>
                            <p>Promote Products on WhatsApp: By installing Product Share on WhatsApp on your webstore and sharing the products and promotion links through it.
                            <a target="_blank" href="http://www.heliossolutions.in/product/hs-whatsapp-share-pro/">Grab it Now!</a></p>
                        </div> <!-- .inside -->

                    </div> <!-- .postbox -->

                </div> <!-- .meta-box-sortables -->

            </div> <!-- #postbox-container-1 .postbox-container -->

        </div> <!-- #post-body .metabox-holder .columns-2 -->

        <br class="clear">
    </div> <!-- #poststuff -->

</div> <!-- .wrap -->