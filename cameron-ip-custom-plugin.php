<?php
/*
Plugin Name: CameronIP Custom Plugin
Description: Plugin for getting user location.
Version: 1.0
Author: Hybrid Anchor
Author URI: https://www.hybridanchor.com/
*/

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

if ( !class_exists('CameronIP') ) :

class CameronIP {

	/** @var string The plugin version number. */

	var $version = '1';


	function __construct() {}

	function initialize() {

		switch ($_SERVER['SERVER_NAME']) {

			case 'cameron-ip.local':
				$this->define('ENV', 'local');
			break;

			case 'staging2.cameronintellectualproperty.com':
				$this->define('ENV', 'staging');
			break;

			default:
				$this->define('ENV', 'prod');
			break;
		}

		// Define constants.
		$this->define('CAMERONIP_PATH', plugin_dir_path( __FILE__ ) );
		$this->define('CAMERONIP_DIR_URL', plugin_dir_url( __FILE__ ) );
		$this->define('CAMERONIP_BASENAME', plugin_basename( __FILE__ ) );
		$this->define('CAMERONIP_VERSION', $this->version );

		//Include libraries
		require_once(CAMERONIP_PATH.'includes/lib/vendor/autoload.php');

		// Include utility functions.
		require_once(CAMERONIP_PATH.'includes/utility-function.php');

		//Include controllers.
        require_once(CAMERONIP_PATH.'includes/controllers/user.php');

		//Include core.
		cameron_include('includes/cameron-assets.php');
 	}


	function define( $name, $value = true ) {

		if( !defined($name) ) {
			define( $name, $value );
		}
	}

}


function cameronIP() {

	global $cameron;

	// Instantiate only once.
	if( !isset($cameron) ) {
		$cameron = new CameronIP();
		$cameron->initialize();
	}

	return $cameron;

 }

 cameronIP();

endif; // class_exists check

