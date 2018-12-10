<?php
get_header();
?>
<section id="vehicles">
	<div class="container">
		<?php
		$cat = get_the_category();
		$img = get_field('vehicle_banner', $cat[0]);
		?>
		<div class="banner" style="background-image: url(<?php echo $img['sizes']['vehicle-banner']?>)">

		</div>
		<div class="articles">
			<?php 
			$vehicle = new WP_Query( array( 
				'post_type' => array('events', 'post'),
				'paged' => $paged 
			) );
			if ( $vehicle->have_posts() ) :
				while ( $vehicle->have_posts() ) : $vehicle->the_post(); 
					?>
					<article>
						<a href="<?php the_permalink() ?>"></a>
						<h2><?php the_title(); ?></h2>
						<?php if ( has_post_thumbnail() ) {
							echo get_the_post_thumbnail($post->ID, "post-banner");
						} 
						echo wp_trim_words( get_the_content(), 55, "..." ); 
						?>

					</article>
				<?php endwhile;
			endif;
			wp_reset_postdata();
			?>
		</div>
		<aside>
			<h2>Partners</h2>
			<ul>
				<?php 
				$partners = new WP_Query( array( 
					'post_type' => 'partners',
				) );
				if ( $partners->have_posts() ) :
					while ( $partners->have_posts() ) : $partners->the_post(); 
						?>
						<li>
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							} else {
								the_title();
							}
							?>
						</li>
					<?php endwhile;
				endif;
				wp_reset_postdata();
				?>
			</ul>
		</aside>
	</div>
</section>
<?php 
get_footer(); 
?>