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