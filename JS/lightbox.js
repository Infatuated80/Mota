/* Début gestion de la lightbox */

function lightbox(identifiant_en_cours)
{
    let cible_lightbox = document.querySelector('.lightbox-contenaire-principal')
    let i = 0
    let id_trouve = 0
    cible_lightbox.classList.add("active")
    
    lightbox_tab_id_js.forEach((tab_id_js) => 
    {
        if (tab_id_js === identifiant_en_cours) 
        {
          id_trouve = i 
        }

        else
        {
            i++
        }
    });

    //On cible les balises à modifier pour notre héros lightbox
    let cible_image_heros = document.querySelector('#lightbox-photo-heros')
    cible_image_heros.src = lightbox_tab_photo_js[id_trouve]

    let cible_ref_heros = document.querySelector('#lightbox-ref')
    cible_ref_heros.innerHTML = lightbox_tab_ref_js[id_trouve]

    let cible_cat_heros = document.querySelector('#lightbox-cat')
    cible_cat_heros.innerHTML = lightbox_tab_cat_js[id_trouve]

    let cible_croix_lightbox = document.querySelector('#lightbox-croix')

    // Lorsqu'on clique sur la croix, la lightbox disparait.
    cible_croix_lightbox.addEventListener("click", () => 
    {  
        cible_lightbox.classList.remove("active")
    });

    carrousel(id_trouve)
}

function carrousel(id)
{
    let cible_fleche_gauche_lightbox = document.querySelector('#lightbox-gauche')
    let nouveau_heros = 0

    // Lorsqu'on clique sur la flèche gauche, on passe à l'image précédente
    cible_fleche_gauche_lightbox.addEventListener("click", () => 
    {  
        if (id <=  0)
        {
            nouveau_heros = lightbox_tab_id_js.length - 1 // Comme on démarre à 0 dans un tableau, on retire 1.
        }

        else
        {
            nouveau_heros = id - 1
        } 

        console.log(nouveau_heros)

        lightbox(lightbox_tab_id_js[nouveau_heros])
    });

    let cible_fleche_droite_lightbox = document.querySelector('#lightbox-droite')

    cible_fleche_droite_lightbox.addEventListener("click", () => 
    {  
        if (id ===  lightbox_tab_id_js.length - 1)
        {
            nouveau_heros <= 0
        }

        else
        {
            nouveau_heros = id + 1
        } 

        console.log(nouveau_heros)

        lightbox(lightbox_tab_id_js[nouveau_heros])
    });
}

/* Fin gestion de la lightbox */