<?php get_header(); 

$category = get_queried_object();

$rootCatId = $category->term_id;
$rootCatName = $category->name;

if($category->parent){

    $rootCatId = $category->parent;
    $rootCatName = get_the_category_by_ID($category->parent);
}

$cats = get_categories( array( 
    'child_of'   => $rootCatId,
    'taxonomy'   => 'directory',
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
) ); 

?>
<div class="container" data-catid="<?= $category->term_id?>" id="catwr">

    <div class="lg:flex gap-x-4">

        <main class="lg:w-3/4">
            <h1 class="font-bold mb-6 text-2xl"><?= $category->name?></h1>

            <?php if(have_posts()): ?>
                <?php while(have_posts()): the_post(); 

                $logo = get_field('logo');
                if(!$logo){
                    $logo = get_template_directory_uri() . '/img/noimg.jpg';
                }
                ?>

                <div class="mb-5">

                    <div class="flex">
                       
                        <div class="mr-2.5 w-20 text-center pt-0.5 flex justify-center">
                            <a href="<?php the_permalink(); ?>">
                                <img class="max-h-20" src="<?php echo $logo; ?>" alt="logo">
                            </a>
                        </div>
            
                        <div class="flex-1">
                            <h3 class="font-bold mb-1">
                                <a class="underline" href="<?php the_permalink(); ?>">
                                    <?php the_title();?>
                                </a>
                            </h3>
                            <div>
                                <?= mb_substr(strip_tags(get_the_content()), 0, 200); ?>...
                            </div>
                        </div>
                    </div>
                </div>

                <?php endwhile; ?>

                <?php wp_pagenavi(); ?>
            <?php endif; ?>
        </main>

        <aside class="lg:w-1/4 side-cats"> 
            <div class="mb-6">
                <h3 class="font-bold mb-2 text-lg">
                    <a href="<?= get_category_link( $rootCatId ) ?>">
                        <?= $rootCatName?>
                    </a>
                </h3>
                <nav>
                    <ul>
                    <?php foreach ($cats as $cat) { ?>
                        <li>
                            <a class="<?php echo $category->term_id == $cat->term_id ? 'active' : ''; ?>" href="<?= get_category_link( $cat->term_id ) ?>">
                                <?= $cat->name;?>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                </nav>
            </div>
            <?php require_once (__DIR__ . '/includes/common/count.php');?>
        </aside>
    </div>
</div>


<?php get_footer(); ?>