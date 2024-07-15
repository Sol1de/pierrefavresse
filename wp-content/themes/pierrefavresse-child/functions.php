<?php

function mes_styles() {
    // CSS THEME PARENT
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'mes_styles');

function enqueue_custom_scripts() {
    if (is_single()){
        wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/script.js', array(), null, true);
    }
    else {
        wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/script.js', array(), null, true);
        wp_enqueue_script('custom-chargementPosts', get_stylesheet_directory_uri() . '/js/chargementPosts.js', array(), null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

register_nav_menus(
    array(
        'header' => 'Header - Menu du header',
        'footer' => 'Footer - Menu du footer',
    )
);

// Fonction pour injecter du CSS personnalisé pour les hauteurs des conteneurs
function inject_custom_post_heights() {
    // Obtenir tous les posts personnalisés
    $args = array(
        'post_type' => 'categories',
        'posts_per_page' => -1
    );
    $query = new WP_Query($args);

    // Commencer à construire le CSS
    $custom_css = "<style type='text/css'>";

    if ($query->have_posts()) {
        if (is_home()){
            while ($query->have_posts()) {
                $query->the_post();
                $post_id = get_the_ID();
                $height = get_field('hauteur_du_post', $post_id);

                if ($height) {
                    $custom_css .= "
                        #post-$post_id {
                            height: $height;
                        }
                    ";
                }
            }
        }       
    }

    // Fermer le CSS
    $custom_css .= "</style>";

    // Réinitialiser les données de post
    wp_reset_postdata();

    // Injecter le CSS dans le <head>
    echo $custom_css;
}
add_action('wp_head', 'inject_custom_post_heights');

function inject_custom_image_sizes() {
    if (is_single()) {
        global $post;
        $images_supplementaire = get_field('images_supplementaire', $post->ID);

        // Commencer à construire le CSS
        $custom_css = "<style type='text/css'>";

        if ($images_supplementaire) {
            foreach ($images_supplementaire as $index => $image_data) {
                $image_id = $image_data['image']['ID'];
                $size = $image_data['hauteur'];

                if ($size) {
                    $custom_css .= "
                        .post-image-$index {
                            height: $size;
                        }
                    ";
                }
            }
        }

        // Fermer le CSS
        $custom_css .= "</style>";

        // Injecter le CSS dans le <head>
        echo $custom_css;
    }
}
add_action('wp_head', 'inject_custom_image_sizes');