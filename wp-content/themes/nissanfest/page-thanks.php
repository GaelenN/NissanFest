<?php
get_header();
?>
<main id="thanks">
<section>
<div class="container">
<?php
$email = $_GET["email"];
$content = "Paid: ".$_GET['amt'];
$content .= "<br/>Item Number: ".$_GET['item_number'];
$content .= "<br/>Item Name: ".$_GET['item_name'];
$content .= "<br/>Completed: ".$_GET['st'];
$content .= "<br/>Paypal ID: ".$_GET['tx'];

$args = array (
    'post_type'              => array( 'entrant' ),  // YOUR POST TYPE
    'post_status' => array('draft') , 
    'meta_query'             => array(
        array(
            'key'       => 'email',  
            'value'     => $email,  // THE COUNTRY TO SEARCH
            'compare'   => 'LIKE',  // TO SEARCH THIS COUNTRY IN YOUR COMMA SEPERATED STRING
        ),
    ),
);
$custom_fields = array(
    'paid' => $_GET['tx'],
);
$the_query = new WP_Query( $args ); 
if ( $the_query->have_posts() ) {
  while ( $the_query->have_posts() ) {
    $the_query->the_post();
    $name = get_the_title($post->ID);
    $tshirt = get_post_meta($post->ID, 'tshirt', true);
    $event = get_the_terms($post->ID, 'nissanfest-events');
    $show_cat = get_post_meta($post->ID, 'show_cat', true);
    $my_post = array(
        'ID'           => $post->ID,
        'post_status'   => 'publish',
        'post_content' => $content,
        'meta_input' => $custom_fields,
    );
    wp_update_post( $my_post ); 
    echo "<h1>Thank you ". $name ."</h1>"; 
    echo "<h3>Your regsitration for the ".$_GET['item_name']." has now been ". $_GET['st'] ."</h3>"; 
    echo "<p>If you have any questions please email us ASAP and we can anser them for you.  If you have any further questions about the event or details about your specific event, check out the <a href='/".$event[0]->slug."'>".$_GET['item_name']." Event Page</a> </p>";
}
} 
$to = $email;
$subject = $_GET['item_name'].' '. date("Y") .' Registration';
$headers[] = 'Bcc: gaelen@northwestnissans.com';
$message = 'Thank You for your registration, We have attached the details below for you to review.  If anything is incorrect please reply to this email ASAP.';
$message .= '<br/>';
$message .= '<strong>Event</strong>: '.$_GET['item_name'];
$message .= '<br/>';
if($event[0]->slug === 'car-show'):
$message .= '<strong>Category</strong>: '.$show_cat;
$message .= '<br/>';
endif;
$message .= '<strong>Name</strong>: '.$name;
$message .= '<br/>';
$message .= '<strong>Email</strong>: '.$email;
$message .= '<br/>';
$message .= '<strong>Tshirt Size</strong>: '.$tshirt;
if($email):
wp_mail( $to, $subject, $message, $headers );
endif;
wp_reset_postdata();
?>
</div>
</section>
</main>
<?php
get_footer();
?>