<?php 
function theme_mota_support()
{
    {
        register_nav_menu('header', 'En tête du menu');
        register_nav_menu('footer', 'Pied de page');
    }
}

add_action('after_setup_theme', 'theme_mota_support');

function mota_chargement_assets() 
{
    // Déclaration du jQuery
    wp_enqueue_script('jquery' );
    
    // Déclaration du Javascript
	wp_enqueue_script('mota_js', get_template_directory_uri() . '/JS/mon_script.js', array( 'jquery' ), '1.0', true);
    
    // Déclarer du fichier style.css à la racine du thème mota
    wp_enqueue_style('mota_css',get_stylesheet_uri(), array(), '1.0');
  	
    // Déclarer le fichier CSS additionnel si nécessaire...
    wp_enqueue_style('mota_additionnel_css', get_template_directory_uri() . '/CSS/style_additionnel.css', array(),'1.0');
}

// Permet la gestion des menus
add_theme_support('menus');

// Ajoute la prise en charge des images mises en avant
add_theme_support('post-thumbnails');

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support('title-tag');

// On charge notre fonction 'mota_chargement_assets' en utilisant le hook add_action
add_action( 'wp_enqueue_scripts', 'mota_chargement_assets' );