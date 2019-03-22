<?php
get_header();
?>
<main id="entrants">
<section id="banner">
		<div class="container content">
        <?php while ( have_posts() ): the_post();
        the_post_thumbnail('feature-banner');
        the_content(); 
        endwhile;
        ?>
		</div>
	</section>
<section id="table">
	<div class="container">
        <h1>Car Show</h1>
        <?php
        $args = array (
            'post_type' => 'entrant',
            'posts_per_page' => -1,
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
        );
        $entrants = new WP_Query( $args );
        $html = '';
?>
<ul>
<li class='flexbox title'>
    <span>Name</span>
    <span>Category</span>
    <span>T-Shirt</span>
</li>
<?php
        while ( $entrants->have_posts() ): $entrants->the_post();
        $html .= "<li class='flexbox'>";
        $html .= "<span>";
        $html .= get_the_title();
        $html .= "</span>";
        $html .= "<span>";
        $html .= get_post_meta($post->ID, 'show_cat', true);
        $html .= "</span>";
        $html .= "<span>";
        $html .= get_post_meta($post->ID, 'tshirt', true);
        $html .= "</span>";
        $html .= "</li>";
        endwhile;
        echo $html;
        wp_reset_postdata();
        ?>
        </ul>
        <?php if ($entrants->post_count < 120 ):  ?>
        <!-- <a onclick="register('car-show');" class="btn">Register</a> -->
        <a disabled class="btn">SOLD OUT</a>
        <?php endif; ?>
	</div>
</section>
</main>
<?php 
get_footer(); 
?>