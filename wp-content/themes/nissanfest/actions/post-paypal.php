<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Processing....</title>
    <link rel="stylesheet" type="text/css" href="/wp-content/themes/nissanfest/style.css">
</head>
<body id="processing" >
    <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</body>
</html>
<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
require_once( $parse_uri[0] . 'wp-load.php' );

$drivers = [];

foreach ($_POST['name'] as $key => $value) {
    $drivers[$key]['name']= $value;
}
foreach ($_POST['email'] as $key => $value) {
    $drivers[$key]['email']= $value;
}
foreach ($_POST['year'] as $key => $value) {
    $drivers[$key]['year']= $value;
}
foreach ($_POST['make'] as $key => $value) {
    $drivers[$key]['make']= $value;
}
foreach ($_POST['model'] as $key => $value) {
    $drivers[$key]['model']= $value;
}
foreach ($_POST['tshirt'] as $key => $value) {
    $drivers[$key]['tshirt']= $value;
}

$driver_count = count($drivers) - 1;

for ($i = 0; $i <= intval($driver_count); $i++) {
    $drivers[$i]['paid'] = $_POST['paid'];
    $drivers[$i]['category'] = $_POST['category'];
    if($_POST['team-name'] !== '') {
        $drivers[$i]['team-name'] = $_POST['team-name'];
    }
}

foreach ($drivers as $driver) {
    $custom_fields = array(
        'tshirt' => $driver['tshirt'],
        'show_cat' => $driver['category'],
        'email' => $driver['email'],
        'make' => $driver['make'],
        'model' => $driver['model'],
        'year' => $driver['year'],
        'paid' => $driver['paid'],
    );
    if($_POST['team-name'] !== '') {
        $custom_fields['team_name'] = $driver['team-name'];
    }
    
    // Create post object
    $my_post = array(
        'post_title'    => $driver['name'],
        'post_status'   => 'draft',
        'post_type' => 'entrant',
        'meta_input' => $custom_fields,
    );
    
    // Insert the post into the database
    $post_ID = wp_insert_post( $my_post );
    $term = get_term_by('slug', $_POST['cat'], 'nissanfest-events'); 
    wp_set_post_terms( $post_ID, array($term->term_id), 'nissanfest-events' );
}
if ($_POST['cat'] !== 'team-tandem') {
?>
<form id="paypal" name="paypal" method="post" action="https://www.paypal.com/cgi-bin/webscr" >
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="paypal@northwestnissans.com">
    <input type="hidden" name="item_name" value="<?php echo $_POST['item_name'] ?>">
    <input type="hidden" name="item_number" value="<?php echo $_POST['item_number'] ?>">
    <input type="hidden" name="amount" value="<?php echo $_POST['amount'] ?>">
    <input type="hidden" name="quantity" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="return" value="<?php echo $actual_link ?>/thanks?<?php echo $_POST['url_add'] ?>">
    <input type="hidden" name="notify_url" value="<?php echo $actual_link ?>/paid?<?php echo $_POST['url_add'] ?>">
</form>
<script>
    document.getElementById("paypal").submit();
</script>
<?php } else { ?>
    <script>
    window.location.replace("<?php echo $actual_link ?>/thanks?email=<?php echo $driver['email'] ?>");
    </script>
<?php } ?>