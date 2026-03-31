<?php $items = get_posts( [
    'post_status' => 'publish',
    'numberposts' => 3,
] ); ?>

<h2 class="font-bold text-xl mb-5">Останні статті в блозі</h2>

<div class="flex gap-4 flex-wrap md:flex-nowrap">

<?php foreach ( $items as $item ) { 

    $image_id = get_post_thumbnail_id($item->ID); // Get the image ID
    $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true); ?>

    <div class="w-full md:w-1/3 mb-2">

        <div class="overflow-hidden h-36 rounded-lg mb-3">
            <a href="<?php the_permalink($item->ID); ?>">
                <img class="object-cover object-center hover:scale-105 duration-500 h-full w-full" src="<?php echo get_the_post_thumbnail_url($item->ID);?>" alt="<?=$alt_text?>">
            </a>
        </div>

        <div>

            <h3 class="font-bold mb-1">
                <a href="<?php the_permalink($item->ID); ?>" class="hover:text-cyan-700">
                    <?= $item->post_title?>
                </a>
            </h3>

            <div>
                <?= mb_substr( strip_tags( $item->post_content ), 0, 150 );?>...
            </div>

        </div>
    </div>
   
<?php } ?>

<div>