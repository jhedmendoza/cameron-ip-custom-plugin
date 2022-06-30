<?php
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

add_action('wp_enqueue_scripts', 'cameron_enqueue_script');

function cameron_enqueue_script() {

	$version_script = '1';

	 //enqueue js
	 wp_enqueue_script('cameron-ip-custom-script', CAMERONIP_DIR_URL . 'assets/js/custom.js', ['jquery'], $version_script, true);
}

function js_inline_script() {
	global $post;

?>
<script type="text/javascript">
    var userCountryCode = "<?php echo $_SESSION['user_country_code'] ?>";
</script>
<?php
}