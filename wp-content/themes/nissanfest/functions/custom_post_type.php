<?php 
function create_post_type() {
	// register_post_type( 'entrant',
  //   array(
  //     'labels' => array(
  //       'name' => __( 'Entrant' ),
  //       'singular_name' => __( 'Entrants' )
  //     ),
  //     'public' => true,
  //     'has_archive' => true,
	//   'supports' => array( 'title', 'editor', 'custom-fields' ),
	//   'taxonomies' => array('nissnfest-events')
  //   )
  // );
	register_post_type( 'driver',
    array(
      'labels' => array(
        'name' => __( 'Driver' ),
        'singular_name' => __( 'Drivers' )
      ),
      'public' => true,
      'has_archive' => true,
	  'supports' => array( 'title', 'editor', 'custom-fields' ),
    'taxonomies' => array('nissnfest-events'),
    'menu_icon' => 'dashicons-performance',
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
    'menu_icon' => 'dashicons-camera'
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
    'menu_icon' => 'dashicons-tickets'
    )
  );
}
add_action( 'init', 'create_post_type' );
?>