<?php get_header(); ?>
<div class="container">
    <?php 
        if( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb(
                '<nav class="breadcrumbs text-xs mb-6 text-gray-500" aria-label="Breadcrumbs">',
                '</nav>'
            );
        }
    ?>
    <div class="lg:flex gap-x-4">
        <main class="lg:w-3/4 mb-5">
        <h1 class="font-bold mb-6 text-2xl">Блог</h1>
        <?php if(have_posts()): ?>
            <?php while(have_posts()): the_post(); 
            
                $imgUrl = get_the_post_thumbnail_url();
            ?>

                <?php if($imgUrl){ 

                    $image_id = get_post_thumbnail_id(); // Get the image ID
                    $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                    
                    ?>
                    <div class="mb-3 max-h-[200px] rounded-xl overflow-hidden">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                            <img class="object-cover w-full object-center rounded-xl h-full max-h-[200px] hover:scale-105 duration-500" src="<?= $imgUrl?>" alt="<?=$alt_text?>">
                        </a>
                    </div>
                <?php } ?>

                <div class="mb-9">

                    <h2 class="font-bold mb-1 text-xl">
                        <a class="underline" href="<?php the_permalink(); ?>">
                            <?php the_title();?>
                        </a>
                    </h2>
                    <div class="mb-3 text-gray-500 text-sm"><i class="icon-calendar"></i> <?= get_the_date()?></div>
                    <div>
                        <?= mb_substr(strip_tags(get_the_content()), 0, 220); ?>...
                    </div>

                </div>

            <?php endwhile; ?>
            <?php wp_pagenavi(); ?>
        <?php endif; ?>

        </main>
        <?php require_once (__DIR__ . '/includes/common/sidebar.php');?>
    </div>
</div>


<?php get_footer(); ?>