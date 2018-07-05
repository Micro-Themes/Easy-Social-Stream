<?php 
global $wpdb;
if(isset($_POST['wpsocial_stream_facebook_appid'])){
	
	update_option('wpsocial_stream_facebook_enable',$_POST['wpsocial_stream_facebook_enable']);
	update_option('wpsocial_stream_facebook_appid',$_POST['wpsocial_stream_facebook_appid']);
	update_option('wpsocial_stream_facebook_appsecret',$_POST['wpsocial_stream_facebook_appsecret']);
	update_option('wpsocial_stream_facebook_post_limit',$_POST['wpsocial_stream_facebook_post_limit']);
	update_option('wpsocial_stream_facebook_display_message',$_POST['wpsocial_stream_facebook_display_message']);
	update_option('wpsocial_stream_facebook_display_link',$_POST['wpsocial_stream_facebook_display_link']);
	update_option('wpsocial_stream_facebook_display_image',$_POST['wpsocial_stream_facebook_display_image']);
	update_option('wpsocial_stream_facebook_display_time',$_POST['wpsocial_stream_facebook_display_time']);
	update_option('wpsocial_stream_facebook_pageid',$_POST['wpsocial_stream_facebook_pageid']);
	unset($_SESSION['fb_posts']); 
	unset($_SESSION['fb_posts_created']);
	unset($_SESSION['tw_posts']);
	unset($_SESSION['tw_posts_created']);
	unset($_SESSION['google_posts']);
	unset($_SESSION['google_posts_created']);
	unset($_SESSION['youtube_posts']);
	unset($_SESSION['youtube_posts_created']);
	unset($_SESSION['vimeo_posts']);
	unset($_SESSION['vimeo_posts_created']);
	unset($_SESSION['dribble_posts']);
	unset($_SESSION['dribble_posts_created']);
	unset($_SESSION['stumbleupon_posts']);
	unset($_SESSION['stumbleupon_posts_created']);
	unset($_SESSION['trumblr_posts']);
	unset($_SESSION['trumblr_posts_created']);
	unset($_SESSION['instagram_posts']);
	unset($_SESSION['instagram_posts_created']);
	unset($_SESSION['rss_posts']);
	unset($_SESSION['rss_posts_created']);
}

$wpsocial_stream_facebook_enable = get_option('wpsocial_stream_facebook_enable');
$wpsocial_stream_facebook_pageid = get_option('wpsocial_stream_facebook_pageid');
$wpsocial_stream_facebook_appid = get_option('wpsocial_stream_facebook_appid');
$wpsocial_stream_facebook_appsecret = get_option('wpsocial_stream_facebook_appsecret');
$wpsocial_stream_facebook_post_limit = get_option('wpsocial_stream_facebook_post_limit');
$wpsocial_stream_facebook_display_message = get_option('wpsocial_stream_facebook_display_message');
$wpsocial_stream_facebook_display_link = get_option('wpsocial_stream_facebook_display_link');
$wpsocial_stream_facebook_display_image = get_option('wpsocial_stream_facebook_display_image');
$wpsocial_stream_facebook_display_time = get_option('wpsocial_stream_facebook_display_time');
?><div class="wrap">
<style>
form.add_credential_form p label{
width:200px;
display:block;
float:left;
font-size:14px;
}
input[type='text'],textarea{
background-color: #fff;
    font-size: 1.7em;
    height: 1.7em;
    line-height: 100%;
    margin: 0;
    outline: 0 none;
    padding: 3px 8px;
    width: 500px;
}
textarea{
height:200px;
}
</style>
<?php if(isset($_POST['wpsocial_stream_facebook_pageid'])){?>

	<div class="notice notice-success is-dismissible">
        <p><?php esc_attr_e('Your settings were updated','easySocialStream'); ?></p>
    </div>
    
<?php } ?>	

<h2><?php esc_attr_e('Easy Social Stream - Facebook Settings', 'easySocialStream'); ?></h2>

<hr />

<p><?php esc_attr_e('Visit', 'easySocialStream'); ?> <strong><a href="https://developers.facebook.com/apps" target="_blank">https://developers.facebook.com/apps</a></strong> <?php esc_attr_e('to register your app', 'easySocialStream'); ?> </p>

<hr />

			<form action=""  method="post" class="add_credential_form" enctype="multipart/form-data">
            
            <p>
            <label><?php esc_attr_e('Enable Facebook Steam?', 'easySocialStream'); ?></label> 
            <select name="wpsocial_stream_facebook_enable">
                <option value="1" <?php if($wpsocial_stream_facebook_enable == 1){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
                <option value="0" <?php if($wpsocial_stream_facebook_enable == 0){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
            </select>
            
            <span class="wpsocial-stream-help-text facebook"><b><?php esc_attr_e('NOTE', 'easySocialStream'); ?>: </b>
				<?php esc_attr_e('this option can be overridden with the', 'easySocialStream'); ?>        
                <strong>display_facebook</strong>        
                <?php esc_attr_e('shortcode parameter.', 'easySocialStream'); ?>         
            </span>
            
            </p>
            
			<p>
            <label><?php esc_attr_e('Page ID', 'easySocialStream'); ?></label>
            <input type="text" name="wpsocial_stream_facebook_pageid" value="<?php esc_attr_e($wpsocial_stream_facebook_pageid); ?>" />
            </p>
            
			<p>
            <label><?php esc_attr_e('App ID', 'easySocialStream'); ?></label>
            <input type="text" name="wpsocial_stream_facebook_appid" value="<?php esc_attr_e($wpsocial_stream_facebook_appid); ?>" />
            </p>
            
			<p>
            <label><?php esc_attr_e('App Secret', 'easySocialStream'); ?></label> 
            <input type="text" name="wpsocial_stream_facebook_appsecret" value="<?php esc_attr_e($wpsocial_stream_facebook_appsecret); ?>" />
            </p>
            
            <hr />
        
    		<p><strong><?php esc_attr_e('Content to include in stream output:', 'easySocialStream'); ?></strong></p>
            
			<p>
            <label><?php esc_attr_e('Post Limit', 'easySocialStream'); ?></label> 
            <input type="text" name="wpsocial_stream_facebook_post_limit" maxlength="3" class="small-field" value="<?php esc_attr_e($wpsocial_stream_facebook_post_limit); ?>" />            
            <span class="wpsocial-stream-help-text facebook"><?php esc_attr_e('Set the number of posts you wish to display - this value is required.', 'easySocialStream'); ?></span>           
            </p>
            
			<p>
            <label><?php esc_attr_e('Display Message?', 'easySocialStream'); ?></label> 
            <select name="wpsocial_stream_facebook_display_message">
                <option value="1" <?php if($wpsocial_stream_facebook_display_message==1){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
                <option value="0" <?php if($wpsocial_stream_facebook_display_message==0){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
            </select>
            </p>
            
			<p>
            <label><?php esc_attr_e('Display Link?', 'easySocialStream'); ?></label> <select name="wpsocial_stream_facebook_display_link">
                <option value="1" <?php if($wpsocial_stream_facebook_display_link==1){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
                <option value="0" <?php if($wpsocial_stream_facebook_display_link==0){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
            </select>
            </p>
            
			<p>
            <label><?php esc_attr_e('Display Image?', 'easySocialStream'); ?></label> 
            <select name="wpsocial_stream_facebook_display_image">
                <option value="1" <?php if($wpsocial_stream_facebook_display_image==1){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
                <option value="0" <?php if($wpsocial_stream_facebook_display_image==0){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
            </select>
            </p>
            
			<p>
            <label><?php esc_attr_e('Display Time?', 'easySocialStream'); ?></label> 
            <select name="wpsocial_stream_facebook_display_time">
                <option value="1" <?php if($wpsocial_stream_facebook_display_time==1){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
                <option value="0" <?php if($wpsocial_stream_facebook_display_time==0){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
            </select>
            </p>
						
			<p><input type="submit" class="button button-primary button-large" Value="<?php esc_attr_e('Save Settings', 'easySocialStream'); ?>" /></p>
            
		</form>

		</div>

