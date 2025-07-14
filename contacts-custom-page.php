<?php
/*
Template Name: Contacts page
*/

?>

<?php get_header(); ?>

<div class="container">
    <div class="lg:flex gap-x-4">
        <main class="lg:w-3/4 mb-5">

            <?php if(have_posts()): ?>
                <?php while(have_posts()): the_post(); ?>
                    <h1 class="font-bold mb-6 text-2xl"><?php the_title()?></h1>


                    <div class="user-content mb-3">
                        <?php the_content();?>
                    </div>

                    <div class="form-add lg:w-1/2 mx-auto">
                        <h3 class="font-bold text-center mb-3 text-xl">Зворотній зв'язок</h3>
                        <?php echo do_shortcode(get_field('contact_form_short_code'))?>
                    </div>

                <?php endwhile; ?>
            <?php endif; ?>
        </main>
        <?php require_once (__DIR__ . '/includes/common/sidebar.php');?>
    </div>
</div>

<?php

get_footer();
