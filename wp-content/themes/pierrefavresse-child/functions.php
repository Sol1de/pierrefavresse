<?php

function mes_styles() {
    // CSS THEME PARENT
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'mes_styles');

function wpb_hook_javascript() {
    if (is_home()) { 
        ?>
        <script type="text/javascript" src="wp-content/themes/pierrefavresse-child/js/script.js"></script>
        <script type="text/javascript" src="wp-content/themes/pierrefavresse-child/js/chargementPosts.js"></script>
        <?php
    }
}
add_action('wp_footer', 'wpb_hook_javascript');

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

    // Fermer le CSS
    $custom_css .= "</style>";

    // Réinitialiser les données de post
    wp_reset_postdata();

    // Injecter le CSS dans le <head>
    echo $custom_css;
}
add_action('wp_head', 'inject_custom_post_heights');

?>