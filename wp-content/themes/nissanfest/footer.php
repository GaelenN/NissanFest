<footer>
<div class="container">
<nav>
<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => false) ); ?>
</nav>
<p class="copyright">Copyright Northwest Nissans <?php echo Date("Y"); ?></p>
</div>
</footer>
<div class="overlay">
</div>
<div class="modal">
<a onclick="modalClose();" class="close">X</a>
<form id="" name="new_entrant" method="post" action="/wp-content/themes/nissanfest/actions/post-paypal.php" >
<input type="hidden" name="cat" value=""/>

<h2 id="form-title"></h2>

<!-- Team Name -->
<li id="team-name">
<label for="title">Team Name</label>
<input type="text" value="" name="team-name" required/>
</li>
<div class="driver">
	<h3 class="driver-title">Driver #1</h3>
<!-- Entrant Name -->
<li>
<label for="title">Name</label>
<input type="text" value="" name="name[0]" required/>
</li>

<!-- Event Category -->
<li id="car-cat">
<label for="Category">Car Category:</label>
<select name="category">
<option selected hidden>- Select Category -</option>
<optgroup label="Nissan">
<option value="Nissan GT-R" >R35 GT-R</option>
<option value="Nissan Skyline R31 to R34">Skyline R31 to R34</option> 
<option value="Nissan S-Chassis">S13/S14/S15</option> 
<option value="Nissan 300ZX" >300ZX</option>
<option value="Nissan 370Z" >370z)</option>
<option value="Nissan 350Z" >350z</option>
<option value="Nissan Altima/Maxima">Altima/Maxima</option>
<option value="Nissan B-Chassis">B12/B13/B14/B15</option>
<option value="Nissan Other" >Other</option>
<option value="Nissan Truck" >Truck/SUV</option>
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

<!-- Vehicle Year -->
<li id="year">
<label for="year">Year:</label>
<input type="text" value="" name="year[0]"/>
</li>

<!-- Vehicle Make -->
<li id="make">
<label for="make">Make:</label>
<input type="text" value="" name="make[0]"/>
</li>

<!-- Vehicle Model -->
<li id="model">
<label for="model">Model:</label>
<input type="text" value="" name="model[0]"/>
</li>

<!-- Tshirt Size -->
<li id="shirt">
<label for="title">Tshirt Size</label>
<select name="tshirt[0]">
<option selected hidden>- Select Shirt Size -</option>
<option value='s'>Small</option>
<option value='m'>Medium</option>
<option value='l'>Large</option>
<option value='xl'>X-Large</option>
<option value='xxl'>XX-Large</option>
<option value='xxxl'>XXX-Large</option>
</select>
</li>

<!-- Entrant Email -->
<li id="email">
<label for="title">Email</label>
<input type="email"  value="" name="email[0]" required/>
</li>

</div><!-- closes driver -->
<li class="adddriver">
<a onclick="addDriver()" class="btn">Add Driver</a>
</li>
<li id="submit" >
<a onclick="checkform(event);" class="btn">Register</a>
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
<?php wp_footer(); ?>
</body>
</html>