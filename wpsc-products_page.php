<?php
global $wp_query;	

$image_width = get_option('product_image_width');
$image_height = get_option('product_image_height');
$cat_image_width = sp_get_theme_init_setting('wpec_product_category_size', 'width');
$cat_image_height = sp_get_theme_init_setting('wpec_product_category_size', 'height');

?>
<div id="default_products_page_container" class="wrap wpsc_container group">

<?php 
$args = array( 
	'crumb-separator' => ' / '
);
wpsc_output_breadcrumbs($args); ?>
<?php 
if (sp_isset_option( 'product_view_buttons', 'boolean', 'true' )) {
	if (get_option('show_search') != '1') {
		echo sp_product_view(); 
	} else {
		if (get_option('show_advanced_search') != '1') {
			echo sp_product_view();	
		}
	}
}
?>
	<?php do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search ?>
	<?php if(wpsc_display_categories()): ?>
	  <?php if(wpsc_category_grid_view()) :?>
			<div class="wpsc_categories wpsc_category_grid group">
				<?php wpsc_start_category_query(array('category_group'=> get_option('wpsc_default_category'), 'show_thumbnails'=> 1)); ?>
                    <a href="<?php wpsc_print_category_url();?>" class="wpsc_category_grid_item  <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name(); ?>">
						<?php wpsc_print_category_image(get_option('category_image_width'),get_option('category_image_height')); ?>
					</a>
				<?php wpsc_end_category_query(); ?>
				
			</div><!--close wpsc_categories-->
	  <?php else:?>
			<ul class="wpsc_categories">
			
				<?php wpsc_start_category_query(array('category_group'=>get_option('wpsc_default_category'), 'show_thumbnails'=> get_option('show_category_thumbnails'))); ?>
						<li>
							<?php wpsc_print_category_image(get_option('category_image_width'), get_option('category_image_height')); ?>
							
							<a href="<?php wpsc_print_category_url();?>" class="wpsc_category_link <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name(); ?>"><?php wpsc_print_category_name(); ?></a>
							<?php if(wpsc_show_category_description()) :?>
								<?php wpsc_print_category_description("<div class='wpsc_subcategory'>", "</div>"); ?>				
							<?php endif;?>
							
						</li>
				<?php wpsc_end_category_query(); ?>
			</ul>
		<?php endif; ?>
	<?php endif; ?>
<?php // */ ?>
	
	<?php if(wpsc_display_products()): ?>
		
	<?php if(wpsc_is_in_category()) : ?>
		<?php if ((get_option('wpsc_category_description') || get_option('show_category_thumbnails')) && (sp_check_ms_image(wpsc_category_image()) || wpsc_category_description()) ) { ?>
            <div class="wpsc_category_details group">
                    <?php if(get_option('show_category_thumbnails') && sp_check_ms_image(wpsc_category_image())) : ?>
                    <img src="<?php echo sp_timthumb_format( 'product_category_image', sp_check_ms_image(wpsc_category_image()), $cat_image_width, $cat_image_height); ?>" width="<?php echo $cat_image_width; ?>" height="<?php echo $cat_image_height; ?>" alt="<?php echo wpsc_category_name(); ?>" />
                <?php endif; ?>
                
                <?php if(get_option('wpsc_category_description') &&  wpsc_category_description()) : ?>
                    <p class="description"><?php echo wpsc_category_description(); ?></p>
                <?php endif; ?>
            </div><!--close wpsc_category_details-->
            <?php } ?>
	<?php endif; ?>
		<?php if(wpsc_has_pages_top()) : ?>
			<div class="wpsc_page_numbers_top">
				<?php wpsc_pagination(); ?>
			</div><!--close wpsc_page_numbers_top-->
		<?php endif; ?>		
		
	
	
		<?php /** start the product loop here */?>
		<?php while (wpsc_have_products()) :  wpsc_the_product(); ?>
			
			
			<?php if(wpsc_category_transition()) :?>
		  	<h3 class="wpsc_category_name"><?php echo wpsc_current_category_name(); ?></h3>
			<?php endif; ?>
		
			<div class="default_product_display product_view_<?php echo wpsc_the_product_id(); ?> <?php echo wpsc_category_class(); ?> group">   
				<?php if(wpsc_show_thumbnails()) :?>
					<div class="imagecol" id="imagecol_<?php echo wpsc_the_product_id(); ?>">
						<?php if(wpsc_the_product_thumbnail()) :
						?>
							<a title="<?php echo wpsc_the_product_title(); ?>" class="<?php echo wpsc_the_product_image_link_classes(); ?>" href="<?php echo wpsc_the_product_image(); ?>" data-id="<?php echo wpsc_the_product_id(); ?>">
								<img class="product_image" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo sp_timthumb_format( 'product_list', sp_get_image(wpsc_the_product_id()), $image_width, $image_height); ?>" />
                        	<img title="Loading" alt="Loading" src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" class="load loading-<?php echo wpsc_the_product_id(); ?>" />
                            <?php if (wpsc_product_on_special() && sp_isset_option( 'saletag', 'boolean', 'true' )) : ?>
                            <span class="saletag"><?php _e('Sale', 'sp'); ?></span>
                            <?php endif; ?>                            
							</a>
						<?php else: ?>
							<a href="<?php echo get_template_directory_uri(); ?>/images/no-product-image.jpg" title="<?php echo wpsc_the_product_title(); ?>" class="<?php echo wpsc_the_product_image_link_classes(); ?>" data-id="<?php echo wpsc_the_product_id(); ?>">
								<img class="no-image" alt="No Image" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo sp_timthumb_format( 'product_list', get_template_directory_uri().'/images/no-product-image.jpg', $image_width, $image_height); ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" />
                        	<img title="Loading" alt="Loading" src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" class="load loading-<?php echo wpsc_the_product_id(); ?>" />
                            <?php if (wpsc_product_on_special() && sp_isset_option( 'saletag', 'boolean', 'true' )) : ?>
                            <span class="saletag"><?php _e('Sale', 'sp'); ?></span>
                            <?php endif; ?>
								</a>
						<?php endif; ?>
                                            
					</div><!--close imagecol-->
				<?php endif; ?>
					<div class="productcol">
                        <h2 class="prodtitle entry-title">
							<?php if(get_option('hide_name_link') == 1) : ?>
								<?php echo wpsc_the_product_title(); ?>
							<?php else: ?> 
								<a class="wpsc_product_title" href="<?php echo wpsc_the_product_permalink(); ?>"><?php echo wpsc_the_product_title(); ?></a>
							<?php endif; ?>
						</h2>   
						<hr class="dashed" />
						<?php							
							do_action('wpsc_product_before_description', wpsc_the_product_id(), $wp_query->post);
							do_action('wpsc_product_addons', wpsc_the_product_id());
						?>
                        
						<div class="wpsc_description">
							<?php echo sp_wpsc_the_product_description(); ?>
                        </div><!--close wpsc_description-->
										
						<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
							<?php $action =  wpsc_product_external_link(wpsc_the_product_id()); ?>
						<?php else: ?>
						<?php $action = htmlentities(wpsc_this_page_url(), ENT_QUOTES, 'UTF-8' ); ?>					
						<?php endif; ?>		
						<form class="product_form_ajax"  enctype="multipart/form-data" action="<?php echo $action; ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>">
                        <?php do_action ( 'wpsc_product_form_fields_begin' ); ?>
							<input type="hidden" value="add_to_cart" name="wpsc_ajax_action" />
							<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id" />  
							<?php if ( wpsc_product_has_personal_text() ) : ?>
								<fieldset class="custom_text">
									<p><span><?php _e( 'Personalize Your Product', 'sp' ); ?></span><br />
									<?php _e( 'Complete this form to include a personalized message.', 'sp' ); ?></p>
									<textarea name="custom_text"></textarea>
								</fieldset>
							<?php endif; ?>
						
							<?php if ( wpsc_product_has_supplied_file() ) : ?>

								<fieldset class="custom_file">
									<legend><?php _e( 'Upload a File', 'sp' ); ?></legend>
									<p><?php _e( 'Select a file from your computer to include with this purchase.', 'sp' ); ?></p>
									<input type="file" name="custom_file" />
								</fieldset>
							<?php endif; ?>	
                                                  
							<div class="wpsc_product_price">
								<?php if( wpsc_show_stock_availability() ): ?>
									<?php if(wpsc_product_has_stock()) : ?>
										<div id="stock_display_<?php echo wpsc_the_product_id(); ?>" class="in_stock"><img src="<?php echo get_template_directory_uri(); ?>/images/instock.png" alt="In Stock" width="16" height="16" /><?php _e('Product in stock', 'sp'); ?></div>
									<?php else: ?>
										<div id="stock_display_<?php echo wpsc_the_product_id(); ?>" class="out_of_stock"><img src="<?php echo get_template_directory_uri(); ?>/images/outofstock.png" alt="Out of Stock" width="16" height="16" /><?php _e('Product not in stock', 'sp'); ?></div>
									<?php endif; ?>
								<?php endif; ?>
								<?php if(wpsc_product_is_donation()) : ?>
									<label for="donation_price_<?php echo wpsc_the_product_id(); ?>"><?php _e('Donation', 'sp'); ?>: </label>
									<input type="text" class="donation_price_<?php echo wpsc_the_product_id(); ?>" name="donation_price" value="<?php echo wpsc_calculate_price(wpsc_the_product_id()); ?>" size="6" />

								<?php else : ?>
									<?php if(wpsc_product_on_special()) : ?>
										<p class="pricedisplay product_<?php echo wpsc_the_product_id(); ?>"><?php _e('Old Price', 'sp'); ?>: <span class="oldprice old_product_price_<?php echo wpsc_the_product_id(); ?>"><?php echo wpsc_product_normal_price(); ?></span></p>
									<?php endif; ?>
									<p class="pricedisplay product_<?php echo wpsc_the_product_id(); ?>"><?php _e('Price', 'sp'); ?>: <span class="currentprice pricedisplay product_price_<?php echo wpsc_the_product_id(); ?>"><?php echo wpsc_the_product_price(); ?></span></p>
									<?php if(wpsc_product_on_special()) : ?>
										<p class="pricedisplay product_<?php echo wpsc_the_product_id(); ?>"><?php _e('You save', 'sp'); ?>: <span class="yousave yousave_<?php echo wpsc_the_product_id(); ?>"><?php echo wpsc_currency_display(wpsc_you_save('type=amount'), array('html' => false)); ?>!</span></p>
									<?php endif; ?>
									
									<!-- multi currency code -->
									<?php if(wpsc_product_has_multicurrency()) : ?>
	                                	<?php echo wpsc_display_product_multicurrency(); ?>
                                    <?php endif; ?>
									
									<?php if(wpsc_show_pnp()) : ?>
                                    	<?php if (!preg_match('/.[0].[0][0]/',wpsc_product_postage_and_packaging())) : ?>
										<p class="pricedisplay"><?php _e('Shipping', 'sp'); ?>:<span class="pp_price"><?php echo wpsc_product_postage_and_packaging(); ?></span></p>
									<?php endif; ?>
                                    	<?php endif; ?>							
								<?php endif; ?>
							</div><!--close wpsc_product_price-->
                        	<hr class="dashed" />
						<?php /** the variation group HTML and loop */?>
                        <?php if (wpsc_have_variation_groups()) { ?>
                        <fieldset>
						<div class="wpsc_variation_forms">
                        	<table><?php $i = 1; ?>
							<?php while (wpsc_have_variation_groups()) : wpsc_the_variation_group(); ?>
                            	<?php if ($i&1) { ?><tr class="row<?php echo $i; ?>"><?php } ?>
								<td class="col"><label for="<?php echo wpsc_vargrp_form_id(); ?>"><?php echo wpsc_the_vargrp_name(); ?>:</label><br /><select class="wpsc_select_variation_ajax" name="variation[<?php echo wpsc_vargrp_id(); ?>]" id="<?php echo wpsc_vargrp_form_id(); ?>">
								<?php while (wpsc_have_variations()) : wpsc_the_variation(); ?>
									<option value="<?php echo wpsc_the_variation_id(); ?>" <?php echo wpsc_the_variation_out_of_stock(); ?>><?php echo wpsc_the_variation_name(); ?></option>
								<?php endwhile; ?>
								</select></td>
                                <?php if (!$i&1) { ?></tr><?php } ?> 
                                <?php $i++; ?>
							<?php endwhile; ?>
                            </table>
						</div><!--close wpsc_variation_forms-->
                        </fieldset>
                        <hr class="dashed" />
						<?php } ?>
						<?php /** the variation group HTML and loop ends here */?>
							
							<!-- THIS IS THE QUANTITY OPTION MUST BE ENABLED FROM ADMIN SETTINGS -->
							<?php if(wpsc_has_multi_adding()): ?>
                            	<fieldset class="quantity"><label><?php _e('Quantity:', 'sp'); ?></label>
								<div class="wpsc_quantity_update">
                                <?php /*<label for="wpsc_quantity_update_<?php echo wpsc_the_product_id(); ?>"><?php _e('Quantity', 'sp'); ?>:</label>*/ ?>
								<input type="text" id="wpsc_quantity_update_<?php echo wpsc_the_product_id(); ?>" name="wpsc_quantity_update" size="2" value="1" />
								<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
								<input type="hidden" name="wpsc_update_quantity" value="true" />
                                </div><!--close wpsc_quantity_update-->
                                </fieldset>
							<?php endif ;?>
					
							<!-- END OF QUANTITY OPTION -->
							<?php if((get_option('hide_addtocart_button') == 0) &&  (get_option('addtocart_or_buynow') !='1')) : ?>
								<?php if(wpsc_product_has_stock()) : ?>
									<div class="wpsc_buy_button_container group">
										<div class="wpsc_loading_animation group">
											<img title="Loading" alt="Loading" src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" />
										</div><!--close wpsc_loading_animation-->
											<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
											<?php $action = wpsc_product_external_link( wpsc_the_product_id() ); ?>
											<input class="wpsc_buy_button external-purchase" type="submit" value="<?php echo wpsc_product_external_link_text( wpsc_the_product_id(), __( 'Buy Now', 'sp' ) ); ?>" data-external-link="<?php echo $action; ?>" data-link-target="<?php echo wpsc_product_external_link_target( wpsc_the_product_id() ); ?>" />
											<?php else: ?>
                                        <div class="input-button-buy">    
										<input type="submit" value="<?php _e('Add To Cart', 'sp'); ?>" name="Buy" class="wpsc_buy_button" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
                                        <div class="alert error"><p><?php _e('Please select product options before adding to cart','sp'); ?></p><span>&nbsp;</span></div>
                                        <div class="alert addtocart"><p><?php _e('Item has been added to your cart!','sp'); ?></p><span>&nbsp;</span></div>                                                                             
                                        </div><!--close input-button-buy-->
											<?php endif; ?>
                                            
									</div><!--close wpsc_buy_button_container-->
								<?php endif ; ?>
							<?php endif ; ?>
							<div class="entry-utility wpsc_product_utility">
								<?php edit_post_link( __( 'Edit', 'sp' ), '<span class="edit-link">', '</span>' ); ?>
							</div>
						<?php 
						if(get_option( 'product_ratings' ) == 1) :
							echo sp_product_rating(get_the_ID()); 
						endif;
						?>
                         <?php do_action ( 'wpsc_product_form_fields_end' ); ?>   
						</form><!--close product_form-->
						<?php if((get_option('hide_addtocart_button') == 0) && (get_option('addtocart_or_buynow')=='1')) : ?>
							<?php echo wpsc_buy_now_button(wpsc_the_product_id()); ?>
						<?php endif ; ?>						
						
					<?php // */ ?>
				</div><!--close productcol-->
		</div><!--close default_product_display-->

		<?php endwhile; ?>
		<?php /** end the product loop here */?>
		<?php if(wpsc_product_count() == 0):?>
			<h3><?php  _e('There are no products in this group.', 'sp'); ?></h3>
		<?php endif ; ?>
        <?php echo sp_fancy_notifications(); ?>
	    <?php do_action( 'wpsc_theme_footer' ); ?> 	

		<?php if(wpsc_has_pages_bottom()) : ?>
			<div class="wpsc_page_numbers_bottom">
				<?php wpsc_pagination(); ?>
			</div><!--close wpsc_page_numbers_bottom-->
		<?php endif; ?>
	<?php endif; ?>
    <input type="hidden" value="<?php echo get_option("fancy_notifications"); ?>" class="fancy-notification" />
</div><!--close default_products_page_container-->
