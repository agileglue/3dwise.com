<?php
global $woo_options, $loop, $woocommerce;

$recent_products_per_page = get_option('woo_homepage_recent_products_number');
$args = array( 
	'post_type' => 'product', 
	'posts_per_page' => $recent_products_per_page, 
	'meta_query' => array( 
		array('key' => '_visibility',
			'value' => array(
				'catalog', 'visible'
				),
			'compare' => 'IN'
			),
		array(
			'key' => '_featured',
			'value' => 'no'
			),
		$woocommerce->query->stock_status_meta_query()
		) 
	);

$loop = new WP_Query( $args );
if ( function_exists( 'get_product' ) ) {
	$product = get_product( $loop->post->ID );
} else { 
	$product = &new WC_Product( $loop->post->ID );
}
while ( $loop->have_posts() ) : $loop->the_post(); $product;
	
	get_template_part( 'content' , 'product-recent' );

endwhile;