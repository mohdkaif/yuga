(function( $ ) {

	var $body = $('body'),
		$colorInput = $('input.color-field'),
		$orderIcon = $('#wcss-order-icon');

	//Initialize color picker for buttons
	$colorInput.wpColorPicker();

	//Initialize section dropdown
	jQuery('a.icon-button').on( 'click', function(e) {
		e.preventDefault();
		var data_id = jQuery(this).data('show');
		jQuery('.slide-section').addClass('closed');
		jQuery('#'+data_id).toggleClass('closed');
	});

	//Iortable icon order
	$orderIcon.sortable({
		stop:function(event,ui){
			var new_order='';
			jQuery('#wcss-order-icon > a').each(function(e,v){
				new_order += jQuery(v).attr('id')+',';
			});
			new_order = new_order.slice(0,new_order.length-1);

			jQuery('input#wcss-button-order-field').val(new_order);

		}
	});

})( jQuery );