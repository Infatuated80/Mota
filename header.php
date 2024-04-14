<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Book de la photographe Nathalie Mota !</title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
    <?php wp_body_open(); ?>
    <header>
        <div class="top-barre">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg" alt="Logo Mota">
            <!-- on appelle le menu localisé dans header -->
            <?php wp_nav_menu(['theme_location' => 'header']) ?>   
        </div>

        <div class="banniere">
            <p class="event">Photographe Event</p>
        </div>
    </header>