<!-- Ce template-parts servira à afficher les photos de même catégorie dans la zone vous-aimerez-aussi -->

<?php 

    $tab_images = array();
    //Crîtères de selection
    $arguments = array(
    'post__not_in' => array($id_banni), //On ne veut pas afficher le post en cours dans la section vous-aimerez-aussi
    'post_type' => 'photo',
    'categorie' => $cat, 
    'orderby' => 'rand',
    'posts_per_page' => 2, 
    );

    //Récupération des arguments de selection pour notre requête.
    $requete = new WP_Query( $arguments );

    /* permet de lister ce que contient la variable 
    var_dump($query); 
    */

    //Si un ou plusieurs post correspond, on lance la boucle
    if ( $requete->have_posts() ) 
    {
        while ( $requete->have_posts() ) 
        {
            $requete->the_post();
            ?><div class="container-image"><span onclick="lightbox('<?php echo get_the_ID(); ?>');" class="full-screen"></span><span class="oeil"></span><p class="ref-photo"><?php echo get_field('reference-photo');?></p><p class="cat-photo"><?php echo $cat;?></p><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('medium');?></a></div> <?php 
        }
        // Restore original post data.
        wp_reset_postdata(); 
        wp_reset_query();
    }    
?>