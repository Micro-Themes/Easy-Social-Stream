<?php
include(plugin_dir_path( __FILE__ ) .'../libs/facebook/inc/facebook.php'); //include facebook SDK
######### Facebook API Configuration ##########

$appId = '1789215208025049'; //Facebook App ID
$appSecret = '0a07bdc7e0a33b77834474f57dec74a2'; // Facebook App Secret
$homeurl = get_home_url()."/login";  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret

));
$fbuser = $facebook->getUser();
 
?>