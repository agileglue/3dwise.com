<?php
/**
 * Index Template
 *
 * Here we setup all logic and XHTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
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
	'thumb_align' => 'alignleft'
	);
					
	$settings = woo_get_dynamic_values( $settings );
?>

<div id="content" class="col-full homepage">

	<div id="main">
			
			<ul class="products">
				
			<?php if ( $woo_options[ 'woo_homepage_content' ] == "true" ) { ?>
													
			<?php 
			
			if ( $woo_options['woo_homepage_content_page'] == "Latest blog post" ) {
				query_posts('posts_per_page=1');
			} else { 			
				query_posts( 'page_id=' . get_page_id( $woo_options['woo_homepage_content_page'] ) ); 
			}
			
			?>
			
			<?php while (have_posts()) : the_post(); ?>
				
				<li class="product post">
				
					<article <?php post_class(); ?>>
					
						
						
						<?php
						
						if ( $woo_options['woo_homepage_content_page'] == "Latest blog post" ) {
							//blog
							?>
							<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'woothemes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							
							<aside class="meta post-meta">
						
								<ul>
									<li class="date"><?php the_time('j F Y', '<time>', '</time>'); ?></li>
									<li class="author"><?php the_author_posts_link(); ?></li>
									<li class="category"><?php the_category(', '); ?></li>
									<li class="comments"><?php comments_popup_link(__( '0 Comments', 'woothemes' ), __( '1 Comment', 'woo themes' ), __( '% Comments', 'woothemes' )); ?></a></li>
									<?php the_tags( '<li class="tags">', ', ', '</li>' ); ?>
								</ul>
							
							</aside><!--/.meta-->
							
							<section class="article-content">
							
								<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] != 'content' ) { woo_image( 'width=' . $settings['thumb_w'] . '&height=' . $settings['thumb_h'] . '&class=thumbnail ' . $settings['thumb_align'] ); } ?>
								<?php global $more; $more = 0; ?>	                                        
			                    <?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content(__( 'Read More...', 'woothemes' ) ); } else { the_excerpt(); } ?>
			                    
			                     <p class="post-more">      
				                	<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'excerpt' ) { ?>
				                    <span class="read-more"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'woothemes' ); ?>"><?php _e( 'Continue Reading &rarr;', 'woothemes' ); ?></a></span>
				                    <?php } ?>
				                </p>  
							
							</section><!--/.article-content-->
						<?php
							
						} else { 			
							//page
							?>
							<h2 class="title"><?php the_title(); ?></h2>
							<?php the_content(); ?>
							<?php
						}
						
						?>
						
						
					
					</article><!--/.post-->
				
				</li>
			
			<?php endwhile;?>
			
			<?php } ?>
				
			<!-- FEATURED PRODUCTS -->

			<?php if ( $woo_options[ 'woo_homepage_featured_products' ] == "true" && $woo_options[ 'woo_homepage_featured_products_display' ] == "Grid" && is_woocommerce_activated() ) {

				get_template_part('loop', 'featured');

			} elseif ( $woo_options[ 'woo_homepage_featured_products' ] == "true" && $woo_options[ 'woo_homepage_featured_products_display' ] == "Slider" && is_woocommerce_activated() ) { ?>
				<li class="product slider">
								
					<ul class="slides">
						<?php get_template_part('loop', 'featured'); ?>
					</ul>

				</li>
			<?php } ?>
			
			<!-- Display the homepage widget area -->
		
			<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar( 'homepage-content' ); ?>

			<!-- RECENT PRODUCTS -->

			<?php if ( $woo_options[ 'woo_homepage_recent_products' ] == "true" && $woo_options[ 'woo_homepage_recent_products_display' ] == "Grid" && is_woocommerce_activated() ) {

				get_template_part('loop', 'recent');

			} elseif ( $woo_options[ 'woo_homepage_recent_products' ] == "true" && $woo_options[ 'woo_homepage_recent_products_display' ] == "Slider" && is_woocommerce_activated() ) { ?>
				<li class="product slider">
								
					<ul class="slides">
						<?php get_template_part('loop', 'recent'); ?>
					</ul>

				</li>
			<?php } ?>
			
			<!-- BEST SELLERS -->

			<?php if ( $woo_options[ 'woo_homepage_best_selling_products' ] == "true" && $woo_options[ 'woo_homepage_best_selling_products_display' ] == "Grid" && is_woocommerce_activated() ) {

				get_template_part('loop', 'bestsellers');

			} elseif ( $woo_options[ 'woo_homepage_best_selling_products' ] == "true" && $woo_options[ 'woo_homepage_best_selling_products_display' ] == "Slider" && is_woocommerce_activated() ) { ?>
				<li class="product slider">
								
					<ul class="slides">
						<?php get_template_part('loop', 'bestsellers'); ?>
					</ul>

				</li>
			<?php } ?>
			
			</ul>
			
			<?php if ( $woo_options[ 'woo_shop_link' ] == "true" && is_woocommerce_activated() ) { ?>
		
			<div class="go-shopping">
			
				<p>					
					<?php echo $woo_options['woo_shop_link_content']; ?>
				</p>
				
				<a href="<?php echo get_permalink(get_option('woocommerce_shop_page_id')); ?>" class="button" title="<?php echo $woo_options['woo_shop_link_content']; ?>"><?php _e('Go Shopping', 'woothemes'); ?> &rarr;</a>
			
			</div>
			
			<?php } ?>

	
	</div><!--/#main-->
	
			
</div><!-- /#content -->
		
<?php get_footer(); ?>
