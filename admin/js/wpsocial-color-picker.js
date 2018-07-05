// JavaScript Document

(function($) {
	
	'use strict'

	$(document).ready(function(e) {
		
		//active colorpicker modules
		if( $('.wpsocial-color-field').length > 0 ){
			$('.wpsocial-color-field').wpColorPicker();
		}
		
		
		//Color mode settings
		if( $('#wpsocial_stream_setting_colormode').length > 0 ){
			
			$('#wpsocial_stream_setting_colormode').change(function(e) {
				
				var $this = $(this),
				selection = $this.val();
				
				if(selection === 'Custom' && !$this.hasClass('active')) {
				
					$this.addClass('active');
				
					//display color pickers
					$('#wpsocial-stream-setting-post-custom-colors').toggle();
					
				} else {
				
					if($this.hasClass('active')) {
						
						$this.removeClass('active');
						
						//check if page load active state is applied - if so remove it
						if( $('#wpsocial-stream-setting-post-custom-colors').hasClass('active') ){
							$('#wpsocial-stream-setting-post-custom-colors').removeClass('active')
						}
						
						//hide color pickers
						$('#wpsocial-stream-setting-post-custom-colors').toggle();
						
					} else {
					
						//check if page load active state is applied - if so remove it
						if( $('#wpsocial-stream-setting-post-custom-colors').hasClass('active') ){
							$('#wpsocial-stream-setting-post-custom-colors').removeClass('active')
						}
						
					}
					
				}
				
			});
			
			
		}//end if
		
		
		//Filter options
		if( $('#wpsocial-stream-setting-filter-options').length > 0 ){
			
			$('#wpsocial_stream_setting_filter').change(function(e) {
				
				var $this = $(this),
				selection = $this.val();
				
				if(selection === '1' && !$this.hasClass('active')) {
				
					$this.addClass('active');
				
					//display options
					$('#wpsocial-stream-setting-filter-options').toggle();
					
				} else {
				
					if($this.hasClass('active')) {
						
						$this.removeClass('active');
						
						//check if page load active state is applied - if so remove it
						if( $('#wpsocial-stream-setting-filter-options').hasClass('active') ){
							$('#wpsocial-stream-setting-filter-options').removeClass('active')
						}
						
						//hide options
						$('#wpsocial-stream-setting-filter-options').toggle();
						
					} else {
					
						//check if page load active state is applied - if so remove it
						if( $('#wpsocial-stream-setting-filter-options').hasClass('active') ){
							$('#wpsocial-stream-setting-filter-options').removeClass('active')
						}
						
					}
					
				}
				
			});
			
			
		}//end if
		
		
	});

})(jQuery);