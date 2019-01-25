<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Processing....</title>
<link rel="stylesheet" type="text/css" href="/wp-content/themes/nissanfest/style.css">
<script type="text/javascript">
function codeAddress() {
    window.location.replace("/applications?v=yes");
}
</script>
</head>
<body id="processing"  onload="codeAddress();">
<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] ); 
require_once( $parse_uri[0] . 'wp-load.php' );
$custom_fields = array(
    'contact' => $_POST['name'],
    'url' => $_POST['url'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'size' => $_POST['size'], 
);

$content = '';
$content .= 'Power: '. $_POST['power'];
$content .= 'Display Vehicle: '. $_POST['vehicle'];
$content .= '<br/>';
$content .= '<br/>';
$content .= $_POST['questions'];


// Create post object
$media_post = array(
    'post_type' => 'vendor',
    'post_status'   => 'draft',
    'post_title'    => $_POST['company'],
    'meta_input' => $custom_fields,
    'post_content' => $content,
);
// Insert the post into the database
$post_ID = wp_insert_post( $media_post );
$message = '';
$message .= 'Thank You, '. $_POST["name"] .', for your vendor application for NissanFest.';
$message .= '<br/>';
$message .= 'Applications are being reviewed we will try and respond within 48hours.';
$message .= '<br/>';
$message .= 'If you have any questions please email gaelen@northwestnissans.com.';
$message .= '<br/>';
$message .= '<br/>';
$message .= '<br/>';
$message .= 'Form Data:';
$message .= '<br/>';
$message .= 'Name: '.$_POST['name'];
$message .= '<br/>';
$message .= 'Email: '.$_POST['email'];
$message .= '<br/>';
$message .= 'Phone: '.$_POST['phone'];
$message .= '<br/>';
$message .= 'Company: '.$_POST['company'];
$message .= '<br/>';
$message .= 'Website: '.$_POST['url'];
$message .= '<br/>';
$to = $_POST['email'];
$subject = 'NissanFest '. date('Y').' Vendor Application';
$headers[] = 'Bcc: gaelen@northwestnissans.com';
wp_mail( $to, $subject, $message, $headers );
?>
<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</body>
</html>