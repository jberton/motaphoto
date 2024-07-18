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

// Insérer la référence de la photo dans le formulaire de contact
(function($){
    $(document).ready(function() {
        $("#contact-ref").click(function(){
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

// Afficher ou masquer les menus déroulants
(function($){
    $(document).ready(function() {
        // Définir les variables
            // Menu 1 Catégories - Récupérer la class pour savoir si menu est affiché ou masqué
            let menu1 = document.getElementById("menu-class-1");
            let fleche1 = document.getElementById("menu-f-1");
        // Menu 2 Formats - Récupérer la class pour savoir si menu est affiché ou masqué
            let menu2 = document.getElementById("menu-class-2");
            let fleche2 = document.getElementById("menu-f-2");
        // Menu 3 Trier par - Récupérer la class pour savoir si menu est affiché ou masqué
            let menu3 = document.getElementById("menu-class-3");
            let fleche3 = document.getElementById("menu-f-3");

        $("#menu-d-1").click(function(){
            // Changer la class + pivoter la fleche vers le haut ou vers le bas
            if (menu1.className === "hide") {
                menu1.classList.replace("hide", "visible");
                fleche1.classList.replace("flechebas", "flechehaut");
              } else {
                menu1.classList.replace("visible", "hide");
                fleche1.classList.replace("flechehaut", "flechebas");
              }
        });
          
        $("#menu-d-2").click(function(){
            // Changer la class + pivoter la fleche vers le haut ou vers le bas
            if (menu2.className === "hide") {
                menu2.classList.replace("hide", "visible");
                fleche2.classList.replace("flechebas", "flechehaut");
                } else {
                menu2.classList.replace("visible", "hide");
                fleche2.classList.replace("flechehaut", "flechebas");
                }
        });

        $("#menu-d-3").click(function(){
            // Changer la class + pivoter la fleche vers le haut ou vers le bas
            if (menu3.className === "hide") {
                menu3.classList.replace("hide", "visible");
                fleche3.classList.replace("flechebas", "flechehaut");
                } else {
                menu3.classList.replace("visible", "hide");
                fleche3.classList.replace("flechehaut", "flechebas");
                }
        });

        // Si clic sur item du menu déroulant Catégories
        $('.clicmenu1').click(function(event){
            // Annuler l'action du lien vers la page contact
            event.preventDefault();
            // Afficher la valeur sélectionnée sur le bouton du menu déroulant
            $valueselected = $(this).attr('data-value');
                if ($valueselected === undefined) {
                    document.getElementById('btncat').innerText = "CATÉGORIES";
                }
                else {
                    document.getElementById('btncat').innerText = $valueselected;
                }
            // Changer la class + pivoter la fleche vers le haut ou vers le bas
            menu1.classList.replace("visible", "hide");
            fleche1.classList.replace("flechehaut", "flechebas");
        });

        // Si clic sur item du menu déroulant Formats
        $('.clicmenu2').click(function(event){
            // Annuler l'action du lien vers la page contact
            event.preventDefault();
            // Afficher la valeur sélectionnée sur le bouton du menu déroulant
            $valueselected = $(this).attr('data-value');
                if ($valueselected === undefined) {
                    document.getElementById('btnform').innerText = "FORMATS";
                }
                else {
                    document.getElementById('btnform').innerText = $valueselected;
                }
            // Changer la class + pivoter la fleche vers le haut ou vers le bas
            menu2.classList.replace("visible", "hide");
            fleche2.classList.replace("flechehaut", "flechebas");
        });

        // Si clic sur item du menu déroulant Trier par
        $('.clicmenu3').click(function(event){
            // Annuler l'action du lien vers la page contact
            event.preventDefault();
            // Afficher la valeur sélectionnée sur le bouton du menu déroulant
            $valueselected = $(this).attr('data-value');
                if ($valueselected === undefined) {
                    document.getElementById('btntri').innerText = "TRIER PAR";
                }
                else {
                    document.getElementById('btntri').innerText = $valueselected;
                }
            // Changer la class + pivoter la fleche vers le haut ou vers le bas
            menu3.classList.replace("visible", "hide");
            fleche3.classList.replace("flechehaut", "flechebas");
        });


    });
})(jQuery);