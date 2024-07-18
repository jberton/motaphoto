(function ($) {
  $(document).ready(function () {
      console.log('Le script JS a bien été chargé');
      
      // Lancer le sript au clic sur Charger plus
      document.querySelector('.js-load-photos').addEventListener('click', function(e) {

            // Empêcher l'envoi classique du formulaire
            e.preventDefault();

            // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <button>
            const ajaxurl = $(this).data('ajaxurl');

            // Les données de notre formulaire
			      // ⚠️ Ne changez pas le nom "action" !
            const data = {
                action: $(this).data('action'), 
                nonce:  $(this).data('nonce'),
                postid: $(this).data('postid'),
                postcateg: $(this).data("id"),
            }

            // Pour vérifier qu'on a bien récupéré les données
            console.log(ajaxurl);
            console.log(data);

            // Requête Ajax en JS natif via Fetch
            fetch(ajaxurl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Cache-Control': 'no-cache',
                },
                body: new URLSearchParams(data),
            })
            .then(response => response.json())
            .then(body => {
                console.log(body);

                // En cas d'erreur
                if (!body.success) {
                    alert(response.data);
                    return;
                }

                // Et en cas de réussite
                if((data.currentpage)+1 === data.maxpage){
                    $(this).hide(); // Cacher le button si aucune photo supplémentaire à afficher
                }

                let nextpage = (data.currentpage)+1;
                $('.js-load-photos')[0].setAttribute('data-currentpage', nextpage); // Passer la variable current page
                $('.home-photos').html(body.data); // Et afficher le HTML
                
                // Recharger le fichier JS pour enregistrer les évènements
                var url = window.location.href;
                $.getScript(url+"wp-content/themes/motaphoto/assets/js/lightbox.js?ver=1.0");
                
            });
        });
        
    });
})(jQuery);


(function ($) {
  $(document).ready(function () {
      console.log('Le script JS a bien été chargé - Catégorie');
      
      // Lancer le sript après le choix d'une catégorie
      $("#menu-class-1 li").on('click', function() {
        
        //alert($(this).data("id"));

        // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <button>
        const ajaxurl = $(this).data('ajaxurl');

        // Les données de notre formulaire
        // ⚠️ Ne changez pas le nom "action" !
        const data = {
            action: $(this).data('action'), 
            nonce:  $(this).data("nonce"),
            postid: $(this).data('postid'),
            postcateg: $(this).data("id"),
            postformat: $('#btnform').text(),
            postorder: $('#btntri').text(),
        }

        // Pour vérifier qu'on a bien récupéré les données
        console.log(ajaxurl);
        console.log(data);

        // Requête Ajax en JS natif via Fetch
        fetch(ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Cache-Control': 'no-cache',
            },
            body: new URLSearchParams(data),
        })
        .then(response => response.json())
        .then(body => {
            console.log(body);

            // En cas d'erreur
            if (!body.success) {
                alert(response.data);
                return;
            }

            // Et en cas de réussite
            if((data.currentpage)+1 === data.maxpage){
                $('.js-load-photos').hide(); // Cacher le button si aucune photo supplémentaire à afficher
            }

            $('.home-photos').html(body.data); // Et afficher le HTML

            // Recharger le fichier JS pour enregistrer les évènements
            var url = window.location.href;
            $.getScript(url+"wp-content/themes/motaphoto/assets/js/lightbox.js?ver=1.0");
        });
  });

    });
})(jQuery);


(function ($) {
    $(document).ready(function () {
        console.log('Le script JS a bien été chargé - format');
        
        // Lancer le sript après le choix d'un format
        $("#menu-class-2 li").on('click', function() {
          
          // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <button>
          const ajaxurl = $(this).data('ajaxurl');
  
          // Les données de notre formulaire
          // ⚠️ Ne changez pas le nom "action" !
          const data = {
              action: $(this).data('action'), 
              nonce:  $(this).data("nonce"),
              postid: $(this).data('postid'),
              postcateg: $('#btncat').text(),
              postformat: $(this).data("id"),
              postorder: $('#btntri').text(),
          }
  
          // Pour vérifier qu'on a bien récupéré les données
          console.log(ajaxurl);
          console.log(data);
  
          // Requête Ajax en JS natif via Fetch
          fetch(ajaxurl, {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded',
                  'Cache-Control': 'no-cache',
              },
              body: new URLSearchParams(data),
          })
          .then(response => response.json())
          .then(body => {
              console.log(body);
  
              // En cas d'erreur
              if (!body.success) {
                  alert(response.data);
                  return;
              }
  
              // Et en cas de réussite
              $('.home-photos').html(body.data); // Et afficher le HTML

            // Recharger le fichier JS pour enregistrer les évènements
            var url = window.location.href;
            $.getScript(url+"wp-content/themes/motaphoto/assets/js/lightbox.js?ver=1.0");
          });
    });
  
      });
  })(jQuery);

  (function ($) {
    $(document).ready(function () {
        console.log('Le script JS a bien été chargé - date');
        
        // Lancer le sript après le choix d'un tri par date
        $("#menu-class-3 li").on('click', function() {
          
          // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <button>
          const ajaxurl = $(this).data('ajaxurl');
  
          // Les données de notre formulaire
          // ⚠️ Ne changez pas le nom "action" !
          const data = {
              action: $(this).data('action'), 
              nonce:  $(this).data("nonce"),
              postid: $(this).data('postid'),
              postcateg: $('#btncat').text(),
              postformat: $('#btnform').text(),
              postorder: $(this).data("id"),
          }
  
          // Pour vérifier qu'on a bien récupéré les données
          console.log(ajaxurl);
          console.log(data);
  
          // Requête Ajax en JS natif via Fetch
          fetch(ajaxurl, {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded',
                  'Cache-Control': 'no-cache',
              },
              body: new URLSearchParams(data),
          })
          .then(response => response.json())
          .then(body => {
              console.log(body);
  
              // En cas d'erreur
              if (!body.success) {
                  alert(response.data);
                  return;
              }
  
              // Et en cas de réussite
              $('.home-photos').html(body.data); // Et afficher le HTML

            // Recharger le fichier JS pour enregistrer les évènements
            var url = window.location.href;
            $.getScript(url+"wp-content/themes/motaphoto/assets/js/lightbox.js?ver=1.0");
          });
    });
  
      });
  })(jQuery);