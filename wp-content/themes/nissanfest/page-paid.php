<?php
$email = $_GET["email"];

$find_user = array(
'post_type' => 'entrant',
'meta_query' => array(
            'key' => 'email',
            'value' => $email,
            'compare' => 'LIKE'
        )
);
query_posts($find_user); while (have_posts()) : the_post();
var_dump($post);
endwhile;
// $update_post = array(
//     'post_type' => 'entrant',
//     'meta_input' => array(
//         'paid' => true;
//     );,
// );
// wp_update_post( $my_post );
?>