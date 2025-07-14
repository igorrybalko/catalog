<?php get_header(); ?>
<div class="container">
    <div class="lg:flex gap-x-4">
        <main class="lg:w-3/4 mb-5">
            <h1 class="font-bold mb-6 text-2xl">404</h1>
            <p>Сторінка відсутня</p>
            <p>Перейдіть на <a href="/" class="underline text-cyan-600">головну</a></p>

        </main>
        <?php require_once (__DIR__ . '/includes/common/sidebar.php');?>
    </div>
</div>
<?php get_footer(); ?>