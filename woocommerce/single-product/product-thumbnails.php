<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>

	<div class="wpcart_gallery group thumbnails <?php echo 'columns-' . $columns; ?>"><?php

		foreach ( $attachment_ids as $attachment_id ) {

			$link = wp_get_attachment_thumb_url( $attachment_id );
			$link_big = wp_get_attachment_url( $attachment_id );
			
			if ( ! sp_is_single_product_page() ) {
	
				$sizes = sp_quickview_image_size( $link );
				$image_width = $sizes['image_width'];
				$image_height = $sizes['image_height'];

			} else {				
				
				$image_sizes = wc_get_image_size( 'shop_catalog' );
				$image_width = $image_sizes['width'];
				$image_height = $image_sizes['height'];
			}
			
				if ( get_post_meta( $attachment->ID, '_woocommerce_exclude_image', true ) == 1 ) 
					continue;
				
				if ( sp_isset_option( 'woo_image_swap', 'boolean', 'true' ) ) {	
					echo '<a href="'.$link_big.'" title="'.get_the_title( $attachment->ID ).'" class="thickbox preview_link" data-src="'.$link_big.'" data-rel="prettyPhoto['.$post->ID.']" onclick="return false;"><img src="'.$link.'" alt="'.get_the_title( $attachment->ID ).'" class="sp-attachment-thumbnails" /></a>';
				} else {
					echo '<a href="'.$link_big.'" title="'.get_the_title( $attachment->ID ).'" class="thickbox preview_link" data-src="'.$link_big.'" data-rel="prettyPhoto['.$post->ID.']" onclick="return false;"><img src="'.$link.'" alt="'.get_the_title( $attachment->ID ).'" /></a>';
				} 
			$i++;
		}

	?></div>
	<?php
}
