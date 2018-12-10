<?php
get_header();
$url = 'https://'.$_SERVER[HTTP_HOST];
?>
<main id="page">
<section>
<!-- New Post Form -->
<div id="postbox" class="container">
<form id="new_entrant" name="new_entrant" method="post" action="/wp-content/themes/nissanfest/actions/post-paypal.php" >

<!-- Event Type -->
<li>
<label for="Category">Event type:</label>
<?php $cat_args = array(
    'taxonomy'    => 'nissanfest-events',
    'hide_empty'  => 0,
    'value_field' => 'slug',
); ?>
<?php wp_dropdown_categories($cat_args); ?>
</li>

<!-- Team Name -->
<li id="team-name" style="display: none;">
<label for="title">Team Name</label>
<input type="text" id="team" value="" name="team-name" />
</li>

<!-- Entrant Name -->
<li>
<label for="title">Name</label>
<input type="text" id="title" value="" name="title" />
</li>

<!-- Entrant Email -->
<li>
<label for="title">Email</label>
<input type="email" id="email" value="" name="email" />
</li>

<!-- Tshirt Size -->
<li>
<label for="title">Tshirt Size</label>
<select name="tshirt">
<option value='s'>Small</option>
<option value='m'>Medium</option>
<option value='l'>Large</option>
<option value='xl'>X-Large</option>
<option value='xxl'>XX-Large</option>
</select>
</li>

<!-- Vehicle Make -->
<li>
<label for="make">Make:</label>
<input type="text" id="make" value="" name="make" />
</li>

<!-- Vehicle Model -->
<li>
<label for="model">Model:</label>
<input type="text" id="model" value="" name="model" />
</li>

<!-- Vehicle Year -->
<li>
<label for="year">Year:</label>
<input type="text" id="year" value="" name="year" />
</li>

<!-- Event Category -->
<li id="car-cat">
<label for="Category">Car Category:</label>
<select>
<optgroup label="Nissan">
<option value="Nissan GT-R" >R35 GT-R</option>
<option value="Nissan S-Chassis">S13/S14/S15</option> 
<option value="Nissan Skyline R31 to R34">Skyline R31 to R34</option> 
<option value="Nissan Truck" >Truck/SUV</option>
<option value="Nissan B-Chassis">B12/B13/B14/B15</option>
<option value="Nissan 300ZX" >300ZX</option>
<option value="Nissan Z" >Z (350/370)</option>
<option value="Nissan Other" >Other</option>
</optgroup>
<optgroup label="Datsun">
<option value="Datsun Z" >Classic Z</option>
<option value="Datsun 510" >510</option>
<option value="Datsun Truck" >Truck</option>
<option value="Datsun Other" >Other</option>
</optgroup>
<optgroup label="Infiniti">
<option value="Infiniti G Coupe" >G Coupe (G35/G37)</option>
<option value="Infiniti Sedan">Sedan (G35/G37/Q40/Q50/Q60)</option>
<option value="Infiniti SUV" >SUV</option>
<option value="Infiniti Other" >Other</option>
</optgroup>
</select>
</li>

<li>
<input type="submit" value="Register" id="submit" name="submit" />
</li>

<input type="hidden" name="action" value="new_post" />
<input type="hidden" name="paid" value="false" />
<input type="hidden" name="item_name" value="NissanFest Car Show" />
<input type="hidden" name="item_number" value="NFCS2019" />
<input type="hidden" name="amount" value="0.01" />
<input type="hidden" name="url_add" value="" />

<?php wp_nonce_field( 'new-post' ); ?>
</form>

</div>
</section>
</main>
<?php 
get_footer(); 
?>
<script>
jQuery('#email').keyup(function() {
    $('input[name="url_add"]').val('email='+$(this).val());
});
jQuery('select[name="cat"]').change(function() {
    var price = '0.01';
    var id = '';
    var name = '';
    if($(this).val() === 'team-tandem') {
        // price = '125';
        id = 'NFTT2019';
        name = 'NissanFest Team Tandem';
    } else
    if($(this).val() === 'autox') {
        // price = '60';
        id = 'NFAX2019';
        name = 'NissanFest AutoX';
    } else
    if($(this).val() === '1-8mi-drag') {
        // price = '40';
        id = 'NFDR2019';
        name = 'NissanFest Drags';
    }
    else {
        // price = '40';
        id = 'NFCS2019';
        name = 'NissanFest Car Show';
    }
    $('input[name="amount"]').val(price);
    $('input[name="item_number"]').val(id);
    $('input[name="item_name"]').val(name);
});
</script>