<?php
/**
 * Template Name: Business
 *
 * This template creates a business style page optionally including a slider, features and testimonials 
 *
 * @package WooFramework
 * @subpackage Template
 */

 get_header();
 global $woo_options;
 
/**
 * The Variables
 *
 * Setup default variables, overriding them if the "Theme Options" have been saved.
 */
	
	$settings = array(
					'thumb_w' => 100, 
					'thumb_h' => 100, 
					'thumb_align' => 'alignleft',
                    'business_display_slider' => 'true', 
                    'business_display_features' => 'true', 
                    'business_display_testimonials' => 'true', 
                    'business_display_blog' => 'true'
					);
					
	$settings = woo_get_dynamic_values( $settings );
?>

    <!-- #content Starts -->
    <div id="content" class="col-full">

        <?php if ( isset( $woo_options['woo_breadcrumbs_show'] ) && $woo_options['woo_breadcrumbs_show'] == 'true' ) { ?>
            <section id="breadcrumbs">
                <?php woo_breadcrumbs(); ?>
            </section><!--/#breadcrumbs -->
        <?php } ?> 

            <?php 
            // Display WooSlider if activated and specified in theme options
            if ( 'true' == $settings['business_display_slider'] ) { 
                do_action( 'wooslider' );
            }
            ?>

            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                        
                <article <?php post_class(); ?>>

                    <h1 class="title"><?php the_title(); ?></h1>

                    <div class="entry">
                        <?php the_content(); ?> 
                    </div><!-- /.entry -->
                        
                </article><!-- /.post -->
                
                                                    
            <?php endwhile; else: ?>
            <?php endif; ?> 
    
            <?php 
            // Display Features if activated and specified in theme options
            if ( 'true' == $settings['business_display_features'] ) {
                do_action( 'woothemes_features' ); 
            }
            // Display Features if activated and specified in theme options
            if ( 'true' == $settings['business_display_testimonials'] ) {
                do_action( 'woothemes_testimonials' ); 
            }
            ?>

            <?php if ( 'true' == $settings['business_display_blog'] ) { ?>
    
        <!-- #main Starts -->
        <section id="main" class="col-left">      

        <?php
        	if ( get_query_var( 'paged') ) { $paged = get_query_var( 'paged' ); } elseif ( get_query_var( 'page') ) { $paged = get_query_var( 'page' ); } else { $paged = 1; }
        	
        	$query_args = array(
        						'post_type' => 'post', 
        						'paged' => $paged
        					);
        	
        	$query_args = apply_filters( 'woo_blog_template_query_args', $query_args ); // Do not remove. Used to exclude categories from displaying here.
        	
        	query_posts( $query_args );
        	
        	if ( have_posts() ) {
        		$count = 0;
        		while ( have_posts() ) { the_post(); $count++;
        ?>                                                            
            <!-- Post Starts -->
            <article <?php post_class(); ?>>

                <header>
                	<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                </header>
                
                <aside class="meta post-meta">
	                <ul>
							<li class="date"><?php the_time('j F Y', '<time>', '</time>'); ?></li>
							<li class="author"><?php the_author_posts_link(); ?></li>
							<li class="category"><?php the_category(', '); ?></li>
							<!--<li class="tags"><?php // the_tags('Tagged: ',', ',''); ?></li>-->
							<li class="comments"><?php comments_popup_link(__( '0 Comments', 'woothemes' ), __( '1 Comment', 'woothemes' ), __( '% Comments', 'woothemes' )); ?></a></li>
							<?php the_tags( '<li class="tags">', ', ', '</li>' ); ?></li>
					</ul>
				</aside>
                
                <section class="entry fix">
                	<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] != 'content' ) { woo_image( 'width=' . $settings['thumb_w'] . '&height=' . $settings['thumb_h'] . '&class=thumbnail ' . $settings['thumb_align'] ); } ?>
					<?php global $more; $more = 0; ?>	                                        
                    <?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content(__( 'Read More...', 'woothemes' ) ); } else { the_excerpt(); } ?>
                    
                     <p class="post-more">      
	                	<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'excerpt' ) { ?>
	                    <span class="read-more"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'woothemes' ); ?>" class="button"><?php _e( 'Continue Reading &rarr;', 'woothemes' ); ?></a></span>
	                    <?php } ?>
	                </p>  
                </section>
    			
                 
    
            </article><!-- /.post -->
                                                
        <?php
        		} // End WHILE Loop
        	
        	} else {
        ?>
            <article <?php post_class(); ?>>
                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
            </article><!-- /.post -->
        <?php } // End IF Statement ?>  
    
            <?php woo_pagenav(); ?>
			<?php wp_reset_query(); ?>                

        </section><!-- /#main -->
            
		<?php get_sidebar(); ?>

        <?php } ?>

    </div><!-- /#content -->    
		
<?php get_footer(); ?>