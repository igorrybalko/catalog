<?php get_header(); ?>

<div class="container">
<h1 class="font-bold mb-6 text-xl">Блог</h1>
<?php if(have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>

        <div class="mb-5">

            <h4 class="font-bold mb-1">
                <a class="underline" href="<?php the_permalink(); ?>">
                    <?php the_title();?>
                </a>
            </h4>
            <div class="mb-3 text-gray-500 text-sm"><?= get_the_date()?></div>
            <div>
                <?= mb_substr(strip_tags(get_the_content()), 0, 220); ?>...
            </div>

        </div>

    <?php endwhile; ?>
    <?php wp_pagenavi(); ?>
<?php endif; ?>

</div>


<?php get_footer(); ?>