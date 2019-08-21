<?php 
wp_print_styles( array('nf_soon') );

$logos = get_field('logos','options');
$logo = $logos['wide']['url'];

$regDate = get_field('registration_open', 'options');
	$today = date('Y-m-d');
	
$opensIn = (strtotime($regDate) - strtotime($today)) / 86400;

$location = get_field('location','options');
$links = get_field('external_links','options');
?>

<main id="comingsoon">
<section>
<div class="container">
<?php
	echo '<img class="logo" src="'. esc_url( $logo ) .'"  srcset="'. esc_url( $logo ) .' 2x">';
?>
<p class="opens">Regsitration Opens In <strong><?php echo $opensIn; ?> Day<?php if($opensIn > 1) { echo "s"; }; ?>!</strong></p>

<h3>Join Us:</h3>
<p class="event_date"><?php the_field('event_date','options'); ?></p>
<p class="location">
	<?php echo $location['title'] ?><br/>
	<?php echo $location['address'] ?><br/>
	<?php echo $location['city'] ?>, <?php echo $location['state'] ?><br/>
	<?php echo $location['zip_code'] ?><br/>
</p>
<a class="btn" href="<?php echo $links['facebook_page'] ?>">Follow us for more information!</a>
</div>
</section>
</main>
<?php 

?>