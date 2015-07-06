<?php
/*
For general blog post format and a fallback if no specific format template is found
*/

if ( is_sticky() )
	$sticky_class = 'sticky';
else
	$sticky_class = '';
?>
	<!-- new code starts-->
	<article class="post-<?php the_ID(); ?> post type-post status-publish format-standard hentry category-articles tag-fresh tag-pepper tag-red group list" id="post-<?php the_ID(); ?>">
		<div class="image-wrap">
		<?php
		// get featured video settings
		$video = get_post_meta( $post->ID, '_sp_post_featured_video', true );
		$poster = get_post_meta( $post->ID, '_sp_post_featured_video_poster', true );

		// if video is set, use that instead of image
		if ( isset( $video ) && ! empty( $video ) ) { 
			$type = sp_check_video_type( $video );
			$video_width = sp_get_theme_init_setting( 'set_post_thumbnail_size', 'width' );
			$video_height = sp_get_theme_init_setting( 'set_post_thumbnail_size', 'height' );

			if ( $type === 'embed' ) {
				echo wp_oembed_get( $video, array( 'width' => (int)$video_width ) );
			} elseif ( $type === 'mp4' ) {
				// strip the extension
				$video_noext = str_replace( '.mp4', '', $video );

				if ( ! isset( $poster ) || empty( $poster ) )
					$poster = '';
				
				echo do_shortcode( '[video mp4="' . esc_url( $video ) . '" ogv="' . esc_url( $video_noext . '.ogv' ) . '" webm="' . esc_url( $video_noext . '.webm' ) . '" width="' . esc_attr( (int)$video_width ) . '" poster="' . esc_attr( $poster ) . '"]' );
			}
		} else {
			// check if have post thumbnail
			if ( has_post_thumbnail() ) { 
				if ( is_singular() ) { ?>
					<div class="image-wrap"><?php the_post_thumbnail(); ?></div>
				<?php } else { 
					$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
				?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-image-link"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'lazyload', 'data-original' => $image_src[0] ) ); ?><span class="more">Read More</span></a>
				<?php } ?>
			<?php } ?> 
		<?php } ?>
                </div><!--close image-wrap-->   
                <div class="post-meta">           
			                <h2 class="entry-title">
							<a data-rel="bookmark" title="Permalink to <?php the_title(); ?>" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
							</a>
							</h2>
                <div class="entry-meta group">
                    <span class="calendar-icon">&nbsp;</span>
					<a data-rel="bookmark" title="<?php the_time('Y-m-d | h:i:sa'); ?>" href="<?php the_permalink(); ?>"><time class="entry-date" datetime="<?php the_time('Y-m-d | h:i:sa'); ?>" pubdate=""><?php the_time('F j, Y'); ?></time></a> 
					<span class="meta-sep">by</span>
					<span class="author vcard">
					<a title="View all posts by <?php get_the_author();?>" href="<?php get_the_author_link(); ?>" class="url fn n">
					<?php echo get_the_author();?></a>
					</span>
					</div><!-- .entry-meta -->
                <hr class="article-divider">
                <div class="entry-summary">
                	<p><?php the_excerpt(); ?></p>
                </div><!-- .entry-summary -->
            			<a class="more-link" title="Read More" href="<?php the_permalink(); ?>">
						Read More 
						<span class="icon">&nbsp;</span>
						</a>
            </div><!--close post-meta-->
            <div class="entry-utility group">
                <div class="group">&nbsp;</div>
                <span class="article-icon">&nbsp;</span>
				Posted in
				<?php 
				$categories = get_the_category();
				foreach($categories as $category)
				{
				?>
				<a rel="category tag" title="View all posts in <?php echo $category->name;?>" href="<?php echo get_category_link( $category->term_id );?>">
				<?php echo $category->name;?>
				</a>
				<?php  } ?>
				
				<span class="tag-icon">&nbsp;</span>
				Tags 
				
				<?php 
				$posttags = get_the_tags();
				foreach($posttags as $tags)
				{
				?>
				<a rel="tag" href="<?php echo get_tag_link($tags->term_id);?>">
				<?php echo $tags->name;?>
				</a>,
				<?php } ?>
				<span class="bookmark-icon">&nbsp;</span>
				Bookmark the 
				<a data-rel="bookmark" title="Permalink to <?php the_title(); ?>" href="<?php the_permalink(); ?>">
				permalink
				</a>
                <span class="comments-link">
				<span class="comment-icon">&nbsp;</span>
				<a title="Comment on <?php the_title(); ?>" href=" <?php comments_link(); ?> ">
				<?php 
				$comments_count = wp_count_comments();
				if($comments_count->total_comment==0)
				{
					echo "0";
				}
				else
				{
					echo $comments_count->total_comment;
				}
				echo $comments_count->total_comment;
				?> &nbsp;  Comments</a>
				</span>
        </div><!-- .entry-utility -->
		</article>
<!-- new code ends here-->
<!-- #post -->
