<aside class="lg:w-1/4">
<?php 
if('new-sites-custom-page.php' != get_post_meta(get_the_ID(), '_wp_page_template', true)) {
    require_once (__DIR__ . '/new_sites.php');
}

require_once (__DIR__ . '/count.php');
?>
<a target="_blank" href="https://www.ukraine.com.ua/?page=561268" title="Хостинг Україна" rel="nofollow">
    <img class="rounded-md" src="<?php echo get_template_directory_uri(); ?>/img/hostukr.jpg" alt="Hosting Ukraine"/>
</a>
</aside>