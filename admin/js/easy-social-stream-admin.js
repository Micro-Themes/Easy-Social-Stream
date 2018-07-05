// JavaScript Document

(function($) {
	
	'use strict'

	$(document).ready(function(e) {
		
		//Toggle Fixed Width fields
		if( $('#wpsocial_stream_setting_fixedwidth').length > 0 ){
			
			$('#wpsocial_stream_setting_fixedwidth').change(function(e) {
                
				var $this = $(this),
				selection = $this.val();
				
				if(selection === 'yes') {
				
					$('#wp-social-stream-width-settings').addClass('active');
					
				} else {
					
					$('#wp-social-stream-width-settings').removeClass('active');
					
				}
				
            });
			
		}//end if
		
		//Shortcode options list
		if( $('#wpsocial-shortcode-options').length > 0 ){
			
			$('#wpsocial-shortcode-options').on('click', function(e) {
				
				var $this = $(this);
				
				if( !$this.hasClass('active') ) {
					
					$this.addClass('active');
					$this.html('Hide Shortcode Options');
					
					$('#wpsocial-shortcode-options-container').toggle(400);
					
				} else {
				
					$this.removeClass('active');
					$this.html('View Shortcode Options');
					
					$('#wpsocial-shortcode-options-container').toggle(400);
					
				}
				
			});
			
		}//end if
		
		
		//Color mode settings
		/*if( $('#wpsocial_stream_setting_colormode').length > 0 ){
			
			$('#wpsocial_stream_setting_colormode').change(function(e) {
				
				var $this = $(this),
				selection = $this.val();
				
				if(selection === 'Custom') {
				
					//display color pickers
					
					
				} 
				
			});
			
			//active colorpicker
		    $('.wpsocial-color-field').wpColorPicker();
			
		}//end if*/
		
		
		
	});

})(jQuery);