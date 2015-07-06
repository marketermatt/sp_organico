
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-style' ); ?>>

			<?php if ( is_search() ) : // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sp-theme' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'sp-theme' ), 'after' => '</div>' ) ); ?>
				<?php //echo sp_display_social_media_buttons(); ?>
			</div><!-- .entry-content -->
			<?php endif; ?>

			<footer class="entry-meta">
				<?php sp_post_footer_entry_meta(); ?>
				<?php edit_post_link( __( 'Edit', 'sp-theme' ), '<span class="edit-link">', '</span>' ); ?>
				<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
					<div class="author-info">
						<div class="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'sp_author_bio_avatar_size', 68 ) ); ?>
						</div><!-- .author-avatar -->
						<div class="author-description">
							<h2><?php printf( __( 'About %s', 'sp-theme' ), get_the_author() ); ?></h2>
							<p><?php the_author_meta( 'description' ); ?></p>
							<div class="author-link">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'sp-theme' ), get_the_author() ); ?>
								</a>
							</div><!-- .author-link	-->
						</div><!-- .author-description -->
					</div><!-- .author-info -->
				<?php endif; ?>
			</footer><!-- .entry-meta -->

	</article><!-- #post -->
