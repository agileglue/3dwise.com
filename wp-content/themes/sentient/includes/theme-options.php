<?php
if (!function_exists( 'woo_options')) {
function woo_options() {

// THEME VARIABLES
$themename = "Sentient";
$themeslug = "sentient";

// STANDARD VARIABLES. DO NOT TOUCH!
$shortname = "woo";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/'.$themeslug.'/';

//Access the WordPress Categories via an Array
$woo_categories = array();
$woo_categories_obj = get_categories( 'hide_empty=0' );
foreach ($woo_categories_obj as $woo_cat) {
    $woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
$categories_tmp = array_unshift($woo_categories, "Select a category:" );

//Access the WordPress Pages via an Array
$woo_pages = array();
$woo_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
foreach ($woo_pages_obj as $woo_page) {
    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
$woo_pages_tmp = array_unshift($woo_pages, "Latest blog post" );

//Stylesheets Reader
$alt_stylesheet_path = get_template_directory() . '/styles/';
$alt_stylesheets = array();
if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) {
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }
    }
}

//More Options
$other_entries = array( "Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19" );

// THIS IS THE DIFFERENT FIELDS
$options = array();

// General

$options[] = array( "name" => __( 'General Settings', 'woothemes' ),
					"type" => "heading",
					"icon" => "general" );

$options[] = array( "name" => __( 'Theme Stylesheet', 'woothemes' ),
					"desc" => __( 'Select your themes alternative color scheme.', 'woothemes' ),
					"id" => $shortname."_alt_stylesheet",
					"std" => "default.css",
					"type" => "select",
					"options" => $alt_stylesheets);

$options[] = array( "name" => __( 'Custom Logo', 'woothemes' ),
					"desc" => __( 'Upload a logo for your theme, or specify an image URL directly.', 'woothemes' ),
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload" );

$options[] = array( "name" => __( 'Text Title', 'woothemes' ),
					"desc" => sprintf( __( 'Enable text-based Site Title. Setup title in %sGeneral Settings%s.', 'woothemes' ), '<a href="' . esc_url( admin_url( 'options-general.php' ) ) . '">', '</a>' ),
					"id" => $shortname."_texttitle",
					"std" => "false",
					"class" => "collapsed",
					"type" => "checkbox" );

/*$options[] = array( "name" => "Site Title",
					"desc" => "Change the site title typography.",
					"id" => $shortname."_font_site_title",
					"std" => array( 'size' => '30','unit' => 'px','face' => 'Droid Serif','style' => 'bold','color' => '#333333'),
					"class" => "hidden",
					"type" => "typography" );*/

$options[] = array( "name" => __( 'Site Description', 'woothemes' ),
					"desc" => __( 'Enable the site description/tagline under site title.', 'woothemes' ),
					"id" => $shortname."_tagline",
					"class" => "hidden last",
					"std" => "false",
					"type" => "checkbox" );

/*$options[] = array( "name" => "Site Description",
					"desc" => "Change the site description typography.",
					"id" => $shortname."_font_tagline",
					"std" => array( 'size' => '12','unit' => 'px','face' => 'Droid Sans','style' => '','color' => '#999999'),
					"class" => "hidden last",
					"type" => "typography" );*/

$options[] = array( "name" => __( 'Custom Favicon', 'woothemes' ),
					"desc" => sprintf( __( 'Upload a 16px x 16px %sco image%s that will represent your website\'s favicon.', 'woothemes' ), '<a href="http://faviconr.com/">', '</a>' ),
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload" );

$options[] = array( "name" => __( 'Tracking Code', 'woothemes' ),
					"desc" => __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'woothemes' ),
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea" );

$options[] = array( "name" => __( 'RSS URL', 'woothemes' ),
					"desc" => __( 'Enter your preferred RSS URL. (Feedburner or other)', 'woothemes' ),
					"id" => $shortname."_feed_url",
					"std" => "",
					"type" => "text" );

$options[] = array( "name" => __( 'E-Mail Subscription URL', 'woothemes' ),
					"desc" => __( 'Enter your preferred E-mail subscription URL. (Feedburner or other)', 'woothemes' ),
					"id" => $shortname."_subscribe_email",
					"std" => "",
					"type" => "text" );

$options[] = array( "name" => __( 'Contact Form E-Mail', 'woothemes' ),
					"desc" => __( 'Enter your E-mail address to use on the Contact Form Page Template. Add the contact form by adding a new page and selecting "Contact Form" as page template.', 'woothemes' ),
					"id" => $shortname."_contactform_email",
					"std" => "",
					"type" => "text" );

$options[] = array( "name" => __( 'Custom CSS', 'woothemes' ),
                    "desc" => __( 'Quickly add some CSS to your theme by adding it to this block.', 'woothemes' ),
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea" );

$options[] = array( "name" => __( 'Post/Page Comments', 'woothemes' ),
					"desc" => __( 'Select if you want to enable/disable comments on posts and/or pages.', 'woothemes' ),
					"id" => $shortname."_comments",
					"type" => "select2",
					"options" => array( "post" => "Posts Only", "page" => "Pages Only", "both" => "Pages / Posts", "none" => "None") );

$options[] = array( "name" => __( 'Post Content', 'woothemes' ),
					"desc" => __( 'Select if you want to show the full content or the excerpt on posts.', 'woothemes' ),
					"id" => $shortname."_post_content",
					"type" => "select2",
					"options" => array( "excerpt" => "The Excerpt", "content" => "Full Content" ) );

$options[] = array( "name" => __( 'Post Author Box', 'woothemes' ),
					"desc" => sprintf( __( 'This will enable the post author box on the single posts page. Edit description in %sProfile%s.', 'woothemes' ), '<a href="' . esc_url( admin_url( 'profile.php' ) ) . '">', '</a>' ),
					"id" => $shortname."_post_author",
					"std" => "true",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'Display Breadcrumbs', 'woothemes' ),
					"desc" => __( 'Display dynamic breadcrumbs on each page of your website.', 'woothemes' ),
					"id" => $shortname."_breadcrumbs_show",
					"std" => "false",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'Pagination Style', 'woothemes' ),
					"desc" => __( 'Select the style of pagination you would like to use on the blog.', 'woothemes' ),
					"id" => $shortname."_pagination_type",
					"type" => "select2",
					"options" => array( "paginated_links" => "Numbers", "simple" => "Next/Previous" ) );

// Styling

$options[] = array( "name" => __( 'Styling Options', 'woothemes' ),
					"type" => "heading",
					"icon" => "styling" );

$options[] = array( "name" => __( 'Background Color', 'woothemes' ),
					"desc" => __( 'Pick a custom color for background color of the theme e.g. #697e09', 'woothemes' ),
					"id" => "woo_body_color",
					"std" => "",
					"type" => "color" );

$options[] = array( "name" => __( 'Background Image', 'woothemes' ),
					"desc" => __( 'Upload an image for the theme\'s background', 'woothemes' ),
					"id" => $shortname."_body_img",
					"std" => "",
					"type" => "upload" );

$options[] = array( "name" => __( 'Background Image Repeat', 'woothemes' ),
                    "desc" => __( 'Select how you would like to repeat the background-image', 'woothemes' ),
                    "id" => $shortname."_body_repeat",
                    "std" => "no-repeat",
                    "type" => "select",
                    "options" => array( "no-repeat","repeat-x","repeat-y","repeat"));

$options[] = array( "name" => __( 'Background Image Position', 'woothemes' ),
                    "desc" => __( 'Select how you would like to position the background', 'woothemes' ),
                    "id" => $shortname."_body_pos",
                    "std" => "top",
                    "type" => "select",
                    "options" => array( "top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right"));

$options[] = array( "name" => __( 'Link Color', 'woothemes' ),
					"desc" => __( 'Pick a custom color for links or add a hex color code e.g. #697e09', 'woothemes' ),
					"id" => "woo_link_color",
					"std" => "",
					"type" => "color" );

$options[] = array( "name" => __( 'Link Hover Color', 'woothemes' ),
					"desc" => __( 'Pick a custom color for links hover or add a hex color code e.g. #697e09', 'woothemes' ),
					"id" => "woo_link_hover_color",
					"std" => "",
					"type" => "color" );

$options[] = array( "name" => __( 'Button Color', 'woothemes' ),
					"desc" => __( 'Pick a custom color for buttons or add a hex color code e.g. #697e09', 'woothemes' ),
					"id" => "woo_button_color",
					"std" => "",
					"type" => "color" );

/* Typography */

$options[] = array( "name" => __( 'Typography', 'woothemes' ),
					"type" => "heading",
					"icon" => "typography" );

$options[] = array( "name" => __( 'Enable Custom Typography', 'woothemes' ),
					"desc" => __( 'Enable the use of custom typography for your site. Custom styling will be output in your sites HEAD.', 'woothemes' ),
					"id" => $shortname."_typography",
					"std" => "false",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'General Typography', 'woothemes' ),
					"desc" => __( 'Change the general font.', 'woothemes' ),
					"id" => $shortname."_font_body",
					"std" => array( 'size' => '1.5','unit' => 'em','face' => 'Arial','style' => '','color' => '#555555'),
					"type" => "typography" );

$options[] = array( "name" => __( 'Navigation', 'woothemes' ),
					"desc" => __( 'Change the navigation font.', 'woothemes' ),
					"id" => $shortname."_font_nav",
					"std" => array( 'size' => '1.1','unit' => 'em','face' => 'Arial','style' => '','color' => '#555555'),
					"type" => "typography" );

$options[] = array( "name" => __( 'Page Title', 'woothemes' ),
					"desc" => __( 'Change the page title.', 'woothemes' ),
					"id" => $shortname."_font_page_title",
					"std" => array( 'size' => '2.2','unit' => 'em','face' => 'Arial','style' => 'bold','color' => '#222222'),
					"type" => "typography" );

$options[] = array( "name" => __( 'Post Title', 'woothemes' ),
					"desc" => __( 'Change the post title.', 'woothemes' ),
					"id" => $shortname."_font_post_title",
					"std" => array( 'size' => '2.2','unit' => 'em','face' => 'Arial','style' => 'bold','color' => '#222222'),
					"type" => "typography" );

$options[] = array( "name" => __( 'Post Meta', 'woothemes' ),
					"desc" => __( 'Change the post meta.', 'woothemes' ),
					"id" => $shortname."_font_post_meta",
					"std" => array( 'size' => '1','unit' => 'em','face' => 'Arial','style' => '','color' => '#999999'),
					"type" => "typography" );

$options[] = array( "name" => __( 'Post Entry', 'woothemes' ),
					"desc" => __( 'Change the post entry.', 'woothemes' ),
					"id" => $shortname."_font_post_entry",
					"std" => array( 'size' => '1','unit' => 'em','face' => 'Arial','style' => '','color' => '#555555'),
					"type" => "typography" );

$options[] = array( "name" => __( 'Widget Titles', 'woothemes' ),
					"desc" => __( 'Change the widget titles.', 'woothemes' ),
					"id" => $shortname."_font_widget_titles",
					"std" => array( 'size' => '1.1','unit' => 'em','face' => 'Arial','style' => 'bold','color' => '#555555'),
					"type" => "typography" );

/* Homepage */

$options[] = array( "name" => __( 'Homepage', 'woothemes' ),
					"icon" => "homepage",
					"type" => "heading");
					
$options[] = array( "name" => __( 'Homepage Content', 'woothemes' ),
					"type" => "subheading");
					
$options[] = array( "name" => __( 'Display Homepage Content?', 'woothemes' ),
					"desc" => __( 'Display content alongside products on the homepage', 'woothemes' ),
					"id" => $shortname."_homepage_content",
					"std" => "false",
					"class" => "collapsed",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'Homepage Content Source', 'woothemes' ),
          			"desc" => __( 'Choose whether to display your latest post or a specific page', 'woothemes' ),
          			"id" => $shortname."_homepage_content_page",
          			"std" => "Latest blog post",
					"type" => "select",
					"class" => "hidden last",
					"options" => $woo_pages); 

if ( is_woocommerce_activated() ) { 
                 
$options[] = array( "name" => __( 'Featured Products', 'woothemes' ),
					"type" => "subheading");
					
$options[] = array( "name" => __( 'Featured Products', 'woothemes' ),
					"desc" => __( 'Display featured products on the homepage', 'woothemes' ),
					"id" => $shortname."_homepage_featured_products",
					"std" => "false",
					"class" => "collapsed",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'Featured Products Display', 'woothemes' ),
                    "desc" => __( 'Select how you\'d like to display your featured products', 'woothemes' ),
                    "id" => $shortname."_homepage_featured_products_display",
                    "std" => "Grid",
                    "type" => "select",
                    "class" => "hidden",
                    "options" => array("Grid","Slider"));

$options[] = array( "name" => __( 'Number Of Featured Products', 'woothemes' ),
                    "desc" => __( 'Select how many featured products you\'d like to display', 'woothemes' ),
                    "id" => $shortname."_homepage_featured_products_number",
                    "std" => "5",
                    "type" => "select",
                    "class" => "hidden last",
                    "options" => array("5","10","15","20","25","30"));
                    
$options[] = array( "name" => __( 'Recent Products', 'woothemes' ),
					"type" => "subheading");

$options[] = array( "name" => __( 'Recent Products', 'woothemes' ),
					"desc" => __( 'Display recent products on the homepage', 'woothemes' ),
					"id" => $shortname."_homepage_recent_products",
					"std" => "false",
					"class" => "collapsed",
					"type" => "checkbox" );
		
$options[] = array( "name" => __( 'Recent Products Display', 'woothemes' ),
                    "desc" => __( 'Select how you\'d like to display your recent products', 'woothemes' ),
                    "id" => $shortname."_homepage_recent_products_display",
                    "std" => "Grid",
                    "type" => "select",
                    "class" => "hidden",
                    "options" => array("Grid","Slider"));
                 
$options[] = array( "name" => __( 'Number Of Recent Products', 'woothemes' ),
                    "desc" => __( 'Select how many recent products you\'d like to display on the homepage', 'woothemes' ),
                    "id" => $shortname."_homepage_recent_products_number",
                    "std" => "10",
                    "type" => "select",
                    "class" => "hidden last",
                    "options" => array("5", "10","15","20","25","30"));
                    
$options[] = array( "name" => __( 'Best Sellers', 'woothemes' ),
					"type" => "subheading");
                    
$options[] = array( "name" => __( 'Best Sellers', 'woothemes' ),
					"desc" => __( 'Display best sellers on the homepage', 'woothemes' ),
					"id" => $shortname."_homepage_best_selling_products",
					"std" => "false",
					"class" => "collapsed",
					"type" => "checkbox" );
		
$options[] = array( "name" => __( 'Best Sellers Display', 'woothemes' ),
                    "desc" => __( 'Select how you\'d like to display your best selling products', 'woothemes' ),
                    "id" => $shortname."_homepage_best_selling_products_display",
                    "std" => "Grid",
                    "type" => "select",
                    "class" => "hidden",
                    "options" => array("Grid","Slider"));
	
$options[] = array( "name" => __( 'Number Of Best Sellers', 'woothemes' ),
                    "desc" => __( 'Select how many best sellers you\'d like to display on the homepage', 'woothemes' ),
                    "id" => $shortname."_homepage_best_selling_products_number",
                    "std" => "10",
                    "type" => "select",
                    "class" => "hidden last",
                    "options" => array("5", "10","15","20","25","30"));
                    
$options[] = array( "name" => __( 'Shop link', 'woothemes' ),
					"type" => "subheading");
                    
$options[] = array( "name" => __( 'Display Shop Link', 'woothemes' ),
					"desc" => __( 'Display a link to the shop page and a message beneath featured, recent and best selling products?', 'woothemes' ),
					"id" => $shortname."_shop_link",
					"std" => "false",
					"class" => "collapsed",
					"type" => "checkbox" );
                 
$options[] = array( "name" => __( 'Shop Link Content', 'woothemes' ),
					"desc" => __( 'Content which appears next to the "Go Shopping" button in the footer', 'woothemes' ),
					"id" => $shortname."_shop_link_content",
					"std" => "View more products in our extensive online catalog!",
					"class" => "hidden last",
					"type" => "text" );
}
                    
/* WooCommerce */
if ( is_woocommerce_activated() ) {
$options[] = array( "name" => __( 'WooCommerce Options', 'woothemes' ),
					"type" => "heading",
					"icon" => "woocommerce" );

$options[] = array( "name" => __( 'Shop Full Width?', 'woothemes' ),
					"desc" => __( 'Make all shop archive pages full width?', 'woothemes' ),
					"id" => $shortname."_shop_archives_fullwidth",
					"std" => "false",
					"class" => "collapsed",
					"type" => "checkbox" );
				
$options[] = array( "name" => __( 'Categories Not Full Width', 'woothemes' ),
					"desc" => __( 'Exclude categories from being displayed full width by ID or by name. Comma separated, no spaces E.G. 1,2,3 or Games,Consoles', 'woothemes' ),
					"id" => $shortname."_shop_fullwidth_exclude",
					"std" => "",
					"class" => "hidden last",
					"type" => "text" );
}
					
/* Layout */

$options[] = array( "name" => __( 'Layout Options', 'woothemes' ),
					"type" => "heading",
					"icon" => "layout" );

$url =  get_template_directory_uri() . '/functions/images/';
$options[] = array( "name" => __( 'Main Layout', 'woothemes' ),
					"desc" => __( 'Select which layout you want for your site.', 'woothemes' ),
					"id" => $shortname."_site_layout",
					"std" => "layout-left-content",
					"type" => "images",
					"options" => array(
						'layout-left-content' => $url . '2cl.png',
						'layout-right-content' => $url . '2cr.png')
					);

$options[] = array( 'name' => __( 'Business Template', 'woothemes' ),
					'type' => 'heading',
					'icon' => 'layout' );
$options[] = array( 'name' => __( 'Display WooSlider', 'woothemes' ),
					'desc' => sprintf( __( 'Display a slider above the page content? Requires %sWooSlider%s plugin.', 'woothemes' ), '<a href="http://www.woothemes.com/products/wooslider/" title="' . __( 'Purchase WooSlider from WooThemes.com', 'woothemes' ) . '" target="_blank">', '</a>' ),
					'id' => $shortname . '_business_display_slider',
					'std' => 'true',
					'type' => 'checkbox' );
$options[] = array( 'name' => __( 'Display Features', 'woothemes' ),
					'desc' => sprintf( __( 'Display Features beneath the page content? Requires %sFeatures%s plugin.', 'woothemes' ), '<a href="http://wordpress.org/extend/plugins/features-by-woothemes/" title="' . __( 'Download \'Features by WooThemes\' from WordPress.org', 'woothemes' ) . '" target="_blank">', '</a>' ),
					'id' => $shortname . '_business_display_features',
					'std' => 'true',
					'type' => 'checkbox' );
$options[] = array( 'name' => __( 'Display Testimonials', 'woothemes' ),
					'desc' => sprintf( __( 'Display testimonials beneath the page content? Requires %sTestimonials%s plugin.', 'woothemes' ), '<a href="http://wordpress.org/extend/plugins/testimonials-by-woothemes/" title="' . __( 'Download \'Testimonials by WooThemes\' from WordPress.org', 'woothemes' ) . '" target="_blank">', '</a>' ),
					'id' => $shortname . '_business_display_testimonials',
					'std' => 'true',
					'type' => 'checkbox' );
$options[] = array( 'name' => __( 'Display latest blog posts and sidebar', 'woothemes' ),
					'desc' => __( 'Display your latest blog posts and primary sidebar beneath the business template content', 'woothemes' ),
					'id' => $shortname . '_business_display_blog',
					'std' => 'true',
					'type' => 'checkbox' );

/*$options[] = array( "name" => "Category Exclude - Homepage",
					"desc" => "Specify a comma seperated list of category IDs or slugs that you'd like to exclude from your homepage (eg: uncategorized).",
					"id" => $shortname."_exclude_cats_home",
					"std" => "",
					"type" => "text" );

$options[] = array( "name" => "Category Exclude - Blog Page Template",
					"desc" => "Specify a comma seperated list of category IDs or slugs that you'd like to exclude from your 'Blog' page template (eg: uncategorized).",
					"id" => $shortname."_exclude_cats_blog",
					"std" => "",
					"type" => "text" );*/

/* Dynamic Images */
$options[] = array( "name" => __( 'Dynamic Images', 'woothemes' ),
					"type" => "heading",
					"icon" => "image" );
					
$options[] = array( "name" => __( 'Dynamic Image Resizing', 'woothemes' ),
					"desc" => "",
					"id" => $shortname."_wpthumb_notice",
					"std" => 'There are two alternative methods of dynamically resizing the thumbnails in the theme, <strong>WP Post Thumbnail</strong> or <strong>TimThumb - Custom Settings panel</strong>. We recommend using WP Post Thumbnail option.',
					"type" => "info");					

$options[] = array( "name" => __( 'WP Post Thumbnail', 'woothemes' ),
					"desc" => __( 'Use WordPress post thumbnail to assign a post thumbnail. Will enable the Featured Image panel in your post sidebar where you can assign a post thumbnail.', 'woothemes' ),
					"id" => $shortname."_post_image_support",
					"std" => "true",
					"class" => "collapsed",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'WP Post Thumbnail - Dynamic Image Resizing', 'woothemes' ),
					"desc" => __( 'The post thumbnail will be dynamically resized using native WP resize functionality. (Requires PHP 5.2+)', 'woothemes' ),
					"id" => $shortname."_pis_resize",
					"std" => "true",
					"class" => "hidden",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'WP Post Thumbnail - Hard Crop', 'woothemes' ),
					"desc" => __( 'The post thumbnail will be cropped to match the target aspect ratio (only used if "Dynamic Image Resizing" is enabled).', 'woothemes' ),
					"id" => $shortname."_pis_hard_crop",
					"std" => "true",
					"class" => "hidden last",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'TimThumb - Custom Settings Panel', 'woothemes' ),
					'desc' => sprintf( __( 'This will enable the %sTimThumb%s (thumb.php) script which dynamically resizes images added through the %scustom settings panel below the post%s. Make sure your themes %scache%s folder is writeable. %sNeed help?%s', 'woothemes' ), '<a href="http://code.google.com/p/timthumb/"">', '</a>', '<strong>', '</strong>', '<em>', '</em>', '<a href="http://www.woothemes.com/2008/10/troubleshooting-image-resizer-thumbphp/">', '</a>' ),
					"id" => $shortname."_resize",
					"std" => "false",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'Automatic Image Thumbnail', 'woothemes' ),
					"desc" => __( 'If no thumbnail is specifified then the first uploaded image in the post is used.', 'woothemes' ),
					"id" => $shortname."_auto_img",
					"std" => "false",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'Thumbnail Image Dimensions', 'woothemes' ),
					"desc" => __( 'Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.', 'woothemes' ),
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"type" => array(
									array(  'id' => $shortname. '_thumb_w',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_thumb_h',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Height')
								  ));

$options[] = array( "name" => __( 'Thumbnail Alignment', 'woothemes' ),
					"desc" => __( 'Select how to align your thumbnails with posts.', 'woothemes' ),
					"id" => $shortname."_thumb_align",
					"std" => "alignleft",
					"type" => "select2",
					"options" => array( "alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"));

$options[] = array( "name" => __( 'Single Post - Show Thumbnail', 'woothemes' ),
					"desc" => __( 'Show the thumbnail in the single post page.', 'woothemes' ),
					"id" => $shortname."_thumb_single",
					"class" => "collapsed",
					"std" => "false",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'Single Post - Thumbnail Dimensions', 'woothemes' ),
					"desc" => __( 'Enter an integer value i.e. 250 for the image size. Max width is 576.', 'woothemes' ),
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"class" => "hidden last",
					"type" => array(
									array(  'id' => $shortname. '_single_w',
											'type' => 'text',
											'std' => 200,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_single_h',
											'type' => 'text',
											'std' => 200,
											'meta' => 'Height')
								  ));

$options[] = array( "name" => __( 'Single Post - Thumbnail Alignment', 'woothemes' ),
					"desc" => __( 'Select how to align your thumbnail with single posts.', 'woothemes' ),
					"id" => $shortname."_thumb_single_align",
					"std" => "alignright",
					"type" => "select2",
					"class" => "hidden",
					"options" => array( "alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"));

$options[] = array( "name" => __( 'Add thumbnail to RSS feed', 'woothemes' ),
					"desc" => __( 'Add the the image uploaded via your Custom Settings panel to your RSS feed', 'woothemes' ),
					"id" => $shortname."_rss_thumb",
					"std" => "false",
					"type" => "checkbox" );

/* Footer */
$options[] = array( "name" => __( 'Footer Customization', 'woothemes' ),
					"type" => "heading",
					"icon" => "footer" );


$url =  get_template_directory_uri() . '/functions/images/';
$options[] = array( "name" => __( 'Footer Widget Areas', 'woothemes' ),
					"desc" => __( 'Select how many footer widget areas you want to display.', 'woothemes' ),
					"id" => $shortname."_footer_sidebars",
					"std" => "4",
					"type" => "images",
					"options" => array(
						'0' => $url . 'layout-off.png',
						'1' => $url . 'footer-widgets-1.png',
						'2' => $url . 'footer-widgets-2.png',
						'3' => $url . 'footer-widgets-3.png',
						'4' => $url . 'footer-widgets-4.png')
					);

$options[] = array( "name" => __( 'Custom Affiliate Link', 'woothemes' ),
					"desc" => __( 'Add an affiliate link to the WooThemes logo in the footer of the theme.', 'woothemes' ),
					"id" => $shortname."_footer_aff_link",
					"std" => "",
					"type" => "text" );

$options[] = array( "name" => __( 'Enable Custom Footer (Left)', 'woothemes' ),
					"desc" => __( 'Activate to add the custom text below to the theme footer.', 'woothemes' ),
					"id" => $shortname."_footer_left",
					"std" => "false",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'Custom Text (Left)', 'woothemes' ),
					"desc" => __( 'Custom HTML and Text that will appear in the footer of your theme.', 'woothemes' ),
					"id" => $shortname."_footer_left_text",
					"std" => "",
					"type" => "textarea" );

$options[] = array( "name" => __( 'Enable Custom Footer (Right)', 'woothemes' ),
					"desc" => __( 'Activate to add the custom text below to the theme footer.', 'woothemes' ),
					"id" => $shortname."_footer_right",
					"std" => "false",
					"type" => "checkbox" );

$options[] = array( "name" => __( 'Custom Text (Right)', 'woothemes' ),
					"desc" => __( 'Custom HTML and Text that will appear in the footer of your theme.', 'woothemes' ),
					"id" => $shortname."_footer_right_text",
					"std" => "",
					"type" => "textarea" );

/* Subscribe & Connect */
$options[] = array( "name" => __( 'Subscribe & Connect', 'woothemes' ),
					"type" => "heading",
					"icon" => "connect" );

$options[] = array( "name" => __( 'Enable Subscribe & Connect - Single Post', 'woothemes' ),
					'desc' => sprintf( __( 'Enable the subscribe & connect area on single posts. You can also add this as a %swidget%s in your sidebar.', 'woothemes' ), '<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '">', '</a>' ),
					"id" => $shortname."_connect",
					"std" => 'false',
					"type" => "checkbox" );

$options[] = array( "name" => __( 'Subscribe Title', 'woothemes' ),
					"desc" => __( 'Enter the title to show in your subscribe & connect area.', 'woothemes' ),
					"id" => $shortname."_connect_title",
					"std" => '',
					"type" => "text" );

$options[] = array( "name" => __( 'Text', 'woothemes' ),
					"desc" => __( 'Change the default text in this area.', 'woothemes' ),
					"id" => $shortname."_connect_content",
					"std" => '',
					"type" => "textarea" );

$options[] = array( "name" => __( 'Subscribe By E-mail ID (Feedburner)', 'woothemes' ),
					'desc' => sprintf( __( 'Enter your %sFeedburner ID%s for the e-mail subscription form.', 'woothemes' ), '<a href="http://www.woothemes.com/tutorials/how-to-find-your-feedburner-id-for-email-subscription/">', '</a>' ),
					"id" => $shortname."_connect_newsletter_id",
					"std" => '',
					"type" => "text" );

$options[] = array( "name" => __( 'Subscribe By E-mail to MailChimp', 'woothemes' ),
    				'desc' => sprintf( __( 'If you have a MailChimp account you can enter the %1$s to allow your users to subscribe to a MailChimp List.', 'woothemes' ), '<a href="http://woochimp.heroku.com" target="_blank">'.__( 'MailChimp List Subscribe URL', 'woothemes' ).'</a>' ),
					"id" => $shortname."_connect_mailchimp_list_url",
					"std" => '',
					"type" => "text");

$options[] = array( "name" => __( 'Enable RSS', 'woothemes' ),
					"desc" => __( 'Enable the subscribe and RSS icon.', 'woothemes' ),
					"id" => $shortname."_connect_rss",
					"std" => 'true',
					"type" => "checkbox" );

$options[] = array( 'name' => __( 'Twitter URL', 'woothemes' ),
    				'desc' => sprintf( __( 'Enter your %1$s URL e.g. http://www.twitter.com/woothemes', 'woothemes' ), '<a href="http://www.twitter.com/">'.__( 'Twitter', 'woothemes' ).'</a>' ),
    				'id' => $shortname . '_connect_twitter',
    				'std' => '',
    				'type' => 'text' );

$options[] = array( 'name' => __( 'Facebook URL', 'woothemes' ),
    				'desc' => sprintf( __( 'Enter your %1$s URL e.g. http://www.facebook.com/woothemes', 'woothemes' ), '<a href="http://www.facebook.com/">'.__( 'Facebook', 'woothemes' ).'</a>' ),
    				'id' => $shortname . '_connect_facebook',
    				'std' => '',
    				'type' => 'text' );

$options[] = array( 'name' => __( 'YouTube URL', 'woothemes' ),
    				'desc' => sprintf( __( 'Enter your %1$s URL e.g. http://www.youtube.com/woothemes', 'woothemes' ), '<a href="http://www.youtube.com/">'.__( 'YouTube', 'woothemes' ).'</a>' ),
    				'id' => $shortname . '_connect_youtube',
    				'std' => '',
    				'type' => 'text' );

$options[] = array( 'name' => __( 'Flickr URL', 'woothemes' ),
    				'desc' => sprintf( __( 'Enter your %1$s URL e.g. http://www.flickr.com/woothemes', 'woothemes' ), '<a href="http://www.flickr.com/">'.__( 'Flickr', 'woothemes' ).'</a>' ),
    				'id' => $shortname . '_connect_flickr',
    				'std' => '',
    				'type' => 'text' );

$options[] = array( 'name' => __( 'LinkedIn URL', 'woothemes' ),
    				'desc' => sprintf( __( 'Enter your %1$s URL e.g. http://www.linkedin.com/in/woothemes', 'woothemes' ), '<a href="http://www.www.linkedin.com.com/">'.__( 'LinkedIn', 'woothemes' ).'</a>' ),
    				'id' => $shortname . '_connect_linkedin',
    				'std' => '',
    				'type' => 'text' );

$options[] = array( 'name' => __( 'Delicious URL', 'woothemes' ),
    				'desc' => sprintf( __( 'Enter your %1$s URL e.g. http://www.delicious.com/woothemes', 'woothemes' ), '<a href="http://www.delicious.com/">'.__( 'Delicious', 'woothemes' ).'</a>' ),
    				'id' => $shortname . '_connect_delicious',
    				'std' => '',
    				'type' => 'text' );

$options[] = array( 'name' => __( 'Google+ URL', 'woothemes' ),
    				'desc' => sprintf( __( 'Enter your %1$s URL e.g. https://plus.google.com/104560124403688998123/', 'woothemes' ), '<a href="http://plus.google.com/">'.__( 'Google+', 'woothemes' ).'</a>' ),
    				'id' => $shortname . '_connect_googleplus',
    				'std' => '',
    				'type' => 'text' );
$options[] = array( "name" => __( 'Enable Related Posts', 'woothemes' ),
					"desc" => __( 'Enable related posts in the subscribe area. Uses posts with the same <strong>tags</strong> to find related posts. Note: Will not show in the Subscribe widget.', 'woothemes' ),
					"id" => $shortname."_connect_related",
					"std" => 'true',
					"type" => "checkbox" );

/* Advertising */
/*$options[] = array( "name" => "Top Ad (468x60px)",
					"type" => "heading",
					"icon" => "ads" );

$options[] = array( "name" => "Enable Ad",
					"desc" => "Enable the ad space",
					"id" => $shortname."_ad_top",
					"std" => "false",
					"type" => "checkbox" );

$options[] = array( "name" => "Adsense code",
					"desc" => "Enter your adsense code (or other ad network code) here.",
					"id" => $shortname."_ad_top_adsense",
					"std" => "",
					"type" => "textarea" );

$options[] = array( "name" => "Image Location",
					"desc" => "Enter the URL to the banner ad image location.",
					"id" => $shortname."_ad_top_image",
					"std" => "http://www.woothemes.com/ads/468x60b.jpg",
					"type" => "upload" );

$options[] = array( "name" => "Destination URL",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_top_url",
					"std" => "http://www.woothemes.com",
					"type" => "text" );*/

// Add extra options through function
if ( function_exists( "woo_options_add") )
	$options = woo_options_add($options);

if ( get_option( 'woo_template') != $options) update_option( 'woo_template',$options);
if ( get_option( 'woo_themename') != $themename) update_option( 'woo_themename',$themename);
if ( get_option( 'woo_shortname') != $shortname) update_option( 'woo_shortname',$shortname);
if ( get_option( 'woo_manual') != $manualurl) update_option( 'woo_manual',$manualurl);

// Woo Metabox Options
// Start name with underscore to hide custom key from the user
global $post;
$woo_metaboxes = array();

// Shown on both posts and pages

$woo_metaboxes[] = array (	"name" => "_layout",
							"std" => "normal",
							"label" => __( 'Layout', 'woothemes' ),
							"type" => "images",
							"desc" => __( 'Select the layout you want on this specific post/page.', 'woothemes' ),
							"options" => array(
										'layout-default' => $url . 'layout-off.png',
										'layout-full' => get_template_directory_uri() . '/functions/images/' . '1c.png',
										'layout-left-content' => get_template_directory_uri() . '/functions/images/' . '2cl.png',
										'layout-right-content' => get_template_directory_uri() . '/functions/images/' . '2cr.png'));


// Show only on specific post types or page

if ( ( get_post_type() == 'post') || ( !get_post_type() ) ) {

	// Check if TimThumb option is enabled before showing custom fields. 
	if ( get_option( 'woo_resize') == "true" ) {

		$woo_metaboxes[] = array (	'name' => "image",
									"label" => __( 'Image', 'woothemes' ),
									"type" => "upload",
									'desc' => __( 'Upload an image or enter an URL.', 'woothemes' ) );


		$woo_metaboxes[] = array (	'name' => "_image_alignment",
									"std" => "c",
									"label" => __( 'Image Crop Alignment', 'woothemes' ),
									"type" => "select2",
									'desc' => __( 'Select crop alignment for resized image', 'woothemes' ),
									"options" => array(	"c" => __( 'Center', 'woothemes' ),
														"t" => __( 'Top', 'woothemes' ),
														"b" => __( 'Bottom', 'woothemes' ),
														"l" => __( 'Left', 'woothemes' ),
														"r" => __( 'Right', 'woothemes' ) ));
	}

	$woo_metaboxes[] = array (  "name"  => "embed",
					            "std"  => "",
					            "label" => __( 'Embed Code', 'woothemes'),
					            "type" => "textarea",
					            "desc" => __( 'Enter the video embed code for your video (YouTube, Vimeo or similar)', 'woothemes') );

} // End post


// Add extra metaboxes through function
if ( function_exists( "woo_metaboxes_add") )
	$woo_metaboxes = woo_metaboxes_add($woo_metaboxes);

if ( get_option( 'woo_custom_template' ) != $woo_metaboxes) update_option( 'woo_custom_template', $woo_metaboxes );

} // END woo_options()
} // END function_exists()

// Add options to admin_head
add_action( 'admin_head','woo_options' );

//Enable WooSEO on these Post types
$seo_post_types = array( 'post','page' );
define( "SEOPOSTTYPES", serialize($seo_post_types));

//Global options setup
add_action( 'init','woo_global_options' );
function woo_global_options(){
	// Populate WooThemes option in array for use in theme
	global $woo_options;
	$woo_options = get_option( 'woo_options' );
}

?>
