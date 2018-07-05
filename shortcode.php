<?php
add_shortcode('easy_social_stream', 'easy_social_stream' );

function easy_social_stream($atts, $content = null) {
		
	global $wpdb;
	
	extract(shortcode_atts(array(
		"display_filter" => 'yes',
		"display_twitter" => 'yes',
		"display_facebook" => 'yes',
		"display_google" => 'yes',
		"display_youtube" => 'yes',
		"display_dribbble" => 'yes',
		"display_vimeo" => 'yes',
		"display_stumbleupon" => 'yes',
		"display_tumblr" => 'yes',
		"display_instagram" => 'yes',
		"display_rss" => 'yes',
		"post_color_mode" => ''
		), 
	$atts));

	//Check which feeds are enabled
	$wpsocial_stream_facebook_enable = get_option('wpsocial_stream_facebook_enable');
	$wpsocial_stream_twitter_enable = get_option('wpsocial_stream_twitter_enable');	
	$wpsocial_stream_vimeo_enable = get_option('wpsocial_stream_vimeo_enable');
	$wpsocial_stream_stumbleupon_enable = get_option('wpsocial_stream_stumbleupon_enable');
	$wpsocial_stream_tumblr_enable = get_option('wpsocial_stream_tumblr_enable');
	$wpsocial_stream_instagram_enable = get_option('wpsocial_stream_instagram_enable');
	$wpsocial_stream_rss_enable = get_option('wpsocial_stream_rss_enable');
	$wpsocial_stream_dribble_enable = get_option('wpsocial_stream_dribble_enable');	
	$wpsocial_stream_google_enable = get_option('wpsocial_stream_google_enable');
	$wpsocial_stream_youtube_enable = get_option('wpsocial_stream_youtube_enable');			

	//Global settings
	$wpsocial_stream_setting_colormode = get_option('wpsocial_stream_setting_colormode');
	$wpsocial_stream_setting_orderby = get_option('wpsocial_stream_setting_orderby');
	$wpsocial_stream_setting_animation_speed = get_option('wpsocial_stream_setting_animation_speed');
	$wpsocial_stream_setting_window = get_option('wpsocial_stream_setting_window');
	$wpsocial_stream_setting_customcss = get_option('wpsocial_stream_setting_customcss');
	$wpsocial_stream_setting_caching = get_option('wpsocial_stream_setting_caching');
	$wpsocial_stream_setting_filter = get_option('wpsocial_stream_setting_filter');	
	$wpsocial_stream_setting_filter_border_radius = get_option('wpsocial_stream_setting_filter_border_radius');
	$wpsocial_stream_setting_filter_button_bg_color = get_option('wpsocial_stream_setting_filter_button_bg_color');
	$wpsocial_stream_setting_filter_view_all_button_bg_color = get_option('wpsocial_stream_setting_filter_view_all_button_bg_color');
	
	//Custom colors
	$wpsocial_stream_setting_custom_post_bg_color = get_option('wpsocial_stream_setting_custom_post_bg_color');
	$wpsocial_stream_setting_custom_post_panel_color = get_option('wpsocial_stream_setting_custom_post_panel_color');
	$wpsocial_stream_setting_custom_post_panel_font_color = get_option('wpsocial_stream_setting_custom_post_panel_font_color');	
	$wpsocial_stream_setting_custom_post_content_color = get_option('wpsocial_stream_setting_custom_post_content_color');	
	

	//Fixed width options
	$wpsocial_stream_setting_fixedwidth = get_option('wpsocial_stream_setting_fixedwidth');
	$wpsocial_stream_setting_postwidth = get_option('wpsocial_stream_setting_postwidth');
	$wpsocial_stream_setting_post_margin_top = get_option('wpsocial_stream_setting_post_margin_top');
	$wpsocial_stream_setting_post_margin_right = get_option('wpsocial_stream_setting_post_margin_right');
	$wpsocial_stream_setting_post_margin_bottom = get_option('wpsocial_stream_setting_post_margin_bottom');
	$wpsocial_stream_setting_post_margin_left = get_option('wpsocial_stream_setting_post_margin_left');	
	
	$color_mode = "";
	
	if( $post_color_mode !== '' ) {
	
		//evaluate shortcode parameter
		switch($post_color_mode){

			case "Classic":
			$color_mode = "classic";
			break;
	
			case "Dark":
			$color_mode = "dark";
			break;
	
			case "Light":
			$color_mode = "light";
			break;
	
		}
		
	} else {
		
		//evaluate global parameter 
		switch($wpsocial_stream_setting_colormode){

			case "Classic":
			$color_mode = "classic";
			break;
	
			case "Dark":
			$color_mode = "dark";
			break;
	
			case "Light":
			$color_mode = "light";
			break;
	
		}
		
	}
	

	$wpdb->query("truncate table social_stream_posts");

	//getfbStream();
	//gettwStream();

	$page = get_permalink();

	wp_enqueue_style( 'wall', plugins_url( 'css/wall.css', __FILE__ ) );

	$display_data = "";	

	if($wpsocial_stream_setting_filter == 1){
		
		if( $display_filter === 'yes' ) :
		
			$display_data .= "		

			<div class='dcsns-toolbar' style='margin-bottom:20px;'>		
	
				<ul id='dcsns-filter' class='option-set filter dc-center modern ".$color_mode."' style='display:block;'>			
	
					<li>
	
						<a class='selected link-all current' data-filter='*' data-group='dc-filter' href='javascript:void(0)'>
	
							<span class='fa fa-globe'></span>
	
						</a>
	
					</li>			
	
				";				
	
				if($wpsocial_stream_facebook_enable) :
				
					if($display_facebook === 'yes') :
					
						$display_data .= "
	
							<li class='active f-facebook'>
								<a data-filter='.dcsns-facebook' data-group='dc-filter' rel='facebook' href='javascript:void(0)'>
									<span class='fa fa-facebook'></span>
								</a>
							</li>
						";
					
					endif;					
	
				endif;
					
				if($wpsocial_stream_twitter_enable) :
				
					if($display_twitter === 'yes') :
					
						$display_data .= "
	
							<li class='active f-twitter'>	
								<a data-filter='.dcsns-twitter' data-group='dc-filter' rel='twitter' href='javascript:void(0)'>	
									<span class='fa fa-twitter'></span>	
								</a>	
							</li>					
		
						";
					
					endif;
	
				endif;
					
	
				if($wpsocial_stream_google_enable) :
				
					if($display_google === 'yes') :
					
						$display_data .= "
					
							<li class='active f-google'>
								<a data-filter='.dcsns-google' data-group='dc-filter' rel='google' href='javascript:void(0)'>
									<span class='fa fa-google-plus'></span>
								</a>
							</li>
		
						";
					
					endif;					
	
				endif;
	
				if($wpsocial_stream_youtube_enable) :
				
					if($display_youtube === 'yes') :
					
						$display_data .= "
	
							<li class='active f-youtube'>
								<a data-filter='.dcsns-youtube' data-group='dc-filter' rel='youtube' href='javascript:void(0)'>
									<span class='fa fa-youtube'></span>
								</a>
							</li>
		
						";
					
					endif;
	
				endif;
	
				if($wpsocial_stream_vimeo_enable) :
				
					if($display_vimeo === 'yes') :
					
						$display_data .= "
	
							<li class='active f-vimeo'>
								<a data-filter='.dcsns-vimeo' data-group='dc-filter' rel='vimeo' href='javascript:void(0)'>
									<span class='fa fa-vimeo'></span>
								</a>
							</li>	
							
						";
					
					endif;
	
				endif;
	
				if($wpsocial_stream_dribble_enable) :	
				
					if($display_dribbble === 'yes') :
					
						$display_data .= "				
	
							<li class='active f-dribbble'>
								<a data-filter='.dcsns-dribbble' data-group='dc-filter' rel='dribbble' href='javascript:void(0)'>
									<span class='fa fa-dribbble'></span>
								</a>
							</li>				
		
						";	
					
					endif;		
	
				endif;						
	
				if($wpsocial_stream_tumblr_enable) :
				
					if($display_tumblr === 'yes') :
					
						$display_data .= "				
	
							<li class='active f-tumblr'>
								<a data-filter='.dcsns-tumblr' data-group='dc-filter' rel='tumblr' href='javascript:void(0)'>
									<span class='fa fa-tumblr'></span>
								</a>
							</li>				
		
						";	
					
					endif;		
	
				endif;					
	
				if($wpsocial_stream_instagram_enable) :			
	
					if($display_instagram === 'yes') :
					
						$display_data .= "				
	
							<li class='active f-instagram'>
								<a data-filter='.dcsns-instagram' data-group='dc-filter' rel='instagram' href='javascript:void(0)'>
									<span class='fa fa-instagram'></span>
								</a>
							</li>				
		
						";	
					
					endif;
				endif;							
	
				if($wpsocial_stream_stumbleupon_enable) :	
				
					if($display_stumbleupon === 'yes') :
					
						$display_data .= "				
	
							<li class='active f-stumbleupon'>
								<a data-filter='.dcsns-stumbleupon' data-group='dc-filter' rel='stumbleupon' href='javascript:void(0)'>
									<span class='fa fa-stumbleupon'></span>
								</a>
							</li>				
		
						";
					
					endif;			
	
				endif;			
	
				if($wpsocial_stream_rss_enable) :	
				
					if($display_rss === 'yes') :
					
						$display_data .= "				
	
							<li class='active f-rss'>
								<a data-filter='.dcsns-rss' data-group='dc-filter' rel='rss' href='javascript:void(0)'>
									<span class='fa fa-rss'></span>
								</a>
							</li>
							
						";
					
					endif;			
	
				endif;				
	
			$display_data .= "				
	
				</ul>
	
			</div>
	
			";
		
		endif;	

	}


	$display_data .= "<div id='social-stream' class='dcsns modern ".$color_mode."'>

	<div class='dcsns-content'>

		<ul class='stream'>

		</ul>

	</div>

	</div>

	<style>";

	

	if($wpsocial_stream_setting_fixedwidth === 'yes'){		

		$display_data .= ".dcsns-li{
			width:".$wpsocial_stream_setting_postwidth."px !important;
			margin-top:". esc_attr($wpsocial_stream_setting_post_margin_top) ."px !important;
			margin-right:". esc_attr($wpsocial_stream_setting_post_margin_right) ."px !important;
			margin-bottom: ". esc_attr($wpsocial_stream_setting_post_margin_bottom) ."px !important;
			margin-left:". esc_attr($wpsocial_stream_setting_post_margin_left) ."px !important;	
		}";

	}	
	
	
	//Process shortcode parameter first / else proces global parameter
	if( $post_color_mode === 'Classic' || $post_color_mode === 'Light' || $post_color_mode === 'Dark' || $post_color_mode === 'Custom' ) {
		
		if( $post_color_mode === 'Classic' || $post_color_mode === 'Light' || $post_color_mode === 'Dark' ) {
			
			//Load Classic, light and dark color modes - loading here to prevent CSS conflicts
			$display_data .= "		
			
				.stream li.dcsns-rss .section-intro {
					background-color: #FF9800;
				}
				.stream li.dcsns-flickr .section-intro {
					background-color: #f90784
				}
				.stream li.dcsns-delicious .section-intro {
					background-color: #3271CB;
				}
				.stream li.dcsns-twitter .section-intro {
					background-color: #4ec2dc;
				}
				.stream li.dcsns-facebook .section-intro {
					background-color: #3b5998;
				}
				.stream li.dcsns-google .section-intro {
					background-color: #DD5044;
				}
				.stream li.dcsns-youtube .section-intro {
					background-color: #DF1F1C;
				}
				.stream li.dcsns-pinterest .section-intro {
					background-color: #CB2528;
				}
				.stream li.dcsns-lastfm .section-intro {
					background-color: #C90E12;
				}
				.stream li.dcsns-dribbble .section-intro {
					background-color: #F175A8;
				}
				.stream li.dcsns-vimeo .section-intro {
					background-color: #4EBAFF;
				}
				.stream li.dcsns-stumbleupon .section-intro {
					background-color: #EB4924;
				}
				.stream li.dcsns-deviantart .section-intro {
					background-color: #EB4924;
				}
				.stream li.dcsns-tumblr .section-intro {
					background-color: #365472;
				}
				.stream li.dcsns-instagram .section-intro {
					background-color:#8D47C1;
				}
				.stream li.dcsns-vine .section-intro {
					background-color: #00BF8F;
				}
			
			";
			
		} elseif($post_color_mode === 'Custom') {
			
			$display_data .= "
			
				.stream li{
					background-color:". esc_attr($wpsocial_stream_setting_custom_post_bg_color) ." !important;
				}
				.stream li .section-intro {
					background-color:". esc_attr($wpsocial_stream_setting_custom_post_panel_color) ." !important;	
				}
				
				.stream li .section-intro a.link-user, .stream li .section-intro span {
					color:". esc_attr($wpsocial_stream_setting_custom_post_panel_font_color) ." !important;
				}
				
				.stream li .section-text, .stream li .section-title, .stream li .section-title p, .stream li .section-title p a, .stream li .section-title a {
					color:". esc_attr($wpsocial_stream_setting_custom_post_content_color) ." !important;					
				}
			
			";
			
		}
		
	} elseif( $wpsocial_stream_setting_colormode === 'Custom' ) { //process global setting
		
		$display_data .= "
		
			.stream li{
				background-color:". esc_attr($wpsocial_stream_setting_custom_post_bg_color) ." !important;
			}
			.stream li .section-intro {
				background-color:". esc_attr($wpsocial_stream_setting_custom_post_panel_color) ." !important;	
			}
			
			.stream li .section-intro a.link-user, .stream li .section-intro span {
				color:". esc_attr($wpsocial_stream_setting_custom_post_panel_font_color) ." !important;
			}
			
			.stream li .section-text, .stream li .section-title, .stream li .section-title p, .stream li .section-title p a, .stream li .section-title a {
				color:". esc_attr($wpsocial_stream_setting_custom_post_content_color) ." !important;					
			}
		
		";
		
	} else {
	
		//Load Classic, light and dark color modes - loading here to prevent CSS conflicts
		$display_data .= "		
		
			.stream li.dcsns-rss .section-intro {
				background-color: #FF9800;
			}
			.stream li.dcsns-flickr .section-intro {
				background-color: #f90784
			}
			.stream li.dcsns-delicious .section-intro {
				background-color: #3271CB;
			}
			.stream li.dcsns-twitter .section-intro {
				background-color: #4ec2dc;
			}
			.stream li.dcsns-facebook .section-intro {
				background-color: #3b5998;
			}
			.stream li.dcsns-google .section-intro {
				background-color: #DD5044;
			}
			.stream li.dcsns-youtube .section-intro {
				background-color: #DF1F1C;
			}
			.stream li.dcsns-pinterest .section-intro {
				background-color: #CB2528;
			}
			.stream li.dcsns-lastfm .section-intro {
				background-color: #C90E12;
			}
			.stream li.dcsns-dribbble .section-intro {
				background-color: #F175A8;
			}
			.stream li.dcsns-vimeo .section-intro {
				background-color: #4EBAFF;
			}
			.stream li.dcsns-stumbleupon .section-intro {
				background-color: #EB4924;
			}
			.stream li.dcsns-deviantart .section-intro {
				background-color: #EB4924;
			}
			.stream li.dcsns-tumblr .section-intro {
				background-color: #365472;
			}
			.stream li.dcsns-instagram .section-intro {
				background-color:#8D47C1;
			}
			.stream li.dcsns-vine .section-intro {
				background-color: #00BF8F;
			}
		
		";
		
	}
	
	if( $wpsocial_stream_setting_filter == 1 ){
	
		$display_data .= "
			.dcsns-toolbar .filter li a {
				border-radius:". esc_attr($wpsocial_stream_setting_filter_border_radius) ."px !important;
				background-color:". esc_attr($wpsocial_stream_setting_filter_button_bg_color) ." !important;	
			}
			
			.option-set > li:first-child > a:hover {
				background-color:". esc_attr($wpsocial_stream_setting_filter_view_all_button_bg_color) ." !important;					
			}
			.option-set > li:first-child > a.current {
				background-color:". esc_attr($wpsocial_stream_setting_filter_view_all_button_bg_color) ." !important;					
			}
		";
		
	}
	
	if($wpsocial_stream_setting_customcss!=''){
		$display_data .= $wpsocial_stream_setting_customcss;
	}	

	$post_rand = "";
	
	if($wpsocial_stream_setting_orderby=='Random'){
		$post_rand = "{ sortBy : 'random' }";
	}	

	$display_data .= "	

	</style>	

	<script>	

	";		

	$display_data .= "	

	function getTwStream(){
		
		
		
		jQuery.ajax({
		type : 'post',
		url : '".admin_url( 'admin-ajax.php' )."',
		data : 'action=gettwStream&page=".$page."',

		success : function( response ) {
						
			jQuery('.stream').append(response);
			jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
			
			jQuery('.stream img').each(function() {	
				jQuery(this).on('load', function() {
				  jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
				});	
			});

		  }  

		});

	}

	function getFbStream(){
		jQuery.ajax({
		type : 'post',
		url : '".admin_url( 'admin-ajax.php' )."',
		data : 'action=getfbStream&page=".$page."',

		success : function( response ) {
			
			jQuery('.stream').append(response);
			jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
			
			jQuery('.stream img').each(function() {
				jQuery(this).on('load', function() {
				  jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
				});
			});

		  }  

		});

	}

	function getGoogleStream(){

		jQuery.ajax({
		type : 'post',
		url : '".admin_url( 'admin-ajax.php' )."',
		data : 'action=getGoogleStream&page=".$page."',

		success : function( response ) {

			jQuery('.stream').append(response);
			jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
			
			jQuery('.stream img').each(function() {
				jQuery(this).on('load', function() {
				  jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
				});	
			});

		  }  

		});

	}

	function getYoutubeStream(){

		jQuery.ajax({
		type : 'post',
		url : '".admin_url( 'admin-ajax.php' )."',
		data : 'action=getYoutubeStream&page=".$page."',

		success : function( response ) {

			jQuery('.stream').append(response);
			jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");

			jQuery('.stream img').each(function() {
				jQuery(this).on('load', function() {
				  jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
				});
			});

		  }  

		});

	}

	function getVimeoStream(){

		jQuery.ajax({
		type : 'post',
		url : '".admin_url( 'admin-ajax.php' )."',
		data : 'action=getVimeoStream&page=".$page."',

		success : function( response ) {

			jQuery('.stream').append(response);
			jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
			
			jQuery('.stream img').each(function() {
				jQuery(this).on('load', function() {
				  jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
				});

			});

		  }  

		});

	}

	function getDribbleStream(){

		jQuery.ajax({
		type : 'post',
		url : '".admin_url( 'admin-ajax.php' )."',
		data : 'action=getDribbleStream&page=".$page."',

		success : function( response ) {

			jQuery('.stream').append(response);
			jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");

			jQuery('.stream img').each(function() {
				jQuery(this).on('load', function() {
				  jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
				});
			});

		  }  

		});

	}

	function getStumbleuponStream(){

		jQuery.ajax({
		type : 'post',
		url : '".admin_url( 'admin-ajax.php' )."',
		data : 'action=getStumbleuponStream&page=".$page."',

		success : function( response ) {

			jQuery('.stream').append(response);
			jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");

			jQuery('.stream img').each(function() {
				jQuery(this).on('load', function() {
				  jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
				});
			});

		  }  

		});

	}

	function getTumblrStream(){

		jQuery.ajax({
		type : 'post',
		url : '".admin_url( 'admin-ajax.php' )."',
		data : 'action=getTumblrStream&page=".$page."',

		success : function( response ) {

			jQuery('.stream').append(response);
			jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");

			jQuery('.stream img').each(function() {	
				jQuery(this).on('load', function() {
				  jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
				});
			});

		  }  

		});

	}

	function getInstagramStream(){

		jQuery.ajax({
		type : 'post',
		url : '".admin_url( 'admin-ajax.php' )."',
		data : 'action=getInstagramStream&page=".$page."',

		success : function( response ) {

			jQuery('.stream').append(response);
			jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");

			jQuery('.stream img').each(function() {
				jQuery(this).on('load', function() {
				  jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
				});
			});

		  }  

		});

	}	

	function getRssStream(){

		jQuery.ajax({
		type : 'post',
		url : '".admin_url( 'admin-ajax.php' )."',
		data : 'action=getRssStream&page=".$page."',

		success : function( response ) {

			jQuery('.stream').append(response);
			jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");

			jQuery('.stream img').each(function() {
				jQuery(this).on('load', function() {
				  jQuery('.stream').isotope( 'reloadItems' ).isotope(".$post_rand.");
				});
			});

		  }  

		});

	} 

	jQuery(document).ready(function(){		

	jQuery('.dcsns-toolbar a').click(function(){ 		

		jQuery('.dcsns-toolbar .current').removeClass('current');

		jQuery(this).addClass('current'); 

		var selector = jQuery(this).attr('data-filter');

		jQuery('.stream').isotope({

			filter: selector,
			transitionDuration: '". ($wpsocial_stream_setting_animation_speed !== '' ? $wpsocial_stream_setting_animation_speed : '0.8') ."s',
			animationOptions: {
				duration: 750,
				easing: 'swing',
				queue: false
			}

		 });

		 return false;

	}); 

	

	jQuery('.stream').isotope({

	  filter: '*',
	  transitionDuration: '". ($wpsocial_stream_setting_animation_speed !== '' ? $wpsocial_stream_setting_animation_speed : '0.8') ."s',
		animationOptions: {
			duration: 750,
			easing: 'swing',
			queue: false
		}

	});

	";	

	if( $wpsocial_stream_facebook_enable ) {
		
		if($display_facebook === 'yes') :
				
			$display_data .= "
				getFbStream();	
			";		
				
		endif;				

	}	

	if( $wpsocial_stream_twitter_enable ) {		
	
		if($display_twitter === 'yes') :
				
			$display_data .= "
				getTwStream();
			";		
				
		endif;

	}	

	if( $wpsocial_stream_google_enable ) {
		
		if($display_google === 'yes') :	
			
			$display_data .= "
				getGoogleStream();	
			";	
					
		endif;	

	}	

	if( $wpsocial_stream_youtube_enable ) {	
	
		if($display_youtube === 'yes') :
				
			$display_data .= "
				getYoutubeStream();	
			";		
				
		endif;	

	}	

	if( $wpsocial_stream_vimeo_enable ) {	
	
		if($display_vimeo === 'yes') :
		
			$display_data .= "	
				getVimeoStream();	
			";	
		
		endif;				

	}	

	if( $wpsocial_stream_dribble_enable ) {	
	
		if($display_dribbble === 'yes') :
		
			$display_data .= "
				getDribbleStream();	
			";	
		
		endif;				

	}	

	if( $wpsocial_stream_stumbleupon_enable ) {		
	
		if($display_stumbleupon === 'yes') :
		
			$display_data .= "
				getStumbleuponStream();
			";	
		
		endif;

	}	

	if( $wpsocial_stream_tumblr_enable ) {	
	
		if($display_tumblr === 'yes') :
		
			$display_data .= "
				getTumblrStream();
			";	
		
		endif;	

	}	

	if( $wpsocial_stream_instagram_enable ) {	
	
		if($display_instagram === 'yes') :
		
			$display_data .= "
				getInstagramStream();	
			";
		
		endif;					

	}	

	if( $wpsocial_stream_rss_enable ) {	
	
		if($display_rss === 'yes') :
		
			$display_data .= "
				getRssStream();	
			";	
		
		endif;				

	}

	$display_data .= "	

		});

		</script>

	";

	return $display_data;
	

}

?>