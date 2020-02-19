<?php
get_header();
wp_print_styles( array( 'nf_entrants' ) );

$details = get_field('event_details','options');
$eventDate = get_field('event_date', 'options');
$eventYear = new DateTime($eventDate);
$eventYear = $eventYear->format('Y');
$expiry = new DateTime($eventDate);
$expiry = $expiry->format('D, j M Y 12:00:00 e');

$today = date('Ymd'); 
$tandemApplication = $details['team-tandem']['application_date'];

?>
<main id="entrants">
    <section id="registration">
        <div class="container">
            <h1><?php the_title() ?></h1>
            <?php if(!isset($_COOKIE["team-tandem"]) && ($today < $tandemApplication) ) { ?>
                <form onsubmit="registerForm(event);" name="register" class="flexbox space-between wrap <?php echo $post->post_name ?>" >
                    
                    <h2 id="form-title">Apply Now</h2>
                    
                    <!-- Entrant Team Name -->
                    <li id="team-name">
                        <label for="title">Team Name</label>
                        <input type="text" value="" name="team-name" data-error="Your Team Name is Required" required/>
                    </li>
                    
                    <!-- Entrant Name -->
                    <li>
                        <label for="title">Name</label>
                        <input type="text" value="" name="name" data-error="Your Full Name is Required" required/>
                    </li>
                    
                    <!-- Entrant Email -->
                    <li id="email">
                        <label for="title">Email</label>
                        <input type="email"  value="" name="email" data-error="Your Email is Required" required/>
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
                    
                    <!-- Vehicle Year -->
                    <li id="year">
                        <label for="year">Year:</label>
                        <input type="text" value="" name="year"/>
                    </li>
                    
                    <!-- Vehicle Make -->
                    <li id="make">
                        <label for="make">Make:</label>
                        <input type="text" value="" name="make"/>
                    </li>
                    
                    <!-- Vehicle Model -->
                    <li id="model">
                        <label for="model">Model:</label>
                        <input type="text" value="" name="model"/>
                    </li>
                    
                    <li id="submit" >
                        <button type="submit" class="btn">Apply</button>
                    </li>
                    
                    <input type="hidden" name="cat" value="team-tandem"/>
                    <input type="hidden" name="post_type" value="driver"/>
                    <input type="hidden" name="item_name" value="NissanFest <?php the_title() ?>" />
                    <input type="hidden" name="item_number" value="NFCS<?php echo $eventYear ?>" />
                    <input type="hidden" name="expiry" value="<?php echo $expiry ?>" />
                </form>
                <?php } ?>
            </div>
        </section>
        <?php if( have_posts() ): ?>
        <section id="content">
            <div class="container">
                <?php 
                while( have_posts() ):
                the_post();
                the_content();
                endwhile;
                ?>
            </div>
        </section>
        <?php endif; ?>
        <section id="applied" class="table">
            <div class="container">
                <?php
                $args = array (
                    'post_type' => 'driver',
                    'posts_per_page' => -1,
                    'meta_key'			=> 'team_name',
                    'orderby'			=> 'meta_value',
                    'order'				=> 'ASC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'nissanfest-events',
                            'field'    => 'slug',
                            'terms'    => 'team-tandem',
                        ),
                    ),
                );
                $entrants = new WP_Query( $args );
                $html = '';
                ?>
                <ul>
                    <li class='flexbox title'>
                        <span>Team Name</span>
                        <span>Driver Name</span>
                        <span>Vehicle</span>
                        <span>T-Shirt</span>
                        <span class="status">Status</span>
                    </li>
                    <?php
                    while ( $entrants->have_posts() ): 
                    $entrants->the_post();
                    ?>
                    <li class='flexbox'>
                        <span><?php the_field('team_name') ?></span>
                        <span><?php the_title() ?></span>
                        <span><?php the_field('year') ?> <?php the_field('make') ?> <?php the_field('model') ?></span>
                        <span><?php the_field('t-shirt') ?></span>
                        <span class="status flexbox space-between">
                            <?php if( get_field('approved') ): ?>
                                <p>Approved</p>
                            <?php elseif( get_field('paypal_id') ): ?>
                                <p>Paid</p>
                            <?php else: ?>
                                <p>Pending</p>
                            <?php endif; ?>
                            <?php if( is_user_logged_in() && !get_field('approved') ): ?>
                            <form onsubmit="approve(event)">
                                <input type="hidden" name="post_type" value="driver" />
                                <input type="hidden" name="key" value="team_name" />
                                <input type="hidden" name="compare" value="<?php the_field('team_name') ?>" />

                                <button type="submit">Approve</button>
                            </form>
                            <?php endif; ?>
                        </span>
                    </li>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
        </section>

    </main>
    <?php 
    get_footer(); 
    ?>