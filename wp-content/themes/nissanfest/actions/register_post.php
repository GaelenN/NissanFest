<?php 
// Create post object
$my_post = array(
    'post_title'    =>"Gaelen",
    'post_content'  => "content ",
    'post_status'   => 'publish',
    'post_type' => 'entrant'
  );
   
  // Insert the post into the database
  wp_insert_post( $my_post );
?>