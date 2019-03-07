<?php

/*

Plugin Name: Live Cricket Score

Author: Pramod Jodhani

Author URI: http://codeholic.in/

Description: A plugin to show live cricket score.

Licence: GPL2 

Version: 1.1.3

*/




/*  Copyright 2013 Pramod Jodhani  (email : mrpramodjodhani@gmail.com)



    This program is free software; you can redistribute it and/or modify

    it under the terms of the GNU General Public License, version 2, as 

    published by the Free Software Foundation.



    This program is distributed in the hope that it will be useful,

    but WITHOUT ANY WARRANTY; without even the implied warranty of

    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

    GNU General Public License for more details.



    You should have received a copy of the GNU General Public License

    along with this program; if not, write to the Free Software

    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/
add_action("wp_enqueue_scripts" , "lks_add_scrips_styles");

function lks_add_scrips_styles() {




	wp_enqueue_script("live-cricket-score",plugins_url("live-cricket-score/js/live_cricket_score.js"),array("jquery"));


	wp_enqueue_style("live-cricket-score",plugins_url("live-cricket-score/css/live_cricket_score.css"));

	
}

add_action( 'admin_menu', 'lks_admin_menu' );

function lks_admin_menu() {

	wp_enqueue_style("colorPicker",plugins_url("live-cricket-score/css/colorpicker.css"));

	wp_enqueue_script( 'colorpickerjs' , plugins_url("live-cricket-score/js/colorpicker.js") );

}

class cricket_score extends WP_Widget
{



	function cricket_score()

	{

	

		$args=array(

			"classname"=>"cs_widget",

			"description"=>"Widget to show live cricket score."

		);

		parent::WP_Widget("cricket_score","Live Cricket Score",$args);

	}

	

	function widget($args,$instance)

	{

	

		echo "<style>

			#cricket-score-container

			{

				color:".$instance['lks_text_color'].";

				background-color:".$instance['lks_body_color'].";

			}

			#cricket-score-score

			{

				color:".$instance['lks_score_color'].";

			}

			.match_head{

				background-color:".$instance['lks_bg_color'].";

			}

		</style>";	

		extract($args);

		echo $before_widget;

		echo $before_title."Cricket Score".$after_title;

		echo "<div class='cricket-live-score-div'></div>";

		echo $after_widget;

			

	}

	

	function form($instance)

	{

		$default=array("lks_bg_color"=>"#e0e0e0","lks_body_color"=>"#ababab","lks_score_color"=>"#ff0000","lks_text_color"=>"#0e0e14");

		$instance=wp_parse_args((array)$instance,$default);

		
		?>

			<label for="<?php echo $this->get_field_id("lks_bg_color")?>">Background Color:</label><br>

			<input type="text" name="<?php echo $this->get_field_name("lks_bg_color")?>" value="<?php  echo $instance["lks_bg_color"]?>" id="<?php echo $this->get_field_id("lks_bg_color")?>" ></input>

			</label>

			<br>

			<label for="<?php echo $this->get_field_id("lks_body_color")?>">Score Background Color:</label><br>

			<input type="text" name="<?php echo $this->get_field_name("lks_body_color")?>" value="<?php  echo $instance["lks_body_color"]?>" id="<?php echo $this->get_field_id("lks_body_color")?>" ></input>

			</label>

			<br>

			<label for="<?php echo $this->get_field_id("lks_score_color")?>">Score Color:</label><br>

			<input type="text" name="<?php echo $this->get_field_name("lks_score_color")?>" value="<?php  echo $instance["lks_score_color"]?>" id="<?php echo $this->get_field_id("lks_score_color")?>" ></input>

			</label>

			<br>

			<label for="<?php echo $this->get_field_id("lks_text_color")?>">Text Color:</label><br>

			<input type="text" name="<?php echo $this->get_field_name("lks_text_color")?>" value="<?php  echo $instance["lks_text_color"]?>" id="<?php echo $this->get_field_id("lks_text_color")?>" ></input>

			</label>

			<br>

			

		<?php

			echo	" <script>

			myColorPicker('#".$this->get_field_id("lks_bg_color")."');

			myColorPicker('#".$this->get_field_id("lks_body_color")."');

			myColorPicker('#".$this->get_field_id("lks_score_color")."');

			myColorPicker('#".$this->get_field_id("lks_text_color")."');

			

			</script>";


	}

	

	function update($new,$old)

	{

		$instance=$old;

		$instance["lks_bg_color"]=$new["lks_bg_color"];

		$instance["lks_text_color"]=$new["lks_text_color"];

		$instance["lks_body_color"]=$new["lks_body_color"];

		$instance["lks_score_color"]=$new["lks_score_color"];

		return $instance;

	}

	



}





function lks_reg_widget()

{

	register_widget("cricket_score");

}



add_action("widgets_init",'lks_reg_widget');





add_action("wp_head",'lks_add_ajax_url');



function lks_add_ajax_url()

{

	echo "<script> 

		var lks_ajaxURL='".plugins_url("live-cricket-score/fetch-score.php")."';

	</script>";

	

}


