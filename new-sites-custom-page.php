<?php
/*
Template Name: New sites
*/

$items = get_posts([
    'post_type'   => 'directory-item',
    'post_status' => 'publish',
    'numberposts' => 10,
]);
?>

<?php get_header(); ?>

<main class="container">

<?php
if (have_posts()): ?>

    <?php while (have_posts()): the_post(); ?>
        
    <h1 class="font-bold mb-6 text-2xl"><?php the_title()?></h1>

    <?php foreach ($items as $item) { 
        $postDate = date("d/m/Y", strtotime($item->post_date));
        $logo = get_field('logo', $item->ID);
        if(!$logo){
            $logo = get_template_directory_uri() . '/img/noimg.jpg';
        }

        $siteUrl = get_field('site_url', $item->ID);

        $labelSiteUrl = get_field('label_site_url', $item->ID);
        if(!$labelSiteUrl){
            $labelSiteUrl = $siteUrl;
        }

        ?>
        <div class="mb-6">

            <div class="flex">

                <div class="mr-2.5 w-20 text-center pt-0.5">
                    <a href="<?php the_permalink($item->ID); ?>">
                        <img class="max-h-20" src="<?php echo $logo; ?>" alt="logo">
                    </a>
                </div>

                <div class="flex-1">

                    <h3 class="font-bold mb-1">
                        <a class="underline" href="<?php the_permalink($item->ID); ?>">
                            <?= $item->post_title?>
                        </a>
                    </h3>

                    <div class="mb-1 text-gray-500 text-sm">
                        <?= $postDate;?>
                    </div>
                    <div>
                        <?= mb_substr(strip_tags($item->post_content), 0, 170);?>...
                    </div>

                    <a class="underline" target="_blank" href="<?= $siteUrl;?>">
                        <?= $labelSiteUrl;?>
                    </a>

                </div>
            </div>
        </div>
    <? } ?>   

    <?php endwhile; ?>
<?php endif; ?>
</main>

<?php

get_footer();
?>
