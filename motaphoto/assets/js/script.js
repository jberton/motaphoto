// Code Javascript pour afficher la popup de contact
    let element = document.getElementById('menu-item-12');
    element.addEventListener("click", show_popup);
    
    function show_popup(event) {
        // Annuler l'action du lien vers la page contact
        event.preventDefault();
        // Ajouter une class pour afficher popup
        let popup = document.getElementById('popup-contact');
        popup.classList.add("popup-overlay-visible");
    }

// Code Javascript pour fermer la popup de contact
        // Soumission du formulaire avec succès
        var wpcf7Elm = document.querySelector( '.wpcf7' );
        wpcf7Elm.addEventListener('wpcf7mailsent', function() {
            // Retirer la class pour masquer popup
            let popup = document.getElementById('popup-contact');
            popup.classList.remove("popup-overlay-visible");
        }, false );
        // clic en dehors de la zone
        (function($){
            $(document).ready(function() {
                $(document).on("click",function(e){
                    if(e.target.id != "popup-container" && e.target.id == "popup-contact"){
                        // Retirer la class pour masquer popup
                        let popup = document.getElementById('popup-contact');
                        popup.classList.remove("popup-overlay-visible");
                    }
                });
            });
        })(jQuery);

// Afficher ou masquer le menu en version mobile
const burger = document.querySelector('.burger');
const navLinks = document.querySelector('.navbar-nav');
const body = document.querySelector('body');

burger.addEventListener('click', () => {
    navLinks.classList.toggle('nav-active');
    // Bloquer le scroll
    body.classList.toggle('fixed-position');
    // Animer le burger
    burger.classList.toggle('toggle');
});





