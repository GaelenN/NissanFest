<?php
get_header();
?>
<section id="vehicles">
	<div class="container">
		<?php 
		if (have_posts()) :
			while (have_posts()) :
				the_post();?>
				<article>
					<?php the_content(); ?>
				</article>
			<?php endwhile;
		endif; ?>
	</div>
</section>
<?php 
get_footer(); 
?>