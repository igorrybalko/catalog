<?php
get_header();

$dirItem = get_queried_object();

$cats = get_the_terms($dirItem->ID, 'directory');

$rootCatId = $cats[0]->parent;
$rootCatName = get_the_category_by_ID($rootCatId);

$otherCats = get_categories( array( 
    'child_of'   => $rootCatId,
    'taxonomy'   => 'directory',
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
) ); 

customSetPostViews(get_the_ID());
?>
<div class="container">
    <div class="lg:flex gap-x-4">
        <main class="lg:w-3/4 mb-5">
        <?php if(have_posts()):
                    while ( have_posts() ) :
                the_post(); 

                $logo = get_field('logo');
                $siteUrl = get_field('site_url');
                $video = get_field('video');
                $tags = get_field('tags');

                $labelSiteUrl = get_field('label_site_url');
                if(!$labelSiteUrl){
                    $labelSiteUrl = $siteUrl;
                }

                $post_views_count = get_post_meta( get_the_ID(), 'post_views_count', true );
 
                ?>
                <h1 class="font-bold mb-6 text-2xl"><?php the_title()?></h1>
                <div class="mb-2 text-gray-500">Категорія: <?= $cats[0]->name?></div>
                <div class="mb-2 text-gray-500 text-sm"><i class="fa-solid fa-calendar-days"></i> <?= get_the_date()?></div>
                <?php if(! empty( $post_views_count )){ ?>
                    <div class="mb-3 text-gray-500 text-sm"><i class="fa-solid fa-eye"></i> Перегляди: <?= $post_views_count;?></div>
                <?php } ?>
                <?php if($logo){?>
                <div class="mb-2 max-w-36">
                    <a class="underline" target="_blank" href="<?= $siteUrl;?>">
                        <img class="max-h-28" src="<?= $logo?>" alt="logo">
                    </a>
                </div>
                <?php }?>
                <div class="user-content mb-5">
                    <?php the_content();?>
                </div>
                <div class="mb-5">
                    <span class="text-gray-500">Сайт:</span> <a class="underline text-blue-700 hover:text-blue-400" target="_blank" href="<?= $siteUrl;?>"><?= $labelSiteUrl;?></a>
                </div>
                
                <?php if($video){?>
                <div>
                    <h2 class="font-bold mb-4 text-xl">Відеопрезентація</h2>
                    <div class="response-video">
                    <iframe width="560" height="315" 
                    src="https://www.youtube.com/embed/<?= $video?>"
                         title="YouTube video player" 
                         frameborder="0" 
                         allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                         referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
                <?php }?>

                <?php if($tags) { ?>

                    <div class="mb-5">
                        <h4 class="font-bold mb-1 text-base">Мітки</h4>

                        <?php 
                            $tagsArr = explode(", ", $tags);
                            foreach ($tagsArr as $tag) { ?>
                                <a href="/?s=<?= $tag ?>" class="text-sm underline text-gray-500 mr-2 hover:text-blue-400">
                                    <?= $tag ?>
                                <a> 
                        <?php } ?>
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

        <aside class="lg:w-1/4 side-cats">
            <h3 class="font-bold mb-2 text-lg">
                <a href="<?= get_category_link( $rootCatId ) ?>">
                    <?= $rootCatName?>
                </a>
            </h3>
            <nav>
                <ul>
                <?php foreach ($otherCats as $cat) { ?>
                    <li>
                        <a class="<?php echo $cat->term_id == $cats[0]->term_id ? 'active' : ''; ?>" href="<?= get_category_link( $cat->term_id ) ?>">
                            <?= $cat->name;?>
                        </a>
                    </li>
                <?php } ?>
                </ul>
            </nav>
        </aside>
    </div>
</div>
<?php
get_footer();