<?php require_once (__DIR__ . '/conf/index.php'); ?>
<!doctype html>
<html lang="<?php echo get_locale();?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <?php wp_head(); ?>
<!--    <meta property="og:title" content=")" />-->
<!--    <meta property="og:type" content="website" />-->
<!--    <meta property="og:url" content="" />-->
<!--    <meta property="og:image" content="" />-->
<!--    <meta property="og:description"-->
<!--          content="" />-->

</head>
<body <?php body_class(); ?>>
    <div>
        <header class="header py-4 shadow mb-6 rounded-b-xl">

            <div class="container">
                <div class="flex justify-between md:items-center flex-col md:flex-row">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <a href="/" class="header__logo"> 
                                <img src="<?php echo get_template_directory_uri(); ?>/img/logo_cat.png" alt="logo">
                            </a>
                            <span class="pl-4 font-bold tracking-wide italic">
                                <a href="/">
                                    <span class="text-2xl">Cat</span><span class="text-xs">alog</span>
                                </a>
                            </span>
                        </div>
                        <div class="md:hidden" id="tm-btn">
                            Меню
                        </div>
                    </div>

                    <nav class="top-menu hidden md:block">
                        <?php wp_nav_menu( array('theme_location'  => 'main')); ?>
                    </nav>
                </div>
            </div>
                    
        </header>
