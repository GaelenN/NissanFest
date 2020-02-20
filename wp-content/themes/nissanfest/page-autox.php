<?php
get_header();
wp_print_styles( array( 'nf_entrants' ) );

$details = get_field('event_details','options');
$eventDate = get_field('event_date', 'options');
$eventYear = new DateTime($eventDate);
$eventYear = $eventYear->format('Y');
$expiry = new DateTime($eventDate);
$expiry = $expiry->format('D, j M Y 12:00:00 e');
$args = array (
    'post_type' => 'driver',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'nissanfest-events',
            'field'    => 'slug',
            'terms'    => 'autox',
        ),
    ),
);
$entrants = new WP_Query( $args );
?>
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo $nf_config['paypal'] ?>"></script>
<main id="entrants">
    <section id="registration">
        <div class="container">
            <h1><?php the_title() ?></h1>
            <?php if(!isset($_COOKIE["autox"]) && ( $entrants->found_posts <= $details['autox']['maximum'] ) ) { ?>
            <form onsubmit="registerForm(event);" name="register" class="flexbox space-between wrap <?php echo $post->post_name ?>" >
                <h2 id="form-title">Register Now </h2>
                
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
                    <div id="paypal-button-container"></div>
                </li>
                
                <input type="hidden" name="cat" value="autox"/>
                <input type="hidden" name="paid" value="" />
                <input type="hidden" name="post_type" value="driver"/>
                <input type="hidden" name="expiry" value="<?php echo $expiry ?>" />
                <input type="hidden" name="item_name" value="NissanFest <?php the_title() ?>" />
                <input type="hidden" name="item_number" value="NFCS<?php echo $eventYear ?>" />
                
            </form>
            <script>
                paypal.Buttons({
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: <?php echo $details['autox']['cost'] ?>
                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            $('input[name="paid"]').val(data.orderID);
                            $('form[name="register"]').submit();
                            // Call your server to save the transaction
                            return fetch('/paypal-transaction-complete', {
                                method: 'post',
                                headers: {
                                    'content-type': 'application/json'
                                },
                                body: JSON.stringify({
                                    orderID: data.orderID
                                })
                            });
                        });
                    }
                }).render('#paypal-button-container');
            </script>
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
    <section class="table">
        <div class="container">
            <ul>
                <li class='flexbox title'>
                    <span>Name</span>
                    <span>Year</span>
                    <span>Make</span>
                    <span>Model</span>
                    <span>T-Shirt</span>
                </li>
                <?php
                while ( $entrants->have_posts() ): 
                    $entrants->the_post();
                ?>
                    <li class='flexbox'>
                        <span><?php the_title() ?></span>
                        <span><?php the_field('year') ?></span>
                        <span><?php the_field('make') ?></span>
                        <span><?php the_field('model') ?></span>
                        <span><?php the_field('t-shirt') ?></span>
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