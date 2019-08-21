<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] ); 
require_once( $parse_uri[0] . 'wp-load.php' );

$person = array();
foreach ($_POST as $key => $value) {
    $person[$key] = $value;
}
if( $person['post_type'] === 'vendor' ) {
    $title = $person['company'];
} else {
    $title = $person['name'];
}

    // Create post object
    $register_driver = array(
        'post_title'    => $title,
        'post_status' => 'publish',
        'post_type' => $person['post_type'],
        'post_content' => $person['questions'],
    );
    
    // Insert the post into the database
    $postID = wp_insert_post( $register_driver );
    $term = get_term_by('slug', $person['cat'], 'nissanfest-events'); 
    wp_set_post_terms( $postID, array($term->term_id), 'nissanfest-events' );

    $person['postID'] = $postID;
    
    //ACF Driver fields
    update_field('field_5d55af0caa2b7', $person['name'], $postID);  // Name
    update_field('field_5d55afeeaa2b8', $person['email'], $postID);  // Email
    update_field('field_5d55aff8aa2b9', $person['tshirt'], $postID);  // Shirt Size

    //ACF Show fields
    update_field('field_5d55b0135a03b', $person['category'], $postID);  // Show Category
    update_field('field_5d55b01e5a03c', $person['year'], $postID);  // Year
    update_field('field_5d55b0265a03d', $person['make'], $postID);  // Make
    update_field('field_5d55b02a5a03e', $person['model'], $postID);  // Model
    update_field('field_5d55b0315a03f', $person['paid'], $postID);  // Paypal Payment ID

    //ACF Autox fields
    update_field('field_5d55d85d2465a', $person['year'], $postID);  // Year
    update_field('field_5d55d85d24cb4', $person['make'], $postID);  // Make
    update_field('field_5d55d85d24e48', $person['model'], $postID);  // Model
    update_field('field_5d55d85d24eeb', $person['paid'], $postID);  // Paypal Payment ID

    //ACF Team-Tandem fields
    update_field('field_5d55daf03d77e', $person['team-name'], $postID);  // Team Name
    update_field('field_5d55daf03d7b7', $person['year'], $postID);  // Year
    update_field('field_5d55daf03d7c5', $person['make'], $postID);  // Make
    update_field('field_5d55daf03d7d3', $person['model'], $postID);  // Model
    update_field('field_5d55daf03d7e2', $person['paid'], $postID);  // Paypal Payment ID

    //ACF Media fields
    update_field('field_5d56f315a3336', $person['outlet'], $postID);  // Media Outlet
    update_field('field_5d56f337065ff', $person['url'], $postID);  // Website
    update_field('field_5d56f34106600', $person['name'], $postID);  // Name
    update_field('field_5d56f34f06601', $person['email'], $postID);  // Email
    update_field('field_5d56f422aa022', $person['link'], $postID);  // Previous Link

    //ACF Vendor fields
    update_field('field_5d5c7ceac9c4c', $person['price'], $postID);  // Price
    update_field('field_5d5b14ff08b5b', array( 'name' => $person['company'], 'website' => $person['website'],  ), $postID);  // Company
    update_field('field_5d5b153130327', array( 'name' => $person['name'], 'email' => $person['email'], 'phone' => $person['phone'] ) , $postID);  // Contact 
    update_field('field_5d5c4b3e9528a', array( 'booth_size' => $person['booth'], 'power' => $person['power'], 'display_vehicle' => $person['show-car'] ) , $postID);  // Requirements

    $email = '';
    if( $person['cat'] === "autox" || $person['cat'] === "car-show" ) {
        $email .= '<h2>NissanFest '.ucfirst($person['cat']).' '.date("Y").' Registration</h2>';
        $email .= '<h4>'. $person['name'] .',</h4>';
        $email .= '<p>Thank you for your '.ucfirst($person['cat']).' registration.  Details for roll-in and day of events will be emailed to you 10 days before the event.</p>';
        $email .= '<p>If you have further questions please respond to this email and we will get back to you within 48 hours.</p>';
        $email .= '<p>Thank you! </p>';

        $to = $person['email'];
        $subject = 'NissanFest '. date('Y').' '.ucfirst($person['cat']).' Registration';
        $headers[] = '';
    }
    if( $person['cat'] === "team-tandem" || $person['cat'] === "media" || $person['cat'] === "vendor" ) {
        $email .= '<h2>NissanFest '.ucfirst($person['cat']).' '.date("Y").' Application</h2>';
        $email .= '<h4>'. $person['name'] .',</h4>';
        $email .= '<p>Thank you for your '.ucfirst($person['cat']).' application.</p>';
        $email .= '<p>Applications will be reviewed and status updates will be sent out one month prior to the event.</p>';
        $email .= '<p>If at any point you\'d like to pull your application please reply to this email and let us know.</p>';
        $email .= '<p>If you have further questions please respond to this email and we will get back to you within 48 hours.</p>';
        $email .= '<p>Thank you! </p>';

        $to = $person['email'];
        $subject = 'NissanFest '. date('Y').' '.ucfirst($person['cat']).' Application';
        $headers[] = '';
    }
    wp_mail( $to, $subject, $email, $headers );

echo json_encode( $person );