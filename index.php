<?php get_header(); ?>
<div class="container">
    <div class="lg:flex gap-x-4">
        <main class="lg:w-3/4 mb-5">
        <h1 class="font-bold mb-6 text-2xl">Блог</h1>
        <?php if(have_posts()): ?>
            <?php while(have_posts()): the_post(); 
            
                $imgUrl = get_the_post_thumbnail_url();
            ?>

                <?php if($imgUrl){ ?>
                    <div class="mb-3 max-h-[200px] rounded-xl overflow-hidden">
                        <a href="<?php the_permalink(); ?>">
                            <img class="object-cover w-full object-center rounded-xl h-full max-h-[200px] hover:scale-105 duration-500" src="<?= $imgUrl?>" alt="">
                        </a>
                    </div>
                <?php } ?>

                <div class="mb-5">

                    <h3 class="font-bold mb-1">
                        <a class="underline" href="<?php the_permalink(); ?>">
                            <?php the_title();?>
                        </a>
                    </h3>
                    <div class="mb-3 text-gray-500 text-sm"><i class="fa-solid fa-calendar-days"></i> <?= get_the_date()?></div>
                    <div>
                        <?= mb_substr(strip_tags(get_the_content()), 0, 220); ?>...
                    </div>

                </div>

            <?php endwhile; ?>
            <?php wp_pagenavi(); ?>
        <?php endif; ?>

        </main>
        <?php require_once (__DIR__ . '/includes/common/new_sites.php');?>
    </div>
</div>


<?php get_footer(); ?>