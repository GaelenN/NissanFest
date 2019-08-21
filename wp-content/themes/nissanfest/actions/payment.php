<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] ); 
require_once( $parse_uri[0] . 'wp-load.php' );

$person = array();
foreach ($_POST as $key => $value) {
    $person[$key] = $value;
}

$postID = $person['id'];

update_field('paypal_id', $person['paid'], $postID);  // Paypal Payment ID

echo json_encode( $person );