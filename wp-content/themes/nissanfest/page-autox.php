<?php
get_header();
?>
<main id="entrants">
<section id="banner">
<div class="container">
<?php the_post_thumbnail('feature-banner') ?>
</div>
</section>
<section id="table">
<div class="container">
<h1>Autox</h1>
<?php
$args = array (
    'post_type' => 'entrant',
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
);
$entrants = new WP_Query( $args );
$html = '';
?>
<ul>
<li class='flexbox title'>
<span>Driver</span>
<span class="year">Year</span>
<span class="make">Make</span>
<span class="model">Model</span>
<span>T-Shirt</span>
</li>
<?php
while ( $entrants->have_posts() ): $entrants->the_post();
$html .= "<li class='flexbox'>";
$html .= "<span>";
$html .= get_the_title();
$html .= "</span>";
$html .= "<span class='year'>";
$html .= get_post_meta($post->ID, 'year', true);
$html .= "</span>";
$html .= "<span class='make'>";
$html .= get_post_meta($post->ID, 'make', true);
$html .= "</span>";
$html .= "<span class='model'>";
$html .= get_post_meta($post->ID, 'model', true);
$html .= "</span>";
$html .= "<span>";
$html .= get_post_meta($post->ID, 'tshirt', true);
$html .= "</span>";
$html .= "</li>";
endwhile;
echo $html;
?>
</ul>
<a onclick="register('autox');" class="btn">Register</a>
</div>
</section>
</main>
<?php 
get_footer(); 
?>