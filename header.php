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

        <div class="top-barre-mobile">
            <div>
                <img class="mobile" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg" alt="Logo Mota">
            </div>
            <div>
                <img class="hamburger" id="btn-hamburger" src="<?php echo get_stylesheet_directory_uri(); ?>/img/icone_menu.svg" alt="Menu hamburger">
            </div>
        </div>
            <div class="menu-mobile" id="menu-mobile">
                <div class="en-tete">
                    <img class="mobile" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg" alt="Logo Mota">    
                    <img class="croix-btn" id="croix-btn" src="<?php echo get_stylesheet_directory_uri(); ?>/img/croix.svg" alt="Croix du menu mobile">
                </div>
                
                <?php wp_nav_menu(['theme_location' => 'header']); ?>
            </div>
        <hr />
    </header>