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
            'post_type' => 'categories',
            'posts_per_page' => -1,
        );

        if ($type !== 'all') {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'type_de_categorie',
                    'field' => 'slug',
                    'terms' => $type,
                ),
            );
        }

        // La requête WP_Query
        $query = new WP_Query($args);

        // Posts publiés séparer en 2 listes distinctes
        $even_posts = [];
        $odd_posts = [];

        //nombre total de post contenu dans la requête
        $post_count = $query->found_posts;

        // La boucle pour séparer les posts
        if ($query->have_posts()) :
            $count = 0;

            while ($query->have_posts()) : $query->the_post();
                if ($count < ($post_count / 2)) {
                    $even_posts[] = $post;
                } else {
                    $odd_posts[] = $post;
                }
                $count++;
            endwhile;

            // Réinitialiser les données de post
            wp_reset_postdata();
        else :
            // Si aucun post n'est trouvé
            echo '<p>Aucun projet trouvé</p>';
        endif;
        ?>

        <!-- Premier appel de WP_Query pour la première moitier des posts publié -->
        <div class="landing-projects-column">
            <?php
            if (!empty($even_posts)) :
                foreach ($even_posts as $post) :
                    setup_postdata($post);
            ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('landing-projects-column-post project-item'); ?>>
                        <div class="landing-projects-column-post-content">
                            <div class="landing-projects-column-post-content-image">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <h2 class="landing-projects-column-post-content-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                        </div>
                    </article><!-- #post-<?php the_ID(); ?> -->
            <?php
                endforeach;
                wp_reset_postdata();
            else :
                echo '<p>Aucun projet trouvé</p>';
            endif;
            ?>
        </div>

        <!-- Deuxième appel de WP_Query pour la deuxième moitier des posts publié -->
        <div class="landing-projects-column">
            <?php
            if (!empty($odd_posts)) :
                foreach ($odd_posts as $post) :
                    setup_postdata($post);
            ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('landing-projects-column-post project-item'); ?>>
                        <div class="landing-projects-column-post-content">
                            <div class="landing-projects-column-post-content-image">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <h2 class="landing-projects-column-post-content-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                        </div>
                    </article><!-- #post-<?php the_ID(); ?> -->
            <?php
                endforeach;
                wp_reset_postdata();
            else :
                echo '<p>Aucun projet trouvé</p>';
            endif;
            ?>
        </div>

    </div>

</main><!-- #main -->

<?php
get_footer();
?>