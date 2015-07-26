<?php
global $wp_query;

$image_width = get_option('product_image_width');
$image_height = get_option('product_image_height');
$cat_image_width = sp_get_theme_init_setting('wpec_product_category_size', 'width');
$cat_image_height = sp_get_theme_init_setting('wpec_product_category_size', 'height');

?>
<div id="grid_view_products_page_container">
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
	  <?php if(get_option('wpsc_category_grid_view') == 1) :?>
			<div class="wpsc_categories wpsc_category_grid group">
				<?php wpsc_start_category_query(array('category_group'=> 1, 'show_thumbnails'=> 1)); ?>
					<a href="<?php wpsc_print_category_url();?>" class="wpsc_category_grid_item  <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name();?>">
						<?php wpsc_print_category_image(get_option('category_image_width'),get_option('category_image_height')); ?>
					</a>
				<?php wpsc_end_category_query(); ?>
				
			</div><!--close wpsc_categories-->
	  <?php else:?>
			<ul class="wpsc_categories">
				<?php wpsc_start_category_query(array('category_group'=> 1, 'show_thumbnails'=> get_option('show_category_thumbnails'))); ?>
						<li>
							<?php wpsc_print_category_image(get_option('category_image_width'),get_option('category_image_height')); ?>
							
							<a href="<?php wpsc_print_category_url();?>" class="wpsc_category_link  <?php wpsc_print_category_classes_section(); ?>"><?php wpsc_print_category_name();?></a>
							<?php if(get_option('wpsc_category_description')) :?>
								<?php wpsc_print_category_description("<div class='wpsc_subcategory'>", "</div>"); ?>				
							<?php endif;?>
							
						</li>
				<?php wpsc_end_category_query(); ?>
			</ul>
		<?php endif; ?>
	<?php endif; ?>

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
			<div class="wpsc_page_numbers_top group">
				<?php wpsc_pagination(); ?>
			</div><!--close wpsc_page_numbers_top-->
	<?php endif; ?>		
		

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
			<?php /*
            if (get_option('show_search') != '1') {
                if(($spdata[THEME_SHORTNAME.'grid_items'] > 0) && ((($wp_query->current_post + 1) % $spdata[THEME_SHORTNAME.'grid_items']) == 0)) {
						echo '<div class="group"></div>';	
				}

            } else {
                if (get_option('show_advanced_search') != '1') {
					if(($spdata[THEME_SHORTNAME.'grid_items'] > 0) && ((($wp_query->current_post + 1) % $spdata[THEME_SHORTNAME.'grid_items']) == 0)) {
							echo '<div class="group"></div>';	
					}
                } else {
					if((get_option('grid_number_per_row') > 0) && ((($wp_query->current_post +1) % get_option('grid_number_per_row')) == 0)) {
						echo '<div class="group"></div>';	
					}
				}
            } */
			?>
            
		<?php endwhile; ?>
		
		<?php if(wpsc_product_count() == 0):?>
			<p><?php  _e('There are no products in this group.', 'sp'); ?></p>
		<?php endif ; ?>
		
		
	</div><!--close product_grid_display-->
	
		<?php if(wpsc_has_pages_bottom()) : ?>
			<div class="wpsc_page_numbers_bottom group">
				<?php wpsc_pagination(); ?>
			</div><!--close wpsc_page_numbers_bottom-->
		<?php endif; ?>
	<?php endif; ?>
	<?php echo sp_fancy_notifications(); ?>
    <?php do_action( 'wpsc_theme_footer' ); ?> 	

</div><!--close grid_view_products_page_container-->