jQuery(function ($) 
{ 
  $(document).ready(function () {
    
    function custom_Select(idselect , idoption, ignorer)
    {
      $(idselect).click(function () {
      $(this).find(idoption).css('border', 'solid 1.3px #215AFF')
      $(this).find(idoption).css('border-radius', '8px 8px 0 0')
      $(idselect).addClass('allume')
      });

      $(idselect).mouseleave(function () {
      $(idselect).removeClass('allume')
      });

      $(idselect).change(function () {
      ignorer = $(this).find('option:selected').val

      if (ignorer != "")
      {  
        $(this).find('option').css('background-color', 'white')
        $(this).find('option').css('color', '#313144')

        $(this).find('option:selected').css('background-color', '#E00000')
        $(this).find('option:selected').css('color', 'white')
      }
      else
      {
        $(this).find('option').css('background-color', 'white')
        $(this).find('option').css('color', '#313144')

        $(this).find('option:selected').css('background-color', 'white')
        $(this).find('option:selected').css('color', '#313144')
      }
            
      });
    }
    // On lance les fonctions pour customiser le menu select de nos filtres
    custom_Select('#select-categorie', '#cat', '')
    custom_Select('#select-format', '#format', '')
    custom_Select('#select-trie', '#trie', '')

  var page = 2 // Page courante
  var nbre = 8 // Post par page
  var cat = $('#select-categorie').val()
  var format = $('#select-format').val()
  var ordre = 'DESC' //Par défaut, on affiche les photos les plus récentes.
  
  var data = {
    'action': 'charger_demarrage',
    'page': page,
    'nbre': nbre,
    'security': demarrage.security, // Clé de sécuité pour authentifier la transaction
  }  

  $.post(demarrage.ajaxurl, data, function(response)
  {
    if($.trim(response) != 0) // Si ajax envoi quelque chose
    {
      $('.contenaire-requete').html(response)// On ajoute le résultat de la requête dans le contenaire ciblé sans tout rafraîchir !
      $('#charger-plus').html('Charger plus !')
      page = 1; // Au démarrage, la page repart à un.
    }
  
    else 
    {
      $('#charger-plus').html('Tout est chargé !') 
    }
  });

  // Cette fonction permet de charger plus de post lorsqu'on clique sur le bouton id='charger-plus'
  $('#charger-plus').click(function (e) 
  {
    e.preventDefault()
    page++ // On charge les pages suivantes.

    var data = {
    'action': 'charger_plus_ajax',
    'page': page,
    'cat': cat,
    'format': format,
    'ordre': ordre,
    'nbre': nbre,
    'security': blog.security, // Clé de sécurité pour authentifier la transaction 
    };

    $.post(blog.ajaxurl, data, function(response){
    if($.trim(response) != 0) // Si ajax envoi quelque chose
    {
      $('.contenaire-requete').append(response);// On ajoute le résultat de la requête dans le contenaire ciblé sans tout rafraîchir !
    }
  
    else 
    {
      $('#charger-plus').html('Tout est chargé !') // Si on a tout chargé, le bouton l'indique.
    }
  
      });
    });

    // Cette fonction permet de filtrer par catégorie lorsqu'on sélectionne une catégorie spécifique. 
    $('.contenaire-filtre select').on('change', function () {
    cat = $('#select-categorie').val()
    format = $('#select-format').val()
    ordre = $('#select-trie').val()

    page = 1 // On retourne sur la page 1 à chaque fois que le filtre est actif.

    var data = 
    {
      action: 'filter_photo',
      cat: cat,
      format: format,
      ordre: ordre,
      page: page,
      nbre: nbre,
    }

    $.ajax ({
      url: varcat.ajax_url,
      type: 'POST',
      data: data,
      success: function (response)
      {
        $('.contenaire-requete').html(response)
        $('#charger-plus').html('Charger plus !') // On change l'intitulé du bouton.
      }

    })
    });
  });

});
