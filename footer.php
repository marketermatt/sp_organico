	</div><!--close container-->
</div><!--close wrapper-->
<?php
if (class_exists('WP_eCommerce')) {
	if (sp_isset_option('footer_carousel_enable', 'boolean', 'true')) { ?>    
        <?php $image_count = 0; ?>
        <div id="featured_wrapper">
        <div class="container">
        <section class="footer_featured group">
        	<div class="footer_slider">
                <span class="footer-arrow-left">&lt;</span>
                <?php 
                if (sp_isset_option( 'footer_carousel_display_type', 'isset' ) && sp_isset_option( 'footer_carousel_display_type', 'value' ) == "products" ) {
                    $footer_rand = sp_isset_option( 'footer_featured_random', 'value' );
                    $footer_slider_category = sp_isset_option( 'footer_carousel_category', 'value' );
					$footer_item_count = sp_isset_option( 'footer_carousel_product_count', 'value' );
                    $featured_products = sp_wpec_get_products($footer_slider_category, $footer_item_count, $footer_rand); // limit to 30 products
                                            
					if ( $featured_products->have_posts() ) 
					{
						$image_width = '175';
						$image_height = '175';
						
						echo '<ul class="group">';

						while ( $featured_products->have_posts() ) : $featured_products->the_post();
						
						echo '<li class="product-slide">';
							
						if (sp_get_image(get_the_ID())) {
							echo '<a href="' . get_permalink() . '" class="products" title="'.get_the_title().'">';
							echo '<img src="' . sp_timthumb_format("footer_carousel", sp_get_image(get_the_ID()), $image_width, $image_height) . '" />';
							if (sp_wpsc_product_on_special(get_the_ID()) && sp_isset_option( 'footer_carousel_featured_tag', 'boolean', 'true' )) : ?>
                            <span class="tag"><?php _e( 'Sale', 'sp' ); ?></span>
                            <?php endif;
                            echo '</a>';
							echo '<h2><a href="' . wpsc_product_url( get_the_ID(), null ) . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h2><hr />';
							echo '<a href="' . wpsc_product_url( get_the_ID(), null ) . '" class="more" title="'.__("More Details",'sp').'"><span class="icon">&nbsp;</span>'.__("More Details",'sp').'</a>'; 
						} else {
							echo '<a href="' . get_permalink() . '" class="products" title="'.get_the_title().'">';
							echo '<img src="'. sp_timthumb_format("footer_carousel", get_template_directory_uri(). "/images/no-product-image.jpg", $image_width, $image_height).'" alt="' . get_the_title() . '" width="'.$image_width.'" height="'.$image_height.'" />';
							if (sp_wpsc_product_on_special(get_the_ID()) && sp_isset_option( 'footer_carousel_featured_tag', 'boolean', 'true' )) : ?>
                            <span class="tag"><?php _e( 'Sale', 'sp' ); ?></span>
                            <?php endif;
                            echo '</a>';
							echo '<h2><a href="' . wpsc_product_url( get_the_ID(), null ) . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h2><hr />';
							echo '<a href="' . wpsc_product_url( get_the_ID(), null ) . '" class="more" title="'.__("More Details",'sp').'"><span class="icon">&nbsp;</span>'.__("More Details",'sp').'</a>';	
										
						} // end have image
						echo '</li>';
						$image_count++;
						endwhile;  
						echo '</ul>';
						wp_reset_postdata();
				} // end have posts
                } elseif (sp_isset_option( 'footer_carousel_display_type', 'boolean', 'categories') ) {	
                        if (sp_isset_option( 'footer_carousel_categories', 'isset' ) && (is_array(sp_isset_option( 'footer_carousel_categories', 'value' )) ? !in_array( '0', sp_isset_option( 'footer_carousel_categories', 'value' ) ) : '' ) ) {								
                        
                            $footer_carousel_rand = sp_isset_option( 'footer_featured_random', 'value' );
                            $cats = sp_isset_option( 'footer_carousel_categories', 'value' );
							$footer_item_count = sp_isset_option( 'footer_carousel_product_count', 'value' );
                            if ($footer_carousel_rand == "true") {
                                shuffle($cats);	
                            }
                            $output = '';
                            $image_count = 0;
                            if (count($cats) > 0 ) {
                                $output .= '<ul class="group">';
                                foreach ($cats as $cat) {
									if ( $image_count > $footer_item_count )
										break;																			
                                    $cat_obj = get_term($cat, 'wpsc_product_category');
                                    $cat_link = wpsc_category_url((int)$cat);
                                    $output .= '<li>';

                                    $image_width = '175';
                                    $image_height = '175';
                                    
                                    if (wpsc_category_image($cat) != false) {
										$output .= '<a href="' . $cat_link . '" class="products" title="'.$cat_obj->name.'">';
                                        $output .= '<img src="' .sp_timthumb_format('footer_carousel', sp_check_ms_image(wpsc_category_image($cat)), $image_width, $image_height).'" title="' . $cat_obj->name . '" alt="' . $cat_obj->name . '" width="'.$image_width.'" height="'.$image_height.'" /></a>';
										$output .= '<h2><a href="" title="">' . stripslashes( $cat_obj->name ) . '</a></h2><hr />';
                                        $output .= '<a href="' . $cat_link . '" class="more" title="'.__("More Details",'sp').'">'.__("More Details",'sp').'</a>';
                                    } else {
										$output .= '<a href="' . $cat_link . '" class="products" title="'.$cat_obj->name.'">';
                                        $output .='<img alt="'. $cat_obj->name . '" title="'.$cat_obj->name.'" src="'.sp_timthumb_format('footer_carousel', get_template_directory_uri(). '/images/no-product-image.jpg', $image_width, $image_height).'" width="'.$image_width.'" height="'.$image_height.'" /></a>';
										$output .= '<h2><a href="' . $cat_link . '" title="' . stripslashes( $cat_obj->name ) . '">' . stripslashes( $cat_obj->name ) . '</a></h2><hr />';
                                        $output .= '<a href="' . $cat_link . '" class="more" title="'.__("More Details",'sp').'">'.__("More Details",'sp').'</a>';	
                                    } // end have images
                                    $output .= '</li>';
                                    $image_count++;
                                } // end foreach
                                $output .= '</ul>';
                            } // end have categories
                            echo $output;
                        } // end categories set
                } ?>
                <span class="footer-arrow-right">&gt;</span>
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_scroll_items', 'value' ); ?>" class="footer_carousel_scroll_items" />
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_interval', 'value' ); ?>" class="footer_carousel_interval" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_speed', 'value' ); ?>" class="footer_carousel_speed" />  
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_circular', 'value' ); ?>" class="footer_carousel_circular" />  
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_easing', 'value' ); ?>" class="footer_carousel_easing" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_reverse', 'value' ); ?>" class="footer_carousel_reverse" />    
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_reverse', 'value' ); ?>" class="footer_carousel_reverse" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_pauseonhover', 'value' ); ?>" class="footer_carousel_pauseonhover" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_effects', 'value' ); ?>" class="footer_carousel_effects" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_autoscrolldirection', 'value' ); ?>" class="footer_carousel_autoscrolldirection" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_infinite', 'value' ); ?>" class="footer_carousel_infinite" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_touchwipe', 'value' ); ?>" class="footer_carousel_touchwipe" /> 
                <input type="hidden" value="<?php echo ($image_count > 4) ? '4' : $image_count; ?>" class="footer_carousel_visible" />  
                
            </div><!--close footer_slider-->
        </section><!--close footer_featured-->
        </div><!--close container-->
        </div><!--close featured_wrapper-->
    <?php 
	} // end if carousel enabled
		
} // end WPEC check ?>

		<?php
if (class_exists( 'woocommerce' )) {
	if (sp_isset_option('footer_carousel_enable', 'boolean', 'true')) { ?> 
    	<?php $image_count = 0; ?>   
        <div id="featured_wrapper">
        <div class="container">        
		<section class="footer_featured group">
			<div class="footer_slider">
				<span class="footer-arrow-left">&lt;</span>
				<?php 
                if (sp_isset_option( 'footer_carousel_display_type', 'isset' ) && sp_isset_option( 'footer_carousel_display_type', 'value' ) == "products" ) {
                    $footer_rand = sp_isset_option( 'footer_featured_random', 'value' );
                    $footer_slider_category = sp_isset_option( 'footer_carousel_category', 'value' );
					$footer_item_count = sp_isset_option( 'footer_carousel_product_count', 'value' );
                    $featured_products = sp_woo_get_products($footer_slider_category, $footer_item_count, $footer_rand); // limit to 30 products  
                                        					
					if ( $featured_products->have_posts() ) 
					{
						$image_width = '175';
						$image_height = '175';
						$dots = '';
						
						echo '<ul class="group">';
						$image_count = 0;
						while ( $featured_products->have_posts() ) : $featured_products->the_post();
													
						echo '<li>';

						if (sp_get_image(get_the_ID())) {
							echo '<a href="' . get_permalink(). '" class="products" title="'.__("More Details",'sp').'">';
							echo woocommerce_get_product_thumbnail('shop_catalog');
							echo "</a>";
							echo '<h2><a href="' . get_permalink() . '" title="'.stripslashes( get_the_title() ).'">'.stripslashes( get_the_title() ).'</a></h2><hr />';
							echo '<a href="' . get_permalink() . '" class="more" title="'.__("More Details",'sp').'">'.__("More Details",'sp').'</a>'; 
						} else {
							echo '<a href="' . get_permalink(). '" class="products" title="'.__("More Details",'sp').'">';							
							echo '<img title="'.get_the_title().'" src="'. sp_timthumb_format("footer_carousel", get_template_directory_uri(). "/images/no-product-image.jpg", $image_width, $image_height).'" alt="' . get_the_title() . '" width="'.$image_width.'" height="'.$image_height.'" /></a>';
							echo '<h2><a href="' . get_permalink() . '" title="'.stripslashes( get_the_title() ).'">'.stripslashes( get_the_title() ).'</a></h2><hr />';
							echo '<a href="' . get_permalink(). '" class="more" title="'.__("More Details",'sp').'"><span class="icon">&nbsp;</span>'.__("More Details",'sp').'</a>';
																		
						} // end have image
						echo '</li>';
						$image_count++;
						
						endwhile;
						wp_reset_postdata();
						echo "</ul>";
					} // end have posts check
					
                } elseif (sp_isset_option( 'footer_carousel_display_type', 'boolean', 'categories') ) {	
                        if (sp_isset_option( 'footer_carousel_categories', 'isset' ) && (is_array(sp_isset_option( 'footer_carousel_categories', 'value' )) ? !in_array( '0', sp_isset_option( 'footer_carousel_categories', 'value' ) ) : '' ) ) {								
                        	$output = '';
                            $footer_carousel_rand = sp_isset_option( 'footer_featured_random', 'value' );
                            $cats = sp_isset_option( 'footer_carousel_categories', 'value' );
							$footer_item_count = sp_isset_option( 'footer_carousel_product_count', 'value' );
                            if ($footer_carousel_rand == "true") {
                                shuffle($cats);	
                            }
                            if (count($cats) > 0 ) {
                                $output .= '<ul class="group">';
                                foreach ($cats as $cat) {
									if ( $image_count > $footer_item_count )
										break;																												
									$cat_obj = get_term($cat, 'product_cat');
									if ( ! is_object( $cat_obj ) )

										continue;
									$cat_link = get_term_link( (int)$cat, 'product_cat');
                                    $dots = '';
                                    $output .= '<li>';

                                    $image_width = '175';
                                    $image_height = '175';
                                    
									$term_id = get_woocommerce_term_meta((int)$cat,'thumbnail_id');
									$cat_image = wp_get_attachment_image_src( $term_id, 'full' );
									$cat_image = sp_check_ms_image($cat_image[0]);
									if ($cat_image) {
										$output .= '<a href="' . $cat_link . '" class="products" title="'.__("More Details",'sp').'">1111';
                                        $output .= '<img src="' .sp_timthumb_format('footer_carousel', $cat_image, $image_width, $image_height).'" title="' . $cat_obj->name . '" alt="' . $cat_obj->name . '" width="'.$image_width.'" height="'.$image_height.'" /></a>';
										$output .= '<h2><a href="' . $cat_link . '" title="' .stripslashes( $cat_obj->name ).'">'.stripslashes( $cat_obj->name ).'</a></h2><hr />';
                                        $output .= '<a href="' . $cat_link . '" class="more" title="'.__("More Details",'sp').'">'.__("More Details",'sp').'</a>';
                                    } else {
										$output .= '<a href="' . $cat_link . '" class="products" title="'.__("More Details",'sp').'">';
                                        $output .='<img alt="'. $cat_obj->name . '" title="'.$cat_obj->name.'" src="'.sp_timthumb_format('footer_carousel', get_template_directory_uri(). '/images/no-product-image.jpg', $image_width, $image_height).'" width="'.$image_width.'" height="'.$image_height.'" /></a>';
										$output .= '<h2><a href="' . $cat_link . '" title="' .stripslashes( $cat_obj->name ).'">'.stripslashes( $cat_obj->name ).'</a></h2><hr />';
                                        $output .= '<a href="' . $cat_link . '" class="more" title="'.__("More Details",'sp').'">'.__("More Details",'sp').'</a>';	
                                    } // end have images
                                    $output .= '</li>';
                                    $image_count++;
                                } // end foreach
                                $output .= '</ul>';
                            } // end have categories
                            echo $output;
                        } // end categories set
                        ?>
                <?php
                } ?>
				<span class="footer-arrow-right">&gt;</span>
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_scroll_items', 'value' ); ?>" class="footer_carousel_scroll_items" />
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_interval', 'value' ); ?>" class="footer_carousel_interval" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_speed', 'value' ); ?>" class="footer_carousel_speed" />  
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_circular', 'value' ); ?>" class="footer_carousel_circular" />  
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_easing', 'value' ); ?>" class="footer_carousel_easing" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_reverse', 'value' ); ?>" class="footer_carousel_reverse" />    
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_reverse', 'value' ); ?>" class="footer_carousel_reverse" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_pauseonhover', 'value' ); ?>" class="footer_carousel_pauseonhover" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_effects', 'value' ); ?>" class="footer_carousel_effects" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_autoscrolldirection', 'value' ); ?>" class="footer_carousel_autoscrolldirection" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_infinite', 'value' ); ?>" class="footer_carousel_infinite" /> 
                <input type="hidden" value="<?php echo sp_isset_option( 'footer_carousel_touchwipe', 'value' ); ?>" class="footer_carousel_touchwipe" /> 
                <input type="hidden" value="<?php echo ($image_count > 4) ? '4' : $image_count; ?>" class="footer_carousel_visible" />  
                
			</div><!--close footer_slider-->
		</section><!--close footer_featured-->
        </div><!--close container-->
        </div><!--close featured_wrapper-->
        
	<?php 
	} // end if carousel enabled 

} // end WOO plugin check ?>
	<footer role="contentinfo" class="group" id="footer-wrapper">  
    	<div class="container">
        <!-- FOOTER WIDGETS-->
       <?php if ( sp_isset_option( 'footer_widget', 'isset' ) && sp_isset_option( 'footer_widget', 'value' ) != '0') { ?>
        <section id="footer-widget" class="group">
					  <?php
					  // sets an array with the number of columns to output
					  $columns = array('4' 	=> array('footer-col col4','footer-col col4','footer-col col4','footer-col col4'),
										 '3'	=> array('footer-col col3','footer-col col3','footer-col col3'),
										 '2' 	=> array('footer-col col2','footer-col col2'),
										 '1' 	=> array('') );
					  $i = 0;
					  
						if (is_array($columns[sp_isset_option( 'footer_widget', 'value' )])) {
						foreach($columns[sp_isset_option( 'footer_widget', 'value' )] as $col): 
						
								 $i++;
								 if($i == 1){ 
									  $class = "first"; 
								 } else {
									  $class = "";	
								 }
							?>
							<div class="<?php echo $col;?> <?php echo $class; ?>">
								 <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-'.$i) ) ?>
							</div>
					  <?php endforeach; 
						}
					  ?>
        </section><!--close footer-widget-->
        <?php } ?>
        <!--END FOOTER WIDGETS-->
       	<section id="footer_nav" class="group">
            <!--SOCIAL MEDIA-->
            <?php if (sp_isset_option( 'facebook_enable', 'boolean', 'true') || sp_isset_option( 'twitter_enable', 'boolean', 'true') || sp_isset_option( 'flickr_enable', 'boolean', 'true') || sp_isset_option( 'rss_enable', 'boolean', 'true') || sp_isset_option( 'gplus_enable', 'boolean', 'true') || sp_isset_option( 'pinterest_enable', 'boolean', 'true') || sp_isset_option( 'youtube_enable', 'boolean', 'true')) 			
			{ ?>
            <div id="social-media" class="group">
					<?php sp_social_media_script(); ?>
            </div><!--close social-media-->
            <?php } ?>
            <!--END SOCIAL MEDIA-->  
        	<?php wp_nav_menu( array('container' => 'nav', 'container_id' => 'footer-nav', 'fallback_cb' => 'footer_menu', 'theme_location' => 'footer', 'depth' => 1, 'after' => '<span>-</span>' ) ); ?>
            <small class="copy"> 
			  <?php if ( sp_isset_option( 'footer_copyright', 'isset' ) && sp_isset_option( 'footer_copyright', 'value' ) != '') : ?>
                  <?php echo sp_isset_option( 'footer_copyright', 'value' ); ?>
              <?php endif; ?>
        	</small>
            <!--LOGO--> 
            <?php if (sp_isset_option( 'footer_logo', 'boolean', 'true' ) ) { ?>            
            <?php $alt_text = sprintf( __( '%s', 'sp' ), sp_isset_option( 'footer_logo_alt_text', 'value' ) ); ?>
            <a href="<?php echo home_url(); ?>" title="<?php echo $alt_text; ?>" id="footer-logo">
            <?php if (sp_isset_option( 'footer_logo_image_text', 'boolean', 'image' ) ) :
            			if (sp_isset_option( 'footer_logo_image', 'isset' ) ) {
							$logo_url = sp_isset_option( 'footer_logo_image', 'value' );
							if (is_ssl())
								$logo_url = str_replace('http', 'https', $logo_url); 
							echo '<img src="'.$logo_url.'" alt="'.sp_isset_option( 'footer_logo_alt_text', 'value' ).'" />';
						} else {
							if (sp_isset_option( 'skins', 'boolean', '1')) {
								echo '<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.sp_isset_option( 'footer_logo_alt_text', 'value' ).'" />';
							} else {
								echo '<img src="'.get_template_directory_uri().'/skins/images/skin'.sp_isset_option( 'skins', 'value' ).'/logo.png" alt="'.sp_isset_option( 'footer_logo_alt_text', 'value' ).'" />';
							}
						}
            	 elseif (sp_isset_option( 'footer_logo_image_text', 'boolean', 'text' )) : 
                		if (sp_isset_option( 'footer_logo_text_title', 'isset')) {
							echo stripslashes(sp_isset_option( 'footer_logo_text_title', 'value' ));
						} else {
							_e('Your Logo Here','sp');	
						}
				endif; ?>
            </a>
            <?php } ?>
            <!--END LOGO-->
        </section>
			<!--start lightbox hidden values-->
            <input type="hidden" value="<?php echo sp_isset_option( 'lightbox_social', 'value' ); ?>" id="lightbox_social" />
            <input type="hidden" value="<?php echo sp_isset_option( 'lightbox_theme', 'value' ); ?>" id="lightbox_theme" />
            <input type="hidden" value="<?php echo sp_isset_option( 'lightbox_slideshow', 'value' ); ?>" id="lightbox_slideshow" />
            <input type="hidden" value="<?php echo sp_isset_option( 'lightbox_show_overlay_gallery', 'value' ); ?>" id="lightbox_show_overlay_gallery" />
            <input type="hidden" value="<?php echo sp_isset_option( 'lightbox_title', 'value' ); ?>" id="lightbox_title" />
            <input type="hidden" value="<?php echo sp_isset_option( 'variation_image_swap', 'value' ); ?>" id="variation_image_swap" />
            <!--end lightbox hidden values-->	
            <input type="hidden" value="<?php echo sp_isset_option( 'tabs_start_collapsed', 'value' ); ?>" id="tabs_start_collapsed" />
            
        </div><!--close container-->
	</footer>
</div><!--close wrap-all-->
<?php dynamic_sidebar( 'site-bottom-widget' ); ?>
<?php wp_footer(); ?>

</body>
</html>
