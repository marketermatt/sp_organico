<?php
/**
 * Product Loop End
 *
 * actual version 2.0.0
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     5.0.0
 */

$add_class = '';

if ( is_woocommerce() ) {
	$add_class = sp_get_product_view_type();
}
?>
</div>