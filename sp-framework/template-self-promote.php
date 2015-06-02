<?php
/**
 * Template Name: Self Promote
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

								
                    <!-- Inner Content Section starts here -->
                    <div id="inner_content_section">

                        
                        	             
                        <!-- Main Content Section starts here -->
                        <div id="main_content_section">
                

										<?php if (have_posts()) : ?>
											<?php $count = 0; while (have_posts()) : the_post(); $count++; ?>
												<!-- Actual Post starts here -->
												<div <?php post_class('actual_post') ?> id="post-<?php the_ID(); ?>">
                                                	<div class="ta_meta_container">
													<div class="actual_post_title_page">
														<h2><?php the_title(); ?></h2>
													</div>
													</div>
													<div class="post_entry">

														<div class="entry">
														
														<?php
														global $wpdb;
														$user_id = get_current_user_id();
														$table_level = $wpdb->prefix . 'm_membership_levels';
														$table_relationship = $wpdb->prefix . 'm_membership_relationships';

														$querystr = "SELECT $table_level.id,$table_level.level_slug,$table_relationship.level_id,$table_relationship.user_id FROM $table_relationship
														INNER JOIN $table_level
														ON $table_relationship.level_id=$table_level.id where $table_relationship.user_id=$user_id";
														$pageposts = $wpdb->get_results($querystr, OBJECT);
														$level = $pageposts[0]->level_slug; 

														?>
														
														
														<?php if($level=='day-player') { ?>
														<?php //echo do_shortcode('[level-day-player]');?>
														<?php if(!isset($_REQUEST['resume_id']) && $_REQUEST['resume_id']==0) { ?>
														Get noticed! Upload your resume, reel, and/or headshot. This is what employers will see when you apply for their gigs.
														<br />
														<br />

														IMPORTANT: To avoid exposure to unwanted parties, personal contact information should NOT be included in your resume. Resumes can be viewed by ALL members. Excluding personal information from your resume is to protect your privacy. We are not responsible for any unwanted contact.
														<br />
														<br />
														<?php } ?>
														<?php echo do_shortcode('[submit_resume_form]');?>
														
													<?php //echo do_shortcode('[/level-day-player]');?>
													
													<?php } // if closed ?>	
														
										<?php if($level=='day-player-employer') { ?>	
													<?php //echo do_shortcode('[level-day-player-employer]');?>	
													<?php if(!isset($_REQUEST['resume_id']) && $_REQUEST['resume_id']==0) { ?>
														

														Get noticed! Upload your resume, reel, and/or headshot. This is what employers will see when you apply for their gigs.
														<br />
														<br />
														IMPORTANT: To avoid exposure to unwanted parties, personal contact information should NOT be included in your resume. Resumes can be viewed by ALL members. Excluding personal information from your resume is to protect your privacy. We are not responsible for any unwanted contact.
														<br />
														<br />
														<?php } ?>
														<?php echo do_shortcode('[submit_resume_form]');?>
														
													
													<?php //echo do_shortcode('[/level-day-player-employer]');?> 
													
											<?php } // if close?>		
														
											<?php if($level=='employer') { ?>	
											<?php //echo do_shortcode('[level-employer]');?>
														
														Please <a href="/protected/?action=registeruser&subscription=4">sign up for a Day Player account</a> to promote yourself as a Day Player.
														<br />
													<?php //echo do_shortcode('[/level-employer]');?> 
													
											<?php } // if closed?>	

														<!--												
														[level-day-player]
Get noticed! Upload your resume, reel, and/or headshot. This is what employers will see when you apply for their gigs.

IMPORTANT: To avoid exposure to unwanted parties, personal contact information should NOT be included in your resume. Resumes can be viewed by ALL members. Excluding personal information from your resume is to protect your privacy. We are not responsible for any unwanted contact.
[submit_resume_form]

[/level-day-player]

[level-day-player-employer]

Get noticed! Upload your resume, reel, and/or headshot. This is what employers will see when you apply for their gigs.

IMPORTANT: To avoid exposure to unwanted parties, personal contact information should NOT be included in your resume. Resumes can be viewed by ALL members. Excluding personal information from your resume is to protect your privacy. We are not responsible for any unwanted contact.
[submit_resume_form]

[/level-day-player-employer]

[level-employer]
Please <a href="/protected/?action=registeruser&amp;subscription=4&amp;from_subscription=1">sign up for a Day Player account</a> to promote yourself as a Day Player.
[/level-employer]					
														-->
													
														
														
															<?php //the_content(); ?>
															<div class="clear"></div>
															<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'Hazen' ) . '</span>', 'after' => '</div>' ) ); ?>																				
														</div>

														
													
													</div>
                                                    
												</div>
												<!-- Actual Post ends here -->		
												<?php // comments_template(); ?>
												<?php endwhile; ?>
												<?php endif; ?>
                
                
                        </div>	
                        <!-- Main Content Section ends here -->

                        <!-- Sidebar Section starts here -->
                        <?php get_sidebar(); ?> 	
                        <!-- Sidebar Section ends here -->






                    </div>	
                    <!-- Inner Content Section ends here -->
							
			<?php get_footer(); ?>								
									

							
								
									
