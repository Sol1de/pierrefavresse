<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package pierreFavresse
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', get_post_type() );

        // Affiche les images annexes avec les tailles sélectionnées
        $images_supplementaire = get_field('images_supplementaire');
        if ($images_supplementaire) :
            // Diviser les images en deux listes
            $half = ceil(count($images_supplementaire) / 2);
            $first_half = array_slice($images_supplementaire, 0, $half);
            $second_half = array_slice($images_supplementaire, $half);

            echo '<div class="post-images">';
            
            // Premier conteneur
            echo '<div class="post-images-column">';
            foreach ($first_half as $index => $image_data) :
                $image = $image_data['image'];
                $size = $image_data['hauteur'] ? $image_data['hauteur'] : '435px';
                $image_url = wp_get_attachment_image_src($image['ID'], $size);
                
                if ($image_url) {
                    echo '<div class="post-images-column-container post-image-' . $index . '">';
                    echo '<img src="' . esc_url($image_url[0]) . '" alt="' . esc_attr($image['alt']) . '" />';
                    echo '</div>';
                }
            endforeach;
            echo '</div>';

            // Deuxième conteneur
            echo '<div class="post-images-column">';
            foreach ($second_half as $index => $image_data) :
                $image = $image_data['image'];
                $size = $image_data['hauteur'] ? $image_data['hauteur'] : '435px';
                $image_url = wp_get_attachment_image_src($image['ID'], $size);
                
                if ($image_url) {
                    echo '<div class="post-images-column-container post-image-' . ($index + $half) . '">';
                    echo '<img src="' . esc_url($image_url[0]) . '" alt="' . esc_attr($image['alt']) . '" />';
                    echo '</div>';
                }
            endforeach;
            echo '</div>';

            echo '</div>';
        endif;

        the_post_navigation(
            array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'pierrefavresse' ) . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'pierrefavresse' ) . '</span> <span class="nav-title">%title</span>',
            )
        );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
?>
