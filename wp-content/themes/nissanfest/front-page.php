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

$car_show = new WP_Query( array (
	'post_type' => 'entrant',
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
	'meta_query' => array(
		array(
			'key'     => 'paid',
			'value'   => 'false',
			'compare' => 'NOT LIKE',
		),
	),
)
);
$autox = new WP_Query( array (
	'post_type' => 'entrant',
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
	'meta_query' => array(
		array(
			'key'     => 'paid',
			'value'   => 'false',
			'compare' => 'NOT LIKE',
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
	<!-- <section id="general">
		<div class="container">
			<h3>General Admission</h3>
			<p>General Admission tickets are available for pre-purchase for $10 below or at the door for $20 on the day of the event.  These tickets give you access to the main spectator areas as well as the pit areas.  Children under 5 are free. </p>
			<a href="https://www.etix.com/ticket/p/8214524/april-13th2019-nissanfest-monroe-evergreen-speedway" class="btn" target="_blank">Buy Now</a>
		</div>
	</section> -->
	<?php if( have_rows('event_types') ): ?>
	<section id="events">
		<div class="container">
			<ul>
			<?php 
			while ( have_rows('event_types') ) : the_row(); 
				$event = get_sub_field('registration');
				if( $event->post_name === 'autox' ):
					$post_count = $autox->post_count;
				endif;
				if( $event->post_name === 'car-show' ):
					$post_count = $car_show->post_count;
				endif;
			?>
				<li style="background-image: url('<?php echo get_the_post_thumbnail_url($event->ID); ?>')">
					<?php if($post_count >= $maximum[$event->post_name]['maximum']): ?>
						<h3 class="sold-out">SOLD OUT</h3>
					<?php else: ?>
						<a class="link" href="<?php the_permalink($event->ID); ?>"></a>
					<?php endif; ?>
					<h2><?php echo $event->post_title; ?></h2>
					<h4>Register Now >></h4>
				</li>
			<?php endwhile;?>
			</ul>
		</div>
	</section>
	<?php endif; ?>
</main>
<?php 
get_footer(); 
?>
