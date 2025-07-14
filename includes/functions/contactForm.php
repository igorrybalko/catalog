<?php

add_filter( 'wpcf7_validate_url*', 'custom_exist_url_filter', 20, 2 );
  
function custom_exist_url_filter( $result, $tag ) {
  if ( 'siteurl' == $tag->name ) {
    $siteurl = isset( $_POST['siteurl'] ) ? trim( $_POST['siteurl'] ) : '';

    $isHttps = str_starts_with($siteurl, 'https://');

    if(!$isHttps) {
        $result->invalidate( $tag, "Протокол повинен бути https" );
        return $result;
    }

    $items = get_posts([
        'post_type'   => 'directory-item',
        'post_status' => 'publish',
        'numberposts' => 4,
        'meta_query' => [
            [
                'key' => 'site_url',
                'value' => $siteurl,
                'compare' => 'LIKE'
            ],
        ],
    ]);

    if(count($items)){
        $result->invalidate( $tag, "Сайт вже додано до каталогу" );
        return $result;
    }
  }
  
  return $result;
}

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
        return in_array($post_id, CONF_7FORM_PAGE_IDS);
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

function wpcf7_before_send_mail_function( $contact_form, $abort, $submission ) {

    if($contact_form->id == 23) {

        $message = '';

        $properties = $contact_form->get_properties();
        $properties['messages']['mail_sent_ok'] = $message;
        $contact_form->set_properties($properties);

    }

    return $contact_form;
    
}
add_filter( 'wpcf7_before_send_mail', 'wpcf7_before_send_mail_function', 10, 3 );