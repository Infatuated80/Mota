// Inclure les scripts JS
console.log("Le javascript fonctionne correctement !")

/* Début --> Gestion du menu hamburger lorsqu'on est en version mobile / petit écran */
    function menu_hamburger()
    {
        let menu = document.getElementById("menu-mobile")
        let btn_hamburger = document.getElementById("btn-hamburger")
        var croix_btn = document.getElementById("croix-btn")
        let body_modif = document.querySelector("body")

        btn_hamburger.onclick = openMenu
        croix_btn.onclick = closeMenu

        /* Ouverture du menu lorsqu'on clique sur le hamburger */
        function openMenu() 
        {
            menu.classList.add("active")
            body_modif.classList.add("active")
        }

        /* Fermeture du menu lorsqu'on clique sur la croix */
        function closeMenu() 
        {
            menu.classList.remove("active")
            body_modif.classList.remove("active")
        }
    }

    if(screen.width <= 1000)
    {
        menu_hamburger()
    }
/* Fin --> permettant la gestion du menu hamburger lorsqu'on est en version mobile */

/* Début --> Gestion de la pop-up de contact */

    // On cible la croix du formulaire de contact.
    let cible_croix = document.querySelector(".contact-close")
    let cible_contact_modal = document.querySelector(".contact-modal")
    let cible_contact_li = document.querySelectorAll(".menu-item-11") //En inspectant, on trouve le id du li de contact.
    let cible_bouton_aime_photo = document.querySelector("#aime-photo")
          
    // Lorsqu'on clique sur la croix, la modale de contact disparait.
    cible_croix.addEventListener("click", () => 
    {
        console.log("Tu cliques sur la croix !")   
        cible_contact_modal.classList.remove("contact-modal-apparait") 
        cible_contact_modal.classList.add("contact-modal-disparait") 
    });

    
    cible_contact_li.forEach(function (cible_li) {

        cible_li.addEventListener("click", () => 
    {
        cible_contact_modal.classList.remove("contact-modal-disparait") 
        cible_contact_modal.classList.add("contact-modal-apparait")     
    });
        
        }); 

    cible_bouton_aime_photo.addEventListener("click", () => 
    {
        cible_contact_modal.classList.remove("contact-modal-disparait") 
        cible_contact_modal.classList.add("contact-modal-apparait")
        let preremplir = document.getElementById('ref')
        let recup_ref = document.getElementById('ma-ref').textContent 
        preremplir.value = "" + recup_ref // On injecte la ref de la photo convoitée dans le champs contact.
    });
/* Fin --> Gestion de la pop-up de contact */ 

/* Début aperçu de la vignette et liens interactives */

    // On cible la span de la vignette à changer 
    let cible_span_aperçu = document.querySelector('#vignette-interactive')
    let cible_fleche_gauche = document.querySelector('.fleche-gauche-petite')
    let cible_fleche_droite = document.querySelector('.fleche-droite-petite')

    // Gestion des survols pour changer la vignette.
    cible_fleche_gauche.addEventListener("mouseover", () => 
    {
        cible_span_aperçu.innerHTML = photo_precedente;
    });

    cible_fleche_gauche.addEventListener("mouseout", () => 
    {
        cible_span_aperçu.innerHTML = ""
    });

    cible_fleche_droite.addEventListener("mouseover", () => 
    {
        cible_span_aperçu.innerHTML = photo_suivante
    });

    cible_fleche_droite.addEventListener("mouseout", () => 
    {
        cible_span_aperçu.innerHTML = ""
    });


    // Gestion des cliques et chargement de la page grâce aux permaliens
    cible_fleche_gauche.addEventListener("click", () => 
    {
        window.location.href = lien_precedent
    });

    cible_fleche_droite.addEventListener("click", () => 
    {
        window.location.href = lien_suivant
    });

/* Fin aperçu de la vignette et liens interactifs */