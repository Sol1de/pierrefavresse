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
); ?>
