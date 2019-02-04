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
    <?php if(!$_GET['m']):?>
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
            <div class="details">
            <p>By Applying for the NissanFest media you agree to the following:</p>
                <p>
                <ul>
                <li>Wear long pants and closed toed shoes</li>
                <li>Use proper equipment (cell phones are not applicable)</li>
                <li>Post your articles/videos within 30 days of the event</li>
                <li>Coverage must include all parts of the event</li>
                <li>Northwest Nissans reserves the right to use any content from the event for promotional purposes</li>
                </ul>
                </p>
            </div>
        </div>
    </section>
    <?php else: ?>
    <section>
        <div class="container">
            <h1>Thank You for your application</h1>
        </div>
    </section>
    <?php endif; ?>
<?php
$args = array (
'post_type' => 'vendor',
);
$vendor = new WP_Query( $args );
$html = '';
?>
    <?php if(!$_GET['v']):?>
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