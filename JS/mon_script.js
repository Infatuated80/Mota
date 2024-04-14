// Inclure les scripts JS
console.log("Le javascript fonctionne correctement !")

// On cible la croix du formulaire de contact.
let cible_croix = document.querySelector(".contact-close")
let cible_contact_modal = document.querySelector(".contact-modal")
let cible_contact_li = document.querySelector('#menu-item-11'); //En inspectant, on trouve le id du li de contact.

// Lorsqu'on clique sur la croix, la modale de contact disparait.
cible_croix.addEventListener("click", () => 
{
    console.log("Tu cliques sur la croix !")   
    cible_contact_modal.classList.remove("contact-modal-apparait") 
    cible_contact_modal.classList.add("contact-modal-disparait") 
});

cible_contact_li.addEventListener("click", () => 
{
    cible_contact_modal.classList.remove("contact-modal-disparait") 
    cible_contact_modal.classList.add("contact-modal-apparait")
});