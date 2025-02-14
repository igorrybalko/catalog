<?php get_header(); ?>

<main class="container">
<h1 class="font-bold mb-6 text-2xl">Блог</h1>
<?php if(have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>

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


<?php get_footer(); ?>