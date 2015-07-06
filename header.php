<?php
global $page, $paged, $post;
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js <?php echo sp_get_browser_agent(); ?>" id="top">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
<script>
jQuery(document).ready(function() {
	jQuery('ul.sub-menu li').append('<span class="before"> </span>');
});
</script>
</head>

<body <?php body_class(); ?>>
<noscript><p class="noscript"><?php _e( 'This site requires JavaScript.  Please enable it in your browser settings.', 'sp-theme' ); ?></p></noscript>
<!--[if lte IE 7]><p class="noscript"><?php _e( 'It appears you\'re using a very old Internet Explorer browser version.  Please update to the latest version to view this site properly.', 'sp-theme' ); ?></p><![endif]-->

<div id="wrap-all">
	<div class="group" id="top_wrapper">
    	<div class="container">
			<?php sp_get_menu( 'primary-menu' ); ?>
            
			<!--HEADER CART-->
            <div id="header_cart">
            	<div class="hover-wrap">
            	<a onclick="return false" class="cart_icon" title="Checkout" href="http://organico.splashingpixels.com/store/checkout/">
						<span class="icon"></span>
						<em class="count">
							0
						</em>
					</a>
            	<div id="cartContents">
                    <div class="shopping-cart-wrapper">
					<p class="empty">
						Your shopping cart is empty
					</p>
                    </div>
                </div><!--close cartContents-->    
                </div><!--close hover-wrap-->   
            	<a class="account_icon" title="My Account" href="/web/20130116145457/http://organico.splashingpixels.com/store/your-account/">Account</a>
                                <div id="search_tab">
                	<form class="searchform" method="get" action="/web/20130116145457/http://organico.splashingpixels.com/">
						<fieldset>
							<input type="text" value="Search Products" class="search" name="s">
							<input type="hidden" name="post_type" value="wpsc_product">
						</fieldset>
					</form>
                	<span class="tab"></span>
                </div><!--close search_tab-->
            </div><!--close header_cart-->
                        
            <!--END HEADER CART-->                            
        </div><!--close container-->
    </div>
	
	<div id="wrapper" class="hfeed">
	<div class="container">
	<?php do_action( 'sp_before_main_header_container' ); ?>
	<header id="header" class="group">
		<div class="logo-tagline-container">
            <!--LOGO--> 
             <?php 
				echo sp_display_logo();
			 ?>
            <!--END LOGO-->
            <!--TAGLINE-->
            <?php //echo sp_display_tagline(); ?>            
            <!--END TAGLINE-->
        </div>
	</header>
	<!-- product slider-->
	<?php 
	if(is_front_page())
		{
			echo sp_home_product_slider();
		}
	?>
	<!--product slider ends here-->
	<?php do_action( 'sp_after_main_nav_container' ); ?>
