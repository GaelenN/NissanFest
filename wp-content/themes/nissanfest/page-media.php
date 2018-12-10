<?php
get_header();
$args = array (
'post_type' => 'media',
);
$media = new WP_Query( $args );
$html = '';
?>
<main id="media">
    <section id="banner">
        <div class="container">
            <?php the_post_thumbnail('feature-banner') ?>
        </div>
    </section>
    <?php if(!$_GET['a']):?>
    <section>
        <div class="container">
            <form id="media_app" name="media_app" method="post" action="/wp-content/themes/nissanfest/actions/post-media.php" >
                <h1>Media Application</h1>
                <ul>
                    <li class="half">
                        <label>Media Outlet</label>
                        <input type="text" name="outlet" required/>
                    </li>
                    <li class="half">
                        <label>Website URL</label>
                        <input type="text" name="url" required/>
                    </li>
                    <li class="radio">
                        <label>Have you shot NissanFest Before?</label>
                        <span><input type="radio" name="previous" value="yes"/>Yes</span>
                        <span><input type="radio" name="previous" value="no"/>No</span>
                    </li>
                    <li class="half">
                        <label>Type of media:</label>
                        <select name="media_type">
                            <option value="photo">Photo</option>
                            <option value="video">Video</option>
                            <option value="both">Both</option>
                        </select>
                    </li>
                    <li class="half">
                        <label>Name</label>
                        <input type="text" name="name" required/>
                    </li>
                    <li>
                        <label>Email</label>
                        <input type="email" name="email" required/>
                    </li>
                    <li style="display: none;">
                        <label>Link to previous coverage</label>
                        <input type="text" name="link" required/>
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
    <?php if( $media->have_posts() ): ?>
    <section id="table">
            <div class="container">
                <h1>Approved Media</h1>
        <ul>
        <li class='flexbox title'>
            <span>Name</span>
            <span>Outlet</span>
            <span>Website</span>
        </li>
        <?php
                while ( $media->have_posts() ): $media->the_post();
                $html .= "<li class='flexbox'>";
                $html .= "<span>";
                $html .= get_the_title();
                $html .= "</span>";
                $html .= "<span>";
                $html .= get_post_meta($post->ID, 'outlet', true);
                $html .= "</span>";
                $html .= "<span>";
                $html .= get_post_meta($post->ID, 'url', true);
                $html .= "</span>";
                $html .= "</li>";
                endwhile;
                echo $html;
                ?>
                </ul>
            </div>
        </section>
        <?php endif; ?>
</main>
<?php 
get_footer(); 
?>