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


(function($){
    $(document).ready(function() {
        $("button").click(function(){
            // Récupérer la référence de la photo
            var divContent = $('#ref-photo').text();
            
            // Ajouter une class pour afficher popup
            let popup = document.getElementById('popup-contact');
            popup.classList.add("popup-overlay-visible");

            // Insérer la valeur de la référence dans le forùmulaire de contact
            document.getElementById("reference").value = divContent;
            
          });
    });
})(jQuery);

// Changer opacité des images au survol sur les liens de navigation
function changeleft() {
    var l = document.getElementById("img-1");
    var m = document.getElementById("img-2");
    var d = document.getElementById("img-3");
    l.style.transition = 'opacity 1s';
    l.style.opacity = 1;
    m.style.transition = 'opacity 1s';
    m.style.opacity = 0;
    d.style.transition = 'opacity 1s';
    d.style.opacity = 0;
}
function changeright() {
    var l = document.getElementById("img-1");
    var m = document.getElementById("img-2");
    var d = document.getElementById("img-3");
    l.style.transition = 'opacity 1s';
    l.style.opacity = 0;
    m.style.transition = 'opacity 1s';
    m.style.opacity = 0;
    d.style.transition = 'opacity 1s';
    d.style.opacity = 1;
}
function changeBack() {
    var l = document.getElementById("img-1");
    var m = document.getElementById("img-2");
    var d = document.getElementById("img-3");
    l.style.opacity = 0;
    m.style.opacity = 1;
    d.style.opacity = 0;
}