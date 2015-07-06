<?php
get_header();
 
$layout = sp_get_page_layout(); 
$orientation = $layout['orientation'];
$span_columns = $layout['span_columns'];

global $post;

// get page builder status
$pb_status = get_post_meta( $post->ID, '_sp_page_builder_status', true );
?>
	
	<?php
	// check if we need to display header
	if ( sp_display_header() ) {
		// don't show any title or breadcrumb for home
		if ( ! is_home() && ! is_front_page() ) {
		?>
		<header class="page-header">
			<div class="container">
				<?php sp_display_page_title(); ?>
				<?php sp_display_breadcrumbs(); ?>
			</div><!--close .container-->
		</header><!-- .page-header -->
	<?php
		}
	}
	?>
	
	<?php 
	// check if page builder is on
	if ( $pb_status === 'on' ) {
		sp_display_page_builder();
	} else {
	
	if(is_front_page())
	{
		$container_id = 'welcome';
	}
	else
	{
		$container_id = 'content';
	}
	?>

		<div id="<?php echo $container_id;?>">
		
				<?php if ( $layout['sidebar_left'] ) get_sidebar( 'left' ); ?>				
					
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'page' ); ?>
						<?php //comments_template( '', true ); ?>
					<?php endwhile; // end of the loop. ?>
				
				<?php if ( $layout['sidebar_right'] ) get_sidebar( 'right' ); ?>

			<?php do_action( 'sp_page_layout_after_content_row' ); ?>

		</div><!--close . container-->
	<?php
	}
	?>
<?php get_footer(); ?>