<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @package WooCommerce
 * @since WooCommerce 1.6
 */
 
global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) 
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) 
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibilty
if ( ! $product->is_visible() ) 
	return; 

// Increase loop count
$woocommerce_loop['loop']++;
?>
<li class="product product_grid_item <?php 
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 ) 
		echo 'last'; 
	elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 ) 
		echo 'first'; 
	?>">
    
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
        <div class="inner_wrap">
			<div class="item_image">                    	
                <a title="<?php the_title(); ?>" href="<?php echo the_permalink(); ?>">
                <?php do_action( 'woocommerce_before_shop_loop_item_title', 'product_grid' );  ?>
                </a>
                <?php if($product->is_on_sale() && sp_isset_option( 'saletag', 'boolean', 'true' ) ) : ?><span class="saletag"><?php _e('Sale', 'sp'); ?></span><?php endif; ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="more"><?php _e('More Details','sp'); ?></a>
            </div><!--close item_image-->
            <div class="grid_product_info">
            	<div class="price_container">
                	<p class="pricedisplay"><?php echo $product->get_price_html(); ?></p>
                </div><!--close price_container-->
            </div><!--close grid_product_info-->
        </div><!--close inner_wrap-->
        <h2 class="prodtitle"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        <input type="hidden" value="<?php echo $post->ID; ?>" class="hidden-id product-id" />
	
    <?php //do_action('woocommerce_after_shop_loop_item_title'); ?> 
</li>