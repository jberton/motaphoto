(function ($) {
    $(document).ready(function () {

// Gestion de la lightbox
/**
 * @property {HTMLElement} element
 * @property {string[]} images tableau de chaines de caractères avec les chemins des images de la lightbox
 * @property {string} url chaine de caractère de l'image actuellement chargée (récupérer la position actuelle pour afficher suivante ou précédente)
 */
class lightbox {
    // Méthode pour initialiser la lightbox
    static init(){
        // Sélectionner tous les liens qui mènent vers des photos        
            const links = Array.from(document.querySelectorAll(".js-load-lightbox"));
            // Créer une variable pour stocker tous les liens des photos
            const gallery = links.map(link => link.getAttribute('href'));

            for (let i = 0; i < links.length; i++) {
                links[i].addEventListener("click", function(e) {
                    
                // Annuler l'action du href
                e.preventDefault();          
                // Initialiser une nouvelle lightbox avec l'url du lien cliqué
                new lightbox(e.currentTarget.getAttribute('href'),gallery);
                });
            }
        }

        // Construire la structure html de la lightbox qui prend en paramètre l'url de l'image
        /**
         * @param {string} url url de l'image
         * @param {string[]} images chemins des images de la lightbox
         */
        constructor(url, images){
            this.element = this.buildDOM(url);
            this.loadImage(url);
            // Passer le paramètre images pour pouvoir naviguer dans le tableau des images et afficher la suivante ou précédente
            this.images = images;
            this.onKeyUp = this.onKeyUp.bind(this);
            // Intégrer la lightbox dans un template à l'intérieur du footer
            document.getElementById("lightbox").appendChild(this.element);
            // Ajouter un écouteur d'évènement pour la fermeture sur echap au clavier
            document.addEventListener('keyup', this.onKeyUp);
        }

    // Fonction pour charger le loader et afficher l'image une fois chargée
        /**
         * @param {string} url url de l'image
         */
        loadImage (url) {
            this.url = null; // pas d'image chargée
            const image = new Image();
            const container = this.element.querySelector(".lightbox__container");
            // créer le html du loader
            const loader = document.createElement('div');
            loader.classList.add('lightbox__loader');
            container.innerHTML = ''; // pour vider l'image déjà chargée
            container.appendChild(loader);
            image.onload = () => {
                container.removeChild(loader);
                container.appendChild(image);

                // créer le html de la référence et catégorie
                const infos = document.createElement('div');
                infos.classList.add('lightbox__infos');
                var refHTML = '<p class="lightbox__ref">Référence de la photo</p>';
                var categHTML = '<p class="lightbox__categ">Catégorie</p>';
                container.appendChild(infos);
                infos.append($(refHTML)[0]);
                infos.append($(categHTML)[0]);

                // définir la largeur du containeur lightbox__infos en fonction de la taille de l'image
                var widthimg = $(".lightbox__container img").width();
                console.log(widthimg);
                $(".lightbox__infos").css('width', widthimg);
                this.url = url; // url passée en paramètre lorsque l'image est chargée
            }
            image.src = url;
        }

        /**
         * Fermer la lightbox au clic sur echap au clavier + navigation au clavier image suivante ou précédente
         * @param {KeyboardEvent}
         */
        onKeyUp (e) {
            if (e.key === 'Escape'){
                this.close(e);
            } else if (e.key === 'ArrowLeft'){
                this.prev(e);
            } else if (e.key === 'ArrowRight'){
                this.next(e);
            } 
        }


    // Créer la fonction de fermeture de la lightbox
        /**
         * Fermer la lightbox au clic sur la croix
         * @param {MouseEvent}
         */
        close(e){
            // Annuler l'action du href
            e.preventDefault();
            // Ajouter une class pour un effet de fermeture
            this.element.classList.add('fadeOut');
            // Supprimer la lightbox au bout de 0.5s
            window.setTimeout(() => {
                this.element.parentElement.removeChild(this.element)
            },500);
            // Supprimer l'évènement pour ne pas qu'il reste en mémoire
            document.removeEventListener('keyup', this.onKeyUp);
        }

    // Créer la fonction image suivante
        /**
         * Afficher image suivante au clic sur la fleche et avec le clavier
         * @param {MouseEvent|KeyboardEvent}
         */
            next(e){
                // empecher le comportement initial
                e.preventDefault();
                // parcourir le tableau des images et afficher l'image suivante
                    // trouver la position de l'image actuelle pour l'incrémenter
                    let i = this.images.findIndex(image => image === this.url);
                    // Si on est sur la dernière image
                    if (i === this.images.length - 1){
                        i = -1; //on revient à la première image
                    }
                    this.loadImage(this.images[i + 1]);
            }

    // Créer la fonction image précédente
        /**
         * Afficher image suivante au clic sur la fleche et avec le clavier
         * @param {MouseEvent|KeyboardEvent}
         */
        prev(e){
                // empecher le comportement initial
                e.preventDefault();
                // parcourir le tableau des images et afficher l'image suivante
                    // trouver la position de l'image actuelle pour l'incrémenter
                    let i = this.images.findIndex(image => image === this.url);
                    // Si on est sur la première image
                    if (i === 0){
                        i = this.images.length; //on va à la dernière image
                    }
                    this.loadImage(this.images[i - 1]);
        }

        // Construire la structure html de la lightbox qui prend en paramètre l'url de l'image et retrouner du HTML
        /**
         * @param {string} url url de l'image
         * @return {HTMLElement}
         */
        buildDOM(url){
            const dom = document.createElement('div');
            dom.classList.add('lightbox');
            dom.innerHTML = `<button class="lightbox__close">Fermer</button>
                    <button class="lightbox__next"><span>Suivante</span></button>
                    <button class="lightbox__prev"><span>Précédente</span></button>
                    <div class="lightbox__container">
                        <p class="lightbox__ref">Référence de la photo</p>
                        <p class="lightbox__categ">Catégorie</p>
                    </div>`
            // Gérer l'évènement du bouton de fermeture et appeler la fonction close
            dom.querySelector('.lightbox__close').addEventListener('click',this.close.bind(this));
            // Gérer l'évènement du bouton image suivante et appeler la fonction next
            dom.querySelector('.lightbox__next').addEventListener('click',this.next.bind(this));
            // Gérer l'évènement du bouton image précédente et appeler la fonction prev
            dom.querySelector('.lightbox__prev').addEventListener('click',this.prev.bind(this));
            return dom;
        }

}
/** Code html de la lightbox
<div class="lightbox">
    <button class="lightbox__close">Fermer</button>
    <button class="lightbox__next"><span>Suivante</span></button>
    <button class="lightbox__prev"><span>Précédente</span></button>
    <div class="lightbox__container">
        <img src="<?= get_stylesheet_directory_uri() . "/assets/images/nathalie-11.webp" ?>" alt="Lightbox">
        <p class="lightbox__ref">Référence de la photo</p>
        <p class="lightbox__categ">Catégorie</p>
    </div>
</div>
*/

// Initialiser la lightbox au chargement de la page
lightbox.init();


    });
})(jQuery);