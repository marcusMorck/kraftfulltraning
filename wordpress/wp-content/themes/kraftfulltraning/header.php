<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script
			  src="https://code.jquery.com/jquery-3.3.1.js"
			  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
			  crossorigin="anonymous"></script>
		
        
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
        <?php wp_nav_menu( array( 'get_template_directory_uri()' => 'main-nav', 'container' => 'div') ); ?> 
    </header>

