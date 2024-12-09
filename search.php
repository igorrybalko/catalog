<?php 
global $wp_query;

$args = array(
    'post_type' => ['directory-item'],
 );

query_posts(array_merge($args, $wp_query->query));

get_header(); 

$sQuery = get_search_query();

?>
<div class="container">

    
    <h1 class="font-bold mb-6 text-2xl">
        <?php if($sQuery){?>
            Ви шукали: "<?= $sQuery ?>"
        <?php } else { ?>
            Пошук
        <?php } ?>
    </h1>

    <?php get_search_form();?>

    <?php 

if($sQuery){
    
    if(have_posts()){ ?>
      
        <ol>
            <?php while(have_posts()): the_post(); 

            $logo = get_field('logo');
            if(!$logo){
                $logo = get_template_directory_uri() . '/img/noimg.jpg';
            }

            $siteUrl = get_field('site_url');

            $labelSiteUrl = get_field('label_site_url');
            if(!$labelSiteUrl){
                $labelSiteUrl = $siteUrl;
            }
            
            ?>

                <li class="mb-5">
                    <div class="flex">

                        <div class="mr-2.5 w-20 text-center pt-0.5">
                            <a href="<?php the_permalink(); ?>">
                                <img class="max-h-20" src="<?php echo $logo; ?>" alt="logo">
                            </a>
                        </div>

                        <div class="flex-1">

                            <h3 class="cap mb-1">
                                <a class="underline" href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <div>
                                <?= mb_substr(strip_tags(get_the_content()), 0, 100); ?>...
                            </div>
                            <div>
                                <a class="underline text-gray-500 text-sm" target="_blank" href="<?= $siteUrl;?>">
                                    <?= $labelSiteUrl;?>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

            <?php endwhile; ?>
        </ol>
        <div class="pagination-wr">
            <?php wp_pagenavi(); ?>
        </div>
    <?php } else{ ?>

       


        Нічого не знадено
        
        <?php }
    } ?>
</div>
<?php get_footer(); ?>