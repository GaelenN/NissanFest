<?php
get_header();
?>
<main id="blog">
<section>
    <div class="container">
        <h1><?php echo wp_title() ?></h1>
        <?php 
        if (have_posts()) :
            while (have_posts()) : ?>
                <article>
                <?php
                the_post();
                $cat = get_the_category();
                ?>
                                <?php if ( has_post_thumbnail()): ?>
                            <div class="featured-hero">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        <?php endif; ?>
                <a class="link" href="<?php the_permalink(); ?>"></a>
                <h3><?php the_title(); ?></h3>
                <h5 class="<?php echo $cat[0]->slug ?>"><?php echo $cat[0]->name ?></h5>
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