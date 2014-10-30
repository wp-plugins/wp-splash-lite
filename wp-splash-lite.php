<?php
/*
Plugin Name: WP Splash Lite
Description: Loads up a splash page, create your splash-page in the template folder named "splash-page.php", only admins can see the template. To unlock splash, visit: example.com/?splash=off
Version: 1.0.4
Author: Jacob Slomp (JS-Systems)
Author URI: http://www.JS-Systems.nl
Plugin URI: http://www.js-systems.nl/wp-plugins/wp-splash-lite/
License: GPLv2 or later

*/

if($_GET['splash'] == 'off'){
	setcookie('splash','off', null, '/' );
	$_COOKIE['splash'] = 'off';
	$_SERVER['REQUEST_URI'] = str_replace('?splash=off','?',$_SERVER['REQUEST_URI']);
	$_SERVER['REQUEST_URI'] = str_replace('&splash=off','',$_SERVER['REQUEST_URI']);
	if(substr($_SERVER['REQUEST_URI'] , -1) == "?"){
		$_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'] ,0, -1);
	}
	header('location: '.$_SERVER['REQUEST_URI'].'');
	exit();
}

function SplashPage(){
if ( ! is_super_admin() && strpos($_SERVER['REQUEST_URI'], '/wp-login.php') === false && strpos($_SERVER['REQUEST_URI'], '/wp-admin') === false && $_COOKIE['splash'] != 'off') {
	$path = get_template_directory();
	if(file_exists($path.'/splash-page.template.php')){
		include($path.'/splash-page.template.php');
		exit();
	} else {
		$dir = dirname(__FILE__);
		include($dir."/splash-page.template.php");
		exit();
	}
}
}
add_action('init','SplashPage');