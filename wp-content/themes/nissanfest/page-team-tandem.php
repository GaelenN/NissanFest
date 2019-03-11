<?php
get_header();
$registered = new WP_Query( 
    array (
        'post_status' => 'draft',
        'post_type' => 'entrant',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'nissanfest-events',
                'field'    => 'slug',
                'terms'    => 'team-tandem',
            ),
        ),
    )
);
$entrants = new WP_Query( 
    array (
        'post_type' => 'entrant',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'nissanfest-events',
                'field'    => 'slug',
                'terms'    => 'team-tandem',
            ),
        ),
    )
);
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
<h1>Team Tandem</h1>
<h5>Approved Teams</h5>
<?php
$html = '';
?>
<ul>
<li class='flexbox title'>
<span>Team Name</span>
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
$html .= get_post_meta($post->ID, 'team_name', true);
$html .= "</span>";
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
<a onclick="register('team-tandem');" class="btn">Register</a>
</div>
<?php if( current_user_can('administrator') && $registered->have_posts() ): ?>
<div class="container">
<h5>Registered Teams</h5>
<?php
$html = '';
?>
<ul>
<li class='flexbox title'>
<span>Team Name</span>
<span>Driver</span>
<span class="year">Year</span>
<span class="make">Make</span>
<span class="model">Model</span>
<span>T-Shirt</span>
</li>
<?php
while ( $registered->have_posts() ): $registered->the_post();
$html .= "<li class='flexbox'>";
$html .= "<span>";
$html .= get_post_meta($post->ID, 'team_name', true);
$html .= "</span>";
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
<a onclick="register('team-tandem');" class="btn">Register</a>
</div>
<?php endif ?>
</section>
</main>
<?php 
get_footer(); 
?>