<?php
get_header();
$args = array (
'post_type' => 'vendor',
);
$vendor = new WP_Query( $args );
$html = '';
?>
<main id="media">
    <section id="banner">
        <div class="container">
            <?php the_post_thumbnail('feature-banner') ?>
        </div>
    </section>
    <?php if( $vendor->have_posts() ): ?>
    <section id="table">
            <div class="container">
                <h1>Vendors Attending</h1>
        <ul>
        <li class='flexbox title'>
            <span>Company</span>
            <span>Website</span>
        </li>
        <?php
                while ( $vendor->have_posts() ): $vendor->the_post();
                $html .= "<li class='flexbox'>";
                $html .= "<span>";
                $html .= get_the_title();
                $html .= "</span>";
                $html .= "<span><a href='";
                $html .= get_post_meta($post->ID, 'url', true);
                $html .= "' target='_blank'>";
                $html .= get_post_meta($post->ID, 'url', true);
                $html .= "</a></span>";
                $html .= "</li>";
                endwhile;
                echo $html;
                ?>
                </ul>
            </div>
        </section>
        <?php endif; ?>
    <?php if(!$_GET['a']):?>
    <section>
        <div class="container">
            <form id="media_app" name="media_app" method="post" action="/wp-content/themes/nissanfest/actions/post-vendor.php" >
                <h1>Vendor Application</h1>
                <ul>
                    <li class="half">
                        <label>Company Name</label>
                        <input type="text" name="company" required/>
                    </li>
                    <li class="half">
                        <label>Website</label>
                        <input type="text" name="url" required/>
                    </li>
                    <li class="half">
                        <label>Contact Name</label>
                        <input type="text" name="name" required/>
                    </li>
                    <li class="half">
                        <label>Contact Phone</label>
                        <input type="text" name="phone" required/>
                    </li>
                    <li>
                        <label>Contact Email</label>
                        <input type="email" name="email" required/>
                    </li>
                    <li>
                        <label>Space Requirement:</label>
                        <ul class="radios">
                            <li>
                                <input type="radio" name="size" />
                                10x10
                            </li>
                            <li>
                                <input type="radio" name="size" />
                                10x20
                            </li>
                            <li>
                                <input type="radio" name="size" />
                                10x30
                            </li>
                            <li>
                                <input type="radio" name="size" />
                                20x30
                            </li>
                            <li>
                                <input type="radio" name="size" />
                                Custom
                            </li>
                    </ul>
                    </li>
                    <li>
                        <label>Requirements: (check all that apply)</label>
                        <ul class="checkboxes">
                            <li>
                                <input type="checkbox" name="power" />
                                Power
                            </li>
                            <li>
                                <input type="checkbox" name="vehicle" />
                                Display Vehicle
                            </li>
                    </ul>
                    </li>
                    <li>
                        <label>Questions/Comments</label>
                        <textarea name="questions"></textarea>
                    </li>
                </ul>
                <a onclick="checkform(event);" class="btn">Submit</a>
            </form>
        </div>
    </section>
    <?php else: ?>
    <section>
        <div class="container">
            <h1>Thank You for your application</h1>
        </div>
    </section>
    <?php endif; ?>
</main>
<?php 
get_footer(); 
?>