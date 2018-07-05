<?php 

/*

Plugin Name: Easy Social Stream
Plugin URI: https://www.microthemes.ca/micro-products/easy-social-stream/
Description: This plugin adds social stream capabilities to your website with many social sites
Version: 1.0.2
Author: Micro Themes
Author URI: https://www.microthemes.ca
License: 

*/

?><?php

//Define global constants
if ( ! defined( 'MT_WP_URL' ) ) {
	define( 'MT_WP_URL', plugin_dir_url(__FILE__) );	
}

if ( ! defined( 'MT_WP_PATH' ) ) {
	define( 'MT_WP_PATH', plugin_dir_path(__FILE__) );
}

if ( ! defined( 'MT_WP_ADMIN_URL' ) ) {
  define( 'MT_WP_ADMIN_URL', MT_WP_URL . 'admin');
}

if ( ! defined( 'MT_WP_FRONT_URL' ) ) {
  define( 'MT_WP_FRONT_URL', MT_WP_URL . 'front-end' );
}

if ( ! defined( 'MT_WP_CSS_URL' ) ) {
  define( 'MT_WP_CSS_URL', MT_WP_URL . 'css' );
}

if ( ! defined( 'MT_WP_DOCS_URL' ) ) {
  define( 'MT_WP_DOCS_URL', MT_WP_URL . 'documentation');
}

if ( ! defined( 'MT_WP_DEBUG' ) ) {
  define( 'MT_WP_DEBUG', false );
}

if ( !class_exists( 'EasySocialStream' ) ) {
	
	class EasySocialStream {
		
		//Constructor
		public function __construct() {
			
			session_start();
			
			register_activation_hook(__FILE__, array( $this, 'wpsocial_stream_plugin_install' ) );
				
			//Add actions
			add_action( 'init', array( $this, 'wpsocial_stream_load_languages' ) );			
			
			//Back-end
			add_action( 'admin_enqueue_scripts', array( $this, 'wpsocial_stream_load_admin_scripts' ) ); 
			
			//Front-end
			add_action( 'wp_enqueue_scripts', array( $this, 'wpsocial_streams_load_front_scripts' ) );
			
			//Ajax
			add_action( 'wp_ajax_getfbStream', array( $this, 'getfbStream' ) );
			add_action( 'wp_ajax_nopriv_getfbStream', array( $this, 'getfbStream' ) );
			
			add_action( 'wp_ajax_gettwStream', array( $this, 'gettwStream' ) );
			add_action( 'wp_ajax_nopriv_gettwStream', array( $this, 'gettwStream' ) );
			
			add_action( 'wp_ajax_getGoogleStream', array( $this, 'getGoogleStream' ) );
			add_action( 'wp_ajax_nopriv_getGoogleStream', array( $this, 'getGoogleStream' ) );
			
			add_action( 'wp_ajax_getYoutubeStream', array( $this, 'getYoutubeStream' ) );
			add_action( 'wp_ajax_nopriv_getYoutubeStream', array( $this, 'getYoutubeStream' ) );
			
			add_action( 'wp_ajax_getVimeoStream', array( $this, 'getVimeoStream' ) );
			add_action( 'wp_ajax_nopriv_getVimeoStream', array( $this, 'getVimeoStream' ) );
			
			add_action( 'wp_ajax_getDribbleStream', array( $this, 'getDribbleStream' ) );
			add_action( 'wp_ajax_nopriv_getDribbleStream', array( $this, 'getDribbleStream' ) );
			
			add_action( 'wp_ajax_getStumbleuponStream', array( $this, 'getStumbleuponStream' ) );
			add_action( 'wp_ajax_nopriv_getStumbleuponStream', array( $this, 'getStumbleuponStream' ) );
			
			add_action( 'wp_ajax_getTumblrStream', array( $this, 'getTumblrStream' ) );
			add_action( 'wp_ajax_nopriv_getTumblrStream', array( $this, 'getTumblrStream' ) );
			
			add_action( 'wp_ajax_getInstagramStream', array( $this, 'getInstagramStream' ) );
			add_action( 'wp_ajax_nopriv_getInstagramStream', array( $this, 'getInstagramStream' ) );
			
			add_action( 'wp_ajax_getRssStream', array( $this, 'getRssStream' ) );
			add_action( 'wp_ajax_nopriv_getRssStream', array( $this, 'getRssStream' ) );
			
			//add widget text shortcode support
			add_filter( 'widget_text', 'do_shortcode' );
			add_filter( 'the_content', 'do_shortcode' );
						
		}//constructor end	
		
		public function wpsocial_stream_load_languages() { 
			load_plugin_textdomain( 'easySocialStream', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
		}
		
		public function wpsocial_streams_load_front_scripts() {				
		
			//load styles and scripts
			wp_enqueue_style( 'font-awesome', MT_WP_CSS_URL . '/font-awesome.min.css' );	
			wp_enqueue_script( 'isotope-js', MT_WP_FRONT_URL . '/js/isotope.pkgd.min.js', array('jquery'), '1.0', true );	
		
		}//end of load_front_scripts
		
		public function wpsocial_stream_load_admin_scripts() {				
		
			//only load if administrator is logged in
			if ( is_admin() ) { 
		
				//WP color picker
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'wpsocial-color-picker', MT_WP_ADMIN_URL . '/js/wpsocial-color-picker.js', array( 'wp-color-picker' ), false, true );
		
				//load styles and scripts
				wp_enqueue_style( 'easy-social-stream-admin-css', MT_WP_ADMIN_URL . '/css/easy-social-stream-admin.css' );
				wp_enqueue_script( 'easy-social-stream-js', MT_WP_ADMIN_URL . '/js/easy-social-stream-admin.js', array('jquery'), '1.0', true );
		
			}
		
		}//end of load_admin_scripts
	
		
		public function timeAgo($timedate){
		
				$datetime1=new DateTime("now");		
				$datetime2=date_create($timedate);		
				$diff=date_diff($datetime1, $datetime2);		
				$timemsg='';		
				
				if($diff->y > 0){		
					$timemsg = $diff->y .' year'. ($diff->y > 1?"'s":'').' ago';
				} else if($diff->m > 0){		
				 $timemsg = $diff->m . ' month'. ($diff->m > 1?"'s":'').' ago';		
				} else if($diff->d > 0){		
				 $timemsg = $diff->d .' day'. ($diff->d > 1?"'s":'').' ago';		
				}
		
				else if($diff->h > 0){		
				 $timemsg = 'Today';		
				}
		
				else if($diff->i > 0){		
				 $timemsg = 'Today';		
				}
		
				else if($diff->s > 0){		
				 $timemsg = 'Today';		
				}
		
			$timemsg = $timemsg;		
			return $timemsg;
		
			}
		
		
		
		public function getfbStream(){
		
			global $wpdb;
		
			$wpsocial_stream_setting_caching = get_option('wpsocial_stream_setting_caching');
		
			if(isset($_SESSION['fb_posts']) && isset($_SESSION['fb_posts_created']) && time()<=strtotime('+30 minutes',$_SESSION['fb_posts_created']) && $wpsocial_stream_setting_caching==1)
		
			{
		
				$dataShow = $_SESSION['fb_posts'];
		
			}else{
		
			
		
			$wpsocial_stream_facebook_pageid = get_option('wpsocial_stream_facebook_pageid');
		
			$wpsocial_stream_facebook_appid = get_option('wpsocial_stream_facebook_appid');
		
			$wpsocial_stream_facebook_appsecret = get_option('wpsocial_stream_facebook_appsecret');
		
			$wpsocial_stream_facebook_post_limit = get_option('wpsocial_stream_facebook_post_limit');
		
			$wpsocial_stream_facebook_display_message = get_option('wpsocial_stream_facebook_display_message');
		
			$wpsocial_stream_facebook_display_link = get_option('wpsocial_stream_facebook_display_link');
		
			$wpsocial_stream_facebook_display_image = get_option('wpsocial_stream_facebook_display_image');
		
			$wpsocial_stream_facebook_display_time = get_option('wpsocial_stream_facebook_display_time');
		
			
		
			$wpsocial_stream_setting_window = get_option('wpsocial_stream_setting_window');
		
			
		
			$target_window = "";
		
			
		
			if($wpsocial_stream_setting_window=='new'){
		
				$target_window = 'target="_blank"';
		
			}
		
		
		
		
		
			$access_token = "https://graph.facebook.com/oauth/access_token?client_id=$wpsocial_stream_facebook_appid&client_secret=$wpsocial_stream_facebook_appsecret&grant_type=client_credentials";
		
			$access_token = file_get_contents($access_token); 
                        
      $token_data = json_decode($access_token, true);
                        
			$access_token = $token_data['access_token'];
                        		
			$limit = 5;
		
			$data  = file_get_contents("https://graph.facebook.com/$wpsocial_stream_facebook_pageid/posts?limit=$wpsocial_stream_facebook_post_limit&access_token=$access_token&fields=message,picture,created_time,id,link");
		
			$data = json_decode($data, true);					
		
			$page_info = file_get_contents("https://graph.facebook.com/v2.3/$wpsocial_stream_facebook_pageid?key=value&access_token=$access_token&fields=id,link,name");			
		
			$page_info = json_decode($page_info, true);
		
			$page_link = $page_info['link'];
		
			$page_name = $page_info['name'];
		
			$dataShow = "";
		
			foreach($data['data'] as $item){			
		
				if(isset($item['picture'])){
		
					$picPart = explode("&url=",$item['picture']);
		
					$picPart1 = explode("&cfs=",$picPart[1]);
		
					$pic = urldecode($picPart1[0]);
		
				}else{
		
					$pic = "";
		
				}
		
				
		
				$time = date('Y-m-d H:m:s',strtotime($item['created_time']));
		
				$wpdb->query("insert into social_stream_posts (title,media_url,post_url,description,created_time,link,author,other_detail,stream_type) values ('','".esc_sql($pic)."','".esc_sql($item['link'])."','".esc_sql($item['message'])."','".esc_sql($time)."','".esc_sql($page_link)."','".esc_sql($page_name)."','','fb')");
		
			}
		
				$fb_items = $wpdb->get_results("select * from social_stream_posts where stream_type='fb' order by created_time desc",ARRAY_A);
		
				
		
				foreach($fb_items as $fb_item){
		
					$dataShow .='<li class="dcsns-li isotope-item dcsns-facebook dcsns-feed-0">
		
							<div class="inner">
		
								';
		
								if(isset($fb_item['media_url']) && $wpsocial_stream_facebook_display_image == 1){
		
									$dataShow .='<span class="section-thumb"><a href="'.$fb_item['post_link'].'" '.$target_window.'>
		
										<img alt="" src="'.$fb_item['media_url'].'" style="opacity: 1; display: inline;">
		
									</a>';
									
									$dataShow .='</span> ';
		
								}
								
		
								if($wpsocial_stream_facebook_display_message==1){
		
									$dataShow .= '<span class="section-text">'.$fb_item['description'].'</span>';
		
								}
								
		
								if($wpsocial_stream_facebook_display_link==1){
									$dataShow .=' <span class="section-share">';
									$dataShow .='<a class="share-facebook" '.$target_window.' href="http://www.facebook.com/sharer.php?u='.urlencode($_POST['page']).'&t='.urlencode($fb_item['description']).'"></a>
		
									<a class="share-twitter" '.$target_window.' href="https://twitter.com/share?url='.urlencode($_POST['page']).'&text='.urlencode($fb_item['description']).'"></a>
		
									<a class="share-google" '.$target_window.' href="https://plus.google.com/share?url='.urlencode($_POST['page']).'"></a>
		
									<a class="share-linkedin" '.$target_window.' href="http://www.linkedin.com/shareArticle?mini=true&url='.urlencode($_POST['page']).'&title='.urlencode($fb_item['description']).'"></a> </span>';
		
									
		
									}
		
								$dataShow .='
		
								<span class="clear"></span>
		
							</div>
		
							<span class="section-intro">
		
								<a class="link-user" href="'.$fb_item['link'].'" '.$target_window.'>'.$fb_item['author'].'</a>	
		
								';								
		
								if($wpsocial_stream_facebook_display_time==1){		
									$dataShow .= '<span>'.$this->timeAgo($fb_item['created_time']).'</span>';		
								}		
		
								$dataShow .='
		
							</span>
		
							<a href="'.$fb_item['link'].'" '.$target_window.'>
		
								<span class="socicon socicon-facebook"></span>
		
							</a>
		
						</li>';
		
					}
		
				
		
				$_SESSION['fb_posts'] = $dataShow;
		
				$_SESSION['fb_posts_created'] = time();
		
			}
		
			die($dataShow);
		
		}
		
		
		public function buildBaseString($baseURI, $method, $params) {
		
			$r = array();
		
			ksort($params);
		
			foreach($params as $key=>$value){
		
				$r[] = "$key=" . rawurlencode($value);
		
			}
		
			return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
		
		}
		
		
		
		public function buildAuthorizationHeader($oauth) {
		
			$r = 'Authorization: OAuth ';
		
			$values = array();
		
			foreach($oauth as $key=>$value)
		
				$values[] = "$key=\"" . rawurlencode($value) . "\"";
		
			$r .= implode(', ', $values);
		
			return $r;
		
		}
		
		
		
		public function gettwStream(){
		
			global $wpdb;
		
			$wpsocial_stream_setting_caching = get_option('wpsocial_stream_setting_caching');
		
			if(isset($_SESSION['tw_posts']) && isset($_SESSION['tw_posts_created']) && time()<=strtotime('+30 minutes',$_SESSION['tw_posts_created']) && $wpsocial_stream_setting_caching==1) {
		
				$dataShow = $_SESSION['tw_posts'];
		
			} else {
		
				
		
			$wpsocial_stream_twitter_screenname = get_option('wpsocial_stream_twitter_screenname');		
			$wpsocial_stream_twitter_accesstoken = get_option('wpsocial_stream_twitter_accesstoken');		
			$wpsocial_stream_twitter_accesssecret = get_option('wpsocial_stream_twitter_accesssecret');		
			$wpsocial_stream_twitter_consumerid = get_option('wpsocial_stream_twitter_consumerid');		
			$wpsocial_stream_twitter_consumersecret = get_option('wpsocial_stream_twitter_consumersecret');		
			$wpsocial_stream_twitter_post_limit = get_option('wpsocial_stream_twitter_post_limit');		
			$wpsocial_stream_twitter_display_name = get_option('wpsocial_stream_twitter_display_name');		
			$wpsocial_stream_twitter_display_message = get_option('wpsocial_stream_twitter_display_message');		
			$wpsocial_stream_twitter_display_link = get_option('wpsocial_stream_twitter_display_link');		
			$wpsocial_stream_twitter_display_image = get_option('wpsocial_stream_twitter_display_image');		
			$wpsocial_stream_twitter_display_time = get_option('wpsocial_stream_twitter_display_time');
			$wpsocial_stream_setting_window = get_option('wpsocial_stream_setting_window');
		
			$target_window = "";				
		
			if($wpsocial_stream_setting_window=='new'){		
				$target_window = 'target="_blank"';		
			}		
		
			$twitter_timeline = "user_timeline";  //  mentions_timeline / user_timeline / home_timeline / retweets_of_me	
		
			//  create request
		
				$request = array(		
					'screen_name'       => $wpsocial_stream_twitter_screenname,		
					'count'             => $wpsocial_stream_twitter_post_limit,		
					'exclude_replies'	=> true,		
					'include_entities'	=> true,		
				);
		
		
			$oauth = array(		
				'oauth_consumer_key'        => $wpsocial_stream_twitter_consumerid,		
				'oauth_nonce'               => time(),		
				'oauth_signature_method'    => 'HMAC-SHA1',		
				'oauth_token'               => $wpsocial_stream_twitter_accesstoken,		
				'oauth_timestamp'           => time(),		
				'oauth_version'             => '1.0'		
			);		
		
			//  merge request and oauth to one array		
				$oauth = array_merge($oauth, $request);	
		
			//  do some magic		
				$base_info              = $this->buildBaseString("https://api.twitter.com/1.1/statuses/$twitter_timeline.json", 'GET', $oauth);		
				$composite_key          = rawurlencode($wpsocial_stream_twitter_consumersecret) . '&' . rawurlencode($wpsocial_stream_twitter_accesssecret);		
				$oauth_signature            = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));		
				$oauth['oauth_signature']   = $oauth_signature;	
		
			//  make request		
				$header = array($this->buildAuthorizationHeader($oauth), 'Expect:');		
				$options = array( CURLOPT_HTTPHEADER => $header,		
								  CURLOPT_HEADER => false,		
								  CURLOPT_URL => "https://api.twitter.com/1.1/statuses/$twitter_timeline.json?". http_build_query($request),		
								  CURLOPT_RETURNTRANSFER => true,		
								  CURLOPT_SSL_VERIFYPEER => false);	
		
				$feed = curl_init();		
				curl_setopt_array($feed, $options);		
				$json = curl_exec($feed);		
				curl_close($feed);
		
		   $data = json_decode($json, true);	
		
		   foreach($data as $item){	
		
				$time = date('Y-m-d H:m:s',strtotime($item['created_at']));
		
				$wpdb->query("insert into social_stream_posts (title,media_url,post_url,description,created_time,link,author,other_detail,stream_type) values ('','".$item['user']['profile_image_url']."','','".$item['text']."','".$time."','".$item['user']['url']."','".$item['user']['screen_name']."','".$item['id_str']."','tw')");
		
			}
		
			$tw_items = $wpdb->get_results("select * from social_stream_posts where stream_type='tw' order by created_time desc",ARRAY_A);
		
				$dataShow = "";
		
				foreach($tw_items as $tw_item){
		
					$dataShow .='<li class="dcsns-li isotope-item dcsns-twitter dcsns-feed-0">
		
							<div class="inner">
		
								';
		
								if(isset($tw_item['media_url']) && $wpsocial_stream_twitter_display_image==1){
		
								$dataShow	.='<span class="section-thumb"><a href="'.$tw_item['link'].'" '.$target_window.'>
		
										<img alt="" src="'.$tw_item['media_url'].'" style="opacity: 1; display: inline;">
		
									</a></span>';
		
								}
		
								if($wpsocial_stream_twitter_display_message==1){
								$dataShow .='
		
								<span class="section-text">';		
									$dataShow	.= $tw_item['description'].'</span>';	
		
								}	
		
								if($wpsocial_stream_twitter_display_link==1){
									$dataShow	.='
		
								<span class="section-share">';
		
									$dataShow	.='
									<a class="share-reply" target="popup" href="https://twitter.com/intent/tweet?in_reply_to='.$tw_item['other_detail'].'&via='.$tw_item['author'].'"></a>
									
									<a class="share-retweet" target="popup" href="https://twitter.com/intent/retweet?tweet_id='.$tw_item['other_detail'].'&via='.$tw_item['author'].'"></a>
									
									<a class="share-favorite" target="popup" href="https://twitter.com/intent/favorite?tweet_id='.$tw_item['other_detail'].'&via='.$tw_item['author'].'"></a>
									<a class="share-facebook" '.$target_window.' href="http://www.facebook.com/sharer.php?u='.urlencode($_POST['page']).'&t='.urlencode($tw_item['description']).'"></a>
		
									<a class="share-twitter" '.$target_window.' href="https://twitter.com/share?url='.urlencode($_POST['page']).'&text='.urlencode($tw_item['description']).'"></a>
		
									<a class="share-google" '.$target_window.' href="https://plus.google.com/share?url='.urlencode($_POST['page']).'"></a>
		
									<a class="share-linkedin" '.$target_window.' href="http://www.linkedin.com/shareArticle?mini=true&url='.urlencode($_POST['page']).'&title='.urlencode($tw_item['description']).'"></a></span>';
				
									}
		
								$dataShow	.='
		
								<span class="clear"></span>
		
							</div>
		
							<span class="section-intro">';
		
							if($wpsocial_stream_twitter_display_name==1){
		
								$dataShow	.='<a class="link-user" href="'.$tw_item['link'].'" '.$target_window.'>'.$tw_item['author'].'</a>';
		
							}
		
								if($wpsocial_stream_twitter_display_time==1){
								
									$dataShow	.='<span>';
		
									$dataShow	.= $this->timeAgo($tw_item['created_time']).'</span>';
								}
		
								$dataShow	.='
		
							</span>
		
							<a href="'.$tw_item['link'].'" '.$target_window.'>
		
								<span class="socicon socicon-twitter"></span>
		
							</a>
		
						</li>';
		
					}
		
				$_SESSION['tw_posts'] = $dataShow;		
				$_SESSION['tw_posts_created'] = time();
		
			}	
		
				die($dataShow);
		
		}
		
		
		public function getGoogleStream(){
		
			global $wpdb;
		
			$wpsocial_stream_setting_caching = get_option('wpsocial_stream_setting_caching');
		
			if(isset($_SESSION['google_posts']) && isset($_SESSION['google_posts_created']) && time()<=strtotime('+30 minutes',$_SESSION['google_posts_created']) && $wpsocial_stream_setting_caching==1)
		
			{
		
				$dataShow = $_SESSION['google_posts'];
		
			}else{
		
			
		
			
		
			$wpsocial_stream_googleplus_userid = get_option('wpsocial_stream_googleplus_userid');
		
			$wpsocial_stream_googleplus_apikey = get_option('wpsocial_stream_googleplus_apikey');
		
			$wpsocial_stream_googleplus_post_limit = get_option('wpsocial_stream_googleplus_post_limit');
		
			$wpsocial_stream_googleplus_display_name = get_option('wpsocial_stream_googleplus_display_name');
		
			$wpsocial_stream_googleplus_display_message = get_option('wpsocial_stream_googleplus_display_message');
		
			$wpsocial_stream_googleplus_display_link = get_option('wpsocial_stream_googleplus_display_link');
		
			$wpsocial_stream_googleplus_display_image = get_option('wpsocial_stream_googleplus_display_image');
		
			$wpsocial_stream_googleplus_display_time = get_option('wpsocial_stream_googleplus_display_time');
		
			
		
			$wpsocial_stream_setting_window = get_option('wpsocial_stream_setting_window');
		
			
		
			$target_window = "";
		
			
		
			if($wpsocial_stream_setting_window=='new'){
		
				$target_window = 'target="_blank"';
		
			}
		
			
		
			$api_link = "https://www.googleapis.com/plus/v1/people/".$wpsocial_stream_googleplus_userid."/activities/public?alt=json&maxResults=".$wpsocial_stream_googleplus_post_limit."&pp=1&key=".$wpsocial_stream_googleplus_apikey;
		
		$data = json_decode(file_get_contents($api_link ));
		
			
		
			foreach($data->items as $item){
		
				
		
				$time = date('Y-m-d H:m:s',strtotime($item->published));
		
				if(isset($item->object->attachments[0]->fullImage->url)){
		
					$pic = $item->object->attachments[0]->fullImage->url; 
		
				}else{
		
					$pic = "";
		
				}
		
				$wpdb->query("insert into social_stream_posts (title,media_url,post_url,description,created_time,link,author,other_detail,stream_type) values ('','".$pic."','','".$item->object->content."','".$time."','".$item->actor->url."','".$item->actor->displayName."','','google')");
		
			}
		
			
		
			$google_items = $wpdb->get_results("select * from social_stream_posts where stream_type='google' order by created_time desc",ARRAY_A);
		
				$dataShow = "";
		
				foreach($google_items as $google_item){
		
					$dataShow .='<li class="dcsns-li isotope-item dcsns-google dcsns-feed-0">
		
							<div class="inner">
		
								';
		
								
		
								if(isset($google_item['media_url']) && $wpsocial_stream_googleplus_display_image==1){
		
								$dataShow	.='<span class="section-thumb"><a href="'.$google_item['link'].'" '.$target_window.'>
		
										<img alt="" src="'.$google_item['media_url'].'" style="opacity: 1; display: inline;">
		
									</a></span>';
		
								}
		
								
		
								
		
								
		
								if($wpsocial_stream_googleplus_display_message==1){
									
									$dataShow .='
		
									<span class="section-text">';
		
									$dataShow .= $google_item['description'].'</span>';
		
							
		
								}
		
								
		
								
		
								
		
								if($wpsocial_stream_googleplus_display_link==1){
								
								$dataShow .='
		
								
		
		
								<span class="section-share">';
		
									$dataShow .='<a class="share-facebook" '.$target_window.' href="http://www.facebook.com/sharer.php?u='.urlencode($_POST['page']).'&t='.urlencode($google_item['description']).'"></a>
		
									<a class="share-twitter" '.$target_window.' href="https://twitter.com/share?url='.urlencode($_POST['page']).'&text='.urlencode($google_item['description']).'"></a>
		
									<a class="share-google" '.$target_window.' href="https://plus.google.com/share?url='.urlencode($_POST['page']).'"></a>
		
									<a class="share-linkedin" '.$target_window.' href="http://www.linkedin.com/shareArticle?mini=true&url='.urlencode($_POST['page']).'&title='.urlencode($google_item['description']).'"></a></span>';
		
									
		
								}
		
								
		
								$dataShow .='
		
								<span class="clear"></span>
		
							</div>
		
							<span class="section-intro">';
		
							
		
							if($wpsocial_stream_googleplus_display_name==1){
		
									$dataShow	.= '<a class="link-user" href="'.$google_item['link'].'" '.$target_window.'>'.$google_item['author'].'</a>';
		
							
		
								}
		
								
		
								
		
								
		
								
		
								if($wpsocial_stream_googleplus_display_time==1){
								$dataShow	.='<span>';
		
									$dataShow	.= $this->timeAgo($google_item['created_time']).'</span>';
		
							
		
								}
		
								
		
							$dataShow	.='
		
							</span>
		
							<a href="'.$google_item['link'].'" '.$target_window.'>
		
								<span class="socicon socicon-googleplus"></span>
		
							</a>
		
						</li>';
		
					}
		
					
		
					$_SESSION['google_posts'] = $dataShow;
		
					$_SESSION['google_posts_created'] = time();
		
				}
		
					
		
				die($dataShow);	
		
		}
		
		
		
		
		
		
		
		public function getYoutubeStream(){
		
			global $wpdb;
		
			$wpsocial_stream_setting_caching = get_option('wpsocial_stream_setting_caching');
		
			if(isset($_SESSION['youtube_posts']) && isset($_SESSION['youtube_posts_created']) && time()<=strtotime('+30 minutes',$_SESSION['youtube_posts_created']) && $wpsocial_stream_setting_caching==1)
		
			{
		
				$dataShow = $_SESSION['youtube_posts'];
		
			} else {	
		
			$wpsocial_stream_youtube_channel = get_option('wpsocial_stream_youtube_channel');
			$wpsocial_stream_youtube_post_limit = get_option('wpsocial_stream_youtube_post_limit');
			$wpsocial_stream_youtube_display_name = get_option('wpsocial_stream_youtube_display_name');
			$wpsocial_stream_youtube_display_message = get_option('wpsocial_stream_youtube_display_message');
			$wpsocial_stream_youtube_display_link = get_option('wpsocial_stream_youtube_display_link');
			$wpsocial_stream_youtube_display_image = get_option('wpsocial_stream_youtube_display_image');	
			$wpsocial_stream_youtube_display_video = get_option('wpsocial_stream_youtube_display_video');	
			$wpsocial_stream_youtube_display_time = get_option('wpsocial_stream_youtube_display_time');
			$wpsocial_stream_setting_window = get_option('wpsocial_stream_setting_window');	
		
			$target_window = "";	
		
			if($wpsocial_stream_setting_window=='new'){
				$target_window = 'target="_blank"';
			}
		
			$url = "https://www.youtube.com/feeds/videos.xml?channel_id=".$wpsocial_stream_youtube_channel."&max-results=".$wpsocial_stream_youtube_post_limit;
		
			//$content = file_get_contents($url);
			$rss = simplexml_load_file($url);
		
			$i=0;
		
			$dataShow = "";
		
			foreach($rss->entry as $entry){
		
			$i++;
		
			if($i<=$wpsocial_stream_youtube_post_limit){
		
			$media = $entry->children('http://search.yahoo.com/mrss/');	
		
				/*$attrs = $media->group->player->attributes();
				$watch = $attrs['url']; */
				// get video thumbnail
		
				$attrs = $media->group->thumbnail[0]->attributes();
				$thumbnail = $attrs['url']; 
				$entry->thumbnail = $thumbnail;	
				$time = date('Y-m-d H:m:s',strtotime($entry->published));
				$attribute = '@attributes';
				$post_url_href = 'href';	
				$post_url = $entry->link->attributes()->$post_url_href;	
		
				$wpdb->query("insert into social_stream_posts (title,media_url,post_url,description,created_time,link,author,other_detail,stream_type) values ('".$entry->title."','".$entry->thumbnail."','".$post_url."','','".$time."','".$entry->author->uri."','".$entry->author->name."','','youtube')");
		
				}
		
			}
		
			$youtube_items = $wpdb->get_results("select * from social_stream_posts where stream_type='youtube' order by created_time desc",ARRAY_A);		
		
				foreach($youtube_items as $youtube_item){
		
					$dataShow .='<li class="dcsns-li isotope-item dcsns-youtube dcsns-feed-0">
		
							<div class="inner">
							
								';
		
								if( isset($youtube_item['media_url']) && $wpsocial_stream_youtube_display_image == 1){
		
									$dataShow	.='
									
									<span class="section-thumb">
										<a href="'.$youtube_item['post_url'].'" '.$target_window.'>
											<img alt="" src="'.$youtube_item['media_url'].'" style="opacity: 1; display: inline;">
										</a>
									</span>
									
									';
		
								} elseif(isset($youtube_item['media_url']) && $wpsocial_stream_youtube_display_video == 1) {
									
									$link = $youtube_item['post_url'];
									$video_id = explode("?v=", $link); 
									
									$dataShow .= '<iframe src="//www.youtube.com/embed/'.$video_id[1].'" width="100%" height="300" allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen"></iframe>';
									
								}
								
		
								if($wpsocial_stream_youtube_display_message==1){
								
								$dataShow .='
								
								<span class="section-text">';
									$dataShow	.= $youtube_item['title'].'</span>';
								}
								
		
								if($wpsocial_stream_youtube_display_link==1){						
								
								$dataShow .='					
		
								<span class="section-share">';
									$dataShow .='<a class="share-facebook" '.$target_window.' href="http://www.facebook.com/sharer.php?u='.urlencode($_POST['page']).'&t='.urlencode($youtube_item['title']).'"></a>
									<a class="share-twitter" '.$target_window.' href="https://twitter.com/share?url='.urlencode($_POST['page']).'&text='.urlencode($youtube_item['title']).'"></a>
									<a class="share-google" '.$target_window.' href="https://plus.google.com/share?url='.urlencode($_POST['page']).'"></a>
									<a class="share-linkedin" '.$target_window.' href="http://www.linkedin.com/shareArticle?mini=true&url='.urlencode($_POST['page']).'&title='.urlencode($youtube_item['title']).'"></a></span>';
								}
		
								$dataShow .='
		
								<span class="clear"></span>
		
							</div>
		
							<span class="section-intro">';
							
		
							if($wpsocial_stream_youtube_display_name==1){
		
								$dataShow	.= '<a class="link-user" href="'.$youtube_item['link'].'" '.$target_window.'>'.$youtube_item['author'].'</a>';				
		
							}
		
							if($wpsocial_stream_youtube_display_time==1){
							
							$dataShow .='	<span>';
		
								$dataShow	.= $this->timeAgo($youtube_item['created_time']).'</span>';
		
							}
		
							$dataShow	.='
		
							</span>
		
							<a href="'.$youtube_item['link'].'" '.$target_window.'>
		
								<span class="socicon socicon-youtube"></span>
		
							</a>
		
						</li>';
		
					}
		
					$_SESSION['youtube_posts'] = $dataShow;
					$_SESSION['youtube_posts_created'] = time();
		
				}
		
				die($dataShow);	
		
		}
		
		public function getVimeoStream(){
		
			global $wpdb;
		
			$wpsocial_stream_setting_caching = get_option('wpsocial_stream_setting_caching');
		
			if(isset($_SESSION['vimeo_posts']) && isset($_SESSION['vimeo_posts_created']) && time()<=strtotime('+30 minutes',$_SESSION['vimeo_posts_created']) && $wpsocial_stream_setting_caching==1){
		
				$dataShow = $_SESSION['vimeo_posts'];
		
			}else{
		
		
			$wpsocial_stream_vimeo_vimeoname = get_option('wpsocial_stream_vimeo_vimeoname');
			$wpsocial_stream_vimeo_post_limit = get_option('wpsocial_stream_vimeo_post_limit');
			$wpsocial_stream_vimeo_display_name = get_option('wpsocial_stream_vimeo_display_name');
			$wpsocial_stream_vimeo_display_title = get_option('wpsocial_stream_vimeo_display_title');
			$wpsocial_stream_vimeo_display_link = get_option('wpsocial_stream_vimeo_display_link');
			$wpsocial_stream_vimeo_display_image = get_option('wpsocial_stream_vimeo_display_image');
			$wpsocial_stream_vimeo_display_video = get_option('wpsocial_stream_vimeo_display_video');	
			$wpsocial_stream_vimeo_display_time = get_option('wpsocial_stream_vimeo_display_time');
			$wpsocial_stream_vimeo_display_duration = get_option('wpsocial_stream_vimeo_display_duration');	
			$wpsocial_stream_setting_window = get_option('wpsocial_stream_setting_window');	
		
			$target_window = "";	
		
			if($wpsocial_stream_setting_window=='new'){
				$target_window = 'target="_blank"';
			}
		
			$videos = simplexml_load_string(file_get_contents('http://vimeo.com/api/v2/'.$wpsocial_stream_vimeo_vimeoname.'/videos.xml'));
		
			$i=0;
		
			$dataShow = "";
		
			foreach($videos->video as $item){
		
			$i++;	
		
			if($i<=$wpsocial_stream_vimeo_post_limit){	
		
				$time = date('Y-m-d H:m:s',strtotime($item->upload_date));	
		
				$wpdb->query("insert into social_stream_posts (title,media_url,post_url,description,created_time,link,author,other_detail,stream_type) values ('".$item->title."','".$item->thumbnail_large."','".$item->url."','','".$time."','".$item->user_url."','".$item->user_name."','".$item->duration."','vimeo')");
		
				}
		
			}
		
			$vimeo_items = $wpdb->get_results("select * from social_stream_posts where stream_type='vimeo' order by created_time desc",ARRAY_A);
		
				
		
				foreach($vimeo_items as $vimeo_item){
		
					$dataShow .='<li class="dcsns-li isotope-item dcsns-vimeo dcsns-feed-0">
		
							<div class="inner">
		
								';
		
								
		
								if( isset($vimeo_item['media_url']) && $wpsocial_stream_vimeo_display_image == 1 ){
		
									$dataShow	.='<span class="section-thumb"><a href="'.$vimeo_item['post_url'].'" '.$target_window.'>
		
										<img alt="" src="'.$vimeo_item['media_url'].'" style="opacity: 1; display: inline;">
		
									</a></span>';
		
								} elseif( isset($vimeo_item['media_url']) && $wpsocial_stream_vimeo_display_video == 1 ) {
									
									//Extract video id
									$url = $vimeo_item['post_url'];
									$urlParts = explode("/", parse_url($url, PHP_URL_PATH));
									$videoId = (int)$urlParts[count($urlParts)-1];
								
									$dataShow	.= '<iframe src="//player.vimeo.com/video/'.$videoId.'?title=0&amp;byline=0&amp;color=ffffff" width="100%" height="300"></iframe>';
									
								}
		
								
		
								if($wpsocial_stream_vimeo_display_title==1){
								
								$dataShow .='
		
								<span class="section-title">';
		
								
		
									$dataShow	.= $vimeo_item['title'].'</span>';
		
							
		
								}
		
								
		
								
		
								
		
								
		
								if($wpsocial_stream_vimeo_display_duration==1){
								
									$dataShow	.='
		
								<span class="section-text">';
		
									$dataShow	.= $vimeo_item['other_detail'].' secs</span>';
		
							
		
								}
		
								
		
								
		
								
		
								if($wpsocial_stream_vimeo_display_link==1){
		
								$dataShow	.= '
		
		
								<span class="section-share">';
		
								$dataShow	.= '	<a class="share-facebook" '.$target_window.' href="http://www.facebook.com/sharer.php?u='.urlencode($_POST['page']).'&t='.urlencode($vimeo_item['title']).'"></a>
		
									<a class="share-twitter" '.$target_window.' href="https://twitter.com/share?url='.urlencode($_POST['page']).'&text='.urlencode($vimeo_item['title']).'"></a>
		
									<a class="share-google" '.$target_window.' href="https://plus.google.com/share?url='.urlencode($_POST['page']).'"></a>
		
									<a class="share-linkedin" '.$target_window.' href="http://www.linkedin.com/shareArticle?mini=true&url='.urlencode($_POST['page']).'&title='.urlencode($vimeo_item['title']).'"></a></span>';
		
									}
		
									
		
								$dataShow	.= '
		
								<span class="clear"></span>
		
							</div>
		
							<span class="section-intro">';
		
							
		
							if($wpsocial_stream_vimeo_display_name==1){
		
								$dataShow	.= '<a class="link-user" href="'.$vimeo_item['link'].'" '.$target_window.'>'.$vimeo_item['author'].'</a>';
		
							}
		
								
		
								
		
								
		
							if($wpsocial_stream_vimeo_display_time==1){	
		
								$dataShow	.= '<span>';
								$dataShow	.= $this->timeAgo($vimeo_item['created_time']).'</span>';
		
							}
		
								
		
								$dataShow	.= '
		
							</span>
		
							<a href="'.$vimeo_item['link'].'" '.$target_window.'>
		
								<span class="socicon socicon-vimeo"></span>
		
							</a>
		
						</li>';
		
					}
		
			
		
					$_SESSION['vimeo_posts'] = $dataShow;
		
					$_SESSION['vimeo_posts_created'] = time();
		
				}
		
					
		
				die($dataShow);	
		
		}
		
		public function getDribbleStream(){
		
			global $wpdb;
		
			
		
			$wpsocial_stream_setting_caching = get_option('wpsocial_stream_setting_caching');
		
			if(isset($_SESSION['dribble_posts']) && isset($_SESSION['dribble_posts_created']) && time()<=strtotime('+30 minutes',$_SESSION['dribble_posts_created']) && $wpsocial_stream_setting_caching==1)
		
			{
		
				$dataShow = $_SESSION['dribble_posts'];
		
			}else{
		
			
		
			
		
			$wpsocial_stream_dribble_user = get_option('wpsocial_stream_dribble_user');
		
			$wpsocial_stream_dribble_access_token = get_option('wpsocial_stream_dribble_access_token');
		
			$wpsocial_stream_dribble_post_limit = get_option('wpsocial_stream_dribble_post_limit');
		
			$wpsocial_stream_dribble_display_name = get_option('wpsocial_stream_dribble_display_name');
		
			$wpsocial_stream_dribble_display_message = get_option('wpsocial_stream_dribble_display_message');
		
			$wpsocial_stream_dribble_display_link = get_option('wpsocial_stream_dribble_display_link');
		
			$wpsocial_stream_dribble_display_image = get_option('wpsocial_stream_dribble_display_image');
		
			$wpsocial_stream_dribble_display_time = get_option('wpsocial_stream_dribble_display_time');
		
			
		
			$wpsocial_stream_setting_window = get_option('wpsocial_stream_setting_window');
		
			
		
			$target_window = "";
		
			
		
			if($wpsocial_stream_setting_window=='new'){
		
				$target_window = 'target="_blank"';
		
			}			
		
			$data = file_get_contents('https://api.dribbble.com/v1/users/'.$wpsocial_stream_dribble_user.'/likes?access_token='.$wpsocial_stream_dribble_access_token.'&sort=recent&page=');
		
			$data = json_decode($data);

			$i=0;
		
			$dataShow = "";
		
			foreach($data as $item){
		
			$i++;			
		
				if($i<=$wpsocial_stream_dribble_post_limit){						
		
				$time = date('Y-m-d H:m:s',strtotime($item->shot->created_at));	
		
				$wpdb->query("insert into social_stream_posts (title,media_url,post_url,description,created_time,link,author,other_detail,stream_type) values ('".$item->shot->title."','".$item->shot->images->normal."','".$item->shot->html_url."','','".$time."','".$item->shot->user->html_url."','".$item->shot->user->username."','','dribble')");
		
				}
		
			}
		
			$dribble_items = $wpdb->get_results("select * from social_stream_posts where stream_type='dribble' order by created_time desc",ARRAY_A);
				
				foreach($dribble_items as $dribble_item){
		
					$dataShow .='<li class="dcsns-li isotope-item dcsns-dribbble dcsns-feed-0">
		
							<div class="inner">';								
		
								if(isset($dribble_item['media_url']) && $wpsocial_stream_dribble_display_image==1){
		
								$dataShow	.='<span class="section-thumb"><a href="'.$dribble_item['post_url'].'" '.$target_window.'>
		
										<img alt="" src="'.$dribble_item['media_url'].'" style="opacity: 1; display: inline;">
		
									</a></span>';
		
								}								
		
								if($wpsocial_stream_dribble_display_message==1){
		
								$dataShow .='
		
								<span class="section-title">';
		
								$dataShow .= $dribble_item['title'].'</span>';
		
								}								
		
								if($wpsocial_stream_dribble_display_link==1){
		
								
									$dataShow .= '
		
								<span class="section-share">';
		
									$dataShow .= '<a class="share-facebook" '.$target_window.' href="http://www.facebook.com/sharer.php?u='.urlencode($_POST['page']).'&t='.urlencode($dribble_item['title']).'"></a>
		
									<a class="share-twitter" '.$target_window.' href="https://twitter.com/share?url='.urlencode($_POST['page']).'&text='.urlencode($dribble_item['title']).'"></a>
		
									<a class="share-google" '.$target_window.' href="https://plus.google.com/share?url='.urlencode($_POST['page']).'"></a>
		
									<a class="share-linkedin" '.$target_window.' href="http://www.linkedin.com/shareArticle?mini=true&url='.urlencode($_POST['page']).'&title='.urlencode($dribble_item['title']).'"></a></span>';
		
									}									
		
								$dataShow .= '
		
								<span class="clear"></span>
		
							</div>
		
							<span class="section-intro">';

							if($wpsocial_stream_dribble_display_name==1){
		
							$dataShow .= '	<a class="link-user" href="'.$dribble_item['link'].'" '.$target_window.'>'.$dribble_item['author'].'</a>';
				
							}
		
							if($wpsocial_stream_dribble_display_time==1){	
							
								$dataShow .= '	<span>';
		
								$dataShow	.= $this->timeAgo($dribble_item['created_time']).'</span>';
		
							}
		
							$dataShow .= '
		
							</span>
		
							<a href="'.$dribble_item['link'].'" '.$target_window.'>
		
								<span class="socicon socicon-dribbble"></span>
		
							</a>
		
						</li>';
		
					}			
		
					$_SESSION['dribble_posts'] = $dataShow;
		
					$_SESSION['dribble_posts_created'] = time();
		
				}					
		
				die($dataShow);	
		
		}
		
		
		public function getStumbleuponStream(){
		
			global $wpdb;
		
			$wpsocial_stream_setting_caching = get_option('wpsocial_stream_setting_caching');
		
			if(isset($_SESSION['stumbleupon_posts']) && isset($_SESSION['stumbleupon_posts_created']) && time()<=strtotime('+30 minutes',$_SESSION['stumbleupon_posts_created']) && $wpsocial_stream_setting_caching==1)
		
			{
		
				$dataShow = $_SESSION['stumbleupon_posts'];
		
			}else{	
		
			$wpsocial_stream_stumbleupon_name = get_option('wpsocial_stream_stumbleupon_name');
		
			$wpsocial_stream_stumbleupon_post_limit = get_option('wpsocial_stream_stumbleupon_post_limit');
		
			$wpsocial_stream_stumbleupon_display_name = get_option('wpsocial_stream_stumbleupon_display_name');
		
			$wpsocial_stream_stumbleupon_display_title = get_option('wpsocial_stream_stumbleupon_display_title');
		
			$wpsocial_stream_stumbleupon_display_link = get_option('wpsocial_stream_stumbleupon_display_link');
		
			$wpsocial_stream_stumbleupon_display_image = get_option('wpsocial_stream_stumbleupon_display_image');
		
			$wpsocial_stream_stumbleupon_display_time = get_option('wpsocial_stream_stumbleupon_display_time');
		
			$wpsocial_stream_stumbleupon_display_view = get_option('wpsocial_stream_stumbleupon_display_view');
		
			$wpsocial_stream_setting_window = get_option('wpsocial_stream_setting_window');

			$target_window = "";
		
			if($wpsocial_stream_setting_window=='new'){
		
				$target_window = 'target="_blank"';
		
			}
		
			$url = "http://www.stumbleupon.com/rss/stumbler/".$wpsocial_stream_stumbleupon_name."/likes";
		
			$rss = simplexml_load_file($url,'SimpleXMLElement', LIBXML_NOCDATA);
			
		
			$i=0;
		
			$dataShow = "";
		
			$author_url = $rss->channel->link;
		
			$author_name = $wpsocial_stream_stumbleupon_name;			
		
			foreach($rss->channel->item as $item){			
		
			$i++;
		
				if($i<=$wpsocial_stream_stumbleupon_post_limit){
		
				$time = date('Y-m-d H:m:s',strtotime($item->pubDate));
		
				$imagePart = explode('src="',$item->description); 
		
				$imagePart2 = explode('"/>',$imagePart[1]);
		
				$image = $imagePart2[0];
		
				$viewPart = explode('views',$imagePart2[1]);
		
				$viewPart2 = explode('">',$viewPart[0]);
		
				$view = $viewPart2[1];
		
				$wpdb->query("insert into social_stream_posts (title,media_url,post_url,description,created_time,link,author,other_detail,stream_type) values ('".esc_sql($item->title)."','".esc_sql($image)."','".esc_sql($item->link)."','','".esc_sql($time)."','".esc_sql($author_url)."','".esc_sql($author_name)."','".esc_sql($view)."','stumbleupon')");
		
				}
		
			}
		
			$stumbleupon_items = $wpdb->get_results("select * from social_stream_posts where stream_type='stumbleupon' order by created_time desc",ARRAY_A);
				
				foreach($stumbleupon_items as $stumbleupon_item){
		
					$dataShow .='<li class="dcsns-li isotope-item dcsns-stumbleupon dcsns-feed-0">
		
							<div class="inner">
		
								';
		
								if(isset($stumbleupon_item['media_url']) && $wpsocial_stream_stumbleupon_display_image==1){
		
								$dataShow	.='<span class="section-thumb"><a href="'.$stumbleupon_item['post_url'].'" '.$target_window.'>
		
										<img alt="" src="'.$stumbleupon_item['media_url'].'" style="opacity: 1; display: inline;">
		
									</a></span>';
		
								}
		
								if($wpsocial_stream_stumbleupon_display_title==1){
		
								$dataShow .='
		
								<span class="section-title">';
		
								$dataShow .= $stumbleupon_item['title'].'</span>';

								}
		
								if($wpsocial_stream_stumbleupon_display_view==1){
		
								$dataShow .= '
		
								<span class="section-text">';
		
								$dataShow .= $stumbleupon_item['other_detail'].' Views </span>';
		
								}
		
								if($wpsocial_stream_stumbleupon_display_link==1){
								
								$dataShow .= '

								<span class="section-share">';
		
								$dataShow .= '	<a class="share-facebook" '.$target_window.' href="http://www.facebook.com/sharer.php?u='.urlencode($_POST['page']).'&t='.urlencode($stumbleupon_item['title']).'"></a>
		
									<a class="share-twitter" '.$target_window.' href="https://twitter.com/share?url='.urlencode($_POST['page']).'&text='.urlencode($stumbleupon_item['title']).'"></a>
		
									<a class="share-google" '.$target_window.' href="https://plus.google.com/share?url='.urlencode($_POST['page']).'"></a>
		
									<a class="share-linkedin" '.$target_window.' href="http://www.linkedin.com/shareArticle?mini=true&url='.urlencode($_POST['page']).'&title='.urlencode($stumbleupon_item['title']).'"></a></span>';
		
								}
		
								$dataShow .= '
		
								<span class="clear"></span>
		
							</div>
		
							<span class="section-intro">';
		
							if($wpsocial_stream_stumbleupon_display_name==1){
		
								$dataShow .= '<a class="link-user" href="'.$stumbleupon_item['link'].'" '.$target_window.'>'.$stumbleupon_item['author'].'</a>';
		
							}
		
							if($wpsocial_stream_stumbleupon_display_time==1){	
								$dataShow .= '<span>';
								$dataShow	.= $this->timeAgo($stumbleupon_item['created_time']).'</span>';
		
							}
		
							$dataShow .= '
		
							</span>
		
							<a href="'.$stumbleupon_item['link'].'" '.$target_window.'>
		
								<span class="socicon socicon-stumbleupon"></span>
		
							</a>
		
						</li>';
		
					}			
		
					$_SESSION['stumbleupon_posts'] = $dataShow;
		
					$_SESSION['stumbleupon_posts_created'] = time();
		
				}
		
				die($dataShow);	
		
		}
		
		
		public function getTumblrStream(){
		
			global $wpdb;
		
			$wpsocial_stream_setting_caching = get_option('wpsocial_stream_setting_caching');
		
			if(isset($_SESSION['trumblr_posts']) && isset($_SESSION['trumblr_posts_created']) && time()<=strtotime('+30 minutes',$_SESSION['trumblr_posts_created']) && $wpsocial_stream_setting_caching==1) {
		
				$dataShow = $_SESSION['trumblr_posts'];
		
			} else {
				
				$wpsocial_stream_tumblr_name = get_option('wpsocial_stream_tumblr_name');
			
				$wpsocial_stream_tumblr_post_limit = get_option('wpsocial_stream_tumblr_post_limit');
			
				$wpsocial_stream_tumblr_display_name = get_option('wpsocial_stream_tumblr_display_name');
			
				$wpsocial_stream_tumblr_display_title = get_option('wpsocial_stream_tumblr_display_title');
			
				$wpsocial_stream_tumblr_display_link = get_option('wpsocial_stream_tumblr_display_link');
			
				$wpsocial_stream_tumblr_display_image = get_option('wpsocial_stream_tumblr_display_image');
			
				$wpsocial_stream_tumblr_display_time = get_option('wpsocial_stream_tumblr_display_time');
			
				$wpsocial_stream_setting_window = get_option('wpsocial_stream_setting_window');
		
				$target_window = "";
		
				if($wpsocial_stream_setting_window=='new'){
					$target_window = 'target="_blank"';
				}

				//$xml = new SimpleXMLElement($content);
				$url = "http://".$wpsocial_stream_tumblr_name.".tumblr.com/api/read/?callback=?&num=".$wpsocial_stream_tumblr_post_limit;
				$data = simplexml_load_file($url);
		
				$i=0;
		
				$dataShow = "";
		
				$author_url = "http://".$wpsocial_stream_tumblr_name.".tumblr.com/";
		
				$author_name = $wpsocial_stream_tumblr_name;
		
				foreach($data->posts->post as $item){
			
					$i++;			
			
					$data_gmt = 'date-gmt';
			
					$time = date('Y-m-d H:m:s',strtotime($item->attributes()->$data_gmt));
			
					$photo_caption = 'photo-caption';
			
					$photo_url = 'photo-url';
			
					$post_url_desc = 'url-with-slug';
			
					$post_url = $item->attributes()->$post_url_desc;
			
					$photo = $item->$photo_url;
			
					$image = $photo['0'];				
			
					$wpdb->query("insert into social_stream_posts (title,media_url,post_url,description,created_time,link,author,other_detail,stream_type) values ('".$item->$photo_caption."','".$image."','".$post_url."','','".$time."','".$author_url."','".$author_name."','','tumblr')");
			
				}//end foreach
		
				$tumblr_items = $wpdb->get_results("select * from social_stream_posts where stream_type='tumblr' order by created_time desc",ARRAY_A);				
		
				//Add a check for title is present? if not present do not display the post
				foreach($tumblr_items as $tumblr_item){
					
					
					if( $tumblr_item['title'] !== '' ) {
						
						$dataShow .='<li class="dcsns-li isotope-item dcsns-tumblr dcsns-feed-0">
		
							<div class="inner">
		
								';
		
								if(isset($tumblr_item['media_url']) && $wpsocial_stream_tumblr_display_image==1){
		
								$dataShow	.='<span class="section-thumb"><a href="'.$tumblr_item['post_url'].'" '.$target_window.'>
		
										<img alt="" src="'.$tumblr_item['media_url'].'" style="opacity: 1; display: inline;">
		
									</a></span>';
		
								}
		
								
								if($wpsocial_stream_tumblr_display_title == 1) {
								
									$dataShow .='
									<span class="section-title">';
									$dataShow .= $tumblr_item['title'].'</span>';
		
								}
								
		
								if($wpsocial_stream_tumblr_display_link == 1) {
									
									$dataShow .='
		
									<span class="section-share">';
		
									$dataShow .=	'<a class="share-facebook" '.$target_window.' href="http://www.facebook.com/sharer.php?u='.urlencode($_POST['page']).'&t='.urlencode($tumblr_item['title']).'"></a>
		
									<a class="share-twitter" '.$target_window.' href="https://twitter.com/share?url='.urlencode($_POST['page']).'&text='.urlencode($tumblr_item['title']).'"></a>
		
									<a class="share-google" '.$target_window.' href="https://plus.google.com/share?url='.urlencode($_POST['page']).'"></a>
		
									<a class="share-linkedin" '.$target_window.' href="http://www.linkedin.com/shareArticle?mini=true&url='.urlencode($_POST['page']).'&title='.urlencode($tumblr_item['title']).'"></a></span>';
		
								}
		
								$dataShow .='
		
								<span class="clear"></span>
		
							</div>
		
							<span class="section-intro">';		
							
		
							if($wpsocial_stream_tumblr_display_name==1){
		
								$dataShow .=	'<a class="link-user" href="'.$tumblr_item['link'].'" '.$target_window.'>'.$tumblr_item['author'].'</a>';
	
							}
								
		
							if($wpsocial_stream_tumblr_display_time==1){
								
								$dataShow .=	'<span>';
								$dataShow .= $this->timeAgo($tumblr_item['created_time']).'</span>';
	
							}
		
							$dataShow .=	'
		
							</span>
		
							<a href="'.$tumblr_item['link'].'" '.$target_window.'>
		
								<span class="socicon socicon-tumblr"></span>
		
							</a>
		
						</li>';
						
					}//end if
					
		
				}//end of foreach
				
				$_SESSION['trumblr_posts'] = $dataShow;
				$_SESSION['trumblr_posts_created'] = time();
		
		
			}//end if
		
		
			die($dataShow);	
		
		}
		
		public function getInstagramStream(){
		
			global $wpdb;
		
			$wpsocial_stream_setting_caching = get_option('wpsocial_stream_setting_caching');
		
			if(isset($_SESSION['instagram_posts']) && isset($_SESSION['instagram_posts_created']) && time()<=strtotime('+30 minutes',$_SESSION['instagram_posts_created']) && $wpsocial_stream_setting_caching==1){
		
				$dataShow = $_SESSION['instagram_posts'];
		
			}else{
		
			$wpsocial_stream_instagram_accesstoken = get_option('wpsocial_stream_instagram_accesstoken');
		
			$wpsocial_stream_instagram_post_limit = get_option('wpsocial_stream_instagram_post_limit');
		
			$wpsocial_stream_instagram_display_name = get_option('wpsocial_stream_instagram_display_name');
		
			$wpsocial_stream_instagram_display_link = get_option('wpsocial_stream_instagram_display_link');
		
			$wpsocial_stream_instagram_display_image = get_option('wpsocial_stream_instagram_display_image');
		
			$wpsocial_stream_instagram_display_time = get_option('wpsocial_stream_instagram_display_time');
			
			$wpsocial_stream_setting_window = get_option('wpsocial_stream_setting_window');
			
			$target_window = "";
		
			if($wpsocial_stream_setting_window=='new'){
		
				$target_window = 'target="_blank"';
		
			}
		
			$url = "https://api.instagram.com/v1/users/self/media/recent/?access_token=".$wpsocial_stream_instagram_accesstoken."&count=".$wpsocial_stream_instagram_post_limit;
		
			$content = file_get_contents($url);
		
			$data = json_decode($content);
		
			$i=0;
			
			$dataShow = "";
		
			foreach($data->data as $item){
		
			$i++;
		
				$time = date('Y-m-d H:m:s',$item->created_time);		
		
				$wpdb->query("insert into social_stream_posts (title,media_url,post_url,description,created_time,link,author,other_detail,stream_type) values ('','".$item->images->standard_resolution->url."','".$item->link."','','".$time."','','".$item->user->username."','','instagram')");
		
				}
		
			$instagram_items = $wpdb->get_results("select * from social_stream_posts where stream_type='instagram' order by created_time desc",ARRAY_A);
		
				foreach($instagram_items as $instagram_item){
		
					$dataShow .='<li class="dcsns-li isotope-item dcsns-instagram dcsns-feed-0">
		
							<div class="inner">
		
								';
		
								if(isset($instagram_item['media_url']) && $wpsocial_stream_instagram_display_image==1){
		
								$dataShow	.='<span class="section-thumb"><a href="'.$instagram_item['post_url'].'" '.$target_window.'>
		
										<img alt="" src="'.$instagram_item['media_url'].'" style="opacity: 1; display: inline;">
		
									</a></span>';
		
								}
		
								if($wpsocial_stream_tumblr_display_time==1){
		
								$dataShow .='
		
								<span class="section-share">';
								
									$dataShow .='<a class="share-facebook" '.$target_window.' href="http://www.facebook.com/sharer.php?u='.urlencode($_POST['page']).'&t="></a>
		
									<a class="share-twitter" '.$target_window.' href="https://twitter.com/share?url='.urlencode($_POST['page']).'&text="></a>
		
									<a class="share-google" '.$target_window.' href="https://plus.google.com/share?url='.urlencode($_POST['page']).'"></a>
		
									<a class="share-linkedin" '.$target_window.' href="http://www.linkedin.com/shareArticle?mini=true&url='.urlencode($_POST['page']).'&title="></a></span>';
									
									}
		
								$dataShow .='
		
								<span class="clear"></span>
		
							</div>
		
							<span class="section-intro">';
							
							if($wpsocial_stream_instagram_display_name==1){
		
							$dataShow .='	<a class="link-user" href="'.$instagram_item['post_url'].'" '.$target_window.'>'.$instagram_item['author'].'</a>';
		
							}
		
							if($wpsocial_stream_instagram_display_time==1){					
		
							$dataShow .='	<span>';
		
							$dataShow .= $this->timeAgo($instagram_item['created_time']).'</span>';
		
							}
		
		
							$dataShow .='
		
							</span>
		
							<a href="'.$instagram_item['post_url'].'" '.$target_window.'>
		
								<span class="socicon socicon-instagram"></span>
		
							</a>
		
						</li>';
		
		
		
					}
		
					$_SESSION['instagram_posts'] = $dataShow;
					$_SESSION['instagram_posts_created'] = time();
		
		
		
				}
		
				die($dataShow);	
		
		
		}
		
		
		
		public function getRssStream(){
		
			global $wpdb;
		
			$wpsocial_stream_setting_caching = get_option('wpsocial_stream_setting_caching');
		
			if(isset($_SESSION['rss_posts']) && isset($_SESSION['rss_posts_created']) && time()<=strtotime('+30 minutes',$_SESSION['rss_posts_created']) && $wpsocial_stream_setting_caching==1) {
		
				$dataShow = $_SESSION['rss_posts'];
		
			} else {
		
			$wpsocial_stream_rss_urls = get_option('wpsocial_stream_rss_urls');
			$wpsocial_stream_rss_post_limit = get_option('wpsocial_stream_rss_post_limit');
			$wpsocial_stream_rss_display_name = get_option('wpsocial_stream_rss_display_name');
			$wpsocial_stream_rss_display_title = get_option('wpsocial_stream_rss_display_title');
			$wpsocial_stream_rss_display_link = get_option('wpsocial_stream_rss_display_link');
			$wpsocial_stream_rss_display_image = get_option('wpsocial_stream_rss_display_image');
			$wpsocial_stream_rss_display_time = get_option('wpsocial_stream_rss_display_time');
			$wpsocial_stream_rss_display_description = get_option('wpsocial_stream_rss_display_description');
			$wpsocial_stream_setting_window = get_option('wpsocial_stream_setting_window');
		
			$target_window = "";
		
			if($wpsocial_stream_setting_window=='new'){
		
				$target_window = 'target="_blank"';
		
			}
		
			$url = $wpsocial_stream_rss_urls;
		
			$feed = new DOMDocument();
		
			$feed->load($url);
		
			$feed_title = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
		
			$items = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('item');
		
			//$xml = new SimpleXMLElement($content);
		
		
			$i=0;
		
			$dataShow = "";
		
			foreach($items as $item){
		
			$i++;
		
			if($i<=$wpsocial_stream_rss_post_limit){
		
			 $title = $item->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
		
			   $description = $item->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
		
			   $text = $item->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
		
			   $image = $this->dc_get_image($text);
		
				$clear = trim(preg_replace('/ +/', ' ', preg_replace('[^A-Za-z0-9áéíóú�?É�?ÓÚ]', ' ', urldecode(html_entity_decode(strip_tags($text))))));
		
		
		   $standardimage = $item->getElementsByTagName('standardimage')->item(0)->firstChild->nodeValue;
		
		   $link = $item->getElementsByTagName('guid')->item(0)->firstChild->nodeValue;  
		
		   $publishedDate = $item->getElementsByTagName('pubDate')->item(0)->firstChild->nodeValue;
		
				$time = date('Y-m-d H:m:s',strtotime($publishedDate));
		
				$wpdb->query("insert into social_stream_posts (title,media_url,post_url,description,created_time,link,author,other_detail,stream_type) values ('".$title."','".$image."','','','".$time."','".$link."','','','rss')");
		
				}
		
			}
		
			$rss_items = $wpdb->get_results("select * from social_stream_posts where stream_type='rss' order by created_time desc",ARRAY_A);
		
				foreach($rss_items as $rss_item){
		
					$dataShow .='<li class="dcsns-li isotope-item dcsns-rss dcsns-feed-0">
		
							<div class="inner">
		
								';
		
								if(isset($rss_item['media_url']) && $wpsocial_stream_rss_display_image==1){
		
								$dataShow	.='<span class="section-thumb"><a href="'.$rss_item['link'].'" '.$target_window.'>
		
										<img alt="" src="'.$rss_item['media_url'].'" style="opacity: 1; display: inline;">
		
									</a></span>';
		
								}
		
								if($wpsocial_stream_rss_display_title==1){
								
								$dataShow .='
		
								<span class="section-title">';
		
		
								$dataShow .= $rss_item['title'].'</span>';
		
								}
		
								if($wpsocial_stream_rss_display_link==1){
								
								$dataShow .= '
		
		
								<span class="section-share">';
		
		
									$dataShow .= '<a class="share-facebook" '.$target_window.' href="http://www.facebook.com/sharer.php?u='.urlencode($_POST['page']).'&t="></a>
		
									<a class="share-twitter" '.$target_window.' href="https://twitter.com/share?url='.urlencode($_POST['page']).'&text="></a>
		
									<a class="share-google" '.$target_window.' href="https://plus.google.com/share?url='.urlencode($_POST['page']).'"></a>
		
									<a class="share-linkedin" '.$target_window.' href="http://www.linkedin.com/shareArticle?mini=true&url='.urlencode($_POST['page']).'&title="></a></span>';
		
									
		
								}
		
								
		
							$dataShow .= '	
		
								<span class="clear"></span>
		
							</div>
		
							<span class="section-intro">';
		
							if($wpsocial_stream_rss_display_name==1){
		
								$dataShow .= '<a class="link-user" href="'.$rss_item['link'].'" '.$target_window.'>'.$rss_item['link'].'</a>';
		
							}	
		
							if($wpsocial_stream_rss_display_time==1){	
							
							$dataShow .= '<span>';
		
								$dataShow .= $this->timeAgo($rss_item['created_time']).'</span>';
		
							}						
		
							$dataShow .= '
		
							</span>
		
							<a href="'.$rss_item['link'].'" '.$target_window.'>
		
								<span class="socicon socicon-rss"></span>
		
							</a>
		
						</li>';
		
					}	
		
					$_SESSION['rss_posts'] = $dataShow;
					$_SESSION['rss_posts_created'] = time();
		
				}			
		
				die($dataShow);	
		
		}
		
		public function dc_get_image($html) {
		
			$doc = new DOMDocument();
			@$doc->loadHTML($html);
			$xpath = new DOMXPath($doc);
			$src = $xpath->evaluate("string(//img/@src)"); # "/images/image.jpg"
			return $src;
		
		}	
		
		public function wpsocial_stream_plugin_install(){
	
			$sql = "CREATE TABLE social_stream_posts  (
		
			`id` BIGINT( 20 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`title` VARCHAR( 500 ), 
			`media_url` TEXT, 
			`post_url` TEXT,
			`description` TEXT, 
			`created_time` DATETIME , 
			`link` VARCHAR( 500 ), 
			`author` VARCHAR( 500 ), 
			`other_detail` VARCHAR( 100 ), 
			`stream_type` VARCHAR( 100 ))";
				
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		
			dbDelta($sql);
			   
			add_option('wpsocial_stream_facebook_pageid','');   
			add_option('wpsocial_stream_facebook_appid','');
			add_option('wpsocial_stream_facebook_appsecret','');
			add_option('wpsocial_stream_facebook_post_limit','');
			add_option('wpsocial_stream_facebook_display_message','');
			add_option('wpsocial_stream_facebook_display_link','');
			add_option('wpsocial_stream_facebook_display_image','');
			add_option('wpsocial_stream_facebook_display_time','');
			
			add_option('wpsocial_stream_twitter_screenname','');   
			add_option('wpsocial_stream_twitter_accesstoken','');
			add_option('wpsocial_stream_twitter_accesssecret','');
			add_option('wpsocial_stream_twitter_consumerid','');
			add_option('wpsocial_stream_twitter_consumersecret','');
			add_option('wpsocial_stream_twitter_post_limit','');
			add_option('wpsocial_stream_twitter_display_name','');
			add_option('wpsocial_stream_twitter_display_message','');
			add_option('wpsocial_stream_twitter_display_link','');   
			add_option('wpsocial_stream_twitter_display_image','');
			add_option('wpsocial_stream_twitter_display_time','');
			
			add_option('wpsocial_stream_googleplus_userid','');   
			add_option('wpsocial_stream_googleplus_apikey','');
			add_option('wpsocial_stream_googleplus_post_limit','');
			add_option('wpsocial_stream_googleplus_display_name','');
			add_option('wpsocial_stream_googleplus_display_message','');
			add_option('wpsocial_stream_googleplus_display_link','');   
			add_option('wpsocial_stream_googleplus_display_image','');
			add_option('wpsocial_stream_googleplus_display_time','');
			
			add_option('wpsocial_stream_youtube_channel',''); 
			add_option('wpsocial_stream_youtube_post_limit','');
			add_option('wpsocial_stream_youtube_display_name','');
			add_option('wpsocial_stream_youtube_display_message','');
			add_option('wpsocial_stream_youtube_display_link','');   
			add_option('wpsocial_stream_youtube_display_image','');
			add_option('wpsocial_stream_youtube_display_time','');
			
			add_option('wpsocial_stream_dribble_user',''); 
			add_option('wpsocial_stream_dribble_access_token',''); 
			add_option('wpsocial_stream_dribble_post_limit','');
			add_option('wpsocial_stream_dribble_display_name','');
			add_option('wpsocial_stream_dribble_display_message','');
			add_option('wpsocial_stream_dribble_display_link','');   
			add_option('wpsocial_stream_dribble_display_image','');
			add_option('wpsocial_stream_dribble_display_time','');
			
			add_option('wpsocial_stream_vimeo_vimeoname','');
			add_option('wpsocial_stream_vimeo_post_limit','');
			add_option('wpsocial_stream_vimeo_display_name','');
			add_option('wpsocial_stream_vimeo_display_title','');
			add_option('wpsocial_stream_vimeo_display_link','');   
			add_option('wpsocial_stream_vimeo_display_image','');
			add_option('wpsocial_stream_vimeo_display_time','');
			add_option('wpsocial_stream_vimeo_display_duration','');
			
			add_option('wpsocial_stream_stumbleupon_name','');
			add_option('wpsocial_stream_stumbleupon_post_limit','');
			add_option('wpsocial_stream_stumbleupon_display_name','');
			add_option('wpsocial_stream_stumbleupon_display_title','');
			add_option('wpsocial_stream_stumbleupon_display_link','');   
			add_option('wpsocial_stream_stumbleupon_display_image','');
			add_option('wpsocial_stream_stumbleupon_display_time','');
			add_option('wpsocial_stream_stumbleupon_display_view','');
			
			add_option('wpsocial_stream_tumblr_name','');
			add_option('wpsocial_stream_tumblr_post_limit','');
			add_option('wpsocial_stream_tumblr_display_name','');
			add_option('wpsocial_stream_tumblr_display_title','');
			add_option('wpsocial_stream_tumblr_display_link','');   
			add_option('wpsocial_stream_tumblr_display_image','');
			add_option('wpsocial_stream_tumblr_display_time','');
			
			add_option('wpsocial_stream_instagram_accesstoken','');
			add_option('wpsocial_stream_instagram_post_limit','');
			add_option('wpsocial_stream_instagram_display_name','');
			add_option('wpsocial_stream_instagram_display_link','');   
			add_option('wpsocial_stream_instagram_display_image','');
			add_option('wpsocial_stream_instagram_display_time','');
			
			add_option('wpsocial_stream_rss_urls','');
			add_option('wpsocial_stream_rss_post_limit','');
			add_option('wpsocial_stream_rss_display_name','');
			add_option('wpsocial_stream_rss_display_description','');
			add_option('wpsocial_stream_rss_display_title','');
			add_option('wpsocial_stream_rss_display_link','');   
			add_option('wpsocial_stream_rss_display_image','');
			add_option('wpsocial_stream_rss_display_time','');
			
			add_option('wpsocial_stream_setting_colormode','');
			add_option('wpsocial_stream_setting_orderby',''); 
			
			add_option('wpsocial_stream_setting_window','');
			add_option('wpsocial_stream_setting_customcss','');
			add_option('wpsocial_stream_setting_caching','');
			
			//fixed width options
			add_option('wpsocial_stream_setting_fixedwidth','');  
			add_option('wpsocial_stream_setting_postwidth','');
			add_option('wpsocial_stream_setting_post_margin_top','');
			add_option('wpsocial_stream_setting_post_margin_right','');
			add_option('wpsocial_stream_setting_post_margin_bottom','');
			add_option('wpsocial_stream_setting_post_margin_left','');		
			
		}
		
	}//end of class
	
}


// Instantiate the class
$easySocialStream = new EasySocialStream; 

include_once('admin/functions.php');
include_once('shortcode.php');
	
?>