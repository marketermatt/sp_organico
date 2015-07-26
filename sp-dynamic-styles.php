<?php
/**
* SP FRAMEWORK FILE - DO NOT EDIT!
* 
* dynamic code
******************************************************************/
if ( class_exists( 'WP_eCommerce' ) ) 
{

$image_width = get_option('product_image_width');
$single_image_width  = get_option( 'single_view_image_width' );
$post_thumbnail_width =	get_option('thumbnail_size_w');

/*
$output .= '.product_grid_display h2.prodtitle {width:'.$image_width.'px;}';
$output .= '.default_product_display .productcol {width:'.(630 - $image_width).'px;}';
$output .= '.default_product_display .productcol .leftcol {width:'.(630 - $image_width - 200).'px;}';
$output .= '#container.onecolumn .default_product_display .productcol {width:'.(920 - $image_width).'px;}';
$output .= '#container.onecolumn .default_product_display .productcol .leftcol {width:'.(920 - $image_width - 200).'px;}'; */
$output .= '.single_product_display .imagecol {width:' . ( $single_image_width + 5 ) . 'px;}';
}

if ( class_exists( 'woocommerce' ) )
{
	$image_width  = get_option( 'shop_catalog_image_size' );
	$post_image_width = get_option('thumbnail_size_w');
}

?>