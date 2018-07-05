<?php 
if(isset($_POST['wpsocial_stream_tumblr_name'])){
	
	update_option('wpsocial_stream_tumblr_enable',$_POST['wpsocial_stream_tumblr_enable']);	
	update_option('wpsocial_stream_tumblr_name',$_POST['wpsocial_stream_tumblr_name']);
	update_option('wpsocial_stream_tumblr_post_limit',$_POST['wpsocial_stream_tumblr_post_limit']);
	update_option('wpsocial_stream_tumblr_display_name',$_POST['wpsocial_stream_tumblr_display_name']);
	update_option('wpsocial_stream_tumblr_display_title',$_POST['wpsocial_stream_tumblr_display_title']);
	update_option('wpsocial_stream_tumblr_display_link',$_POST['wpsocial_stream_tumblr_display_link']);
	update_option('wpsocial_stream_tumblr_display_image',$_POST['wpsocial_stream_tumblr_display_image']);
	update_option('wpsocial_stream_tumblr_display_time',$_POST['wpsocial_stream_tumblr_display_time']);
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

$wpsocial_stream_tumblr_enable = get_option('wpsocial_stream_tumblr_enable');
$wpsocial_stream_tumblr_name = get_option('wpsocial_stream_tumblr_name');
$wpsocial_stream_tumblr_post_limit = get_option('wpsocial_stream_tumblr_post_limit');
$wpsocial_stream_tumblr_display_name = get_option('wpsocial_stream_tumblr_display_name');
$wpsocial_stream_tumblr_display_title = get_option('wpsocial_stream_tumblr_display_title');
$wpsocial_stream_tumblr_display_link = get_option('wpsocial_stream_tumblr_display_link');
$wpsocial_stream_tumblr_display_image = get_option('wpsocial_stream_tumblr_display_image');
$wpsocial_stream_tumblr_display_time = get_option('wpsocial_stream_tumblr_display_time');
?>

<div class="wrap">
<style>
form.add_credential_form p label{
	width:250px;
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

<?php if(isset($_POST['wpsocial_stream_tumblr_name'])){?>

	<div class="notice notice-success is-dismissible">
        <p><?php esc_attr_e('Your settings were updated','easySocialStream'); ?></p>
    </div>
    
<?php } ?>	

<h2><?php esc_attr_e('Easy Social Stream - Tumblr Settings', 'easySocialStream'); ?></h2>

<hr />

<form action=""  method="post" class="add_credential_form" enctype="multipart/form-data">

	<p>
    <label><?php esc_attr_e('Enable Tumblr Stream?', 'easySocialStream'); ?></label> 
    <select name="wpsocial_stream_tumblr_enable">
        <option value="1" <?php if($wpsocial_stream_tumblr_enable == 1){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
        <option value="0" <?php if($wpsocial_stream_tumblr_enable == 0){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
    </select>
    
    <span class="wpsocial-stream-help-text"><b><?php esc_attr_e('NOTE', 'easySocialStream'); ?>: </b>
		<?php esc_attr_e('this option can be overridden with the', 'easySocialStream'); ?>        
        <strong>display_tumblr</strong>        
        <?php esc_attr_e('shortcode parameter.', 'easySocialStream'); ?>         
    </span>
    </p>

    <p>
    <label><?php esc_attr_e('Username', 'easySocialStream'); ?></label>
    <input type="text" name="wpsocial_stream_tumblr_name" value="<?php esc_attr_e($wpsocial_stream_tumblr_name); ?>" />
    </p>
    
    <hr />
        
    <p><strong><?php esc_attr_e('Content to include in stream output:', 'easySocialStream'); ?></strong></p>
    
    <p>
    <label><?php esc_attr_e('Post Limit', 'easySocialStream'); ?></label> 
    <input type="text" name="wpsocial_stream_tumblr_post_limit" maxlength="3" class="small-field" value="<?php esc_attr_e($wpsocial_stream_tumblr_post_limit); ?>" />
    <span class="wpsocial-stream-help-text"><?php esc_attr_e('Set the number of posts you wish to display - this value is required.', 'easySocialStream'); ?></span>
    </p>
    
    <p>
    <label><?php esc_attr_e('Display Name?', 'easySocialStream'); ?></label> 
    <select name="wpsocial_stream_tumblr_display_name">
        <option value="1" <?php if($wpsocial_stream_tumblr_display_name==1){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
        <option value="0" <?php if($wpsocial_stream_tumblr_display_name==0){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
    </select>
    </p>
    
    <p>
    <label><?php esc_attr_e('Display Title?', 'easySocialStream'); ?></label> 
    <select name="wpsocial_stream_tumblr_display_title">
        <option value="1" <?php if($wpsocial_stream_tumblr_display_title==1){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
        <option value="0" <?php if($wpsocial_stream_tumblr_display_title==0){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
    </select>
    </p>
    
    <p>
    <label><?php esc_attr_e('Display Link?', 'easySocialStream'); ?></label> 
    <select name="wpsocial_stream_tumblr_display_link">
        <option value="1" <?php if($wpsocial_stream_tumblr_display_link==1){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
        <option value="0" <?php if($wpsocial_stream_tumblr_display_link==0){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
    </select>
    </p>
    
    <p>
    <label><?php esc_attr_e('Display Image?', 'easySocialStream'); ?></label> 
    <select name="wpsocial_stream_tumblr_display_image">
        <option value="1" <?php if($wpsocial_stream_tumblr_display_image==1){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
        <option value="0" <?php if($wpsocial_stream_tumblr_display_image==0){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
    </select>
    </p>
    
    <p>
    <label><?php esc_attr_e('Display Time?', 'easySocialStream'); ?></label> 
    <select name="wpsocial_stream_tumblr_display_time">
        <option value="1" <?php if($wpsocial_stream_tumblr_display_time==1){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
        <option value="0" <?php if($wpsocial_stream_tumblr_display_time==0){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
    </select>
    </p>
    
    <p><input type="submit" class="button button-primary button-large" Value="<?php esc_attr_e('Save Settings', 'easySocialStream'); ?>" /></p>
    
</form>

</div>

