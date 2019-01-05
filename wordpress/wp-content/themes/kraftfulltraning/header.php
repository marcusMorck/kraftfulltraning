<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kraftfullträning</title>
    <?php wp_head(); ?>
</head>
<body>
    <header>
        <div id="custom-header-img">
            <a href="<?php echo get_option('home'); ?>">
            <?php the_header_image_tag(); ?>
            </a>
        </div>
        <?php wp_nav_menu( array( 'get_template_directory_uri()' => 'header-menu' ) ); ?> 
    </header>
    <main>

