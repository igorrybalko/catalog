<?php
get_header(); ?>
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

        <?php
        if (have_posts()): ?>

            <?php while (have_posts()): the_post();
                
                ?>
                    <h1 class="font-bold mb-6 text-2xl"><?php the_title()?></h1>
                    <div class="user-content">
                        <?php the_content();?>
                    </div>
                <?php
            endwhile; ?>
        <?php endif; ?>
        </main>
        <?php require_once (__DIR__ . '/includes/common/sidebar.php');?>
    </div>
</div>
<?php

get_footer();