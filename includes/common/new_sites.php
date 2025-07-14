<?php
$items = get_posts([
    'post_type'   => 'directory-item',
    'post_status' => 'publish',
    'numberposts' => 3,
]);
?>

<div class="mb-6">
    <h3 class="font-bold mb-4 text-lg">Нові сайти в каталозі</h3>

    <?php foreach ($items as $item) { 
        $postDate = date("d/m/Y", strtotime($item->post_date));
        $logo = get_field('logo', $item->ID);

        if (is_numeric($logo)) {
            $logo_url = wp_get_attachment_url($logo);
        } else {
            $logo_url = $logo;
        }

        if(!$logo){
            $logo_url = get_template_directory_uri() . '/img/noimg.jpg';
        }

        ?>
        <div class="mb-3">

            <div class="flex">

                <div class="mr-2.5 w-20 text-center pt-0.5 flex justify-center">
                    <a href="<?php the_permalink($item->ID); ?>">
                        <img class="max-h-20" src="<?php echo $logo_url; ?>" alt="logo">
                    </a>
                </div>

                <div class="flex-1 text-sm">

                    <h3 class="font-bold mb-1">
                        <a class="underline" href="<?php the_permalink($item->ID); ?>">
                            <?= $item->post_title?>
                        </a>
                    </h3>

                    <div class="mb-1 text-gray-500">
                        <i class="fa-solid fa-calendar-days"></i> <?= $postDate;?>
                    </div>
                    <div>
                        <?= mb_substr(strip_tags($item->post_content), 0, 70);?>...
                    </div>


                </div>
            </div>
        </div>
    <? } ?> 
</div>
