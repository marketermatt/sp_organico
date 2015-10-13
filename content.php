<?php 
$image_width = get_option('thumbnail_size_w');
$image_height = get_option('thumbnail_size_h');
?>
    
		<article id="post-<?php the_ID(); ?>" <?php post_class('group list'); ?>>
			<?php  
			$post_image_url = has_post_thumbnail(get_the_ID());
			if (has_post_thumbnail()  && $post_image_url ) { ?>
				<div class="image-wrap">
				<a href="<?php the_permalink(); ?>" title="<?php _e( 'Read More', 'sp' ); ?>" class="post-image-link">
				<?php // context was blog_list for timthumb 310x80
					echo get_the_post_thumbnail($post->ID, 'thumbnail', array('class' => "wp-post-image $size", 'alt' => trim( strip_tags($attachment->post_title)), 'title' => trim( strip_tags($attachment->post_title)))); ?>
                <span class="more"><?php _e('Read More', 'sp'); ?></span></a>
                </div><!--close image-wrap-->   
                <div class="post-meta">           
			<?php } else { ?>
				<div class="post-meta no-image">
            <?php } ?>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sp' ), the_title_attribute( 'echo=0' ) ); ?>" data-rel="bookmark"><?php the_title(); ?></a></h2>
    
                <div class="entry-meta group">
                    <?php sp_posted_on(); ?>
                </div><!-- .entry-meta -->
                <hr class="article-divider" />
        <?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
                <div class="entry-summary">
                	<p>
                	<?php
					$count = get_post_meta($post->ID, '_sp_truncate_count', true);
					$denote = get_post_meta($post->ID, '_sp_truncate_denote', true);
					$disabled = get_post_meta($post->ID, '_sp_truncate_disabled', true);
					?>
                    <?php 
                    if ( $disabled != '1' )
					{                    					
					echo sp_truncate(get_the_excerpt(), (!isset($count) || $count == null) ? 200 : $count, (!isset($denote) || $denote == null) ? '...' : $denote, get_post_meta($post->ID, '_sp_truncate_precision', true), true); 
					} else {
						the_excerpt();	
					}
					?>
                    </p>
                </div><!-- .entry-summary -->
        <?php else : ?>
                <div class="entry-content">
                    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sp' ) ); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sp' ), 'after' => '</div>' ) ); ?>
                </div><!-- .entry-content -->
        <?php endif; ?>
    			<a href="<?php the_permalink(); ?>" title="<?php _e( 'Read More', 'sp' ); ?>" class="more-link"><?php _e( 'Read More', 'sp' ); ?> <span class="icon">&nbsp;</span></a>
            </div><!--close post-meta-->
            <div class="entry-utility group">
                
                <div class="group">&nbsp;</div>
                <?php sp_posted_in(); ?>
                <span class="comments-link"><span class="comment-icon">&nbsp;</span><?php comments_popup_link( __( 'Leave a comment', 'sp' ), __( '1 Comment', 'sp' ), __( '% Comments', 'sp' ) ); ?></span>
                <?php edit_post_link( __( 'Edit', 'sp' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
            </div><!-- .entry-utility -->
                        
		</article><!-- #post-## -->        