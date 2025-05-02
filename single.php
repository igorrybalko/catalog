<?php
get_header();
?>
<div class="container">
    <div class="lg:flex gap-x-4">
        <main class="lg:w-3/4 mb-5">
            <?php if(have_posts()):
                        while ( have_posts() ) :
                    the_post();  ?>
                    <h1 class="font-bold mb-6 text-2xl"><?php the_title()?></h1>
                    <div class="mb-3 text-gray-500 text-sm"><i class="fa-solid fa-calendar-days"></i> <?= get_the_date()?></div>
                    <div class="user-content mb-8">
                        <?php the_content();?>
                    </div>

                    <?php 
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>
                
                <?php endwhile; ?>
            <?php endif;?>
        </main>
        <?php require_once (__DIR__ . '/includes/common/new_sites.php');?>
    </div>
</div>
<?php
get_footer();