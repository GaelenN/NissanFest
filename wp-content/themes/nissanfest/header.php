<!doctype html>
<?php 
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'logo' );
$logo_2x = wp_get_attachment_image_src( $custom_logo_id , 'logo_2x' );

$regDate = date('2019-02-01');
    $today = date('Y-m-d');
    $openReg = false;
    if($regDate < $today) {
        $openReg = true;
    }

?>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
	<meta property="og:title" content="<?php bloginfo('name'); ?>" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="2200" />
	<meta property="og:image:height" content="1000" />
	<meta property="og:url" content="http://nissanfest.us/" />
	<meta property="og:image" content="http://nissanfest.us/wp-content/themes/nissanfest/img/nissanfest-social.png" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header>
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
			<p class="date">Regsitration Opens In <strong><?php echo (strtotime($regDate) - strtotime($today)) / 86400; ?> Days</strong></p>
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