<?php
/*
Template Name: Add site
*/
$cats = getCategories();
?>



<?php get_header(); ?>

<script type="text/x-template" id="catsselect">
<select>
<option value="">- Оберіть категорію -</option>
<?php foreach ($cats as $cat) { ?>
    <optgroup label="<?= $cat->name;?>">
        <?php foreach ($cat->children as $item) { ?>
            <option value="<?= $item->term_id . ':' . $item->name;?>">
                <?= $item->name;?>
            </option>
        <?php } ?>
    </optgroup>
<?php } ?>
</select>

</script>



<div class="container">

    <pre>
        <?php 
        //var_dump(count($items))?>
    </pre>
    <?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
        <h1 class="font-bold mb-6 text-xl"><?php the_title()?></h1>

        <div class="form-add lg:w-1/2 mx-auto">
            <?php echo do_shortcode('[contact-form-7 id="9cc808b" title="Add site"]')?>
        </div>

            
            <?php the_content();?>
             
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php

get_footer();
?>