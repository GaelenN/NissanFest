<?php 
function nf_event_taxonomy() {

    register_taxonomy(
        'nissanfest-events',
        'driver',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'nissanfest-events' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'nf_event_taxonomy' );
?>