<?php
if ( ! is_admin() ) { add_action( 'wp_print_scripts', 'woothemes_add_javascript' ); }

if ( ! function_exists( 'woothemes_add_javascript' ) ) {
	function woothemes_add_javascript() {

		wp_register_script( 'masonry', get_template_directory_uri() . '/includes/js/jquery.masonry.min.js', array( 'jquery' ) );
		//wp_register_script( 'chosen', plugins_url( '/woocommerce/assets/js/chosen.jquery.min.js' , '' ), array( 'jquery' ) );
		
		wp_enqueue_script( 'jquery' );    
		wp_enqueue_script( 'general', get_template_directory_uri() . '/includes/js/general.js', array( 'jquery' ) );
		
		// Only load the sliders on the homepage
		if (is_home()) :
			
			wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/includes/js/jquery.flexslider.min.js', array( 'jquery' ) );
			wp_enqueue_script( 'masonry', '', array( 'jquery' ) );
			
			// Hook in a function to fire those scripts
			add_action ('wp_head' , 'fire_homepage_scripts');
			if (!function_exists('fire_homepage_scripts')) {
				function fire_homepage_scripts() {
					?>
						<script>
							jQuery(document).ready(function(){
								jQuery('.slider').flexslider({
									animation: "slide",
									directionNav: false,
									pauseOnHover: true 
								});
							});

							// Only fire masonry if the window is an appropriate size and images are loaded
							jQuery(function(){
								var $container = jQuery('ul.products');

								$container.imagesLoaded( function(){
									if (jQuery(window).width() > 767) {	
										$container.masonry({
											itemSelector : 'li.product',
											columnWidth : 250,
											isFitWidth: true,
											gutterWidth : 20
										});
									}
								});
							});
						</script>
					<?php
				}
			}
			
		endif;
		
		// Only load and fire masonry on WooCommerce pages
		if ( is_woocommerce_activated() ) {
			if ( is_woocommerce() || is_cart() ) {
				wp_enqueue_script( 'masonry', '', array( 'jquery' ) );
				
				add_action ('wp_head', 'fire_woocommerce_scripts' );
				if (!function_exists('fire_woocommerce_scripts')) {
					function fire_woocommerce_scripts() {
						?>
							<script>
								// Only fire masonry if the window is an appropriate size and images are loaded
								jQuery(function(){
									var $container = jQuery('ul.products');

									$container.imagesLoaded( function(){
										if (jQuery(window).width() > 767) {	
											$container.masonry({
												itemSelector : 'li.product',
												columnWidth : 250,
												isFitWidth: true,
												gutterWidth : 20
											});
										}
									});
								});
							</script>
						<?php
					}
				}
			}
		}
	}
}

?>
