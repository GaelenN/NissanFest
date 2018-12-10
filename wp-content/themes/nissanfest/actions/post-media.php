<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Processing....</title>
<link rel="stylesheet" type="text/css" href="/wp-content/themes/nissanfest/style.css">
<script type="text/javascript">
    function codeAddress() {
        window.location.replace("/media?a=yes");
    }
</script>
</head>
<body id="processing"  onload="codeAddress();">
        <?php
        $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] ); 
        require_once( $parse_uri[0] . 'wp-load.php' );
$custom_fields = array(
    'url' => $_POST['url'],
    'link' => $_POST['link'],
    'email' => $_POST['email'],
    'outlet' => $_POST['outlet'],
    'previous' => $_POST['previous'],
    'media_type' => $_POST['media_type'],
);

// Create post object
$media_post = array(
    'post_type' => 'media',
    'post_status'   => 'draft',
    'post_title'    => $_POST['name'],
    'meta_input' => $custom_fields,
    'post_content' => $_POST['questions'],
);
// Insert the post into the database
$post_ID = wp_insert_post( $media_post );
$message = '';
$message .= 'Thank You, '. $_POST["name"] .', for your media application for NissanFest.';
$message .= '<br/>';
$message .= 'Applications are being reviewed and your approval will be sent out by March 13, '. date('Y');
$message .= '<br/>';
$message .= 'If you have any questions please email jason@northwestnissans.com.';
$message .= '<br/>';
$message .= '<br/>';
$message .= '<br/>';
$message .= 'Form Data:';
$message .= '<br/>';
$message .= 'Name: '.$_POST['name'];
$message .= '<br/>';
$message .= 'Outlet: '.$_POST['outlet'];
$message .= '<br/>';
$message .= 'Website: '.$_POST['url'];
$message .= '<br/>';
$to = $_POST['email'];
$subject = 'NissanFest '. date('Y').' Media Application';
$headers[] = 'Bcc: gaelen@northwestnissans.com';
wp_mail( $to, $subject, $message, $headers );
?>
<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</body>
</html>