<?php
get_header();
wp_print_styles( array( 'nf_media' ) );

$details = get_field('event_details','options');
$location = get_field('location','options');

$eventDate = get_field('event_date', 'options');

$eventYear = new DateTime($eventDate);
$eventYear = $eventYear->format('Y');
$expiry = new DateTime($eventDate);
$expiry = $expiry->format('D, j M Y 12:00:00 e');

$today = date('Ymd'); 
$applicationEnd = get_field('media_end_date', 'options');
?>
<main id="media">
    <section id="content">
        <div class="container">
            <h1>Media Application </h1>

            <p>Application Requirements:</p>
            <ul>
                <li>Have a Website (Facebook/Instagram are not acceptable)</li>
                <li>Coverage must include all parts of the event</li>
                <li>Post your articles/videos within 10 days of the event</li>
                <li>Northwest Nissans reserves the right to use any content from the event for promotional purposes</li>
            </ul>
        </div>
    </section>
<section id="registration">
        <div class="container">
            <?php if(!isset($_COOKIE["media"]) && ($today < $applicationEnd) ) { ?>
                <form onsubmit="registerForm(event);" name="register" class="flexbox space-between wrap <?php echo $post->post_name ?>" >
                    <h2 id="form-title">Apply Now</h2>

                    <!-- Name -->
                    <li class="half">
                        <label>Name</label>
                        <input type="text" name="name" data-error="Your Full Name is Required" required/>
                    </li>

                    <!-- Email -->
                    <li>
                        <label>Email</label>
                        <input type="email" name="email" data-error="Your Email is Required" required/>
                    </li>

                    <!-- Tshirt Size -->
                    <li id="shirt">
                        <label for="title">Tshirt Size</label>
                        <select name="tshirt">
                            <option selected hidden>- Select Shirt Size -</option>
                            <option value='s'>Small</option>
                            <option value='m'>Medium</option>
                            <option value='l'>Large</option>
                            <option value='xl'>X-Large</option>
                            <option value='xxl'>XX-Large</option>
                            <option value='xxxl'>XXX-Large</option>
                        </select>
                    </li>
                   
                    <!-- Media Outlet -->
                    <li class="half">
                        <label>Media Outlet</label>
                        <input type="text" name="outlet" data-error="Your Outlet Name is Required" required/>
                    </li>

                    <!-- URL Outlet -->
                    <li class="half">
                        <label>Website URL</label>
                        <input type="url" name="url" data-error="Your Website is Required" required/>
                    </li>
                    
                    <!-- Media Type -->
                    <li class="half">
                        <label>Type of media:</label>
                        <select name="media_type">
                            <option value="photo">Photo</option>
                            <option value="video">Video</option>
                            <option value="both">Both</option>
                        </select>
                    </li>

                    <!-- Questions -->
                    <li>
                        <label>Questions/Comments</label>
                        <textarea name="questions"></textarea>
                    </li>
                    
                    <!-- Shot Before -->
                    <li class="radio">
                        <label>Have you shot NissanFest Before?</label>
                        <span><input type="radio" name="previous" value="yes"/>Yes</span>
                        <span><input type="radio" name="previous" value="no"/>No</span>
                    </li>

                    <!-- Previous Coverage -->
                    <li class="coverage">
                        <label style="display: none;">Link to previous coverage</label>
                        <input style="display: none;" type="url" name="link" />
                    </li>


                    <li id="submit" >
                        <button type="submit" class="btn">Apply</button>
                    </li>
                    
                    <input type="hidden" name="cat" value="media"/>
                    <input type="hidden" name="post_type" value="media"/>
                    <input type="hidden" name="expiry" value="<?php echo $expiry ?>" />
                </form>
                <?php } ?>
            </div>
        </section>
    <section class="table">
            <div class="container">
        <ul>
        <li class='flexbox title'>
            <span>Outlet</span>
            <span>Name</span>
            <span>Previous Coverage</span>
            <span class="status">Status</span>
        </li>
        <?php
                while ( have_posts() ): 
                    the_post();
                    ?>
                <li class='flexbox'>
                    <span><a href="<?php the_field('website') ?>" target="_blank"><?php the_field('outlet') ?></a></span>
                    <span><?php the_title() ?></span>
                    <span>
                        <?php if( get_field('previous') ): ?>
                        <a href="<?php the_field('previous') ?>" target="_blank">Link</a>
                        <?php endif; ?>
                    </span>
                    <span class="status flexbox space-between">
                            <?php if( get_field('approved') ): ?>
                                <p>Approved</p>
                            <?php else: ?>
                                <p>Pending</p>
                            <?php endif; ?>
                            <?php if( is_user_logged_in() ): ?>
                            <form onsubmit="approve(event)">
                                <input type="hidden" name="post_type" value="media" />
                                <input type="hidden" name="email" value="<?php the_field('email') ?>" />
                                <input type="hidden" name="post_ID" value="<?php echo $post->ID ?>" />
                                <input type="hidden" name="date" value="<?php echo $eventDate ?>" />
                                <input type="hidden" name="name" value="<?php the_title() ?>" />
                                <input type="hidden" name="location" value="<?php echo $location['title'].'<br/>'.$location['address'].'<br/>'.$location['city'].', '.$location['state'].'<br/>'.$location['zip_code']; ?>" />

                                <button type="submit">Approve</button>
                            </form>
                            <form onsubmit="denied(event)">
                                <input type="hidden" name="post_type" value="media" />
                                <input type="hidden" name="email" value="<?php the_field('email') ?>" />
                                <input type="hidden" name="post_ID" value="<?php echo $post->ID ?>" />
                                <input type="hidden" name="name" value="<?php the_title() ?>" />

                                <button type="submit">Denied</button>
                            </form>
                            <?php endif; ?>
                        </span>
                </li>
                <?php
                endwhile;
                ?>
                </ul>
            </div>
        </section>
</main>
<?php 
get_footer(); 
?>