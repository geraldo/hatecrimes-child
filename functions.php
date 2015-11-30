<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
  	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );	

  	/*if ( is_page_template( 'map-template.php' ) ) {
		wp_enqueue_style('leaflet-css', get_template_directory_uri() . '-child/mapa/lib/leaflet.css');
		wp_enqueue_style('map-css', get_template_directory_uri() . '-child/mapa/style.css');
		wp_enqueue_style('markercluster-css', get_template_directory_uri() . '-child/mapa/lib/MarkerCluster.css');
		wp_enqueue_style('markercluster-default-css', get_template_directory_uri() . '-child/mapa/lib/MarkerCluster.Default.css');
		//wp_enqueue_script('leaflet-js', get_template_directory_uri() . '-child/mapa/lib/leaflet.js');
		//wp_enqueue_script('leaflet-markercluster-js', get_template_directory_uri() . '-child/mapa/lib/leaflet.markercluster.js');
		//wp_enqueue_script('date-js', get_template_directory_uri() . '-child/mapa/lib/date.format.js');
		//wp_enqueue_script('map-js', get_template_directory_uri() . '-child/mapa/map.js');
  	}*/
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
add_filter( 'radio-buttons-for-taxonomies-no-term-sentence_type', '__return_FALSE' );
add_filter( 'radio-buttons-for-taxonomies-no-term-delict', '__return_FALSE' );

?>
