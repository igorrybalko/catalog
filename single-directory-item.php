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
?>

<div class="container">
    <div class="lg:flex gap-x-4">
        <main class="lg:w-3/4 mb-5">
        <?php if(have_posts()):
                    while ( have_posts() ) :
                the_post(); 

                $logo = get_field('logo');
                $siteUrl = get_field('site_url');

                $labelSiteUrl = get_field('label_site_url');
                if(!$labelSiteUrl){
                    $labelSiteUrl = $siteUrl;
                }
                ?>
                <h1 class="font-bold mb-6 text-xl"><?php the_title()?></h1>
                
                <div class="mb-2 text-gray-500">Категорія: <?= $cats[0]->name?></div>
                <div class="mb-3 text-gray-500 text-sm"><?= get_the_date()?></div>
                <?php if($logo){?>
                <div class="mb-2 max-w-32">
                    <img class="max-h-28" src="<?= $logo?>" alt="logo">
                </div>
                <?php }?>
                <div class="user-content mb-5">
                    <?php the_content();?>
                </div>
                <a class="underline" target="_blank" href="<?= $siteUrl;?>"><?= $labelSiteUrl;?></a>
            <?php endwhile; ?>
        <?php endif;?>
        </main>

        <aside class="lg:w-1/4 side-cats">
            <h3 class="font-bold mb-2">
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