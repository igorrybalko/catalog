<?php
get_header();
?>
<div class="container">
    <div class="lg:flex gap-x-4">
        <main class="lg:w-3/4 mb-5">
            <?php if(have_posts()):
                        while ( have_posts() ) :
                    the_post();  
                    $imgUrl = get_the_post_thumbnail_url();
                    ?>

                    <?php if($imgUrl){ ?>
                        <div class="mb-3 max-h-[200px]">
                            <img class="object-cover w-full object-center rounded-xl h-full max-h-[200px]" src="<?= $imgUrl?>" alt="">
                        </div>
                    <?php } ?>
                    <h1 class="font-bold mb-6 text-2xl"><?php the_title()?></h1>
                    <div class="mb-3 text-gray-500 text-sm"><i class="fa-solid fa-calendar-days"></i> <?= get_the_date()?></div>
                    <div class="user-content mb-8">
                        <?php the_content();?>
                    </div>

                    <?php 

            $id = get_the_ID();
            $categories = get_the_category($id);
            $show_similar = $categories[0];

            if ($show_similar->category_count > 2) { ?>
                <div class="mb-6">

                    <h3 class="text-xl mb-3 font-bold">Інші статті:</h3>

                    <?php 
                    if ($categories) {
                        $category_ids = [];
                        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

                        $args = [
                            'exclude' => $id,
                            'category' => $category_ids, 
                            'numberposts' => 3,
                            'orderby' => 'rand',
                        ]; 

                        $similar_posts = get_posts($args);
                   
                        if( $similar_posts ) { ?>

                        <nav>
                            <ul>
                            <?php
                                foreach ($similar_posts as $sim_post){ ?>
                                    <li class="mb-2">
                                        <a href="<?= get_permalink($sim_post->ID); ?>" title="<?= $sim_post->post_title; ?>" class="underline text-blue-700 hover:text-blue-400">
                                            <?= $sim_post->post_title; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                </ul>
                            </nav>
                        <?php 

                        }
                   
                    } ?>
                </div>
            <?php } ?>


                    <?php 
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>
                
                <?php endwhile; ?>
            <?php endif;?>
        </main>
        <?php require_once (__DIR__ . '/includes/common/sidebar.php');?>
    </div>
</div>
<?php
get_footer();