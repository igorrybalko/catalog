<?php

get_header();
?>

        <?php if(have_posts()):
            while ( have_posts() ) :
                the_post();  ?>
             
       
            <?php endwhile; ?>
        <?php endif;?>


    <?php wp_pagenavi(); ?>

<?php
get_footer();