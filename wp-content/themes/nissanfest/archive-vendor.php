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

?>
<main id="media">
    <section id="content">
        <div class="container">
            <h1>Vendor Application </h1>
            <?php if( isset($_COOKIE["vendor"]) ): ?>
            <h3>Thank you for your application</h3>
            <?php endif; ?>
        </div>
    </section>
    <section id="registration">
        <div class="container">
                <?php if( !isset($_COOKIE["vendor"]) ) { ?>
                <form onsubmit="registerForm(event);" name="register" class="flexbox space-between wrap <?php echo $post->post_name ?>" >
                    <ul class="flexbox wrap">
                        <h4>Company Details</h4>
                        <!-- Company Name -->
                        <li class="half">
                            <label>Company Name</label>
                            <input type="text" name="company" data-error="Your Company Name is Required" required/>
                        </li>
                        
                        <!-- Website -->
                        <li>
                            <label>Website</label>
                            <input type="url" name="website" data-error="Your Email is Required" required/>
                        </li>
                    </ul>
                    <ul class="flexbox wrap">
                        <h4>Contact Details</h4>
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
                        
                        <!-- Email -->
                        <li>
                            <label>Phone</label>
                            <input type="phone" name="phone" data-error="Your Phone Number is Required" required/>
                        </li>
                    </ul>
                    <ul class="flexbox wrap">
                        <h4>Space Details</h4>
                        <!-- Booth Size -->
                        <li>
                            <label>Booth Size <span>(does not include display vehicle)</span></label>
                            <ul class="radio vendor">
                                <li><input type="radio" name="booth" value="10x10" data-cost="150"/> <span>10x10</span></li>
                                <li><input type="radio" name="booth" value="10x20" data-cost="250"/> <span>10x20</span></li>
                                <li><input type="radio" name="booth" value="10x30" data-cost="400"/> <span>10x30</span></li>
                                <li><input type="radio" name="booth" value="20x20" data-cost="400"/> <span>20x20</span></li>
                                <li><input type="radio" name="booth" value="20x30" data-cost="550"/> <span>20x30</span></li>
                            </ul>
                        </li>
                        
                        <!-- Ammenities -->
                        <li>
                            <label>Ammenities</label>
                            <ul class="checkboxes vendor">
                                <li><input type="checkbox" name="power" value="power" data-cost="0" /> <span>Power</span></li>
                                <li><input type="checkbox" name="show-car" value="show-car" data-cost="75" /> <span>Display Vehicle</span></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="flexbox wrap">
                        <li id="submit" >
                            <button type="submit" class="btn">Apply</button>
                        </li>
                    </ul>
                    
                    <input type="hidden" name="cat" value="vendor"/>
                    <input type="hidden" name="price" value=""/>
                    <input type="hidden" name="post_type" value="vendor"/>
                    <input type="hidden" name="item_name" value="NissanFest <?php the_title() ?>" />
                    <input type="hidden" name="item_number" value="NFCS<?php echo $eventYear ?>" />
                    <input type="hidden" name="expiry" value="<?php echo $expiry ?>" />
                </form>
                <?php } ?>
            </div>
        </section>
        <?php if( have_posts() && is_user_logged_in() ): ?>
        <section class="table">
            <div class="container">
                <ul>
                    <li class='flexbox title'>
                        <span>Company</span>
                        <span class="contact">Contact</span>
                        <span class="ammenities">Ammenities</span>
                        <span class="status">Status</span>
                    </li>
                    <?php
                    while ( have_posts() ): 
                    the_post();
                    $approval = get_field('approval');
                    $company = get_field('company');
                    $contact = get_field('contact');
                    $ammenities = get_field('requirements');
                    ?>
                    <li class='flexbox'>
                        <span><a href="<?php echo $company['website'] ?>" target="_blank"><?php echo $company['name'] ?></a></span>
                        <span class="contact"><a href="mailto: <?php echo $contact['email'] ?>"><?php echo $contact['name'] ?></a> - <?php echo $contact['phone'] ?></span>
                        <span class="ammenities"><?php echo $ammenities['booth_size'] ?> - <?php echo $ammenities['power']? "Power" : "" ?>, <?php echo $ammenities['display_vehicle']? "Vehicle" : ""?></span>
                        <span class="status flexbox space-between">
                            <?php 
                            if( get_field('paypal_id') ): 
                            echo "<p>Paid</p>";
                            elseif( $approval['approved'] ):
                            echo "<p>Approved</p>";
                            endif;
                            if( $approval['denied'] ):
                            echo "<p>Denied</p>";
                            endif; 
                            if( !isset( $approval['approved'] ) && !isset( $approval['approved'] ) ): ?>
                            <form onsubmit="approve(event)">
                                <input type="hidden" name="post_type" value="vendor" />
                                <input type="hidden" name="email" value="<?php echo $contact['email'] ?>" />
                                <input type="hidden" name="post_ID" value="<?php echo $post->ID ?>" />
                                <input type="hidden" name="date" value="<?php echo $eventDate ?>" />
                                <input type="hidden" name="name" value="<?php echo $contact['name'] ?>" />
                                <input type="hidden" name="location" value="<?php echo $location['title'].'<br/>'.$location['address'].'<br/>'.$location['city'].', '.$location['state'].'<br/>'.$location['zip_code']; ?>" />
                                
                                <button type="submit">Approve</button>
                            </form>
                            <form onsubmit="denied(event)">
                                <input type="hidden" name="post_type" value="vendor" />
                                <input type="hidden" name="post_ID" value="<?php echo $post->ID ?>" />
                                <input type="hidden" name="email" value="<?php echo $contact['email'] ?>" />
                                <input type="hidden" name="name" value="<?php echo $contact['name'] ?>" />

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
        <?php endif; ?>
    </main>
    <?php 
    get_footer(); 
    ?>