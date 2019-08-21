<!doctype html>
<?php 
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'logo' );
$logo_2x = wp_get_attachment_image_src( $custom_logo_id , 'logo_2x' );

$regDate = get_field('registration_open', 'options');
    $today = date('Y-m-d');
    $openReg = false;
    if($regDate < $today) {
        $openReg = true;
    }
$opensIn = (strtotime($regDate) - strtotime($today)) / 86400;
?>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NissanFest @ Evergreen Speedway - <?php echo $regDate ?></title>
	<meta property="og:title" content="<?php bloginfo('name'); ?>" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="2200" />
	<meta property="og:image:height" content="1000" />
	<meta property="og:url" content="http://nissanfest.us/" />
	<meta property="og:image" content="http://nissanfest.us/wp-content/themes/nissanfest/img/nissanfest-social.png" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header class="<?php echo (!$openReg) ? 'comingsoon' : ''; ?>">
		<div class="container flexbox flex-start align-center">
		<?php if($openReg): ?>
			<a id="toggleNav" onclick="toggleNav();">
					<span></span>
					<span></span>
					<span></span>
				</a>
				<?php endif; ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php 
				if ( has_custom_logo() ) {
					echo '<img src="'. esc_url( $logo[0] ) .'"  srcset="'. esc_url( $logo_2x[0] ) .' 2x">';
				} else {
					echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
				}
				?>
				</a>
				<?php if(!$openReg): ?>
			<p class="date">Regsitration Opens In <strong><?php echo $opensIn; ?> Day<?php if($opensIn > 1) { echo "s"; }; ?></strong></p>
			<?php else: ?>
			<p class="date"><?php the_field('event_date', 'options') ?></p>
			<?php endif; ?>
			</div>
	</header>
	<div id="nav-menu">
		<?php 
		if ( has_custom_logo() ) {
			echo '<img src="'. esc_url( $logo[0] ) .'"  srcset="'. esc_url( $logo_2x[0] ) .' 2x">';
		} else {
			echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
		}
		?>
		<a class="close" onclick="toggleNav();">X</a>
		<nav class="nav-container">
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => false) ); ?>
		</nav>
	</div>
	<?php 
	if(!$openReg) {
		get_template_part( 'template-parts/partial', 'soon' );
	}
	?>