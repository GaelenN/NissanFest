<?php 
function theme_styles() {
	wp_enqueue_style( 'theme_css', get_template_directory_uri() . '/css/style.css', array() , filemtime(get_template_directory() . '/css/style.css') );
	wp_register_style( 'nf_front', get_template_directory_uri() . '/css/pages/front_page.css', array() , filemtime(get_template_directory() . '/css/pages/front_page.css') );
	wp_register_style( 'nf_entrants', get_template_directory_uri() . '/css/pages/entrants.css', array() , filemtime(get_template_directory() . '/css/pages/entrants.css') );
	wp_register_style( 'nf_media', get_template_directory_uri() . '/css/pages/media.css', array() , filemtime(get_template_directory() . '/css/pages/media.css') );
	wp_register_style( 'nf_soon', get_template_directory_uri() . '/css/partials/comingsoon.css', array() , filemtime(get_template_directory() . '/css/partials/comingsoon.css') );
	wp_register_style( 'nf_driver', get_template_directory_uri() . '/css/single/driver.css', array() , filemtime(get_template_directory() . '/css/single/driver.css') );
}
add_action( 'wp_enqueue_scripts', 'theme_styles');

function theme_js() {
	global $wp_scripts;
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/nf.min.js', array() , filemtime(get_template_directory() . '/js/nf.min.js'));
}
add_action( 'wp_enqueue_scripts', 'theme_js');
?>