<?php get_header(); 

$cats = getCategories();
?>

<main class="container">

<?php if(have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>

        <h1 class="font-bold mb-6 text-xl">
            <?php the_title();?>
        </h1>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 mb-8">
            <?php foreach ($cats as $cat) { ?>

                <div>
                    <h4 class="font-semibold">
                        <a href="<?= get_category_link( $cat->term_id ) ?>">
                            <?= $cat->name;?> (<?= $cat->count;?>)
                        </a>
                    </h4>
                    <ul>

                        <?php foreach ($cat->children as $item) { ?>

                            <li>
                                <a href="<?= get_category_link( $item->term_id ) ?>">
                                    <?= $item->name;?> (<?= $item->count;?>)
                                </a>
                            </li>

                        <?php } ?>

                    </ul>
                </div>
            
            <?php } ?>
        </div>

        <div class="user-content mb-5">
            <?php the_content(); ?>
        </div>

    <?php endwhile; ?>
<?php endif; ?>

</main>

<?php get_footer();
