<div class="overlay-image">
    <img class="photo-card" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" alt="<?php the_title(); ?>" />
    <div class="hover">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <img class="icone-oeil" src="<?= get_stylesheet_directory_uri() . "/assets/images/Icon_eye.png" ?>">
        </a>
        <a href="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" class="js-load-lightbox" title="Agrandir la photo">
            <img class="icone-fullscreen" src="<?= get_stylesheet_directory_uri() . "/assets/images/Icon_fullscreen.png" ?>">
        </a>
        <p class="txt-ref">
            <?php the_field('reference'); ?>
        </p>
        <p class="txt-categ">
            <?php
            $categ = get_the_terms( get_the_ID(), 'categorie' );
            $categ = join(', ', wp_list_pluck( $categ , 'name') );
            echo $categ;
            ?>
        </p>
    </div>

</div>