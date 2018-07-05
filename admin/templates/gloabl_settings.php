<?php 
if(isset($_POST['wpsocial_stream_setting_colormode'])){
	update_option('wpsocial_stream_setting_colormode',$_POST['wpsocial_stream_setting_colormode']);
	update_option('wpsocial_stream_setting_orderby',$_POST['wpsocial_stream_setting_orderby']);
	update_option('wpsocial_stream_setting_animation_speed',$_POST['wpsocial_stream_setting_animation_speed']);	
	update_option('wpsocial_stream_setting_window',$_POST['wpsocial_stream_setting_window']);
	update_option('wpsocial_stream_setting_customcss',$_POST['wpsocial_stream_setting_customcss']);
	update_option('wpsocial_stream_setting_caching',$_POST['wpsocial_stream_setting_caching']);
	update_option('wpsocial_stream_setting_filter',$_POST['wpsocial_stream_setting_filter']);	
	update_option('wpsocial_stream_setting_custom_post_bg_color',$_POST['wpsocial_stream_setting_custom_post_bg_color']);
	update_option('wpsocial_stream_setting_custom_post_panel_color',$_POST['wpsocial_stream_setting_custom_post_panel_color']);
	update_option('wpsocial_stream_setting_custom_post_panel_font_color',$_POST['wpsocial_stream_setting_custom_post_panel_font_color']);
	update_option('wpsocial_stream_setting_custom_post_content_color',$_POST['wpsocial_stream_setting_custom_post_content_color']);	
	update_option('wpsocial_stream_setting_filter_border_radius',$_POST['wpsocial_stream_setting_filter_border_radius']);
	update_option('wpsocial_stream_setting_filter_button_bg_color',$_POST['wpsocial_stream_setting_filter_button_bg_color']);
	update_option('wpsocial_stream_setting_filter_view_all_button_bg_color',$_POST['wpsocial_stream_setting_filter_view_all_button_bg_color']);
		
	
	//fixed width options
	update_option('wpsocial_stream_setting_fixedwidth',$_POST['wpsocial_stream_setting_fixedwidth']);	
	update_option('wpsocial_stream_setting_postwidth',$_POST['wpsocial_stream_setting_postwidth']);
	update_option('wpsocial_stream_setting_post_margin_top',$_POST['wpsocial_stream_setting_post_margin_top']);
	update_option('wpsocial_stream_setting_post_margin_right',$_POST['wpsocial_stream_setting_post_margin_right']);
	update_option('wpsocial_stream_setting_post_margin_bottom',$_POST['wpsocial_stream_setting_post_margin_bottom']);
	update_option('wpsocial_stream_setting_post_margin_left',$_POST['wpsocial_stream_setting_post_margin_left']);
	
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

$wpsocial_stream_setting_colormode = get_option('wpsocial_stream_setting_colormode');
$wpsocial_stream_setting_orderby = get_option('wpsocial_stream_setting_orderby');
$wpsocial_stream_setting_animation_speed = get_option('wpsocial_stream_setting_animation_speed');
$wpsocial_stream_setting_window = get_option('wpsocial_stream_setting_window');
$wpsocial_stream_setting_customcss = get_option('wpsocial_stream_setting_customcss');
$wpsocial_stream_setting_caching = get_option('wpsocial_stream_setting_caching');
$wpsocial_stream_setting_filter = get_option('wpsocial_stream_setting_filter');

$wpsocial_stream_setting_custom_post_bg_color = get_option('wpsocial_stream_setting_custom_post_bg_color');
$wpsocial_stream_setting_custom_post_panel_color = get_option('wpsocial_stream_setting_custom_post_panel_color');
$wpsocial_stream_setting_custom_post_panel_font_color = get_option('wpsocial_stream_setting_custom_post_panel_font_color');
$wpsocial_stream_setting_custom_post_content_color = get_option('wpsocial_stream_setting_custom_post_content_color');

$wpsocial_stream_setting_filter_border_radius = get_option('wpsocial_stream_setting_filter_border_radius');
$wpsocial_stream_setting_filter_button_bg_color = get_option('wpsocial_stream_setting_filter_button_bg_color');
$wpsocial_stream_setting_filter_view_all_button_bg_color = get_option('wpsocial_stream_setting_filter_view_all_button_bg_color');


//fixed width options
$wpsocial_stream_setting_fixedwidth = get_option('wpsocial_stream_setting_fixedwidth');
$wpsocial_stream_setting_postwidth = get_option('wpsocial_stream_setting_postwidth');
$wpsocial_stream_setting_post_margin_top = get_option('wpsocial_stream_setting_post_margin_top');
$wpsocial_stream_setting_post_margin_right = get_option('wpsocial_stream_setting_post_margin_right');
$wpsocial_stream_setting_post_margin_bottom = get_option('wpsocial_stream_setting_post_margin_bottom');
$wpsocial_stream_setting_post_margin_left = get_option('wpsocial_stream_setting_post_margin_left');

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

	<?php if(isset($_POST['wpsocial_stream_setting_colormode'])){?>
    
        <div class="notice notice-success is-dismissible">
            <p><?php esc_attr_e('Your settings were updated','easySocialStream'); ?></p>
        </div>
        
    <?php } ?>	

	<h2><?php esc_attr_e('Easy Social Stream - Global Settings', 'easySocialStream'); ?></h2>

	<hr />

	<?php esc_attr_e('Use shortcode', 'easySocialStream'); ?> <strong>[easy_social_stream]</strong> <?php esc_attr_e('to display your social stream', 'easySocialStream'); ?>.

	<p><a href="#" id="wpsocial-shortcode-options"><?php esc_attr_e('View Shortcode Options', 'easySocialStream'); ?></a></p>

    <div class="wpsocial-shortcode-options-container" id="wpsocial-shortcode-options-container">
    
        <p><?php esc_attr_e('You can use the following shortcode parameters to override global options - this is useful if you want to display social streams on multiple pages with different configurations.', 'easySocialStream'); ?></p>
        
        <pre class="wpsocial-shortcode-parameter">display_filter="yes"</pre>
        <p><?php esc_attr_e('The', 'easySocialStream'); ?> <strong>display_filter</strong> <?php esc_attr_e('parameter accepts a value of', 'easySocialStream'); ?> <strong>yes</strong> <?php esc_attr_e('or', 'easySocialStream'); ?> <strong>no</strong> <?php esc_attr_e('and is used to enable or disable the filter menu.', 'easySocialStream'); ?> </p>
        
        <div class="wpsocial-content-divider"></div>
        
        <pre class="wpsocial-shortcode-parameter">post_color_mode="Classic"</pre>
        <p><?php esc_attr_e('The', 'easySocialStream'); ?> <strong>post_color_mode</strong> <?php esc_attr_e('parameter accepts 1 of 4 values:', 'easySocialStream'); ?> <strong>Classic</strong>, <strong>Light</strong>, <strong>Dark</strong> or <strong>Custom</strong>. <?php esc_attr_e('Use this parameter to change the color styling of the posts.', 'easySocialStream'); ?> </p>
        
        <div class="wpsocial-content-divider"></div>
        
        <pre class="wpsocial-shortcode-parameter">display_facebook="yes"</pre>
        <p><?php esc_attr_e('The', 'easySocialStream'); ?> <strong>display_facebook</strong> <?php esc_attr_e('parameter accepts a value of', 'easySocialStream'); ?> <strong>yes</strong> <?php esc_attr_e('or', 'easySocialStream'); ?> <strong>no</strong> <?php esc_attr_e('and is used to enable or disable the Facebook stream.', 'easySocialStream'); ?></p>
        
        <div class="wpsocial-content-divider"></div>
        
        <pre class="wpsocial-shortcode-parameter">display_twitter="yes"</pre>
        <p><?php esc_attr_e('The', 'easySocialStream'); ?> <strong>display_twitter</strong> <?php esc_attr_e('parameter accepts a value of', 'easySocialStream'); ?> <strong>yes</strong> <?php esc_attr_e('or', 'easySocialStream'); ?> <strong>no</strong> <?php esc_attr_e('and is used to enable or disable the Twitter stream.', 'easySocialStream'); ?></p>
        
        <div class="wpsocial-content-divider"></div>
        
        <pre class="wpsocial-shortcode-parameter">display_google="yes"</pre>
        <p><?php esc_attr_e('The', 'easySocialStream'); ?> <strong>display_google</strong> <?php esc_attr_e('parameter accepts a value of', 'easySocialStream'); ?> <strong>yes</strong> <?php esc_attr_e('or', 'easySocialStream'); ?> <strong>no</strong> <?php esc_attr_e('and is used to enable or disable the Google + stream.', 'easySocialStream'); ?></p>
        
        <div class="wpsocial-content-divider"></div>
        
        <pre class="wpsocial-shortcode-parameter">display_youtube="yes"</pre>
        <p><?php esc_attr_e('The', 'easySocialStream'); ?> <strong>display_youtube</strong> <?php esc_attr_e('parameter accepts a value of', 'easySocialStream'); ?> <strong>yes</strong> <?php esc_attr_e('or', 'easySocialStream'); ?> <strong>no</strong> <?php esc_attr_e('and is used to enable or disable the Youtube stream.', 'easySocialStream'); ?></p>
        
        <div class="wpsocial-content-divider"></div>
        
        <pre class="wpsocial-shortcode-parameter">display_dribbble="yes"</pre>
        <p><?php esc_attr_e('The', 'easySocialStream'); ?> <strong>display_dribbble</strong> <?php esc_attr_e('parameter accepts a value of', 'easySocialStream'); ?> <strong>yes</strong> <?php esc_attr_e('or', 'easySocialStream'); ?> <strong>no</strong> <?php esc_attr_e('and is used to enable or disable the Dribble stream.', 'easySocialStream'); ?></p>
        
        <div class="wpsocial-content-divider"></div>
        
        <pre class="wpsocial-shortcode-parameter">display_vimeo="yes"</pre>
        <p><?php esc_attr_e('The', 'easySocialStream'); ?> <strong>display_vimeo</strong> <?php esc_attr_e('parameter accepts a value of', 'easySocialStream'); ?> <strong>yes</strong> <?php esc_attr_e('or', 'easySocialStream'); ?> <strong>no</strong> <?php esc_attr_e('and is used to enable or disable the Vimeo stream.', 'easySocialStream'); ?></p>
        
        <div class="wpsocial-content-divider"></div>
        
        <pre class="wpsocial-shortcode-parameter">display_stumbleupon="yes"</pre>
        <p><?php esc_attr_e('The', 'easySocialStream'); ?> <strong>display_stumbleupon</strong> <?php esc_attr_e('parameter accepts a value of', 'easySocialStream'); ?> <strong>yes</strong> <?php esc_attr_e('or', 'easySocialStream'); ?> <strong>no</strong> <?php esc_attr_e('and is used to enable or disable the Stumbleupon stream.', 'easySocialStream'); ?></p>
        
        <div class="wpsocial-content-divider"></div>
        
        <pre class="wpsocial-shortcode-parameter">display_tumblr="yes"</pre>
        <p><?php esc_attr_e('The', 'easySocialStream'); ?> <strong>display_tumblr</strong> <?php esc_attr_e('parameter accepts a value of', 'easySocialStream'); ?> <strong>yes</strong> <?php esc_attr_e('or', 'easySocialStream'); ?> <strong>no</strong> <?php esc_attr_e('and is used to enable or disable the Tumblr stream.', 'easySocialStream'); ?></p>
        
        <div class="wpsocial-content-divider"></div>
        
        <pre class="wpsocial-shortcode-parameter">display_instagram="yes"</pre>
        <p><?php esc_attr_e('The', 'easySocialStream'); ?> <strong>display_instagram</strong> <?php esc_attr_e('parameter accepts a value of', 'easySocialStream'); ?> <strong>yes</strong> <?php esc_attr_e('or', 'easySocialStream'); ?> <strong>no</strong> <?php esc_attr_e('and is used to enable or disable the Instagram stream.', 'easySocialStream'); ?></p>
        
        <div class="wpsocial-content-divider"></div>
        
        <pre class="wpsocial-shortcode-parameter">display_rss="yes"</pre>
        <p><?php esc_attr_e('The', 'easySocialStream'); ?> <strong>display_rss</strong> <?php esc_attr_e('parameter accepts a value of', 'easySocialStream'); ?>  <strong>yes</strong> <?php esc_attr_e('or', 'easySocialStream'); ?> <strong>no</strong> <?php esc_attr_e('and is used to enable or disable the RSS stream.', 'easySocialStream'); ?></p>
        
        <div class="wpsocial-content-divider"></div>
        
        <p><?php esc_attr_e('These shortcode parameters can be used in any combination you desire. The following shortcode sample is configured to display only two social streams and the filter menu with a classic mode color setting:', 'easySocialStream'); ?></p>
        
        <pre>[easy_social_stream display_filter="yes" post_color_mode="Classic" display_twitter="no" display_facebook="no" display_vimeo="no" display_tumblr="no" display_stumbleupon="no" display_rss="no" display_google="no" display_dribbble="no" display_instagram="yes" display_youtube="yes"]</pre>
    
    </div>

	<hr />


    <form action=""  method="post" class="add_credential_form" enctype="multipart/form-data">
    <p>
    <label><?php esc_attr_e('Post Color Mode', 'easySocialStream'); ?></label> 
    <select name="wpsocial_stream_setting_colormode" id="wpsocial_stream_setting_colormode">
        <option value="Classic" <?php if($wpsocial_stream_setting_colormode=='Classic'){echo "selected"; }?>><?php esc_attr_e('Classic', 'easySocialStream'); ?></option>
        <option value="Dark" <?php if($wpsocial_stream_setting_colormode=='Dark'){echo "selected"; }?>><?php esc_attr_e('Dark', 'easySocialStream'); ?></option>
        <option value="Light" <?php if($wpsocial_stream_setting_colormode=='Light'){echo "selected"; }?>><?php esc_attr_e('Light', 'easySocialStream'); ?></option>
        <option value="Custom" <?php if($wpsocial_stream_setting_colormode=='Custom'){echo "selected"; }?>><?php esc_attr_e('Custom', 'easySocialStream'); ?></option>
    </select>
    
    <span class="wpsocial-stream-help-text">
    <?php esc_attr_e('NOTE: This option can be overriden with the ', 'easySocialStream'); ?>
    <strong>post_color_mode</strong>
	<?php esc_attr_e('shortcode parameter.', 'easySocialStream'); ?>
    </span>

    
    <div class="wpsocial-stream-setting-post-custom-colors <?php echo $wpsocial_stream_setting_colormode == 'Custom' ? 'active' : ''; ?>" id="wpsocial-stream-setting-post-custom-colors">
    
    <hr />
    
    <p><strong><?php esc_attr_e('Post Color Options', 'easySocialStream'); ?>:</strong></p>
    
    	<p><?php esc_attr_e('Post Background Color', 'easySocialStream'); ?></p>
    	<input type="text" value="<?php esc_attr_e($wpsocial_stream_setting_custom_post_bg_color); ?>" name="wpsocial_stream_setting_custom_post_bg_color" class="wpsocial-color-field" data-default-color="#ffffff" />
        
        <p><?php esc_attr_e('Post Content Color', 'easySocialStream'); ?></p>
    	<input type="text" value="<?php esc_attr_e($wpsocial_stream_setting_custom_post_content_color); ?>" name="wpsocial_stream_setting_custom_post_content_color" class="wpsocial-color-field" data-default-color="#ffffff" />
        
        <p><?php esc_attr_e('Post Panel Color', 'easySocialStream'); ?></p>
    	<input type="text" value="<?php esc_attr_e($wpsocial_stream_setting_custom_post_panel_color); ?>" name="wpsocial_stream_setting_custom_post_panel_color" class="wpsocial-color-field" data-default-color="#ffffff" />
        
        <p><?php esc_attr_e('Post Panel Font Color', 'easySocialStream'); ?></p>
    	<input type="text" value="<?php esc_attr_e($wpsocial_stream_setting_custom_post_panel_font_color); ?>" name="wpsocial_stream_setting_custom_post_panel_font_color" class="wpsocial-color-field" data-default-color="#ffffff" />
        
    <hr />
    
    </div><!-- /.wpsocial-stream-setting-custom-colors -->
    
    </p>
    
    <p>
    <label><?php esc_attr_e('Order By', 'easySocialStream'); ?></label> 
    <select name="wpsocial_stream_setting_orderby">
        <option value="Posted" <?php if($wpsocial_stream_setting_orderby=='Posted'){echo "selected"; }?>><?php esc_attr_e('Date Posted', 'easySocialStream'); ?></option>
        <option value="Random" <?php if($wpsocial_stream_setting_orderby=='Random'){echo "selected"; }?>><?php esc_attr_e('Random', 'easySocialStream'); ?></option>
    </select>
    </p>
    
    <p>
        <label><?php esc_attr_e('Animation Speed', 'easySocialStream'); ?> </label>
        <input type="text" name="wpsocial_stream_setting_animation_speed" class="small-field" value="<?php esc_attr_e($wpsocial_stream_setting_animation_speed); ?>" />
        <span class="wpsocial-stream-help-text"><?php esc_attr_e('Control the posts transition speed by entering a positive integer value. A value of around 1 is recommended.', 'easySocialStream'); ?></span>
    </p>
    
    <!-- Fixed Width Settings  -->
    <p>
        <label><?php esc_attr_e('Enable Fixed Width?', 'easySocialStream'); ?></label> 
        <select name="wpsocial_stream_setting_fixedwidth" id="wpsocial_stream_setting_fixedwidth">
            <option value="no" <?php if($wpsocial_stream_setting_fixedwidth == 'no'){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
            <option value="yes" <?php if($wpsocial_stream_setting_fixedwidth == 'yes'){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
        </select>
    </p>
                
        <?php if( empty($wpsocial_stream_setting_fixedwidth) ) { ?>
    
            <div class="wp-social-stream-width-settings" id="wp-social-stream-width-settings">
        
        <?php } else { ?>
        
            <div class="wp-social-stream-width-settings <?php echo $wpsocial_stream_setting_fixedwidth === 'yes' ? 'active' : ''; ?>" id="wp-social-stream-width-settings">
        
        <?php } ?>
        
        	<hr />
            
            <p><strong><?php esc_attr_e('Fixed Width Settings:', 'easySocialStream'); ?></strong></p>
    
            <p>
            <label><?php esc_attr_e('Post Width', 'easySocialStream'); ?> </label>
            <input type="text" name="wpsocial_stream_setting_postwidth" maxlength="3" class="small-field" value="<?php esc_attr_e($wpsocial_stream_setting_postwidth); ?>" />
            </p>
        
            <p>
            <label><?php esc_attr_e('Margin Top', 'easySocialStream'); ?></label>
            <input type="text" name="wpsocial_stream_setting_post_margin_top" maxlength="3" class="small-field" value="<?php esc_attr_e($wpsocial_stream_setting_post_margin_top); ?>" />
            </p>
            
            <p>
            <label><?php esc_attr_e('Margin Right', 'easySocialStream'); ?></label>
            <input type="text" name="wpsocial_stream_setting_post_margin_right" maxlength="3" class="small-field" value="<?php esc_attr_e($wpsocial_stream_setting_post_margin_right); ?>" />
            </p>
            
            <p>
            <label><?php esc_attr_e('Margin Bottom', 'easySocialStream'); ?></label>
            <input type="text" name="wpsocial_stream_setting_post_margin_bottom" maxlength="3" class="small-field" value="<?php esc_attr_e($wpsocial_stream_setting_post_margin_bottom); ?>" />
            </p>
            
            <p>
            <label><?php esc_attr_e('Margin Left', 'easySocialStream'); ?></label>
            <input type="text" class="small-field" name="wpsocial_stream_setting_post_margin_left" maxlength="3" value="<?php esc_attr_e($wpsocial_stream_setting_post_margin_left); ?>" />
            </p>
            
            <hr />
        
        </div><!-- /.wp-social-stream-width-settings -->                        			
    
    <!-- Fixed Width Settings end -->
    
    <p>
    <label><?php esc_attr_e('Open links in new window?', 'easySocialStream'); ?></label> 
    <select name="wpsocial_stream_setting_window">
        <option value="self" <?php if($wpsocial_stream_setting_window=='self'){echo "selected"; }?>><?php esc_attr_e('No', 'easySocialStream'); ?></option>
        <option value="new" <?php if($wpsocial_stream_setting_window=='new'){echo "selected"; }?>><?php esc_attr_e('Yes', 'easySocialStream'); ?></option>
    </select>
    </p>
                
    <p><label><?php esc_attr_e('Caching', 'easySocialStream'); ?></label> 
    <select name="wpsocial_stream_setting_caching">
        <option value="1" <?php if($wpsocial_stream_setting_caching=='1'){echo "selected"; }?>><?php esc_attr_e('On', 'easySocialStream'); ?></option>
        <option value="0" <?php if($wpsocial_stream_setting_caching=='0'){echo "selected"; }?>><?php esc_attr_e('Off', 'easySocialStream'); ?></option>
    </select>
    <span class="wpsocial-stream-help-text"><?php esc_attr_e('This option enables session caching for faster load times. If this option is enabled the social stream will update every 30 minutes. You may want to disable this option while making changes.', 'easySocialStream'); ?></span>
    </p>
    
    <p>
    <label><?php esc_attr_e('Filter Menu', 'easySocialStream'); ?></label> 
    <select name="wpsocial_stream_setting_filter" id="wpsocial_stream_setting_filter">
        <option value="1" <?php if($wpsocial_stream_setting_filter=='1'){echo "selected"; }?>><?php esc_attr_e('On', 'easySocialStream'); ?></option>
        <option value="0" <?php if($wpsocial_stream_setting_filter=='0'){echo "selected"; }?>><?php esc_attr_e('Off', 'easySocialStream'); ?></option>
    </select>
    
    <div class="wpsocial-stream-setting-filter-options <?php echo $wpsocial_stream_setting_filter == '1' ? 'active' : ''; ?>" id="wpsocial-stream-setting-filter-options">
    
    <hr />
    
    	<p><strong><?php esc_attr_e('Filter Menu Options', 'easySocialStream'); ?></strong>:</p>
    
    	<p><?php esc_attr_e('Filter Button Border Radius', 'easySocialStream'); ?></p>
    	<input type="text" name="wpsocial_stream_setting_filter_border_radius" maxlength="3" class="small-field" value="<?php esc_attr_e($wpsocial_stream_setting_filter_border_radius); ?>" />
    
    	<p><?php esc_attr_e('Filter Button Background Color', 'easySocialStream'); ?></p>
    	<input type="text" value="<?php esc_attr_e($wpsocial_stream_setting_filter_button_bg_color); ?>" name="wpsocial_stream_setting_filter_button_bg_color" class="wpsocial-color-field" data-default-color="#4C4C4C" />
        
        <p><?php esc_attr_e('Filter Active Button Background Color', 'easySocialStream'); ?></p>
    	<input type="text" value="<?php esc_attr_e($wpsocial_stream_setting_filter_view_all_button_bg_color); ?>" name="wpsocial_stream_setting_filter_view_all_button_bg_color" class="wpsocial-color-field" data-default-color="#4C4C4C" />        
    
    <hr />
    
    </div><!-- /.wpsocial-stream-setting-filter-options -->
    
    </p>
    
    <p>
    <label><?php esc_attr_e('Custom CSS', 'easySocialStream'); ?></label>
    <textarea name="wpsocial_stream_setting_customcss" class="wpsocial_stream_setting_customcss"><?php esc_attr_e($wpsocial_stream_setting_customcss); ?></textarea>
    </p>
			
    <p><input type="submit" class="button button-primary button-large" Value="<?php esc_attr_e('Save Settings', 'easySocialStream'); ?>" /></p>
</form>

</div>

