<?php
	/**
	 * The Transaction Results Theme.
	 *
	 * Displays everything within transaction results.  Hopefully much more useable than the previous implementation.
	 *
	 * @package WPSC
	 * @since WPSC 3.8
	 */
?>
	<script type="text/javascript">
	jQuery(window).load(function() {
			jQuery("#header_cart em.count").html("0");
			jQuery("#header_cart .shopping-cart-wrapper").html('<p class="empty"> <?php _e( 'Your shopping cart is empty', 'sp' ); ?> </p>');			
			jQuery(".progress_wrapper .final").addClass("act");	
	});
	</script>
<div class="progress_wrapper top">
    <ul>
        <li class="cart act"><?php _e('Your Cart', 'sp'); ?></li>
        <li class="info act"><?php _e('Info', 'sp'); ?></li>
        <li class="final"><?php _e('Final', 'sp'); ?></li>
    </ul>
</div><!--close progress_wrapper-->

<div class="wpsc-transaction-results-wrap">
	<?php echo wpsc_transaction_theme(); ?>
</div>