<?php 
/* Template Name: template-mota-accueil */
?>

<?php get_header(); ?>

    <?php 
        /* On récupère les taxonomies pour pouvoir les injecter dans le formulaire. */
        $taxo_cat = get_terms( array(
        'taxonomy' => 'categorie',
        ) );

        $taxo_format = get_terms( array(
        'taxonomy' => 'format',
        ) ); 
    ?>

    <?php
        /* Requête pour récupérer une image au hasard et l'injecter dans la bannière */
        
        $arguments = array(
        'post_type' => 'photo',
        'orderby' => 'rand',
        'posts_per_page' => 1, 
        );

        $query = new WP_Query( $arguments ); // On lance la requête

    if ( $query->have_posts() ) 
    {
        while ( $query->have_posts() ) 
        {
            $query->the_post();
            $image_banniere[] = get_the_post_thumbnail_url('', 'large'); 
        }
        // On injecte l'image dans notre bannière 
        wp_localize_script( 'banniere_js', 'image_banniere', $image_banniere );
        
        // Restore original post data.
        wp_reset_postdata(); 
        wp_reset_query();
    }    
        
    ?>

<div class="banniere">
    <p class="event">Photographe Event</p>
</div>

<main>
    
    <div class="contenaire-filtre"> 
        <div>      
            <select onfocus="this.size='<?php echo count($taxo_cat) + 2; ?>';" onblur='this.size=0;' onchange='this.size=1; this.blur();' name="categorie" id="select-categorie">
                <option id="cat" value="" selected>Catégories</option> 
                <option value=""></option>
                <?php
                foreach( $taxo_cat as $categorie ): 
                    echo "<option value='" . $categorie->slug . "'>". $categorie->name . "</option>"; 
                endforeach;
                ?>  
            </select>
        </div>

        <div>
            <select onfocus="this.size='<?php echo count($taxo_format) + 2; ?>';" onblur='this.size=0;' onchange='this.size=1; this.blur();' name="format" id="select-format">
                <option id="format" value="" selected>Formats</option>
                <option value=""></option>
                <?php
                    foreach( $taxo_format as $format ): 
                        echo "<option value='" . $format->slug . "'>" . $format->name . "</option>"; 
                    endforeach; 
                ?>
            </select>
        </div>

        <div>
            <select onfocus="this.size=4;" onblur='this.size=0;' onchange='this.size=1; this.blur();' name="trie" id="select-trie">
                <option id="trie" value="DESC" selected>TRIER PAR</option>
                <option value="DESC"></option><!-- Par défaut, on affiche les plus récentes -->
                <option value="DESC">Plus récentes</option> <!-- DESC(décroissant) pour une date, donnera les plus récentes -->
                <option value="ASC">Plus anciennes</option> <!-- ASC(croissant) les plus anciennes -->
            </select>
        </div>    
    </div>
    
    <!-- Ce contenaire recevra le résultat des requêtes ajax -->
    <div class="contenaire-requete">
        
    </div>

    <div class="contenaire-charger-plus">
        <button id="charger-plus">Charger plus</button>
    </div>
    
</main>

<?php get_footer(); ?>