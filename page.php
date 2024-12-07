<?php
get_header(); ?>
<main class="container">

<?php
if (have_posts()): ?>

    <?php while (have_posts()): the_post();
        
        ?>
      
                <h1 class="font-bold mb-6 text-xl"><?php the_title()?></h1>
                <div class="user-content">
                    <?php the_content();?>
                </div>
        <?php
    endwhile; ?>
<?php endif; ?>
</main>
<?php

get_footer();