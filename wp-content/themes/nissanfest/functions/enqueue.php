<?php 
function theme_styles() {
	wp_enqueue_style( 'theme_css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_styles');

function theme_js() {
	global $wp_scripts;
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/nf.min.js');
}
add_action( 'wp_enqueue_scripts', 'theme_js');
?>