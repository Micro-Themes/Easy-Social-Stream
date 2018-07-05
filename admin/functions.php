<?php 



add_action( 'admin_menu', 'wpsocial_stream_admin_menus' );

function wpsocial_stream_admin_menus(){

	add_menu_page( '', esc_attr__( 'Easy Social Stream', 'easySocialStream' ), '', 'easy-social-stream', 'manage_options', 'dashicons-share', 75 );
	
	add_submenu_page( 'easy-social-stream', esc_attr__( 'Facebook', 'easySocialLogin' ), esc_attr__( 'Facebook', 'easySocialLogin' ), 'manage_options', 'wpsocial_stream_facebook', 'wpsocial_stream_facebook' );
	
	add_submenu_page( 'easy-social-stream', esc_attr__( 'Twitter', 'easySocialLogin' ), esc_attr__( 'Twitter', 'easySocialLogin' ), 'manage_options', 'wpsocial_stream_twitter', 'wpsocial_stream_twitter' );
	
	add_submenu_page( 'easy-social-stream', esc_attr__( 'Google +', 'easySocialLogin' ), esc_attr__( 'Google +', 'easySocialLogin' ), 'manage_options', 'wpsocial_stream_googleplus', 'wpsocial_stream_googleplus' );
	
	add_submenu_page( 'easy-social-stream', esc_attr__( 'Youtube', 'easySocialLogin' ), esc_attr__( 'Youtube', 'easySocialLogin' ), 'manage_options', 'wpsocial_stream_youtube', 'wpsocial_stream_youtube' );
	
	add_submenu_page( 'easy-social-stream', esc_attr__( 'Dribbble', 'easySocialLogin' ), esc_attr__( 'Dribbble', 'easySocialLogin' ), 'manage_options', 'wpsocial_stream_dribble', 'wpsocial_stream_dribble' );
	
	add_submenu_page( 'easy-social-stream', esc_attr__( 'Vimeo', 'easySocialLogin' ), esc_attr__( 'Vimeo', 'easySocialLogin' ), 'manage_options', 'wpsocial_stream_vimeo', 'wpsocial_stream_vimeo' );
	
	add_submenu_page( 'easy-social-stream', esc_attr__( 'Stumbleupon', 'easySocialLogin' ), esc_attr__( 'Stumbleupon', 'easySocialLogin' ), 'manage_options', 'wpsocial_stream_stumbleupon', 'wpsocial_stream_stumbleupon' );
	
	add_submenu_page( 'easy-social-stream', esc_attr__( 'Tumblr', 'easySocialLogin' ), esc_attr__( 'Tumblr', 'easySocialLogin' ), 'manage_options', 'wpsocial_stream_tumblr', 'wpsocial_stream_tumblr' );
	
	add_submenu_page( 'easy-social-stream', esc_attr__( 'Instagram', 'easySocialLogin' ), esc_attr__( 'Instagram', 'easySocialLogin' ), 'manage_options', 'wpsocial_stream_instagram', 'wpsocial_stream_instagram' );
	
	add_submenu_page( 'easy-social-stream', esc_attr__( 'RSS Feed', 'easySocialLogin' ), esc_attr__( 'RSS Feed', 'easySocialLogin' ), 'manage_options', 'wpsocial_stream_rss', 'wpsocial_stream_rss' );
	
	add_submenu_page( 'easy-social-stream', esc_attr__( 'Global Settings', 'easySocialLogin' ), esc_attr__( 'Global Settings', 'easySocialLogin' ), 'manage_options', 'wpsocial_stream_global_settings', 'wpsocial_stream_global_settings' );
	
}




function manage_options_easy_stream() {

	if ( !current_user_can( 'manage_options_easy_stream' ) )  {

		wp_die( esc_attr__( 'You do not have sufficient permissions to access this page.', 'easySocialStream' ) );

	}
		
}

function wpsocial_stream_facebook(){
	include("templates/facebook_credential.php");
}

function wpsocial_stream_twitter(){
	include("templates/twitter_credential.php");
}

function wpsocial_stream_googleplus(){
	include("templates/google_credential.php");
}

function wpsocial_stream_youtube(){
	include("templates/youtube_credential.php");
}

function wpsocial_stream_dribble(){
	include("templates/dribble_credential.php");
}

function wpsocial_stream_vimeo(){
	include("templates/vimeo_credential.php");
}

function wpsocial_stream_stumbleupon(){
	include("templates/stumbleupon_credential.php");
}

function wpsocial_stream_tumblr(){
	include("templates/tumblr_credential.php");
}

function wpsocial_stream_instagram(){
	include("templates/instagram_credential.php");
}

function wpsocial_stream_rss(){
	include("templates/rss_credential.php");
}

function wpsocial_stream_global_settings(){
	include("templates/gloabl_settings.php");
}





?>