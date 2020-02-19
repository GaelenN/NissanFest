<!doctype html>
<?php 

//Event Details
$opensIn = (strtotime($regDate) - strtotime($today)) / 86400;
$eventDate = get_field('event_date', 'options');
$eventYear = new DateTime($eventDate);
$eventYear = $eventYear->format('Y');
$regDate = get_field('registration_open', 'options');
$today = date('Y-m-d');
$openReg = false;
if($regDate < $today) {
    $openReg = true;
}

// Global Variables
$logos = get_field('logos','options');
$logo = $logos['square']['url'];
$location = get_field('location','options');
$links = get_field('external_links','options');
$maximum = get_field('details','options');

$car_show = new WP_Query( 
	array (
		'post_type' => 'driver',
		'posts_per_page' => -1,
		'date_query' => array(
			array(
				'year'  => $eventYear,
			),
		),
		'tax_query' => array(
			array(
				'taxonomy' => 'nissanfest-events',
				'field'    => 'slug',
				'terms'    => 'car-show',
			),
		),
	)
);
$autox = new WP_Query( 
	array (
		'post_type' => 'driver',
		'posts_per_page' => -1,
		'date_query' => array(
			array(
				'year'  => $eventYear,
			),
		),
		'tax_query' => array(
			array(
				'taxonomy' => 'nissanfest-events',
				'field'    => 'slug',
				'terms'    => 'autox',
			),
		),
	)
);
?>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NissanFest @ Evergreen Speedway - <?php echo $eventDate ?></title>
	<meta property="og:title" content="<?php bloginfo('name'); ?>" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="2200" />
	<meta property="og:image:height" content="1000" />
	<meta property="og:url" content="http://nissanfest.us/" />
	<meta property="og:image" content="http://nissanfest.us/wp-content/themes/nissanfest/img/nissanfest-social.png" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php 
	if(!$openReg) {
		get_template_part( 'template-parts/partial', 'soon' );
	}
	?>
<?php 
wp_print_styles( array( 'nf_front' ) );
?>
<main id="home">
	<section id="info">
		<div class="container flexbox wrap align-center space-between">
		<?php echo '<img class="logo" src="'. esc_url( $logo ) .'"  srcset="'. esc_url( $logo ) .' 2x">'; ?>
		<div class="info">
			<h3>Join Us:</h3>
			<p class="event_date"><?php echo $eventDate ?></p>
			<p class="location">
				<?php echo $location['title'] ?><br/>
				<?php echo $location['address'] ?><br/>
				<?php echo $location['city'] ?>, <?php echo $location['state'] ?><br/>
				<?php echo $location['zip_code'] ?><br/>
			</p>
			<?php if( $links['tickets'] ): ?>
			<a class="btn" target="_blank" href="<?php echo $links['tickets'] ?>">Buy Tickets</a>
			<?php endif;?>
			<a class="btn" href="#events">Register</a>
			<a class="btn" target="_blank" href="https://goo.gl/maps/FvPP1TmoiwA1FzQ58">Get Directions</a>
		</div>
		</div>
	</section>
	<section class="post_content">
		<div class="container">
			<p>This is our <?php echo $eventYear - 2012; ?>th annual NissanFest event at Evergreen Speedway, with the success of last year we are happy to bring it back with even more events and activities for everyone to enjoy! This year we’re bringing back the Car Show, Autox, Drift Competition and adding some other great activities for all automotive enthusiasts.  Northwestnissans.com has had one of the largest Nissan & Datsun spring meets for 9 years running that was being held at Golden Gardens Park in Seattle, WA.</p>
		</div>
	</section>
	<section id="general">
		<div class="container">
			<h3>General Admission</h3>
			<p>General Admission tickets are available for pre-purchase for $10 below or at the door for $20 on the day of the event.  These tickets give you access to the main spectator areas as well as the pit areas.  Children under 5 are free. </p>
			<a href="https://www.etix.com/ticket/p/8214524/april-13th2019-nissanfest-monroe-evergreen-speedway" class="btn" target="_blank">Buy Now</a>
		</div>
	</section>
	<?php 
	$events = get_field('event_details', 'option');
	?>
	<section id="events">
		<div class="container">
			<ul>
			<?php 
			foreach($events as $event => $details): 
				if( $event === 'car-show' ):
					$postcount = $car_show->found_posts;
				endif; 
				if( $event === 'autox' ):
					$postcount = $autox->found_posts;
				endif; 
			?>
				<li style="background-image: url('<?php echo get_stylesheet_directory_uri() ?>/img/nissanfest-<?php echo $event ?>.jpg')">
					<?php if( $postcount < $details['maximum'] ): ?>
						<a class="link" href="/<?php echo $event ?>"></a>
					<?php endif; ?>
					<?php if( $postcount >= $details['maximum'] ): ?>
						<span class="sold-out">Sold Out</span>
					<?php endif; ?>
					<h2>
						<?php 
						echo strtoupper( str_replace('-',' ',$event) );
						if( $postcount < $details['maximum'] ):
							if( $event === 'team-tandem' ):
								echo " - Apply Now";
							else: 
								echo " - $". $details['cost'];
							endif;  
						endif; 
						?>
						</h2>
					<?php if( $postcount < $details['maximum'] ): ?>
						<h4>Register Now >></h4>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>
	</section>
</main>
<?php 
get_footer(); 
?>
