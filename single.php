<?php
get_header();
?>
<main class="container">
     <?php if(have_posts()):
                while ( have_posts() ) :
            the_post();  ?>
            <h1 class="font-bold mb-6 text-2xl"><?php the_title()?></h1>
            <div class="mb-3 text-gray-500 text-sm"><?= get_the_date()?></div>
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
<?php
get_footer();