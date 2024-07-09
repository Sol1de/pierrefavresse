<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pierreFavresse
 */

?>

<article id="post-<?php the_ID(); ?>" class="post" <?php post_class(); ?>>

    <?php pierrefavresse_post_thumbnail(); ?>

    <div class="post-content">
        <?php
        // Title of the post
        if ( is_singular() ) :
            the_title( '<h1 class="post-content-title">', '</h1>' );
        else :
            the_title( '<h2 class="post-content-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        // Content of the post encapsulated in #custom-content
        echo '<div class="post-content-paragraph">';
        the_content();
        echo '</div>';

        // Links to other posts
        //wp_link_pages(
        //    array(
        //        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pierrefavresse' ),
        //        'after'  => '</div>',
        //    )
        //);
        ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->