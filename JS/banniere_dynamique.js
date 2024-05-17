/* Permet de modifier aléatoirement l'image de la bannière */
console.log("Le javascript pour la bannière est chargé !")
let cible_banniere = document.querySelector('.banniere');

// Dès que la page est chargée
window.addEventListener("load", (event) => {
    cible_banniere.style.backgroundImage="url(" + image_banniere + ")"
  });