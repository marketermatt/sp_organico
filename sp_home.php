<?php 
/* Template Name: SP Home */
get_header();
if ( class_exists( 'WP_eCommerce' ) )
{
	if ( sp_isset_option( 'homepage_slider_enable', 'boolean', 'true' ) ) {
		if (sp_isset_option( 'homepage_slider_category', 'isset' ) && sp_isset_option( 'homepage_slider_category', 'value' ) != '') {
			$category = sp_isset_option( 'homepage_slider_category', 'value' );
			$rand = sp_isset_option( 'homepage_slider_random', 'value' );
			$item_count = sp_isset_option( 'homepage_slider_product_count', 'value' );
			$products = sp_wpec_get_products($category, $item_count, $rand); // limit to 30 products 	
	?>
	
            	<div id="home-slider">
                	<div id="slides">
                    <!--start generating slide html-->
                    <?php 
							$count = 0;   
							if ( is_object( $products ) && $products->have_posts() ) 
							{
								$image_width = 500;
								$image_height = 500;
								
								while ( $products->have_posts() ) : $products->the_post(); 
																	  
							 ?>
                        <div class="slide group">
                            <div class="product_description">
                                <h2><?php the_title(); ?></h2>
                                <p><?php echo sp_truncate(strip_tags( sp_wpsc_the_product_description(), '<p><a><ul><li><strong><br><em><small><div>' ), sp_isset_option( 'homepage_slider_description_characters', 'value' ), sp_isset_option( 'homepage_slider_description_denote', 'value' ), true, true); ?></p>
                                    <div class="price">
                                    <?php if (sp_isset_option( 'homepage_slider_display_price', 'boolean', 'true' )) { ?> 
										<?php if (sp_wpsc_product_on_special(get_the_ID())) { ?>
                                        
                                        <p class="special"><span class="old"><?php echo sp_wpsc_product_normal_price(get_the_ID()); ?></span><br />
                                        <?php echo sp_wpsc_the_product_price(false,get_the_ID()); ?>
                                        </p>
                                        <?php } else { ?>
                                        <p><?php echo sp_wpsc_the_product_price(false,get_the_ID()); ?></p>
                                        <?php } ?>
                                    <?php } // end display price check ?>
                                    <?php if (sp_isset_option( 'homepage_slider_display_link', 'boolean', 'true' )) { ?>
                                    	<p><a href="<?php the_permalink(); ?>" title="<?php _e("Buy Now",'sp'); ?>" class="buynow"><?php _e("Buy Now",'sp'); ?></a></p>
                                    <?php } ?>
                                    
                                	</div><!--close price-->  
                                	
                            </div><!--close product_description-->
							<?php
                            if ( has_post_thumbnail() ) { ?>
                            <div class="featured_image">
                                    <a href="<?php the_permalink(); ?>" title="<?php _e("Buy Now",'sp'); ?>">
									<?php echo woocommerce_get_product_thumbnail('shop_catalog');?>
									</a>
                            </div><!--close featured_image-->
                            <?php } else { ?>
                            <div class="featured_image">
                                    <a href="<?php the_permalink(); ?>" title="<?php _e("Buy Now",'sp'); ?>"><img src="<?php echo sp_timthumb_format( 'homepage_slider', get_template_directory_uri().'/images/no-product-image.jpg', $image_width, $image_height ); ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php the_title(); ?>" /></a>
                            </div><!--close featured_image-->
                            <?php } ?>
                        </div><!--close slide-->
                            <?php $count++; ?>
    						<?php endwhile; 
							} ?>
                    </div><!--close slides-->
                <span class="left-arrow">&lt;</span>
				<span class="right-arrow">&gt;</span>
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_interval', 'value' ); ?>" class="homepage_slider_interval" />                           
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_effects', 'value' ); ?>" class="homepage_slider_effects" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_transition', 'value' ); ?>" class="homepage_slider_transition" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_easing', 'value' ); ?>" class="homepage_slider_easing" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_pause', 'value' ); ?>" class="homepage_slider_pause" />   
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_direction', 'value' ); ?>" class="homepage_slider_direction" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_touchswipe', 'value' ); ?>" class="homepage_slider_touchswipe" />
                        
                </div><!--close home-slider-->
                <?php wp_reset_postdata(); ?>
<?php
		} // end check for category is set
	} // end check slider enabled
} //end WPEC check

if ( class_exists( 'woocommerce' ) )
{
	if ( sp_isset_option( 'homepage_slider_enable', 'boolean', 'true' ) ) 
	{
		if (sp_isset_option( 'homepage_slider_category', 'isset' ) && sp_isset_option( 'homepage_slider_category', 'value' ) != '') 
		{
			$category = sp_isset_option( 'homepage_slider_category', 'value' );
			$rand = sp_isset_option( 'homepage_slider_random', 'value' );
			$item_count = sp_isset_option( 'homepage_slider_product_count', 'value' );
			$products = sp_woo_get_products($category, $item_count, $rand); // limit to 30 products
		?>
            	<div id="home-slider">
                	<div id="slides">
                    <!--start generating slide html-->
                    <?php 
							$count = 0;   
							if ( is_object( $products ) && $products->have_posts() ) 
							{
								$image_width = 500;
								$image_height = 500;
								
								while ( $products->have_posts() ) : $products->the_post(); 
                                    // if 2.0+
                                    if ( function_exists( 'get_product' ) ) 
                                        $product = get_product( $post->ID );
                                    else
                                        $product = new WC_Product( $post->ID );								  
							 ?>
                        <div class="slide group">
                            <div class="product_description">
                                <h2><?php the_title(); ?></h2>
                                <p><?php echo sp_truncate(get_the_excerpt(), sp_isset_option( 'homepage_slider_description_characters', 'value' ), sp_isset_option( 'homepage_slider_description_denote', 'value' ), true, true); ?></p>
                                    
                                    <?php if (sp_isset_option( 'homepage_slider_display_price', 'boolean', 'true' )) { ?> 
										<div class="price">
                                            <p><?php echo $product->get_price_html(); ?></p>
                                        </div><!--close price-wrap-->
                                    <?php } // end display price check ?>
                                    <?php if (sp_isset_option( 'homepage_slider_display_link', 'boolean', 'true' )) { ?>
                                    	<p><a href="<?php the_permalink(); ?>" title="<?php _e("Buy Now",'sp'); ?>" class="buynow"><?php _e("Buy Now",'sp'); ?></a></p>
                                    <?php } ?>
                                	
                            </div><!--close product_description-->
							<?php
                            if ( has_post_thumbnail() ) { ?>
                            <div class="featured_image">
                                    <a href="<?php the_permalink(); ?>" title="<?php _e("Buy Now",'sp'); ?>"><?php echo get_the_post_thumbnail( $product_id, array($image_width,$image_height), array( 'class' => '' ) ); ?></a>
                            </div><!--close featured_image-->
                            <?php } else { ?>
                            <div class="featured_image">
                                    <a href="<?php the_permalink(); ?>" title="<?php _e("Buy Now",'sp'); ?>"><img src="<?php echo sp_timthumb_format( 'homepage_slider', get_template_directory_uri().'/images/no-product-image.jpg', $image_width, $image_height ); ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php the_title(); ?>" /></a>
                            </div><!--close featured_image-->
                            <?php } ?>
                        </div><!--close slide-->
                            <?php $count++; ?>
    						<?php endwhile; 
							} ?>
                    </div><!--close slides-->
                <span class="left-arrow">&lt;</span>
				<span class="right-arrow">&gt;</span>
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_interval', 'value' ); ?>" class="homepage_slider_interval" />                           
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_effects', 'value' ); ?>" class="homepage_slider_effects" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_transition', 'value' ); ?>" class="homepage_slider_transition" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_easing', 'value' ); ?>" class="homepage_slider_easing" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_pause', 'value' ); ?>" class="homepage_slider_pause" />   
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_direction', 'value' ); ?>" class="homepage_slider_direction" /> 
                    <input type="hidden" value="<?php echo sp_isset_option( 'homepage_slider_touchswipe', 'value' ); ?>" class="homepage_slider_touchswipe" />
                        
                </div><!--close home-slider-->
        <?php
		} // end check if category is set
	} // end check if enabled
} // end check for woo plugin
?>
                
<?php if (sp_isset_option( 'welcome_text', 'boolean', 'true' )) { ?>
<div id="welcome">
	<?php get_template_part( 'content', 'home' ); ?>
</div><!--close welcome-->
<?php } ?>
<?php get_footer(); ?>