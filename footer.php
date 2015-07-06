		
	 </div><!--close container-->	
	</div><!--close #wrapper-->
	<!-- featured product slider-->
	<div id="featured_wrapper">
		<div class="container">
			<section class="footer_featured group">
				<?php echo sp_home_feature_product_slider();?>
			</section><!--close footer_featured-->
		</div><!--close container-->
	</div>
	<!-- featured product slider-->
	<?php do_action( 'sp_before_main_footer_container' ); ?>
		
		<footer id="footer-wrapper" class="group" role="contentinfo">
			<?php get_sidebar( 'footer' ); ?>
			<div class="container">
			<section class="group" id="footer_nav">
				<!--SOCIAL MEDIA-->
                <div class="group" id="social-media">
					<ul>
					<li class="pinterest">
						<a title="Follow our Pins" href="">
							Pinterest
						</a>
					</li>
					<li class="gplus">
						<a title="Checkout our Google Plus Profile" href="">Google Plus</a>
					</li>
					<li class="rss">
						<a title="Get Fed on our Feeds" href="http://organico.splashingpixels.com/feed/">RSS
						</a>
					</li>
					</ul>
				</div><!--close social-media-->
						<div class="<?php echo sp_column_css( '12', '6', '', '6' ); ?>">
							<?php echo sp_copyright_html(); ?>
						</div><!--close .column-->

						<div class="<?php echo sp_column_css( '12', '6', '', '6' ); ?>">
							<?php sp_get_menu( 'footer-bar-menu' ); ?> 
							<?php echo sp_footer_phone_number_html(); ?> 
						</div><!--close .column-->		
				<?php echo sp_display_logo(); ?>				
			</section><!--close .footer-bar-->
			</div><!--close .container-->
		</footer><!--close #footer-wrap-->
		<?php do_action( 'sp_after_main_footer_container' ); ?>
</div><!--close #wrap-all-->

<?php echo sp_back_to_top_html(); ?>

<?php wp_footer(); ?>
</body>
</html>