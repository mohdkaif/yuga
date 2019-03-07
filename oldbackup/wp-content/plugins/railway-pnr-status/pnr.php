<?php
/*
Plugin Name: PNR Status Plugin
Description: Add PNR Status Code Plugin in your website
Author: Rohit Kumar Agrahari
Version: 1.0
Author URI: http://www.rohitkumaragrahari.in
*/
/* Start Adding Functions Below this Line */
// Creating the widget 
class wpb_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'wpb_widget', 

// Widget name will appear in UI
__('Railway PNR Status', 'wpb_widget_domain'), 

// Widget description
array( 'description' => __( 'Add Railway PNR Status Script at your website', 'wpb_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
echo __( '<div align="center"><table bgcolor="#ffffff" cellpadding="10" cellspacing="10" bordercolor="#0A2229" width="250" height="100%" border="0">
<tr><td valign="top">
<form role="form" action="http://www.pnrstatusinfo.in/status.php" target="_blank" id="myform" method="post" name="pnrform">

<p style="text-align: center;"><span style="font-family:georgia,serif; font-size:22px"><strong>PNR Status Onlne</strong></span>
<br><br>
<span style="font-family:georgia,serif; font-size:18px"><strong>Enter 10 Digit PNR Number</strong></span></p>

<p style="text-align: center;"><input style="width:200px; height:30px; font-size:18px;" maxlength="10" name="pnrno" size="25" type="tel" /></p>

<p style="text-align: center;"><input style="width:150px; height:30px; font-family:georgia,serif;" name="submitpnr" type="submit" value="Check PNR Status" /></p>
<p style="text-align: center;"><span style="font-family:georgia,serif; font-size:10px"><strong><a href="http://www.pnrstatusinfo.in" target="_blank">PNR Status Info</a></strong></span></p>
</form>
</td></tr>
</table>
</div>', 'wpb_widget_domain' );
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'wpb_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

/* Stop Adding Functions Below this Line */
?>