<?php 
global $page, $paged, $current_user, $woocommerce;
get_currentuserinfo();
$fb_html = '';
if ( sp_isset_option( 'facebook_opengraph', 'boolean', 'true' ) && (  ( class_exists( 'WooCommerce' ) && is_product() ) ) ) 
{ 
	$fb_html = 'xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"';
} ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js <?php echo sp_get_browser_agent();?>" <?php echo $fb_html; ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'sp' ), max( $paged, $page ) );

	?></title>
<?php 
if ( sp_isset_option( 'facebook_opengraph', 'boolean', 'true' ) && class_exists( 'WooCommerce' )  ) 
{ 
		
	if ( class_exists( 'WooCommerce' ) && is_product() ) {
		while ( have_posts() ) : the_post();
			$product_title = get_the_title();
			$product_url = get_permalink();
			$product_image_link = sp_get_image( get_the_ID() );
			$product_description = get_the_content();
		endwhile;
		wp_reset_postdata(); ?>
<meta property="og:title" content="<?php echo $product_title; ?>" />
<meta property="og:type" content="<?php echo sp_isset_option( 'facebook_opengraph_type', 'value' ); ?>" />
<meta property="og:url" content="<?php echo $product_url; ?>" />
<meta property="og:image" content="<?php echo $product_image_link; ?>" />
<meta property="og:site_name" content="<?php echo bloginfo( 'name' ); ?>" />
<meta property="fb:admins" content="<?php echo sp_isset_option( 'facebook_opengraph_admin_id', 'value' ); ?>" />
<meta property="fb:app_id" content="<?php echo sp_isset_option( 'facebook_opengraph_app_id', 'value' ); ?>" /> 
<meta property="og:description" content="<?php echo strip_tags( $product_description ); ?>" />            
	<?php        
	}
} // end check for opengraph and cart ?>  
<?php if (sp_isset_option( 'mobile_zoom', 'boolean', 'true' ) ) { ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php } else { ?>
<meta name="viewport" content="width=device-width, intital-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<?php } ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php echo sp_facebook_script(); ?>
<?php dynamic_sidebar( 'site-top-widget' ); ?>
<div id="wrap-all">
	<div id="top_wrapper" class="group">
    	<div class="container">
    	<nav class="group" id="main-nav">
			<?php /* if dynamic menu is not set, it fallbacks to wp_list_pages function */ ?>
            <?php wp_nav_menu( array( 'container' => 'false', 'fallback_cb' => 'header_menu', 'theme_location' => 'header', 'before' => '<span class="before">&nbsp;</span>') ); ?>
    	</nav>
            <!--HEADER CART-->
            <?php if ( class_exists( 'WooCommerce' ) )
			{ ?>
            
            <div id="header_cart">
            	<div class="hover-wrap">
            	<a href="<?php echo get_option('shopping_cart_url'); ?>" title="<?php _e('Checkout', 'sp'); ?>" class="cart_icon" onClick="return false">
                    <span class="icon"></span>
                    
                    <em class="count">
                    <?php 
					if (class_exists('WooCommerce')) {
								if ($woocommerce->cart->cart_contents_count == 0) {
									echo "0";
								} else {
									echo $woocommerce->cart->cart_contents_count;
								}
					} ?>
                    </em></a>
            	<div id="cartContents">
                    <div class="shopping-cart-wrapper">
                        <?php 
						if (class_exists('WooCommerce')) {
							the_widget('SP_WooCommerce_Widget_Cart', array('title' => '&nbsp;'));
						}
                        ?>
                    </div>
                </div><!--close cartContents-->    
                </div><!--close hover-wrap-->   
				<?php if ( class_exists( 'WooCommerce' ) ) {
                    $account_url = get_permalink( get_option( 'woocommerce_myaccount_page_id', true ) );
                } else {
                    $account_url = get_option('user_account_url');
                } ?>
                
            	<a href="<?php echo $account_url; ?>" title="<?php _e('My Account', 'sp'); ?>" class="account_icon"><?php _e('Account', 'sp'); ?></a>
                <?php if(is_user_logged_in()) : ?>
				<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e('Logout', 'sp'); ?>" class="account_logout"><?php _e('(Logout)', 'sp'); ?>                
                <img title="Loading" alt="Loading" src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" class="header-logout-loading" />
                </a>
                <?php endif; ?>
                <div id="search_tab">
                	<?php get_search_form(); ?>
                	<span class="tab">Tab</span>
                </div><!--close search_tab-->
                             
            </div><!--close header_cart-->
            <?php } ?>
            
            <!--END HEADER CART-->                            
        </div><!--close container-->
    </div><!--close top_wrapper-->
    
<div id="wrapper" class="hfeed">
	<div class="container">
	<header class="group <?php echo (!sp_isset_option( 'homepage_slider_enable', 'isset' ) ) ? 'no-slider' : ''; ?>" id="header">
            <div class="logo-tagline-container">
            <!--LOGO--> 
            <?php $alt_text = sprintf( __( '%s', 'sp' ), sp_isset_option( 'logo_alt_text', 'value' ) ); ?>
            <a href="<?php echo home_url(); ?>" title="<?php echo $alt_text; ?>" id="logo">
            <?php if (sp_isset_option( 'site_logo_image_text', 'boolean', 'image' ) ) :
            			if (sp_isset_option( 'logo_image', 'isset' ) ) {
							$logo_url = sp_isset_option( 'logo_image', 'value' );
							if (is_ssl())
								$logo_url = str_replace('http', 'https', $logo_url); 
							echo '<img src="'.$logo_url.'" alt="'.sp_isset_option( 'logo_alt_text', 'value' ).'" />';
						} else {
							if (sp_isset_option( 'skins', 'boolean', '1')) {
								echo '<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.sp_isset_option( 'logo_alt_text', 'value' ).'" />';
							} else {
								echo '<img src="'.get_template_directory_uri().'/skins/images/skin'.sp_isset_option( 'skins', 'value' ).'/logo.png" alt="'.sp_isset_option( 'logo_alt_text', 'value' ).'" />';
							}
						}
            	 elseif (sp_isset_option( 'site_logo_image_text', 'boolean', 'text' )) : 
                		if (sp_isset_option( 'site_logo_text_title', 'isset')) {
							echo stripslashes(sp_isset_option( 'site_logo_text_title', 'value' ));
						} else {
							_e('Your Logo Here','sp');	
						}
				endif; ?>
            </a>
            <!--END LOGO-->
                <!--TAGLINE-->
                <?php if (sp_isset_option( 'tagline', 'boolean', 'true' )) : ?>
                <h1 id="tagline">
                    <?php bloginfo( 'description' ); ?>
                </h1>
                <?php endif; ?>        
                <!--END TAGLINE-->
        </div><!--close logo-tagline-container-->
	</header>
