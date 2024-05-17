<!-- Ce template-parts permet de trouver les post avant et après celui en cours pour la vignette interactive -->
<?php 
    $tab_photos = array();
    $tab_liens = array();
    $trouve = 0;
    $i = 0;
    $test = false;

    $lien_precedent = "";
    $lien_suivant = "";

    $photo_precedente = 0;
    $photo_suivante = 0;

    //Crîtères de selection
    $args = array(
    'post_type' => 'photo', 
    'orderby' => array('date' =>'DESC'),
    'posts_per_page' => -1, 
    );

    //Récupération des arguments de selection pour notre requête.
    $requete = new WP_Query( $args );
    //Si un ou plusieurs post correspond, on lance la boucle
    if ( $requete->have_posts() ) 
    {
        while ( $requete->have_posts() ) 
        {
            $requete->the_post();
            $tab_photos[] = get_the_post_thumbnail( get_the_ID(), 'thumbnail' );
            $tab_liens[] = get_the_permalink();   

            if (get_the_id() == $id_en_cours)
            {
            $trouve = $i;
            }

            else 
            {
            $i++;
            }
        }
        // Restore original post data.
        wp_reset_postdata(); 
        wp_reset_query();
    } 
    
    $nbre_elements = count($tab_liens);

    if ($trouve == 0) 
    {
        $photo_precedente = $tab_photos[$nbre_elements - 1];
        $photo_suivante = $tab_photos[$trouve + 1];

        $lien_precedent = $tab_liens[$nbre_elements - 1];
        $lien_suivant = $tab_liens[$trouve + 1];
        $test = true;
    }

    if ($trouve == $nbre_elements - 1) 
    {
        $photo_precedente = $tab_photos[$nbre_elements - 2];
        $photo_suivante = $tab_photos[0];

        $lien_precedent = $tab_liens[$nbre_elements - 2];
        $lien_suivant = $tab_liens[0];
        $test = true;
    }

    if ($test == false)
    {
        $photo_precedente = $tab_photos[$trouve - 1];
        $photo_suivante = $tab_photos[$trouve +1];

        $lien_precedent = $tab_liens[$trouve - 1];
        $lien_suivant = $tab_liens[$trouve +1];
    }

    // On transmet les variables à JS via notre script mota_js chargé dans functions.php
    wp_localize_script( 'mota_js', 'photo_precedente', $photo_precedente );
    wp_localize_script( 'mota_js', 'photo_suivante', $photo_suivante );

    wp_localize_script( 'mota_js', 'lien_precedent', $lien_precedent );
    wp_localize_script( 'mota_js', 'lien_suivant', $lien_suivant );
?> 