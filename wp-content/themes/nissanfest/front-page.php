<?php get_header(); ?>
<main id="home">
	<section id="banner">
		<div class="container">
			<?php the_post_thumbnail('feature-banner') ?>
		</div>
	</section>
	<section class="post_content">
		<div class="container">
			<?php echo $post->post_content ?>
		</div>
	</section>
	<?php 
	if($openReg): ?>
	<section id="general">
		<div class="container">
			<h3>General Admission >> <a href="#" class="btn">Buy Now</a></h3>
		</div>
	</section>
	<?php endif; ?>
	<section id="events">
		<div class="container">
			<ul class="flexbox wrap space-between">
				<li>
					<h4>Car Show</h4>
					<p>The Car Show is a showcase of everything Nissan Related.  We restrict entries to Nissan/Infiniti and Datsun vehicles to showcase the generations of products that we all love and enjoy.</p>
					<a onclick="register('car-show');" class="btn">Register</a>
					<?php if($openReg): ?>
					<?php endif; ?>
				</li>
				<li>
					<h4>AutoX</h4>
					<p>The Autox portion is open to all makes and models, we’re looking for automotive enthusiasts that like to come out and have fun and enjoy some healthy competition. </p>
					<?php if($openReg): ?>
					<?php endif; ?>
					<a onclick="register('autox');" class="btn">Register</a>
				</li>
				<li>
					<h4>Team Tandem</h4>
					<p>The team tandem event is made up of teams of 3-4 drivers that drift in tandem around our course.  They are judged on their proximity and style as a team.  </p>
					<?php if($openReg): ?>
					<?php endif; ?>
					<a onclick="register('team-tandem');" class="btn">Register</a>
				</li>
			</ul>
		</div>
	</section>
</main>
<?php get_footer(); ?>
