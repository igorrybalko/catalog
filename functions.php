<?php
function true_register_wp_sidebars() {

    register_sidebar(
        array(
            'id' => 'lang',
            'name' => 'For lang switch',
            'description' => 'Перетащите сюда виджеты',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '',
            'after_title' => ''
        )
    );

    register_sidebar(
        array(
            'id' => 'footer-text',
            'name' => 'footer-text',
            'description' => 'Перетащите сюда виджеты',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<div class="hidden">',
            'after_title' => '</div>'
        )
    );
}

add_action( 'widgets_init', 'true_register_wp_sidebars' );

add_filter( 'widget_title', 'hide_widget_title' );
function hide_widget_title( $title ) {
    if ( empty( $title ) ) return '';
    if ( $title[0] == '!' ) return '';
    return $title;
}

//show_admin_bar( false );

function theme_register_nav_menu() {

    register_nav_menu( 'main', 'main' );
    register_nav_menu( 'bottom', 'bottom' );
}
add_action( 'after_setup_theme', 'theme_register_nav_menu' );

function register_theme_styles() {

    wp_register_style( 'main', get_template_directory_uri() . '/css/style.min.css' );
    wp_enqueue_style( 'main' );

    wp_register_style( 'vendor', get_template_directory_uri() . '/css/vendor.min.css' );
    wp_enqueue_style( 'vendor' );

}
add_action( 'wp_enqueue_scripts', 'register_theme_styles' );

function register_theme_scripts() {

    wp_enqueue_script("jquery");
    wp_enqueue_script('app', get_template_directory_uri() . '/js/app.min.js');

}

add_action( 'wp_enqueue_scripts', 'register_theme_scripts' );
/*откл форматирование*/
// remove_filter( 'the_content', 'wptexturize' );
// remove_filter( 'the_excerpt', 'wptexturize' );
// remove_filter( 'comment_text', 'wptexturize' );
// remove_filter( 'the_title', 'wptexturize' );

// remove_filter( 'the_content', 'wpautop' );
// remove_filter( 'the_excerpt', 'wpautop' );
// remove_filter( 'comment_text', 'wpautop' );
// remove_filter( 'the_title', 'wpautop' );

add_theme_support( 'post-thumbnails' );

function wp_remove_version() {
    return '';
}
add_filter('the_generator', 'wp_remove_version');

add_theme_support( 'title-tag' );

function custom_cat() {
    // create a new taxonomy
    register_taxonomy(
        'directory',
        'directory-item',
        array(
            'label' => __( 'Dir Category' ),
            'rewrite' => array( 'slug' => 'directory', 'with_front' => false ),
            'capabilities' => array(
                'manage_terms' => 'manage_categories',
                'edit_terms' => 'manage_categories',
                'delete_terms' => 'manage_categories',
                'assign_terms' => 'edit_posts',
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
add_action( 'init', 'custom_cat' );

function create_post_type() {
   register_post_type( 'directory-item',
       array(
           'labels' => array(
               'name' => __( 'Items' ),
               'singular_name' => __( 'Item' )
           ),
           'rewrite' => array( 'slug' => 'directory/%directory%', 'with_front' => false ),
           'public' => true,
           'has_archive' => true,
           'taxonomies' => array('directory'),
           'hierarchical' => true,
       )
   );
}
add_action( 'init', 'create_post_type' );

function wpa_show_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'directory-item' ){
        $terms = wp_get_object_terms( $post->ID, 'directory' );
        if( $terms ){
            return str_replace( '%directory%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'wpa_show_permalinks', 1, 2 );


//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );


/**
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );
 
/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}
 
/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
 
$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }
 
return $urls;
}

remove_action('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

add_action( 'init', 'wpkama_disable_embed_route', 99 );

function wpkama_disable_embed_route(){

	// Remove the REST API endpoint.
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );

	// Remove oEmbed discovery links.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	// Remove all embeds rewrite rules.
	add_filter( 'rewrite_rules_array', function ( $rules ){

		foreach( $rules as $rule => $rewrite ){
			if( false !== strpos( $rewrite, 'embed=true' ) ){
				unset( $rules[$rule] );
			}
		}

		return $rules;
	} );
}

require_once (__DIR__ . '/includes/functions/getCategories.php');
require_once (__DIR__ . '/includes/functions/contactForm.php');


/**
 * Check if Contact Form 7 Shortcode Exists
 * 
 * Only checks content for the `[contact-form-7]` shortcode in 
 * singular post types. Defaults to false for other templates.
 * 
 * @param int|null $post_id Optional. Post ID to check, otherwise 
 * it grabs it from the global `$post` object.
 * @return bool True if shortcode was found. False otherwise.
 */
function tw_cf7_shortcode_exists($post_id = null)
{
    if (!is_null($post_id) || (is_singular() && class_exists('WPCF7'))) {
        if (is_null($post_id)) {
            global $post;
            $post_id = $post->ID;
        }
        return $post_id == 17;
    }
    return false;
}

/**
 * Disable Contact Form 7's Recaptcha when form is not on page
 */
add_action('wp_enqueue_scripts', function () {
    if (!tw_cf7_shortcode_exists()) {
        remove_action('wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts', 20, 0);
    }
}, 1, 0);

/**
 * Enable Contact Form 7's assets when form is on page
 */
add_action('wp_enqueue_scripts', function () {
    if (tw_cf7_shortcode_exists()) {
        if (function_exists('wpcf7_enqueue_scripts')) {
            wpcf7_enqueue_scripts();
        }
        if (function_exists('wpcf7_enqueue_styles')) {
            wpcf7_enqueue_styles();
        }
    }
}, 20, 0);

add_filter('comment_form_default_fields', 'website_remove');
function website_remove($fields)
{
   if(isset($fields['url']))
   unset($fields['url']);
   return $fields;
}


// add_action('acf/init', 'my_acf_op_init');
// function my_acf_op_init() {

//     // Check function exists.
//     if( function_exists('acf_add_options_page') ) {

//         // Register options page.
//         $option_page = acf_add_options_page(array(
//             'page_title'    => __('Theme General Settings'),
//             'menu_title'    => __('Theme Settings'),
//             'menu_slug'     => 'theme-general-settings',
//             'capability'    => 'edit_posts',
//             'redirect'      => false
//         ));
//     }
// }


/*
 * Set post views count using post meta//functions.php
 */
function customSetPostViews($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '1');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}