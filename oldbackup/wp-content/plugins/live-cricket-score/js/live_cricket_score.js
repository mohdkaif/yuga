jQuery(document).ready(
	function()
	{
		jQuery(".cricket-live-score-div").load(lks_ajaxURL , "temp" , 
	 	
	 		function()
	 		{
				jQuery(".cricket-live-score-div .match_body").slideUp();

				jQuery(".match_head").click(
				    function(e)
				    {
				    	
				        jQuery(this).next().slideToggle();
				    }
				);
			}
		);
	}
);

/*window.setInterval(
	function()
	{
		jQuery(".cricket-live-score-div").load(lks_ajaxURL);
	},15000);
*/