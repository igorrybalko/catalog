<?php 
function getCategories(){
    $args = array(
        'type'                     => 'directory-item',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'name',
        'order'                    => 'ASC',
        'hierarchical'             => 1,
        'taxonomy'                 => 'directory',
        'hide_empty' => false,
        'pad_counts' => 1,
    );
    
    $categories = get_categories($args);

    $parents = array_filter($categories, function($el){
    return !$el->parent;
    });

    $cats = array_map(function($parent) use($categories){
        $parent->children = array_filter($categories, function($cat) use($parent){
            return $cat->parent == $parent->cat_ID;
        });
        return $parent;
    }, $parents);

    return $cats;
}