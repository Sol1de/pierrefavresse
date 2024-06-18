<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pierrefavresse
 */

get_header();
?>

<main id="primary" class="site-main">

    <div class="landing-branding">
        <div class="landing-branding-title">
            <h1 class="landing-branding-title-we">WE</h1>
            <h1 class="landing-branding-title-texte"></h1>
            <span class="landing-branding-title-cursor">|</span>
        </div>

        <div class="landing-branding-subtitle">
            <h3 class="landing-branding-subtitle-paragraph">Design & Research Studio <br> Paris</h3>
        </div>
    </div>

    <div class="landing-projects">
        <?php
        // Récupération du type de catégorie à filtrer depuis l'URL
        $type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : 'all';

        // Arguments pour WP_Query
        $args = array(
            'post_type' => 'categories',  // Remplacez 'categories' par votre type de contenu personnalisé
            'posts_per_page' => -1,  // Enlever la limite de posts
            'tax_query' => array(
                array(
                    'taxonomy' => 'type_de_categorie',  // Remplacez 'type_de_categorie' par votre nom de taxonomie
                    'field' => 'slug',
                    'terms' => $type,
                ),
            ),
        );

        // La requête WP_Query
        $query = new WP_Query($args);

        // La boucle
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('project-item'); ?>>
                    <header class="entry-header">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                    </header>

                    <div class="entry-content">
                        <?php the_post_thumbnail(); ?>
                    </div>
                </article><!-- #post-<?php the_ID(); ?> -->

        <?php
            endwhile;

            // Réinitialiser les données de post
            wp_reset_postdata();
        else :
            // Si aucun post n'est trouvé
            echo '<p>Aucun projet trouvé</p>';
        endif;
        ?>
    </div>

</main><!-- #main -->

<?php
get_footer();
?>