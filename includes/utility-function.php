<?php
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

// Globals.
global $__instances;

// Initialize placeholders.
$__instances = array();

function cameron_new_instances( $class = '' ) {
	global $__instances;
	return $__instances[ $class ] = new $class();
}

function cameron_get_path( $filename = '' ) {
	return CAMERONIP_PATH . ltrim($filename, '/');
}

function cameron_include( $filename = '', $attributes='') {
	$file_path = cameron_get_path($filename);
	if( file_exists($file_path) ) {
		include_once($file_path);
	}
}

function cameron_get_user_ip_address()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function cameron_get_detected_location() {
	
	$ip = cameron_get_user_ip_address();
	$ip_address = (ENV == 'local') ? '161.49.193.234' : $ip;
	$db = new \IP2Location\Database(cameron_get_path('includes/lib/vendor/ip2location/ip2location-php/databases/IP2LOCATION-LITE-DB1.BIN'), \IP2Location\Database::FILE_IO);
	$country_code = $db->lookup($ip_address, \IP2Location\Database::COUNTRY_CODE);
	return $country_code;
}

