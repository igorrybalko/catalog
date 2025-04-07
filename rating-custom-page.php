<?php
/*
Template Name: Rating
*/

$items = get_posts( [
    'post_type'   => 'directory-item',
    'post_status' => 'publish',
    'numberposts' => 10,
    'order' => 'DESC',
    'meta_key' => 'post_views_count',
    'orderby' => 'meta_value_num'
] );

?>

<?php get_header();?>

<main class="container">


<?php

if ( have_posts() ): ?>

<?php while ( have_posts() ): the_post(); ?>

<h1 class="font-bold mb-6 text-2xl"><?php the_title()?></h1>

<div class="user-content mb-6">
    <?php the_content();?>
</div>

<?php foreach ( $items as $item ) {

    $logo = get_field( 'logo', $item->ID );
    if ( !$logo ) {
        $logo = get_template_directory_uri() . '/img/noimg.jpg';
    }

    $post_views_count = get_post_meta( $item->ID, 'post_views_count', true );

    ?>
    <div class="mb-6">

        <div class="flex">

            <div class="mr-2.5 w-20 text-center pt-0.5">
                <a href="<?php the_permalink($item->ID); ?>">
                    <img class="max-h-20" src="<?php echo $logo; ?>" alt="logo">
                </a>
            </div>

            <div class='flex-1'>

                <h3 class="font-bold mb-1">
                    <a href="<?php the_permalink($item->ID); ?>">
                        <?= $item->post_title?>
                    </a>
                </h3>

                <?php if(! empty( $post_views_count )){ ?>
                    <div class="mb-1 text-gray-500 text-sm"><i class="fa-solid fa-eye"></i> Перегляди: <?= $post_views_count;?></div>
                <?php } ?>

                <div>
                    <?= mb_substr( strip_tags( $item->post_content ), 0, 170 );?>...
                </div>

            </div>
        </div>
    </div>
<?php } ?>

<?php endwhile;?>
<?php endif;?>
</main>

<?php get_footer();?>
