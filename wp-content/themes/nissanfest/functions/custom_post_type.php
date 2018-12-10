<?php 
function create_post_type() {
	register_post_type( 'entrant',
    array(
      'labels' => array(
        'name' => __( 'Entrant' ),
        'singular_name' => __( 'Entrants' )
      ),
      'public' => true,
      'has_archive' => true,
	  'supports' => array( 'title', 'editor', 'custom-fields' ),
	  'taxonomies' => array('nissnfest-events')
    )
  );
	register_post_type( 'media',
    array(
      'labels' => array(
        'name' => __( 'Media' ),
        'singular_name' => __( 'Media' )
      ),
      'public' => true,
      'has_archive' => true,
	  'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
    )
  );
	register_post_type( 'vendor',
    array(
      'labels' => array(
        'name' => __( 'Vendor' ),
        'singular_name' => __( 'Vendors' )
      ),
      'public' => true,
      'has_archive' => true,
	  'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
    )
  );
}
add_action( 'init', 'create_post_type' );
?>