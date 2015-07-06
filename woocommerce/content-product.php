<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * actual version 1.6.4
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product->is_visible() )
	return;

// get quickview setting
$show_quickview = sp_get_option( 'quickview' );

if ( $show_quickview === 'on' )
	$quickview_class = 'quickview';
else
	$quickview_class = '';

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

// add column class
switch( $woocommerce_loop['columns'] ) {
	case 1:
		$classes[] = sp_column_css( '', '', '', '12' );
		break;

	case 2:
		$classes[] = sp_column_css( '', '', '', '6' );
		break;
		
	case 3:
		$classes[] = sp_column_css( '', '', '', '4' );
		break;
		
	case 4:
		$classes[] = sp_column_css( '', '', '', '3' );
		break;
		
	case 5:
		$classes[] = sp_column_css( '', '', '', '2' );
		$classes[] = 'hide-action-metas';
		break;
		
	case 6:
		$classes[] = sp_column_css( '', '', '', '2' );
		$classes[] = 'hide-action-metas';
		break;
		
	default:
		$classes[] = sp_column_css( '', '', '', '4' );
		break;

}

// get image width
$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $product->id ), 'shop_catalog' );

if ( $image_url ) {
	$image_width = $image_url[1];
} else {
	// get saved option
	$image_width = get_option( 'shop_catalog_image_size' );
	$image_width = $image_width['width']; 
}

// removes the default image function and load our own
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// product views
$view_type = sp_get_product_view_type();

if ( $view_type === 'list-view' && is_woocommerce() ) {
	$classes[] = 'clearfix';
	$image_wrap_column = apply_filters( 'sp_product_view_list_image_wrap_column', sp_column_css( '', '' ,'', '4' ) );
	$content_wrap = apply_filters( 'sp_product_view_list_content_wrap', sp_column_css( '', '', '', '8' ) );
} else {
	$image_wrap_column = '';
	$content_wrap = '';
}
?>

<!-- new code starts here-->
<div class="product_grid_item product_view_<?php echo get_the_ID(); ?>">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
	  <div class="inner_wrap">
		<div class="item_image">
			<a class="product-link" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
			
			<?php
			// get user set image width/height
			$catalog_image_size = get_option( 'shop_catalog_image_size' );

			// get alternate product image settings
			$hover_status = get_post_meta( $product->id, '_sp_alternate_product_image_on_hover_status', true );

			// get the alternate image
			$show_alt_image = false;
			if ( $hover_status === 'on' ) {
				$alt_image_id = absint( get_post_meta( $product->id, '_sp_alternate_product_image_id', true ) );
				$alt_image = sp_get_image( $alt_image_id, $catalog_image_size['width'], $catalog_image_size['height'], $catalog_image_size['crop'] );
				$show_alt_image = true;
			}

			$image = sp_get_image( get_post_thumbnail_id( $product->id ), $catalog_image_size['width'], $catalog_image_size['height'], $catalog_image_size['crop'] );

			echo '<img src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image['alt'] ) . '" itemprop="image" width="200" height="200" class="product_image" data-original="' . esc_url( $image['url'] ) . '" />' . PHP_EOL;

			if ( $product->is_on_sale() )
				echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'sp-theme' ) . '</span>', $post, $product );

			if ( $show_alt_image )
				echo '<img src="' . esc_attr( $alt_image['url'] ) . '" alt="' . esc_attr( $alt_image['alt'] ) . '" itemprop="image" width="200" height="200" class="product_image" />' . PHP_EOL;
		?>
			</a>
			<?php
			if ( $product->is_on_sale() )
			{
			?>	
			<span class="saletag">Sale</span>
			<?php } ?>
			<a class="more" href="<?php the_permalink(); ?>" style="display: none;">
				More Details
			</a> 
		</div><!--close item_image-->				
		<div class="grid_product_info">							
				<div class="price_container">
				<p class="pricedisplay <?php get_the_ID(); ?>">
				Old Price:
				<span class="oldprice">
				<?php 
					$price = get_post_meta( get_the_ID(), '_regular_price',true);
				?>
				$<?php echo $price;?>
				</span>
				</p>
				<p class="pricedisplay <?php get_the_ID(); ?>">
				Price:
				<span class="currentprice">
				<?php 
					$price = get_post_meta( get_the_ID(), '_regular_price',true);
				?>
				$<?php echo $price;?>
				</span></p>
				</div><!--close price_container-->
		</div><!--close grid_product_info-->
	</div><!--close inner_wrap-->	
	<h2 class="prodtitle">
	<input type="hidden" name="product_type" value="<?php echo esc_attr( $product_type ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo esc_attr( $product->id ); ?>" />
	<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
		<?php the_title(); ?>
	</a>
	</h2>
<!-- new code end for loop of products-->	
</div>