<?php
/* Ce template nous permet d'afficher les vignettes en fonction d'une requête */
$requete->the_post();
$taxo = get_the_terms('', 'categorie');
$categorie = $taxo[0]->name;

if ($i == 1)
                {
                ?><div class="contenaire-photo">
                    <div class="vignette-accueil"><span onclick="lightbox('<?php echo get_the_ID(); ?>');" class="full-screen"></span><span class="oeil"></span><p class="ref-photo"><?php echo get_field('reference-photo');?></p><p class="cat-photo"><?php echo $categorie;?></p><a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium');?></a></div>
                    <?php
                }

                if ($i == 2)
                {
                    ?><div class="vignette-accueil"><span onclick="lightbox('<?php echo get_the_ID(); ?>');" class="full-screen"></span><span class="oeil"></span><p class="ref-photo"><?php echo get_field('reference-photo');?></p><p class="cat-photo"><?php echo $categorie;?></p><a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium');?></a></div></div>
                    <?php
                }

                $i++;

                if ($i > 2)
                {
                    $i = 1;
                }
