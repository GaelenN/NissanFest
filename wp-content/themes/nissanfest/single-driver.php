<?php
get_header();
wp_print_styles( array('nf_driver') );

$details = get_field('details','options');
?>
<main id="single" class="driver">
  <section>
    <div class="container">
      <?php 
      if (have_posts()) :
      while (have_posts()) : 
      the_post();
      ?>
      <article>
      <h1><?php the_title() ?></h1>
        <ul>
          <li><strong>Team: </strong> <?php the_field('team_name'); ?></li>
          <li><strong>Vehicle: </strong> <?php the_field('year') ?> <?php the_field('make') ?> <?php the_field('model') ?></li>
          <li><strong>T-Shirt Size: </strong> <?php the_field('t-shirt'); ?></li>
          <li><strong>Status: </strong> 
          <?php if( get_field('paypal_id') ) { ?>
            Confirmed
            <?php } else { ?>
            Awaiting Payment
            <?php } ?>
        </li>
      </ul>
      <?php if( !get_field('paypal_id') ): ?>
      <h3>Make your payment to secure your spot</h3>
      <div id="paypal-button-container"></div>
      <form onsubmit="paymentForm(event);" name="payment">
          <input type="hidden" name="paid" value="" />
          <input type="hidden" name="id" value="<?php echo get_the_ID() ?>" />
        </form>
      <?php endif; ?>
      </article>
      <?php 
      endwhile;
      endif; 
      ?>
    </div>
  </section>
  <?php if( !get_field('paypal_id') ): ?>
  <script
  src="https://www.paypal.com/sdk/js?client-id=AWtVquRtWcMDZpQLTF4GUARSwXLiKNesINgDwvUA2fW2zRq02SBoDmCoROBl88epamelEezETxzJMWBu">
</script>
<script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: <?php echo $details['team-tandem']['cost'] ?>
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      $('input[name="paid"]').val(data.orderID);
      $('form[name="payment"]').submit();
    }
  }).render('#paypal-button-container');
  </script>
<?php endif; ?>
</main>
<?php 
get_footer(); 
?>
  