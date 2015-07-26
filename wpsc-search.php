<?php
$image_width = get_option('product_image_width');
$image_height = get_option('product_image_height');
$cat_image_width = sp_get_theme_init_setting('wpec_product_category_size', 'width');
$cat_image_height = sp_get_theme_init_setting('wpec_product_category_size', 'height');

?>
<div id="grid_view_products_page_container">
	<div class="product_grid_display group">
		<?php while (wpsc_have_products()) :  wpsc_the_product(); ?>
			<div class="product_grid_item product_view_<?php echo wpsc_the_product_id(); ?>">
				  <div class="inner_wrap">
					<div class="item_image">
				<?php if(wpsc_the_product_thumbnail()) :?> 	   
						<a href="<?php echo wpsc_the_product_permalink(); ?>" title="<?php echo wpsc_the_product_title(); ?>" class="product-link">
						<img class="product_image" alt="<?php echo wpsc_the_product_title(); ?>" src="<?php echo sp_timthumb_format( 'product_grid', sp_get_image( wpsc_the_product_id()), $image_width, $image_height); ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" />
						</a>
                            <?php if (wpsc_product_on_special() && sp_isset_option( 'saletag', 'boolean', 'true' )) : ?>
                            <span class="saletag"><?php _e( 'Sale', 'sp' ); ?></span>
                            <?php endif; ?>
                          <a href="<?php echo wpsc_the_product_permalink(); ?>" class="more"><?php _e('More Details', 'sp'); ?></a>                        
				<?php else: ?> 
						<a href="<?php echo wpsc_the_product_permalink(); ?>" title="<?php echo wpsc_the_product_title(); ?>" class="product-link">
						<img class="no-image" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo sp_timthumb_format( 'product_grid', get_template_directory_uri() . '/images/no-product-image.jpg', $image_width, $image_height ); ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" />
						</a>
                            <?php if(wpsc_product_on_special() && sp_isset_option( 'saletag', 'boolean', 'true' )) : ?>
                            <span class="saletag"><?php _e( 'Sale', 'sp' ); ?></span>
                            <?php endif; ?>
                          <a href="<?php echo wpsc_the_product_permalink(); ?>" class="more"><?php _e('More Details', 'sp'); ?></a>                        
				<?php endif; ?> 
					</div><!--close item_image-->				
					<div class="grid_product_info">							
                        	<div class="price_container">
							<?php if(wpsc_product_on_special()) : ?>
										<p class="pricedisplay <?php echo wpsc_the_product_id(); ?>"><?php _e('Old Price', 'sp'); ?>:<span class="oldprice"><?php echo wpsc_product_normal_price(); ?></span></p>
									<?php endif; ?>
									<p class="pricedisplay <?php echo wpsc_the_product_id(); ?>"><?php _e('Price', 'sp'); ?>:<span class="currentprice"><?php echo wpsc_the_product_price(); ?></span></p>
							</div><!--close price_container-->
					</div><!--close grid_product_info-->
						
                </div><!--close inner_wrap-->	
							<h2 class="prodtitle"><a href="<?php echo wpsc_the_product_permalink(); ?>" title="<?php echo wpsc_the_product_title(); ?>"><?php echo wpsc_the_product_title(); ?></a></h2>
                		
			</div><!--close product_grid_item-->
            
		<?php endwhile; ?>
	</div><!--close product_grid_display-->
	<?php echo sp_fancy_notifications(); ?>
</div><!--close grid_view_products_page_container-->