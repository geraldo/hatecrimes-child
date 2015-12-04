<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
  	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );	
}

add_action('plugins_loaded', 'wan_load_textdomain');
function wan_load_textdomain() {
	load_plugin_textdomain( 'hatecrimes', false, dirname( plugin_basename(__FILE__) ) );
}

/* redirect after login */
function admin_default_page() {
  return ( '/' );
}
add_filter('login_redirect', 'admin_default_page');

/* desactivar default options */
//add_filter( 'radio-buttons-for-taxonomies-no-term-sentence_type', '__return_FALSE' );
//add_filter( 'radio-buttons-for-taxonomies-no-term-delict', '__return_FALSE' );

add_filter( 'gettext', 'change_rb4t_strings', 20, 3 );

function change_rb4t_strings( $translated_text, $text, $domain ) {

    if( 'radio-buttons-for-taxonomies' == $domain && 'No %s' == $translated_text ){
        $translated_text = __( 'unknown', 'hatecrimes' );
    }

    return $translated_text;
}

?>
