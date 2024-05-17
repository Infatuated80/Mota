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
    // Déclaration du Javascript
	wp_enqueue_script('mota_js', get_template_directory_uri() . '/js/mon_script.js', array( 'jquery' ), '1.0', true);

    //On veut rendre aléatoire la bannière de la page d'accueil.
    if( is_page('accueil') )
    {
        wp_enqueue_script('banniere_js', get_template_directory_uri() . '/js/banniere_dynamique.js', array( 'jquery' ), '1.0', true);
    }

    //Ce script permet la gestion de la lightbox
    wp_enqueue_script('lightbox_js', get_template_directory_uri() . '/js/lightbox.js', array( 'jquery' ), '1.0', true);

    
    // Déclarer du fichier style.css à la racine du thème mota
    wp_enqueue_style('mota_css',get_stylesheet_uri(), array(), '1.0'); 	
}

// Permet la gestion des menus
add_theme_support('menus');

// Ajoute la prise en charge des images mises en avant
add_theme_support('post-thumbnails');

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support('title-tag');

// On charge notre fonction 'mota_chargement_assets' en utilisant le hook add_action
add_action( 'wp_enqueue_scripts', 'mota_chargement_assets' );

/* Gestion des tailles d'image par rapport au thème */
add_theme_support( 'post-thumbnails' );

// Définir la taille des images mises en avant
set_post_thumbnail_size( 2000, 400, true );

// Définir d'autres tailles d'images
add_image_size( 'vignette-portable', 300, 300, true);
add_image_size( 'vignette-small', 100, 100, true);


/* Début Script pour Ajax */

    //Registration du script pour le localiser 
    function ajax_customisation()
    {
        //On définit le script custom-ajax, sa localisation et on le rend compatible avec jquery / Ajax
        wp_register_script('custom-ajax', get_stylesheet_directory_uri() . '/js/ajax_query.js', array('jquery'), false, true);

        //On localise le script avec de nouvelles données et on sécurise la transaction
        $script_data_array = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce( 'charger_plus_photos' ),
        );

        $script_data_run = array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce( 'init_accueil' ),
            );
        
        wp_localize_script('custom-ajax', 'demarrage', $script_data_run); //On sécurise la transaction

        wp_localize_script('custom-ajax', 'blog', $script_data_array); //On sécurise la transaction

        wp_localize_script('custom-ajax', 'varcat',[ //On sécurise la transaction
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);

        //Script avec les données localisées dans la file d'attente
        wp_enqueue_script( 'custom-ajax' );
    }    
        add_action('wp_enqueue_scripts', 'ajax_customisation' );

    function charger_demarrage_appel()
    {       
        $i = 1;

        //Critères de selection
        $args = array(
        'post_type' => 'photo', 
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC', // Par défaut, on affiche les plus récentes.
        'posts_per_page' => $_POST['nbre'], // -1 Pour tout afficher sur une page sinon mettre valeur > 0. ici, nbre vaut 8.
        'paged' => $_POST['page'], //On affiche la première page uniquement lors du lancement.
        );

        //Récupération des arguments de selection pour notre requête.
        $requete = new WP_Query( $args );

        //Si un ou plusieurs post correspond, on lance la boucle
        if ($requete->have_posts()) 
        {   
            while ( $requete->have_posts() ) 
            {
                include ('template-parts/loop_display.php'); 
            }
            // Restore original post data.
            wp_reset_postdata(); 
            wp_reset_query();
            wp_die();
        } 
    }

        function charger_plus_ajax_appel()
        {
            check_ajax_referer('charger_plus_photos', 'security'); // nonce de $script_data_array, le jeton de sécurité

            $args = array(
            'post_type' => 'photo', 
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => $_POST['ordre'],
            'posts_per_page' => $_POST['nbre'], 
            'paged' => $_POST['page'], 
            );

                $cat = $_POST['cat'];
                $format = $_POST['format'];
       

                if(!empty($cat))
                {
                    $args['tax_query'][] = [
                    'taxonomy'=> 'categorie',
                    'field' => 'slug',
                    'terms' => $cat,
                ];
                }

        if(!empty($format))
        {
            $args['tax_query'][] = [
            'taxonomy'=> 'format',
            'field' => 'slug',
            'terms' => $format,
            ];
        }

            //Récupération des arguments de selection pour notre requête.
            $requete = new WP_Query( $args );

            //Si un ou plusieurs post correspond, on lance la boucle
            if ($requete -> have_posts())
            {   
                $i = 1;  
                while ( $requete->have_posts() ) 
                {
                    include ('template-parts/loop_display.php'); 
                }
                // Restore original post data.
                wp_reset_postdata(); 
                wp_reset_query();
                wp_die();
            } 
        }
    
    function filter_photo_appel()
    {
        $ordre = $_REQUEST['ordre']; // on récupère les valeurs data du fichier ajax_query.js
        $page = $_REQUEST['page'];
        $nbre = $_REQUEST['nbre'];

        if(empty($page))
        {
            $page = 1;
        }

        $args = array(
        'post_type' => 'photo', 
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => $ordre,
        'posts_per_page' => $nbre, 
        'paged' => $page, 
        );

        $cat = $_REQUEST['cat'];
        $format = $_REQUEST['format'];
       

        if(!empty($cat))
        {
            $args['tax_query'][] = [
                'taxonomy'=> 'categorie',
                'field' => 'slug',
                'terms' => $cat,
            ];
        }

        if(!empty($format))
        {
            $args['tax_query'][] = [
            'taxonomy'=> 'format',
            'field' => 'slug',
            'terms' => $format,
            ];
        }

        $requete = new wp_query($args);
        if($requete -> have_posts())
        {
            $i=1;
            while($requete->have_posts())
            {
                include ('template-parts/loop_display.php'); 
            }
            // Restore original post data.
            wp_reset_postdata(); 
            wp_reset_query();
            wp_die();
        }

        else
        {
            echo "<script>alert('Aucune photo ne correspond à cette requête !')</script>";
        }

        wp_die();
    }

    //Action qui lance la fonction charger_demarrage_appel qui initialisera les photos de la page d'accueil.
    add_action( 'wp_ajax_charger_demarrage', 'charger_demarrage_appel' ); // Pour utilisateurs connectés
    add_action( 'wp_ajax_nopriv_charger_demarrage', 'charger_demarrage_appel' ); // Pour utilisateurs non connectés       
    
    //Action qui lance la fonction charger_plus_ajax_appel    
    add_action( 'wp_ajax_charger_plus_ajax', 'charger_plus_ajax_appel'); // Pour utilisateurs connectés
    add_action( 'wp_ajax_nopriv_charger_plus_ajax', 'charger_plus_ajax_appel'); // Pour utilisateurs non connectés

    
    //Action qui lance la fonction filter_photo_cat_appel
    add_action( 'wp_ajax_filter_photo', 'filter_photo_appel' );
    add_action( 'wp_ajax_nopriv_filter_photo_cat', 'filter_photo_appel' );

/* Fin script pour Ajax */