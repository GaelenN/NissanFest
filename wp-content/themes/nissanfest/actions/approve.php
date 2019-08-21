<?php 
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] ); 
require_once( $parse_uri[0] . 'wp-load.php' );

$data = array();
foreach ($_POST as $key => $value) {
    $data[$key] = $value;
}

if($data['compare']):
$meta_query = array(
    'relation' => 'OR',
    array(
        'key' => $data['key'],
        'value' => $data['compare'],
        'compare' => 'LIKE',
    ),
);
endif;
if($data['post_ID']):
    $single_ID = $data['post_ID'];
endif;

$posts = new WP_Query(
    array(
        'post_type' => $data['post_type'],
        'p' => $single_ID,
        'meta_query' => $meta_query,
    )
);
$i = 0;
while( $posts->have_posts() ):
    $posts->the_post();
        $i++;
        $data['ID'][$i] = $post->ID;
endwhile;
wp_reset_postdata();
if( $data['post_type'] === 'team-tandem' ){
    $fieldID = 'field_5d56dab3e17e9';
}
if( $data['post_type'] === 'media' ){
    $fieldID = 'field_5d56f315a32fb';
}
if( $data['post_type'] === 'vendor' ){
    $fieldID = 'field_5d5b14ff08ae1';
}

foreach ($data['ID'] as $value) {
    update_field($fieldID, array('approved' => true), $value);  // Approved
}

$email = '';
$email .= '<h2>NissanFest '.ucfirst($data['post_type']).' '.date("Y").' Approval</h2>';
$email .= '<h4>'. $data['name'] .',</h4>';
$email .= '<p>You have been approved for '.ucfirst($data['post_type']).'!</p>';
$email .= '<p>Please make your <a href="'. esc_url( get_permalink($postID) ) .'">payment</a> to confirm your spot.</p>';
$email .= '<p>If you have any further questions please respond to this email and we\'ll answer them ASAP</p>';
$email .= '<a href="'. esc_url( get_permalink($postID) ) .'">Make Payment</a>';


$to = $data['email'];
$subject = 'NissanFest '. date('Y').' '.ucfirst($data['post_type']).' Approval';
$headers[] = '';
wp_mail( $to, $subject, $email, $headers );

echo json_encode( $data );