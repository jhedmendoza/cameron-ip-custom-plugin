<?php

if (!defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action('template_redirect', 'cameron_get_user_location');
add_action('wp_head', 'js_inline_script');

function cameron_get_user_location() {
    if ( !isset($_SESSION['user_country_code']) && empty($_SESSION['user_country_code']) ) {
        $user_location = cameron_get_detected_location();
        $_SESSION['user_country_code'] = $user_location;
    }
}

?>