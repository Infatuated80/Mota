<!--Début Ce template part permet de gérer la lightbox -->

    <!-- On récupère la référence sur laquelle le clic a eu lieu. -->
    <?php
        //Tableau de récupération des données pour la lightbox 
        $curseur = 0;
        $lightbox_tab_photo = array();
        $lightbox_tab_ref = array();
        $lightbox_tab_cat = array();
        $lightbox_tab_id = array();

        //Critères de selection
        $args = array(
        'post_type' => 'photo', 
        'orderby' => 'date', //On classe par référence photo pour tester la lightbox
        'order' => 'ASC',
        'posts_per_page' => -1 // -1 Pour tout afficher sur une page sinon mettre valeur > 0
        );
    
        //Récupération des arguments de selection pour notre requête.
        $requete = new WP_Query( $args );

        //Si un ou plusieurs post correspond, on lance la boucle
        if ( $requete->have_posts() ) 
        {   
            while ( $requete->have_posts() ) 
            {
                $requete->the_post();
                $taxo = get_the_terms('', 'categorie');
		        $categorie = $taxo[0]->name;    
                
                $lightbox_tab_id[] = get_the_ID();
                $lightbox_tab_photo[] = get_the_post_thumbnail_url('', 'large');
                $lightbox_tab_cat[] = $categorie;
                $lightbox_tab_ref[] = get_field('reference-photo');
            }
        }
        // Restore original post data.
        wp_reset_postdata();

        // On transmet les tableaux à JS via notre script lightbox_js chargé dans functions.php
        wp_localize_script( 'lightbox_js', 'lightbox_tab_id_js', $lightbox_tab_id );
        wp_localize_script( 'lightbox_js', 'lightbox_tab_photo_js', $lightbox_tab_photo );
        wp_localize_script( 'lightbox_js', 'lightbox_tab_cat_js', $lightbox_tab_cat );
        wp_localize_script( 'lightbox_js', 'lightbox_tab_ref_js', $lightbox_tab_ref );
        
    ?>
    <div class="lightbox-contenaire-principal">
        <div class="lightbox-croix">
            <img id="lightbox-croix" src="<?php echo get_template_directory_uri(); ?>/img/croix_lightbox.svg" / alt="Croix qui ferme la lightbox">
        </div>

        <div class="lightbox-en-ligne">

            <div class="lightbox-nav-gauche">
                <img id="lightbox-gauche" src="<?php echo get_template_directory_uri(); ?>/img/gauche_lightbox.svg" / alt="Flèche gauche">  
            </div>

            <div class="lightbox-photo">
                <img id="lightbox-photo-heros" src="<?php echo get_template_directory_uri(); ?>/img/header-photo-event.jpg" / alt="image mise en avant">
            </div>

            <div class="lightbox-nav-droite">
                <img id="lightbox-droite" src="<?php echo get_template_directory_uri(); ?>/img/droite_lightbox.svg" / alt="Flèche droite"> 
            </div>
        </div>

        <div class="lightbox-description">
            <p id="lightbox-ref">Référence</p>
            <p id="lightbox-cat">Catégorie</p>
        </div>

    </div>
<!--Fin Ce template part permet de gérer la lightbox -->
