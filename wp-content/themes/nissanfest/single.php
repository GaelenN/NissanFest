<?php
get_header();
?>
<main id="single">
	<section>
		<div class="container">
			<?php 
			if (have_posts()) :
				while (have_posts()) : ?>
						<?php
						the_post();
						$cat = get_the_category(); ?>
						<h1><?php the_title() ?></h1>
					<aside>
						<?php if ( has_post_thumbnail()): ?>
							<div class="featured-hero">
								<?php the_post_thumbnail(); ?>
							</div>
						<?php endif; ?>
						<h5 class="<?php echo $cat[0]->slug ?>"><?php echo $cat[0]->name ?></h5>
						<p class="tags"><strong>Tech: </strong><?php echo strip_tags(get_the_tag_list('',', ','')); ?> </p>
					</aside>
					<article>
						<?php the_content(); ?>
					</article>
				<?php endwhile;
			endif; ?>
		</div>
	</section>
</main>
<?php 
get_footer(); 
?>

<!-- <?php get_header(); ?>
<div class="container">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( has_post_thumbnail()): ?>
				<div class="featured-hero">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php endif; ?>

			<?php 
			$categories = get_the_category();
			$separator = ', ';
			$output = '';
			if ( ! empty( $categories ) ) {
				foreach( $categories as $category ) {
					$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
				}
				echo trim( $output, $separator );
			} ?>

			<div class="date">
				<?php the_time('F j, Y'); ?>
			</div>

			<h1><?php the_title(); ?></h1>

			<aside class="blog-author">
				<div class="author-img"><?php echo get_avatar( get_the_author_email(), '200' ); ?></div>
				<h4>Written By <?php the_author_posts_link(); ?></h4>
			</aside>

			<div class="excerpt">
				<?php the_content(); ?>
			</div>

		</article>
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?> -->
